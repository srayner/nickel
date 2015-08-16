<?php

namespace Nickel\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function IndexAction()
    {   
        $staffService    = $this->getServiceLocator()->get('nickel_staff_service');
        $customerService = $this->getServiceLocator()->get('nickel_customer_service');
        $locationService = $this->getServiceLocator()->get('nickel_location_service');
        $jobService      = $this->getServiceLocator()->get('nickel_job_service');
        
        return array(
            'jobCount'      => $jobService->countJobs(),
            'staffCount'    => $staffService->countStaff(),
            'customerCount' => $customerService->countCustomers(),
            'locationCount' => $locationService->countLocations()
        );
    }
    
    public function gettingstartedAction()
    {
        return array();
    }
}