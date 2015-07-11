<?php

namespace Staff\Form;

use Zend\InputFilter\InputFilter;

class StaffFilter extends InputFilter
{
    public function __construct()
    {
        // First name
        $this->add(array(
            'name'       => 'first_name',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'max' => 24,
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Last name
        $this->add(array(
            'name'       => 'last_name',
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
    }
}