<?php

namespace src\Service\Job;

use lib\View\View;
use src\Model\CatJobHistoryTypes\CatJobHistoryTypes;
use src\Model\CatJobHistoryTypes\Mapper\CatJobHistoryTypesMapper;
use src\Model\JobHistory\JobHistory;
use src\Model\JobHistory\Mapper\JobHistoryContainer;

class JobService
{
    public function getHistories(): array
    {
        $histories = [];

        $jobHistories = JobHistoryContainer::getInstance()?->findBy(['ORDER' => ['timestamp' => 'DESC']]);

        /** @var JobHistory $jobHistory */
        foreach ($jobHistories as $jobHistory) {
            $type = CatJobHistoryTypesMapper::getInstance()?->read($jobHistory->getType());

            if ($type instanceof CatJobHistoryTypes) {
                $histories[] = View::load('job/job-history', [
                    'historyId' => $jobHistory->getID(),
                    'message' => $jobHistory->getMessage(),
                    'type' => $type->getText(),
                    'timestamp' => (new \DateTime($jobHistory->getTimestamp()))->format('d.m.Y H:i:s')
                ]);
            }
        }

        return $histories;
    }
}