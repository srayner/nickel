<?php

namespace Nickel\Form;

use Zend\Form\Form;

class LocationForm extends Form
{
    public function __construct($customers)
    {
        parent::__construct();
        
        // Location Id
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'location_id',
        ));
        
        // Organisation name
        $this->add(array(
            'name' => 'organisation_name',
            'options' => array(
                'label' => 'Organisation Name',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Customer select
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'customer_id',
            'options' => array(
                'label' => 'Customer',
                'value_options' => $this->getSelectOptions($customers)     
            ),
            'attributes' => array(
                'class' => 'form-control input-sm'
            )
        ));
        
        // Address Line 1
        $this->add(array(
            'name' => 'address_line1',
            'options' => array(
                'label' => 'Address Line 1',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Address Line2
        $this->add(array(
            'name' => 'address_line2',
            'options' => array(
                'label' => 'Address Line 2',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Post Town
        $this->add(array(
            'name' => 'post_town',
            'options' => array(
                'label' => 'Postal Town',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // County
        $this->add(array(
            'name' => 'county',
            'options' => array(
                'label' => 'County',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Post Code
        $this->add(array(
            'name' => 'post_code',
            'options' => array(
                'label' => 'Post Code',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Submit button.
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary'
            ),
        ));
    }
    
    protected function getSelectOptions($customers)
    {
        $selectData = array();
        foreach ($customers as $customer) {
            $selectData[$customer->getCustomerId()] = $customer->getCompanyName();
        }
        return $selectData;
    }
}
        
