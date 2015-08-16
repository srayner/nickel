<?php

namespace Nickel\Form;

use Zend\Form\Form;

class CustomerForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        // Customer Id
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'customer_id',
        ));
        
        // Company name
        $this->add(array(
            'name' => 'company_name',
            'options' => array(
                'label' => 'Company Name',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Phone No
        $this->add(array(
            'name' => 'phone_no',
            'options' => array(
                'label' => 'Telephone Number',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Fax No
        $this->add(array(
            'name' => 'fax_no',
            'options' => array(
                'label' => 'Fax Number',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Email Address
        $this->add(array(
            'name' => 'email_address',
            'options' => array(
                'label' => 'Email Address',
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
}