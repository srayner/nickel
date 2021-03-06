<?php

namespace Nickel\Form;

use Zend\Form\Form;

class StaffForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        // Staff Id
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'staff_id',
        ));
        
        // First name
        $this->add(array(
            'name' => 'first_name',
            'options' => array(
                'label' => 'First Name',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Last name
        $this->add(array(
            'name' => 'last_name',
            'options' => array(
                'label' => 'Last Name',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Birth date
        $this->add(array(
            'name' => 'birth_date',
            'options' => array(
                'label' => 'Date of Birth',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Hire date
        $this->add(array(
            'name' => 'hire_date',
            'options' => array(
                'label' => 'Hire Date',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Job title
        $this->add(array(
            'name' => 'job_title',
            'options' => array(
                'label' => 'Job Title',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Active
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'active',
            'options' => array(
                'use_hidden_element' => true,
                'checked_value' => 1,
                'unchecked_value' => 0
            )
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