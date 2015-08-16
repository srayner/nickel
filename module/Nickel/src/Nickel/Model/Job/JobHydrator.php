<?php

namespace Nickel\Model\Job;

use Zend\Stdlib\Hydrator\ClassMethods;
use Nickel\Hydrator\Strategy\DateTimeStrategy;

class JobHydrator extends ClassMethods
{
    public function __construct($format = 'Y-m-d')
    {
        parent::__construct();
        $dateStrategy = new DateTimeStrategy($format);
        $this->addStrategy('job_date', $dateStrategy);
    }
    
    public function extract($object)
    {
        if (!$object instanceof JobInterface) {
            throw new \InvalidArgumentException('$object must be an instance of ' . __NAMESPACE__ . '\JobInterface');
        }
        $data = parent::extract($object);
        return $data;
    }
    
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof JobInterface) {
            throw new \InvalidArgumentException('$object must be an instance of ' . __NAMESPACE__ . '\JobInterface');
        }
        return parent::hydrate($data, $object);
    }  
}
