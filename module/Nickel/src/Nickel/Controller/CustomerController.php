<?php

namespace Nickel\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class CustomerController extends AbstractActionController
{
    private $customerService;
    
    private function getCustomerService()
    {
        if (null === $this->customerService) {
            $this->customerService = $this->getServiceLocator()->get('nickel_customer_service');
        }
        return $this->customerService;
    }
    
    public function indexAction()
    {
        return array(
            'customers' => $this->getCustomerService()->getCustomers()
        );
    }
    
    public function detailAction()
    {
        // Ensure we have a customer id, if not redirect to customer list
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'customer'));
        }
        
        $customer = $this->getCustomerService()->getCustomerById($id);
        $locations = $this->getServiceLocator()->get('nickel_location_service')->getLocationsByCustomerId($id);
        
        return array(
            'customer' => $customer,
            'locations' => $locations,
        );
        
    }
    
    public function addAction()
    {
        // Create new form instance.
        $form = $this->getServiceLocator()->get('nickel_customer_form');
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Bind the form to the customer entity, and set the data from post.
            $customer = $this->getServiceLocator()->get('nickel_customer');
            $form->bind($customer);
            $form->setData($request->getPost());
            
            // Check if data is valid.
            if ($form->isValid())
            {
          	// Persist customer.
            	$this->getCustomerService()->persist($customer);
                
            	// Redirect to list of customers
		return $this->redirect()->toRoute('nickel/default', array('controller' => 'customer'));
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
                 'controller' => 'customer',
                 'action' => 'add'
             ));
        }
        
        // Grab the customer with the specified id.
        $customer = $this->getCustomerService()->getCustomerById($id);
        
        $form = $this->getServiceLocator()->get('nickel_customer_form');
        $form->bind($customer);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist customer.
                $this->getCustomerService()->persist($customer);
                
                // Redirect to list of customers
                return $this->redirect()->toRoute('nickel/default', array('controller' => 'customer'));
            }     
        }
        
        return array(
             'customerId' => $id,
             'form' => $form,
        );
    }
    
    public function deleteAction()
    {
        // Ensure we have a customer id, if not redirect to customer list
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'customer'));
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getCustomerService()->deleteCustomerById($id);
            }

            // Redirect to list of customers
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'customer'));
         }
        
        // If not a POST request, then render the confirmation page.
        return array(
            'id'    => $id,
            'customer' => $this->getCustomerService()->getCustomerById($id)    
        );
    }
}
