<?php

namespace Job;

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
                'nickel_job_service' => function($sm) {
                    $service = new Service\Job;
                    $service->setJobMapper($sm->get('nickel_job_mapper'));
                    return $service;
                },
                'nickel_job_mapper' => function($sm) {
                    $mapper = new Model\Job\JobMapper;
                    $mapper->setEntityPrototype($sm->get('nickel_job'));
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'nickel_job_form' => function ($sm) {
                    $form = new Form\JobForm();
                    $form->setInputFilter(new Form\JobFilter());
                    return $form;
                },
                'nickel_job' => function($sm) {
                    return new Model\Job\Job;
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
        static::$options = $config['nickel_job'];
    }
    
    public static function getOption($option)
    {
        if (!isset(static::$options[$option])) {
            return null;
        }
        
        return static::$options[$option];
    }
}
