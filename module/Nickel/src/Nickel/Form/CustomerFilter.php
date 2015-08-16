<?php

namespace Nickel\Form;

use Zend\InputFilter\InputFilter;

class CustomerFilter extends InputFilter
{
    public function __construct()
    {
        // Company name
        $this->add(array(
            'name'       => 'company_name',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 32,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Phone No
        $this->add(array(
            'name'       => 'phone_no',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 12,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Fax No
        $this->add(array(
            'name'       => 'fax_no',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 12,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Email Address
        $this->add(array(
            'name'       => 'email_address',
            'required'   => false,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 128,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
    }
}