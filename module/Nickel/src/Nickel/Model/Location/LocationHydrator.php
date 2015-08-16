<?php

namespace Nickel\Model\Location;

use Zend\Stdlib\Hydrator\ClassMethods;

class LocationHydrator extends ClassMethods
{
    public function extract($object)
    {
        if (!$object instanceof LocationInterface) {
            throw new \InvalidArgumentException('$object must be an instance of ' . __NAMESPACE__ . '\LocationInterface');
        }
        $data =  parent::extract($object);
        unset($data['full_address']);
        return $data;
    }
    
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof LocationInterface) {
            throw new \InvalidArgumentException('$object must be an instance of ' . __NAMESPACE__ . '\LocationInterface');
        }
        return  parent::hydrate($data, $object);
    }
}