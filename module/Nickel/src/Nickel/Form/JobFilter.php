<?php

namespace Nickel\Form;

use Zend\InputFilter\InputFilter;

class JobFilter extends InputFilter
{
    public function __construct()
    {
        // Job Description
        $this->add(array(
            'name'       => 'job_description',
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
        
        // Job Type
        $this->add(array(
            'name'       => 'job_type',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'InArray',
                    'options' => array(
                        'haystack' => array('flexible', 'fixed'),
                    ),
                ),
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
    }
}
