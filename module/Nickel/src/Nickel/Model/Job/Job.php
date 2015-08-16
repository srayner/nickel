<?php

namespace Nickel\Model\Job;

class Job implements JobInterface
{
    private $jobId;
    private $locationId;
    private $staffId;
    private $jobDescription;
    private $notes;
    private $jobDate;
    private $jobType;
    
    public function getJobId()
    {
        return $this->jobId;
    }
    
    public function setJobId($jobId)
    {
        $this->jobId = $jobId;
        return $this;
    }
    
    public function getLocationId()
    {
        return $this->locationId;
    }
    
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
        return $this;
    }
    
    public function getStaffId()
    {
        return $this->staffId;
    }
    
    public function setStaffId($staffId)
    {
        $this->staffId = $staffId;
        return $this;
    }
    
    public function getJobDescription()
    {
        return $this->jobDescription;
    }
    
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;
        return $this;
    }
    
    public function getNotes()
    {
        return $this->notes;
    }
    
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }
    
    public function getJobDate()
    {
        return $this->jobDate;
    }
    
    public function setJobDate(\DateTime $jobDate)
    {
        $this->jobDate = $jobDate;
        return $this;
    }
    
    public function getJobType()
    {
        return $this->jobType;
    }
    
    public function setJobType($jobType)
    {
        $this->jobType = $jobType;
        return $this;
    }
}
