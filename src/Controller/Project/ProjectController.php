<?php

declare(strict_types=1);

namespace src\Controller\Project;

use Com\Tecnick\Pdf\Tcpdf;
use Dompdf\Dompdf;
use lib\Controller\AbstractController;
use src\Form\Project\ProjectFormFactory;
use src\Model\Task\Mapper\JobContainer;
use src\Model\Task\Mapper\TaskContainer;
use src\Service\Pdf\ProjectSummary;
use src\Service\Table\Task\TaskService;

class ProjectController extends AbstractController
{
    public function project(): void
    {
        $projectId = $this->urlParams[0];

        if ($projectId !== 'new') {
            $this->editProject((int)$projectId);
        } else {
            $this->newProject();
        }
    }

    private function newProject(): void
    {
        $this->form = ProjectFormFactory::make();

        $this->render(
            'project/new-project',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form,
                'projectId' => 0,
                'tableFields' => ''
            ]
        );
    }

    private function editProject(int $projectId): void
    {
        $this->form = ProjectFormFactory::makeWithData($projectId);

        $taskService = new TaskService();
        $tasks = TaskContainer::getInstance()?->findBy(['projectId' => $projectId, 'childOf' => [0, -1]]);

        $this->render(
            'project/project',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form,
                'projectId' => $projectId,
                'tableFields' => $taskService->buildTableBody($tasks),
                'projectProcesses' => $taskService->getActiveProcesses($projectId)
            ]
        );
    }

    public function saveProject(): void
    {
        $projectId = (int)$this->urlParams[0];

        $this->form = ProjectFormFactory::makeWithData($projectId);

        $this->form->save();
    }

    public function summaryAction(): void
    {
        $projectId = (int)$this->urlParams[0];

        if (!empty($projectId)) {
            new ProjectSummary($projectId);
        }
    }
}