<?php

namespace src\Controller\Job;

use lib\Controller\AbstractController;
use src\Form\Job\History\JobHistoryFormFactory;
use src\Helper\Redirect;
use src\Model\Task\Job;
use src\Model\Task\Mapper\JobMapper;
use src\Model\JobHistory\JobHistory;
use src\Model\JobHistory\Mapper\JobHistoryMapper;

class JobHistoryController extends AbstractController
{
    public function deleteCheckAction(): void
    {
        $historyId = (int)$this->urlParams[0];

        $this->render(
            'job/history/delete',
            [
                'renderWithBasicBody' => true,
                'historyId' => $historyId
            ]
        );
    }

    public function deleteAction(): void
    {
        $historyId = (int)$this->urlParams[0];

        $mapper = JobHistoryMapper::getInstance();

        $jobHistory = $mapper->read($historyId);

        if ($jobHistory instanceof JobHistory) {
            $jobId = $jobHistory->getJobId();

            $mapper->delete($jobHistory);

            $job = JobMapper::getInstance()?->read($jobId);

            if ($job instanceof Job) {
                $projectId = $job->getProject_id();
                Redirect::to('/job/' . $projectId . '/' . $jobId);
            }
        }
    }

    public function createAction(): void
    {
        $jobId = (int)$this->urlParams[0];

        $this->form = JobHistoryFormFactory::makeWithoutJobModel($jobId);

        $this->render(
            'job/history/create',
            [
                'renderWithBasicBody' => true,
                'jobId' => $jobId,
                'form' => $this->form
            ]
        );
    }
}