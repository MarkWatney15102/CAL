<?php

namespace src\Controller\Task;

use JsonException;
use lib\Controller\AbstractController;
use lib\Database\Database;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Form\Task\TaskFormFactory;
use src\Helper\Task\TaskHelper;
use src\Model\Resource\Mapper\ResourceMapper;
use src\Model\Resource\Resource;
use src\Model\Task\Task;
use src\Pdf\TaskWorkCard;
use src\Service\Table\Task\TaskService;

class TaskController extends AbstractController
{
    public function taskAction(): void
    {
        $projectId = (int)$this->urlParams[0];
        $taskId = (int)$this->urlParams[1];

        if ($projectId > 0) {
            if ($taskId !== 0) {
                $this->editTask($projectId, $taskId);
            } else {
                $this->newTask($projectId);
            }
        }
    }

    private function editTask(int $projectId, int $taskId): void
    {
        $this->form = TaskFormFactory::make($projectId, $taskId);

        $taskHelper = new TaskHelper();
        $taskTableService = new TaskService();

        $subTasks = $taskHelper->getSubTasks($taskId);
        $subTasksTable = $taskTableService->buildTableBody($subTasks);

        /** @var Task $task */
        $task = $this->form->getFormData()->getModel('task');

        $this->render(
            'task/task',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form,
                'taskId' => $task->getID(),
                'projectId' => $projectId,
                'subTasksTable' => $subTasksTable,
                'orderNeeded' => (int)$task->getOrderNeeded() === 1,
                'resourceFields' => $taskHelper->getResourcesFields($taskId)
            ]
        );
    }

    private function newTask(int $projectId): void
    {
        $this->form = TaskFormFactory::makeWithoutModel($projectId);

        $this->render(
            'task/new-task',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form,
            ]
        );
    }

    public function saveTaskAction(): void
    {
        $projectId = (int)$this->urlParams[0];
        $taskId = (int)$this->urlParams[1];

        $this->form = TaskFormFactory::make($projectId, $taskId);

        /** @var Task $task */
        $task = $this->form->getFormData()->getModel('task');

        if ((int)$task->getOrderNeeded() === 0) {
            $task->setOrderId(0);
            $task->setOrderInformation("");
        }

        $messageGroup = MessageGroup::getInstance();

        if ($messageGroup instanceof MessageGroup) {
            $messageGroup->addMessage(Message::SUCCESS, 'Formular', 'Speicherung war erfolgreich');
        }

        $this->form->save();
    }

    public function createNewResourceAction(): void
    {
        $taskId = (int)$this->urlParams[0];

        $resource = new Resource();
        $resource->setTaskId($taskId);
        $resource->setName("---");
        $resource->setAmount(0);

        $resourceId = ResourceMapper::getInstance()?->create($resource);

        $this->renderJson(['resourceId' => $resourceId]);
    }

    /**
     * @throws JsonException
     */
    public function editResourceAction(): void
    {
        $status = 400;
        $message = "Es ist ein Fehler aufgetreten";

        $data = json_decode(file_get_contents('php://input'));

        $name = $data->name;
        $amount = $data->amount;
        $resourceId = $data->resourceId;

        if (!empty($name) && is_numeric($amount) && !empty($resourceId)) {
            $resource = ResourceMapper::getInstance()?->read($resourceId);

            if ($resource instanceof Resource) {
                $resource->setAmount($amount);
                $resource->setName($name);

                ResourceMapper::getInstance()?->update($resource);

                $message = "Erfolgreich gespeichert";
                $status = 200;
            }
        }

        $this->renderJson(['status' => $status, 'message' => $message]);
    }

    public function deleteResourceAction(): void
    {
        $status = 400;
        $message = "Es ist ein Fehler aufgetreten";

        $data = json_decode(file_get_contents('php://input'));

        $resourceId = $data->resourceId;

        if (!empty($resourceId)) {
            $resource = ResourceMapper::getInstance()?->read($resourceId);

            if ($resource instanceof Resource) {
                ResourceMapper::getInstance()?->delete($resource);
                $message = "Erfolgreich gelöscht";
                $status = 200;
            }
        }

        $this->renderJson(['status' => $status, 'message' => $message]);
    }

    public function taskWorkCardAction(): void
    {
        $taskId = (int)$this->urlParams[0];

        if (!empty($taskId)) {
            $taskSummary = new TaskWorkCard();
            $taskSummary->setTaskId($taskId);

            $taskSummary->initPdf();
            $taskSummary->outputPdf();
        }
    }
}