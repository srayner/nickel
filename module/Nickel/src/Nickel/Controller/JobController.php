<?php

namespace Nickel\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class JobController extends AbstractActionController
{
    private $jobService;
    
    protected function getJobService()
    {
        if (null === $this->jobService){
            $this->jobService = $this->getServiceLocator()->get('nickel_job_service');
        }
        return $this->jobService;
    }
    
    public function indexAction()
    {
        $jobs = $this->getJobService()->getJobs();
        return new ViewModel(array(
            'jobs' => $jobs
        ));
    }
    
    public function jsonAction()
    {
        $jobs = $this->getJobService()->getJobs();
        return new JsonModel(array(
            'jobs' => $jobs->toArray()
        ));
    }
    
    public function addAction()
    {
        // Create new form instance.
        $form = $this->getServiceLocator()->get('nickel_job_form');
        
        // Check if the request is a POST.
        $request = $this->getRequest();
        if ($request->isPost())
        {
            // Bind the form to the job entity, and set the data from post.
            $job = $this->getServiceLocator()->get('nickel_job');
            $form->bind($job);
            $form->setData($request->getPost());
            
            // Check if data is valid.
            if ($form->isValid())
            {
          	// Persist job.
            	$this->getJobService()->persistJob($job);
                
            	// Redirect to list of customers
		return $this->redirect()->toRoute('nickel/default', array('controller' => 'job'));
            }
        } 
        
        // If not a POST request, or invalid data, then just render the form.
        return array(
            'form' => $form,
        );
    }
    
    public function editAction()
    {
        // Ensure we have an id, else redirect to add action.
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
             return $this->redirect()->toRoute('nickel/default', array(
                 'controller' => 'job',
                 'action' => 'add'
             ));
        }
        
        // Grab the location with the specified id.
        $job = $this->getJobService()->getJobById($id);
        $form = $this->getServiceLocator()->get('nickel_job_form');
        $form->bind($job);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
        
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                // Persist job.
                $this->getJobService()->persistJob($job);
                
                // Redirect to list of jobs
                return $this->redirect()->toRoute('nickel/default', array('controller' => 'job'));
            }     
        }
        
        return array(
             'jobId' => $id,
             'form' => $form,
        );
    }
    
    public function deleteAction()
    {
        // Ensure we have a job id, if not redirect to location list
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'job'));
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            // Only perform delete if value posted was 'Yes'.
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getJobService()->deleteJobById($id);
            }

            // Redirect to list of jobs
            return $this->redirect()->toRoute('nickel/default', array('controller' => 'job'));
         }
        
        // If not a POST request, then render the confirmation page.
        return array(
            'id'    => $id,
            'job' => $this->getJobService()->getJobById($id)    
        );
    }
    
    public function updateAction()
    {
        $data = $this->getRequest()->getPost();
        
        // Grab the job with the specified id.
        $job = $this->getJobService()->getJobById($data['job_id']);
        $form = $this->getServiceLocator()->get('nickel_job_form');
        $form->bind($job);
        $form->setData($data);
        if ($form->isValid())
        {    
            // Persist job.
            $this->getJobService()->persistJob($job);
                
            // Return ok response
            return new JsonModel(array(
                'result' => 'ok',
                'echo' => $data
            ));     
        }
        
        return new JsonModel(array(
            'result' => 'error',
            'echo' => $data
        ));
        
    }
}