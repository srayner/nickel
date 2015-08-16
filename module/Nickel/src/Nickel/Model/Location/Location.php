<?php

namespace Nickel\Model\Location;

class Location implements LocationInterface
{
    protected $locationId;
    protected $organisationName;
    protected $addressLine1;
    protected $addressLine2;
    protected $postTown;
    protected $county;
    protected $postCode;
    protected $customerId;
    
    public function getLocationId()
    {
        return $this->locationId;
    }
    
    public function setLocationID($locationId)
    {
        $this->locationId = $locationId;
        return $this;
    }
    
    public function getOrganisationName()
    {
        return $this->organisationName;
    }
    
    public function setOrganisationName($organisationName)
    {
        $this->organisationName = $organisationName;
        return $this;
    }
    
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }
    
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;
        return $this;
    }
    
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }
    
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;
        return $this;
    }
    
    public function getPostTown()
    {
        return $this->postTown;
    }
    
    public function setPostTown($postTown)
    {
        $this->postTown = $postTown;
        return $this;
    }
    
    public function getCounty()
    {
        return $this->county;
    }
    
    public function setCounty($county)
    {
        $this->county = $county;
        return $this;
    }
    
    public function getPostCode()
    {
        return $this->postCode;
    }
    
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
        return $this;
    }
    
    public function getCustomerId()
    {
        return $this->customerId;
    }
    
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }
    
    public function getFullAddress($seperator = ', ')
    {
        $address = $this->addressLine1;
        
        if (!$this->addressLine2 == '') {
            $address .= $seperator . $this->addressLine2;
        }
        
        if (!$this->postTown == '') {
            $address .= $seperator . $this->postTown;
        }
        
        if (!$this->county == '') {
            $address .= $seperator . $this->county;
        }
        return $address;
    }
}