<?php
return array(
    
    // Router
    'router' => array(
        'routes' => array(
            'nickel' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Nickel\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => ':controller[/:action[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'gettingstarted' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/gettingstarted',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Nickel\Controller',
                        'controller' => 'index',
                        'action' => 'gettingstarted',
                    ),
                ),
            ),
        ),
    ),
    
    // Controllers
    'controllers' => array(
        'invokables' => array(
            'Nickel\Controller\Index'    => 'Nickel\Controller\IndexController',
            'Nickel\Controller\Staff'    => 'Nickel\Controller\StaffController',
            'Nickel\Controller\Customer' => 'Nickel\Controller\CustomerController',
            'Nickel\Controller\Job'      => 'Nickel\Controller\JobController',
            'Nickel\Controller\Location' => 'Nickel\Controller\LocationController',
            'Nickel\Controller\Planner'  => 'Nickel\Controller\PlannerController'
        ),
    ),
    
    // View manager
    'view_manager' => array(
        'template_map' => array(
            'error/403'               => __DIR__ . '/../view/error/403.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        
    ),
    
    // View helpers
    'view_helpers' => array(
        'invokables'=> array(
            'identity_view_helper' => 'Nickel\View\Helper\IdentityViewHelper'  
        )
    ),
    
    // Service manager
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
    
    // Navigation
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'nickel'
            ),
            array(
                'label' => 'Planner',
                'route' => 'nickel/default',
                'controller' => 'planner'
            ),
            array(
                'label' => 'Jobs',
                'route' => 'nickel/default',
                'controller' => 'job'
            ),
            array(
                'label' => 'Staff',
                'route' => 'nickel/default',
                'controller' => 'staff',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'nickel/default',
                        'controller' => 'staff',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'route' => 'nickel/default',
                        'controller' => 'staff',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'route' => 'nickel/default',
                        'controller' => 'customers',
                        'action' => 'delete',
                    ),
                ),
            ),
            array(
                'label' => 'Customers',
                'route' => 'nickel/default',
                'controller' => 'customer',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'nickel/default',
                        'controller' => 'customer',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'route' => 'nickel/default',
                        'controller' => 'customer',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'route' => 'nickel/default',
                        'controller' => 'customer',
                        'action' => 'customers',
                    ),
                ),
            ),
            array(
                'label' => 'Locations',
                'route' => 'nickel/default',
                'controller' => 'location'
            ),
        ),
    ),
    
    // Nickel config
    'nickel' => array(
        'staff_model_class'    => 'Nickel\Model\Staff\Staff',
        'customer_model_class' => 'Nickel\Model\Customer\Customer',
        'job_model_class'      => 'Nickel\Model\Job\Job',
        'location_model_class' => 'Nickel\Model\Location\Location',
        'staff_avatar_dir'     => 'img\avatar'
    ),
);

