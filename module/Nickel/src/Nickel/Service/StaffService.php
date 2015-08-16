<?php

namespace Nickel\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
        
class StaffService implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * @var StaffMapperInterface
     */
    protected $staffMapper;
    
    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
    
    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return Staff
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
    
    public function setStaffMapper($mapper)
    {
        $this->staffMapper = $mapper;
        return $this;
    }
    
    public function getStaff()
    {
        return $this->staffMapper->getStaff();
    }
    
    public function getActiveStaff()
    {
        return $this->staffMapper->getActiveStaff();
    }
    
    public function getStaffById($staffId)
    {
        return $this->staffMapper->getStaffById($staffId);
    }

    public function deleteStaffById($staffId)
    {
        $this->staffMapper->deleteStaffById($staffId);
        return $this;
    }
    
    public function persist($staff)
    {
        $this->staffMapper->persist($staff);
        return $this;
    }
    
    public function persistAvatar($staffId, $tmpFile)
    {
        $this->staffMapper->persistAvatar($staffId, $tmpFile);
    }
    
    public function countStaff()
    {
        return $this->staffMapper->countStaff();
    }
}