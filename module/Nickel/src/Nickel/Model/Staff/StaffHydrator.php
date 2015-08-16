<?php

namespace Nickel\Model\Staff;

use Zend\Stdlib\Hydrator\ClassMethods;
use Nickel\Model\Staff\StaffInterface;
use Nickel\Hydrator\Strategy\DateTimeStrategy;

class StaffHydrator extends ClassMethods
{
    public function __construct($format = 'Y-m-d')
    {
        parent::__construct();
        $dateStrategy = new DateTimeStrategy($format);
        $this->addStrategy('birth_date', $dateStrategy);
        $this->addStrategy('hire_date', $dateStrategy);
    }
    
    public function extract($object)
    {
        if (!$object instanceof StaffInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Nickel\Model\Staff\StaffInterface');
        }
        $data = parent::extract($object);
        unset($data['full_name']);
        return $data;
    }
    
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof StaffInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Nickel\Model\Staff\StaffInterface');
        }
        return parent::hydrate($data, $object);
    }  
}