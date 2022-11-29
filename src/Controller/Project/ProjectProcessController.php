<?php

namespace src\Controller\Project;

use lib\Controller\AbstractController;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Helper\Redirect;
use src\Model\User\User;
use src\Service\Project\ProjectProcessService;

class ProjectProcessController extends AbstractController
{
    public function startProcessAction(): void
    {
        $projectProcessService = new ProjectProcessService();

        $projectId = (int)$this->urlParams[0];

        if ($projectId > 0) {
            $me = User::currentUser();

            $processId = $projectProcessService->createNewProcess($projectId, $me);

            $projectProcessService->createNewProcessTasks($projectId, $processId);

            $messageGroup = MessageGroup::getInstance();

            if ($messageGroup instanceof MessageGroup) {
                $messageGroup->addMessage(Message::SUCCESS, 'Prozess', 'Es wurde ein neuer Prozess gestartet');
            }
        }

        Redirect::to('/project/' . $projectId);
    }
}