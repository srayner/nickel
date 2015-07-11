<?php

namespace Staff\Model\Staff;

use Zend\Stdlib\Hydrator\ClassMethods;
use Staff\Model\Staff\StaffInterface;

class StaffHydrator extends ClassMethods
{
    public function extract($object)
    {
        if (!$object instanceof StaffInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Staff\Model\Staff\StaffInterface');
        }
        $data = parent::extract($object);
        if ($data['created']) {
            $data['created'] = $data['created']->format('Y-m-d H:i:s');
        }
        if ($data['modified']) {
            $data['modified'] = $data['modified']->format('Y-m-d H:i:s');
        }
        return $data;
    }
    
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof StaffInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of Staff\Model\Staff\StaffInterface');
        }       
        return parent::hydrate($data, $object);
    }  
}

