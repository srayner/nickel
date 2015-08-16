<?php

namespace Nickel\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class PlannerController extends AbstractActionController
{
    private $staffService;
    
    private function getStaffService()
    {
        if (null === $this->staffService) {
            $this->staffService = $this->getServiceLocator()->get('nickel_staff_service');
        }
        return $this->staffService;
    }
    
    public function indexAction()
    {
        $staff = $this->getStaffService()->getActiveStaff();
        return array(
            'staff' => $staff
        );
    }
}