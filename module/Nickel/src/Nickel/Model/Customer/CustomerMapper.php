<?php

namespace Nickel\Model\Customer;

use ZfcBase\Mapper\AbstractDbMapper;
use Nickel\Service\DbAdapterAwareInterface;
use Zend\Db\Sql\Expression;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Stdlib\Hydrator\ArraySerializable;

class CustomerMapper extends AbstractDbMapper implements CustomerMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'customer';
    
    public function getCustomers()
    {
        $select = $this->getSelect();
        return $this->select($select);
    }
    
    public function getCustomerById($customerId)
    {
        $select = $this->getSelect()
                       ->where(array('customer_id' => $customerId));
        return $this->select($select)->current();
    }
    
    public function deleteCustomerById($customerId)
    {
        return parent::delete(array('customer_id' => $customerId));
    }
    
    public function persist(CustomerInterface $customer)
    {
        if ($customer->getCustomerId() > 0) {
            $this->update($customer, null, null, new CustomerHydrator);
        } else {
            $this->insert($customer, null, new CustomerHydrator);
        }
        return $customer; 
    }
    
    public function countCustomers()
    {
        $select = $this->getSelect()
                       ->columns(array('count' => new Expression('COUNT(1)')));
        $rows = $this->select($select, new \ArrayObject, new ArraySerializable)->toArray();
        return (int) $rows[0]['count'];
    }
    
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setCustomerId($result->getGeneratedValue());
        return $result;
    }
    
    protected function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'customer_id = ' . $entity->getCustomerId();
        }
        return parent::update($entity, $where, $tableName, $hydrator);
    }
}


