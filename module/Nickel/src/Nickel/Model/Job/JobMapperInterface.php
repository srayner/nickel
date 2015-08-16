<?php

namespace Nickel\Model\Job;

interface JobMapperInterface
{
    public function getJobs();
    public function getJobById($jobId);
    public function getJobsByLocationId($locationId);
    public function deleteJobById($jobId);
    public function persistJob(JobInterface $job);
    public function countJobs();
}

