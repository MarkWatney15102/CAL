<?php

declare(strict_types=1);

namespace src\Controller\Job;

use lib\Controller\AbstractController;
use lib\Message\Message;
use lib\Message\MessageGroup;
use lib\View\View;
use src\Form\JobFormFactory;
use src\Service\Job\JobService;

class JobController extends AbstractController
{
    public function job(): void
    {
        $projectId = (int)$this->urlParams[0];
        $jobId = $this->urlParams[1];

        if ($projectId > 0) {
            if ($jobId !== 'new') {
                $this->editJob($projectId, (int)$jobId);
            } else {
                $this->newJob($projectId);
            }
        }
    }

    private function newJob(int $projectId): void
    {
        $this->form = JobFormFactory::makeWithoutJobModel($projectId);

        $this->render(
            'job/new-job',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form,
            ]
        );
    }

    private function editJob(int $projectId, int $jobId): void
    {
        $this->form = JobFormFactory::make($projectId, $jobId);

        $jobService = new JobService();
        $jobHistories = $jobService->getHistories();

        $this->render(
            'job/job',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form,
                'histories' => $jobHistories,
                'jobId' => $jobId
            ]
        );
    }

    public function saveJob(): void
    {
        $projectId = (int)$this->urlParams[0];
        $jobId = (int)$this->urlParams[1];

        $this->form = JobFormFactory::make($projectId, $jobId);

        $messageGroup = MessageGroup::getInstance();

        if ($messageGroup instanceof MessageGroup) {
            $messageGroup->addMessage(Message::SUCCESS, 'Formular', 'Speicherung war erfolgreich');
        }

        $this->form->save();
    }
}