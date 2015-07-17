<?php

namespace Staff\Model\Staff;

class Staff implements StaffInterface
{
    protected $staffId;
    protected $firstName;
    protected $lastName;
    protected $birthDate;
    protected $hireDate;
    
    public function getStaffId()
    {
        return $this->staffId;
    }
    
    public function setStaffId($staffId)
    {
        $this->staffId = $staffId;
        return $this;
    }
    
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function setFirstName($firstName)
    {
        $this->firstName = ucfirst(strtolower($firstName));
        return $this;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }
    
    public function setLastName($lastName)
    {
        $this->lastName = ucfirst(strtolower($lastName));
        return $this;
    }
    
    public function getBirthDate()
    {
        return $this->birthDate;
    }
    
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }
    
    public function getHireDate()
    {
        return $this->hireDate;
    }
    
    public function setHireDate(\Datetime $hireDate)
    {
        $this->hireDate = $hireDate;
        return $this;
    }

}
