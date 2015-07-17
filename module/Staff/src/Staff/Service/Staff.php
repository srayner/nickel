<?php

namespace Staff\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
        
class Staff implements ServiceManagerAwareInterface
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
     * @return Computer
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
}