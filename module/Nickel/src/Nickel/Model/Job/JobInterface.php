<?php

namespace Nickel\Model\Job;

interface JobInterface
{
    public function getJobId();
    public function setJobId($jobId);
    public function getLocationId();
    public function setLocationId($locationId);
    public function getStaffId();
    public function setStaffId($staffId);
    public function getJobDescription();
    public function setJobDescription($jobDescription);
    public function getNotes();
    public function setNotes($notes);
    public function getJobDate();
    public function setJobDate(\DateTime $jobDate);
    public function getJobType();
    public function setJobType($jobType);
}

