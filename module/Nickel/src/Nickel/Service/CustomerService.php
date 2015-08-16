<?php

namespace Nickel\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
        
class CustomerService implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * @var CustomerMapperInterface
     */
    protected $customerMapper;
    
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
    
    public function setCustomerMapper($mapper)
    {
        $this->customerMapper = $mapper;
        return $this;
    }
    
    public function getCustomers()
    {
        return $this->customerMapper->getCustomers();
    }
    
    public function getCustomerById($customerId)
    {
        return $this->customerMapper->getCustomerById($customerId);
    }
    
    public function deleteCustomerById($customerId)
    {
        $this->customerMapper->deleteCustomerById($customerId);
        return $this;
    }
    
    public function persist($customer)
    {
        $this->customerMapper->persist($customer);
        return $this;
    }
    
    public function countCustomers()
    {
        return $this->customerMapper->countCustomers();
    }
}
