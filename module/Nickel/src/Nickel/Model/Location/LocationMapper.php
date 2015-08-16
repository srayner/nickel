<?php

namespace Nickel\Model\Location;

use ZfcBase\Mapper\AbstractDbMapper;
use Nickel\Service\DbAdapterAwareInterface;
use Zend\Db\Sql\Expression;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Stdlib\Hydrator\ArraySerializable;

class LocationMapper extends AbstractDbMapper implements LocationMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'location';
    
    public function getLocations()
    {
        $select = $this->getSelect();
        return $this->select($select);
    }
    
    public function getLocationById($locationId)
    {
        $select = $this->getSelect()
                       ->where(array('location_id' => $locationId));
        return $this->select($select)->current();
    }
    
    public function getLocationsByCustomerId($customerId)
    {
        $select = $this->getSelect()
                       ->where(array('customer_id' => $customerId));
        return $this->select($select);
    }
    
    public function deleteLocationById($locationId)
    {
        return parent::delete(array('location_id' => $locationId));
    }
    
    public function persist(LocationInterface $location)
    {
        if ($location->getLocationId() > 0) {
            $this->update($location, null, null, new LocationHydrator);
        } else {
            $this->insert($location, null, new LocationHydrator);
        }
        return $location; 
    }
    
    public function countLocations()
    {
        $select = $this->getSelect()
                       ->columns(array('count' => new Expression('COUNT(1)')));
        $rows = $this->select($select, new \ArrayObject, new ArraySerializable)->toArray();
        return (int) $rows[0]['count'];
    }
    
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setLocationId($result->getGeneratedValue());
        return $result;
    }
    
    protected function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'location_id = ' . $entity->getLocationId();
        }
        return parent::update($entity, $where, $tableName, $hydrator);
    }
}


