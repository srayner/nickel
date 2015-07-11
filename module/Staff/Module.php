<?php

namespace Staff;

use Zend\ModuleManager\ModuleManager;

class Module
{
    protected static $options;
    
    public function init(ModuleManager $moduleManager)
    {
        $moduleManager->getEventManager()->attach('loadModules.post', array($this, 'modulesLoaded'));
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'nickel_form_hydrator' => 'Zend\Stdlib\Hydrator\ClassMethods'
            ),
            'factories' => array(
                'nickel_staff_service' => function($sm) {
                    $service = new Service\Staff;
                    $service->setStaffMapper($sm->get('nickel_staff_mapper'));
                    return $service;
                },
                'nickel_staff_mapper' => function($sm) {
                    $mapper = new Model\Staff\StaffMapper;
                    $staffModelClass = Module::getOption('staff_model_class');
                    $mapper->setEntityPrototype(new $staffModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'nickel_staff_form' => function ($sm) {
                    $form = new Form\StaffForm();
                    $form->setInputFilter(new Form\StaffFilter());
                    return $form;
                },
                'nickel_staff' => function($sm) {
                    return new Model\Staff\Staff;
                },
            ),
            'initializers' => array(
                function($instance, $sm){
                    if($instance instanceof Service\DbAdapterAwareInterface){
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                        return $instance->setDbAdapter($dbAdapter);
                    }
                },
            ),
        );
                        
    }
    
    public function modulesLoaded($e)
    {
        $config = $e->getConfigListener()->getMergedConfig();
        static::$options = $config['nickel_staff'];
    }
    
    public static function getOption($option)
    {
        if (!isset(static::$options[$option])) {
            return null;
        }
        
        return static::$options[$option];
    }
}
