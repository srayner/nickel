<?php

namespace Nickel\Service;

use Nickel\Model\Job\JobInterface;
use Nickel\Model\Job\JobMapperInterface;

class JobService
{
    protected $jobMapper;
    
    public function __construct(JobMapperInterface $jobMapper) {
        
        $this->jobMapper = $jobMapper;
        
    }
    
    public function getJobs()
    {
        return $this->jobMapper->getJobs();
    }
    
    public function getJobById($jobId)
    {
        return $this->jobMapper->getJobById($jobId);
    }
    
    public function persistJob(JobInterface $job)
    {
        return $this->jobMapper->persistJob($job);
    }
    
    public function deleteJobById($jobId)
    {
        return $this->jobMapper->deleteJobById($jobId);
    }
    
    public function countJobs()
    {
        return $this->jobMapper->countJobs();
    }
}

