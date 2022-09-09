<?php

namespace src\Pdf;

use Exception;
use lib\PDF\AbstractPdf;
use lib\View\View;
use src\Model\Task\Mapper\TaskMapper;
use src\Model\Task\Task;
use src\Service\Pdf\TaskWorkCardService;
use src\Service\Qr\QrCodeGenerator;

class TaskWorkCard extends AbstractPdf
{
    private int $taskId;
    private TaskWorkCardService $taskSummaryService;

    public function getHtml(): string
    {
        $task = TaskMapper::getInstance()?->read($this->taskId);

        if (!$task instanceof Task) {
            throw new Exception('No task found for ' . $this->taskId);
        }

        $this->taskSummaryService = new TaskWorkCardService($task);

        $url = "https://{$_SERVER['HTTP_HOST']}/task/{$task->getProjectId()}/{$task->getID()}";

        return View::load(
            'pdf/taskWorkCard',
            [
                'taskId' => $task->getID(),
                'name' => $task->getName(),
                'status' => $this->taskSummaryService->getStatus(),
                'resource' => $this->taskSummaryService->getResourceList(),
                'description' => $task->getDescription(),
                'pathToQRCode' => QrCodeGenerator::generateQrCode($url, 'Auftrag einsehen', 150)
            ]
        );
    }

    public function setTaskId(int $taskId): void
    {
        $this->taskId = $taskId;
    }
}