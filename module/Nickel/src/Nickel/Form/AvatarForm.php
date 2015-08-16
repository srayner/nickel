<?php

namespace Nickel\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class AvatarForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        // Staff Id
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'staff_id',
        ));
        
        // File Input
        $file = new Element\File('image-file');
        $file->setLabel('Avatar Image Upload')
             ->setAttribute('id', 'image-file');
        $this->add($file);   
    }
}

