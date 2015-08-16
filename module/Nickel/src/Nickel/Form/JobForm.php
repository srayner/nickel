<?php

namespace Nickel\Form;

use Zend\Form\Form;

class JobForm extends Form
{
    public function __construct($locations, $staff)
    {
        parent::__construct();
        
        // Job Id
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'job_id',
        ));
        
        // Location select
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'location_id',
            'options' => array(
                'label' => 'Location',
                'value_options' => $this->getSelectOptions($locations, 'getLocationId', 'getFullAddress')     
            ),
            'attributes' => array(
                'class' => 'form-control input-sm'
            )
        ));
        
        // Staff select
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'staff_id',
            'options' => array(
                'label' => 'Staff Member',
                'value_options' => $this->getSelectOptions($staff, 'getStaffId', 'getFullName')     
            ),
            'attributes' => array(
                'class' => 'form-control input-sm'
            )
        ));
        
        // Job Description
        $this->add(array(
            'name' => 'job_description',
            'options' => array(
                'label' => 'Job Description',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Notes
        $this->add(array(
            'name' => 'notes',
            'options' => array(
                'label' => 'Notes',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Job date
        $this->add(array(
            'name' => 'job_date',
            'options' => array(
                'label' => 'Job Date',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm'
            ), 
        ));
        
        // Job type
        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'job_type',
            'options' => array(
                'label' => 'Job Type',
                'value_options' => array(
                    'flexible' => 'Flexible',
                    'fixed' => 'Fixed',
                ),
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
    
    protected function getSelectOptions($objects, $keyProperty, $listProperty)
    {
        $selectData = array();
        foreach ($objects as $object) {
            $key = $object->$keyProperty();
            $value = $object->$listProperty();
            $selectData[$key] = $value;
        }
        return $selectData;
    }
}
    