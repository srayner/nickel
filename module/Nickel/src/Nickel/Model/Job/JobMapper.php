<?php

namespace Nickel\Model\Job;

use ZfcBase\Mapper\AbstractDbMapper;
use Nickel\Service\DbAdapterAwareInterface;
use Zend\Db\Sql\Expression;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Stdlib\Hydrator\ArraySerializable;

class JobMapper extends AbstractDbMapper implements JobMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'job';
    
    public function getJobs()
    {
        $select = $this->getSelect();
        return $this->select($select);
    }
    
    public function getJobById($jobId)
    {
        $select = $this->getSelect()
                       ->where(array('job_id' => $jobId));
        return $this->select($select)->current();
    }
    
    public function getJobsByLocationId($locationId)
    {
        $select = $this->getSelect()
                       ->where(array('location_id' => $locationId));
        return $this->select($select);
    }
    
    public function deleteJobById($jobId)
    {
        return parent::delete(array('job_id' => $jobId));      
    }
    
    public function persistJob(JobInterface $job)
    {
        if ($job->getJobId() > 0) {
            $this->update($job, null, null, new JobHydrator);
        } else {
            $this->insert($job, null, new JobHydrator);
        }
        return $job; 
    }
    
    public function countJobs()
    {
        $select = $this->getSelect()
                       ->columns(array('count' => new Expression('COUNT(1)')));
        $rows = $this->select($select, new \ArrayObject, new ArraySerializable)->toArray();
        return (int) $rows[0]['count'];
    }
    
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setJobId($result->getGeneratedValue());
        return $result;
    }
    
    protected function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'job_id = ' . $entity->getJobId();
        }
        return parent::update($entity, $where, $tableName, $hydrator);
    }
}