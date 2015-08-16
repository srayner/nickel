<?php

namespace Nickel\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class LocationService implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * @var LocationMapperInterface
     */
    protected $locationMapper;
    
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
     * @return Customer
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
    
    public function setLocationMapper($locationMapper)
    {
        $this->locationMapper = $locationMapper;
        return $this;
    }
    
    public function getLocations()
    {
        return $this->locationMapper->getLocations();
    }
    
    public function getLocationById($locationId)
    {
        return $this->locationMapper->getLocationById($locationId);
    }
    
    public function getLocationsByCustomerId($customerId)
    {
        return $this->locationMapper->getLocationsByCustomerId($customerId);
    }
    
    public function deleteLocationById($locationId)
    {
        return $this->locationMapper->deleteLocationById($locationId);
    }
    
    public function persist($location)
    {
        return $this->locationMapper->persist($location);
    }
    
    public function countLocations()
    {
        return $this->locationMapper->countLocations();
    }
}