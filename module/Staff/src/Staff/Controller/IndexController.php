<?php

namespace Staff\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
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
        return new ViewModel();
    }
    
    public function addAction()
    {
        // Create new form and hydrator instances.
        $form = $this->getServiceLocator()->get('nickel_staff_form');
        $formHydrator = $this->getServiceLocator()->get('nickel_form_hydrator');
         
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // POST, so check if valid.
            $data = (array) $request->getPost();
          
            // Create a new staff object.
            $staff = $this->getServiceLocator()->get('nickel_staff');
            
            $form->setHydrator($formHydrator);
            $form->bind($staff);
            $form->setData($data);
            if ($form->isValid())
            {
          	// Persist staff.
            	$this->getStaffService()->persist($staff);
                
            	// Redirect to list of staff
		return $this->redirect()->toRoute('staff/default', array(
		    'action' => 'index'
		));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return array(
            'form' => $form,
        );
    }
    
    public function editAction()
    {
        return new ViewModel();
    }
    
    public function deleteAction()
    {
        return new ViewModel();
    }
}


