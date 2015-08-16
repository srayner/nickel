<?php

namespace Nickel\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class StaffController extends AbstractActionController
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
        return array(
            'staff' => $this->getStaffService()->getStaff()
        );
    }
    
    public function addAction()
    {
        // Create new form instance.
        $form = $this->getServiceLocator()->get('nickel_staff_form');
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Bind the form to the staff entity, and set the data from post.
            $staff = $this->getServiceLocator()->get('nickel_staff');
            $form->bind($staff);
            $form->setData($request->getPost());
            
            // Check if data is valid.
            if ($form->isValid())
            {
          	// Persist staff.
            	$this->getStaffService()->persist($staff);
                
            	// Redirect to list of staff
		return $this->redirect()->toRoute('nickel/default', array('controller' => 'staff'));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return array(
            'form' => $form,
        );
    }
    
    public function editAction()
    {
        // Ensure we have an id, else redirect to add action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('nickel/default', array(
                 'controller' => 'staff',
                 'action' => 'add'
             ));
        }
        
        // Grab the staff member with the specified id.
        $staff = $this->getStaffService()->getStaffById($id);
        
        $form = $this->getServiceLocator()->get('nickel_staff_form');
        $form->bind($staff);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist staff.
                $this->getStaffService()->persist($staff);
                
                // Redirect to list of staff
                return $this->redirect()->toRoute('nickel/default', array('controller' => 'staff'));
            }     
        }
        
        return array(
             'staffId' => $id,
             'form' => $form,
        );   
    }
    
    public function deleteAction()
    {
        // Ensure we have a staff id, if not redirect to staff list
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'staff'));
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getStaffService()->deleteStaffById($id);
            }

            // Redirect to list of staff
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'staff'));
         }
        
        // If not a POST request, then render the confirmation page.
        return array(
            'id'    => $id,
            'staff' => $this->getStaffService()->getStaffById($id)    
        );
    }
    
    public function avatarAction()
    {
        // Ensure we have a staff id, if not redirect to staff list
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'staff'));
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $data_images = $request->getFiles()->toArray();
            if (!empty($data_images['avatar']))
            {    
                // Persist avatar.
                $this->getStaffService()->persistAvatar($id, $data_images['avatar']);
            }
                
            // Redirect to staff index
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'staff'));
            
        }
        
        $staff = $this->getStaffService()->getStaffById($id);
        return array('staff' => $staff);
    }
}