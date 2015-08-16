<?php

namespace Nickel\Model\Staff;

use ZfcBase\Mapper\AbstractDbMapper;
use Nickel\Service\DbAdapterAwareInterface;
use Zend\Db\Sql\Expression;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Stdlib\Hydrator\ArraySerializable;

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
    
    public function getActiveStaff()
    {
        $select = $this->getSelect()
                       ->where(array('active' => 1));
        return $this->select($select);
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
    
    public function persistAvatar($staffId, $tmpFile)
    {
        $allowed = array('gif','png' ,'jpg');
        $ext = pathinfo($tmpFile['name'], PATHINFO_EXTENSION);
        if(!in_array($ext, $allowed)) {
            return false;
        }
        $uploads_dir = getcwd() . '/public/img';
        $filename = "avatar-$staffId.$ext";
        move_uploaded_file($tmpFile['tmp_name'], "$uploads_dir/$filename");
    }
    
    public function countStaff()
    {   
        $select = $this->getSelect()
                       ->columns(array('count' => new Expression('COUNT(1)')));
        $rows = $this->select($select, new \ArrayObject, new ArraySerializable)->toArray();
        return (int) $rows[0]['count']; 
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