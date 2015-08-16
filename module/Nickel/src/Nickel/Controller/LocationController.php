<?php

namespace Nickel\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class LocationController extends AbstractActionController
{
    private $locationService;
    
    protected function getLocationService()
    {
        if (null === $this->locationService) {
            $this->locationService = $this->getServiceLocator()->get('nickel_location_service');
        }
        return $this->locationService;
    }
    
    public function indexAction()
    {
        return array(
            'locations' => $this->getLocationService()->getLocations()
        );
    }

    public function addAction()
    {
        // Create new form instance.
        $form = $this->getServiceLocator()->get('nickel_location_form');
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Bind the form to the location entity, and set the data from post.
            $location = $this->getServiceLocator()->get('nickel_location');
            $form->bind($location);
            $form->setData($request->getPost());
            
            // Check if data is valid.
            if ($form->isValid())
            {
          	// Persist customer.
            	$this->getLocationService()->persist($location);
                
            	// Redirect to list of customers
		return $this->redirect()->toRoute('nickel/default', array('controller' => 'location'));
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
                 'controller' => 'location',
                 'action' => 'add'
             ));
        }
        
        // Grab the location with the specified id.
        $location = $this->getLocationService()->getLocationById($id);
        
        $form = $this->getServiceLocator()->get('nickel_location_form');
        $form->bind($location);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist location.
                $this->getLocationService()->persist($location);
                
                // Redirect to list of locations
                return $this->redirect()->toRoute('nickel/default', array('controller' => 'location'));
            }     
        }
        
        return array(
             'locationId' => $id,
             'form' => $form,
        );
    }
    
    public function deleteAction()
    {
        // Ensure we have a location id, if not redirect to location list
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'location'));
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getLocationService()->deleteLocationById($id);
            }

            // Redirect to list of location
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'location'));
         }
        
        // If not a POST request, then render the confirmation page.
        return array(
            'id'    => $id,
            'location' => $this->getLocationService()->getLocationById($id)    
        );
    }
    
    public function mapAction()
    {
        // Ensure we have a customer id, if not redirect to location list
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'location'));
        }
        
        return array(
            'location' => $this->getLocationService()->getLocationById($id)
        );
    }
}