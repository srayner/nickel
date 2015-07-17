<?php

namespace Staff\Model\Staff;

use Zend\Stdlib\Hydrator\ClassMethods;
use Staff\Model\Staff\StaffInterface;

class StaffHydrator extends ClassMethods
{
    public function __construct($format = 'Y-m-d')
    {
        parent::__construct();
        $dateStrategy = new \Staff\Hydrator\Strategy\DateTimeStrategy($format);
        $this->addStrategy('birth_date', $dateStrategy);
        $this->addStrategy('hire_date', $dateStrategy);
    }
    
    public function extract($object)
    {
        if (!$object instanceof StaffInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Staff\Model\Staff\StaffInterface');
        }
        return parent::extract($object);
    }
    
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof StaffInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Staff\Model\Staff\StaffInterface');
        }
        return parent::hydrate($data, $object);
    }  
}