<?php

namespace Staff\Model\Staff;

use ZfcBase\Mapper\AbstractDbMapper;
use Staff\Service\DbAdapterAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

class StaffMapper extends AbstractDbMapper implements StaffMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'staff';
    
    public function getStaff()
    {
        $select = $this->getSelect();
        return $this->select($select);
    }
    
    public function getStaffById($staffId)
    {
        $select = $this->getSelect()
                       ->where(array('staff_id' => $staffId));
        return $this->select($select)->current();
    }

    public function deleteStaffById($staffId)
    {
        return parent::delete(array('staff_id' => $staffId));
    }
    
    public function persist(StaffInterface $staff)
    {
        if ($staff->getStaffId() > 0) {
            $this->update($staff, null, null, new StaffHydrator);
        } else {
            $this->insert($staff, null, new StaffHydrator);
        }
        return $staff; 
    }
    
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setStaffId($result->getGeneratedValue());
        return $result;
    }
    
    protected function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'staff_id = ' . $entity->getStaffId();
        }
        return parent::update($entity, $where, $tableName, $hydrator);
    }
}