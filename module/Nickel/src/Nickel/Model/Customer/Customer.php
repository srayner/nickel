<?php

namespace Nickel\Model\Customer;

class Customer implements CustomerInterface
{
    private $customerId;
    private $companyName;
    private $phoneNo;
    private $faxNo;
    private $emailAddress;
    
    public function getCustomerId()
    {
        return $this->customerId;
    }
    
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }
    
    public function getCompanyName()
    {
        return $this->companyName;
    }
    
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }
    
    public function getPhoneNo()
    {
        return $this->phoneNo;
    }
    
    public function setPhoneNo($phoneNo)
    {
        $this->phoneNo = $phoneNo;
        return $this;
    }
    
    public function getFaxNo()
    {
        return $this->faxNo;
    }
    
    public function setFaxNo($faxNo)
    {
        $this->faxNo = $faxNo;
        return $this;
    }
    
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }
    
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }
}