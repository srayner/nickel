<?php

namespace Nickel\Model\Staff;

class Staff implements StaffInterface
{
    protected $staffId;
    protected $firstName;
    protected $lastName;
    protected $birthDate;
    protected $hireDate;
    protected $jobTitle;
    protected $active;
    
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
    
    public function getFullName()
    {
        return trim($this->firstName . ' ' . $this->lastName);
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
    
    public function getJobTitle()
    {
        return $this->jobTitle;
    }
    
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
        return $this;
    }
    
    public function getActive()
    {
        return $this->active;
    }
    
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }
    
    public function avatar()
    {
        $filename = '/img/avatar-' . $this->staffId;
        if (file_exists("./public$filename.jpg"))
        {
            return $filename . '.jpg';
        }
        return '/img/avatar-blank.jpg';
    }
}
