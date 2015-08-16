<?php

namespace Nickel\Model\Customer;

use Zend\Stdlib\Hydrator\ClassMethods;

class CustomerHydrator extends ClassMethods
{
    public function extract($object)
    {
        if (!$object instanceof CustomerInterface) {
            throw new \InvalidArgumentException('$object must be an instance of ' . __NAMESPACE__ . '\CustomerInterface');
        }
        $data = parent::extract($object);
        $data['head_office_address_id'] = 0;
        return $data;
    }
    
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof CustomerInterface) {
            throw new \InvalidArgumentException('$object must be an instance of ' . __NAMESPACE__ . '\CustomerInterface');
        }
        return parent::hydrate($data, $object);
    }  
}