<?php
return array(
    
    // Router
    'router' => array(
        'routes' => array(
            'staff' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/staff',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Staff\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action[/:id]]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'         => '[0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    
    // Controllers
    'controllers' => array(
        'invokables' => array(
            'Staff\Controller\Index' => 'Staff\Controller\IndexController'
        ),
    ),
    
    // View manager
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
);

