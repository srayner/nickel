<?php

namespace Nickel;

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
            'factories' => array(
                
                // Staff factories
                'nickel_staff_service' => function($sm) {
                    $service = new Service\StaffService;
                    $service->setStaffMapper($sm->get('nickel_staff_mapper'));
                    return $service;
                },
                'nickel_staff_mapper' => function($sm) {
                    $mapper = new Model\Staff\StaffMapper;
                    $mapper->setEntityPrototype($sm->get('nickel_staff'));
                    $mapper->setHydrator(new Model\Staff\StaffHydrator('Y-m-d'));
                    return $mapper;
                },
                'nickel_staff_form' => function ($sm) {
                    $form = new Form\StaffForm();
                    $form->setInputFilter(new Form\StaffFilter());
                    $form->setHydrator(new Model\Staff\StaffHydrator('d/m/Y'));
                    return $form;
                },
                'nickel_staff' => function($sm) {
                    $staffModelClass = Module::getOption('staff_model_class');
                    return new $staffModelClass;
                },
                        
                // Customer factories
                'nickel_customer_service' => function($sm) {
                    $service = new Service\CustomerService;
                    $service->setCustomerMapper($sm->get('nickel_customer_mapper'));
                    return $service;
                },
                'nickel_customer_mapper' => function($sm) {
                    $mapper = new Model\Customer\CustomerMapper;
                    $mapper->setEntityPrototype($sm->get('nickel_customer'));
                    $mapper->setHydrator(new Model\Customer\CustomerHydrator());
                    return $mapper;
                },
                'nickel_customer_form' => function ($sm) {
                    $form = new Form\CustomerForm();
                    $form->setInputFilter(new Form\CustomerFilter());
                    $form->setHydrator(new Model\Customer\CustomerHydrator());
                    return $form;
                },
                'nickel_customer' => function($sm) {
                    $customerModelClass = Module::getOption('customer_model_class');
                    return new $customerModelClass;
                },
                        
                // Location factories
                'nickel_location_service' => function($sm) {
                    $service = new Service\LocationService;
                    $service->setLocationMapper($sm->get('nickel_location_mapper'));
                    return $service;
                },
                'nickel_location_mapper' => function($sm) {
                    $mapper = new Model\Location\LocationMapper;
                    $mapper->setEntityPrototype($sm->get('nickel_location'));
                    $mapper->setHydrator(new Model\Location\LocationHydrator());
                    return $mapper;
                },
                'nickel_location_form' => function ($sm) {
                    $customers = $sm->get('nickel_customer_service')->getCustomers();
                    $form = new Form\LocationForm($customers);
                    $form->setInputFilter(new Form\LocationFilter());
                    $form->setHydrator(new Model\Location\LocationHydrator());
                    return $form;
                },
                'nickel_location' => function($sm) {
                    $locationModelClass = Module::getOption('location_model_class');
                    return new $locationModelClass;
                },
                        
                // Job factories
                'nickel_job_service' => function($sm) {
                    return new Service\JobService($sm->get('nickel_job_mapper'));
                },
                'nickel_job_mapper' => function($sm) {
                    $mapper = new Model\Job\JobMapper;
                    $mapper->setEntityPrototype($sm->get('nickel_job'));
                    $mapper->setHydrator(new Model\Job\JobHydrator('Y-m-d'));
                    return $mapper;
                },
                'nickel_job_form' => function ($sm) {
                    $staff = $sm->get('nickel_staff_service')->getStaff();
                    $locations = $sm->get('nickel_location_service')->getLocations();
                    $form = new Form\JobForm($locations, $staff);
                    $form->setInputFilter(new Form\JobFilter());
                    $form->setHydrator(new Model\Job\JobHydrator('d/m/Y'));
                    return $form;
                },
                'nickel_job' => function($sm) {
                    $jobModelClass = Module::getOption('job_model_class');
                    return new $jobModelClass;
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
        static::$options = $config['nickel'];
    }
    
    public static function getOption($option)
    {
        if (!isset(static::$options[$option])) {
            return null;
        }
        
        return static::$options[$option];
    }
}
