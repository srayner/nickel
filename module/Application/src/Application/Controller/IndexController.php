<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $staffService = $this->getServiceLocator()->get('nickel_staff_service');
        return array(
            'staffCount' => $staffService->countStaff()
        );
    }
    
    
}
