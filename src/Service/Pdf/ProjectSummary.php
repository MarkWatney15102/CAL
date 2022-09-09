<?php

namespace src\Service\Pdf;

use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use lib\View\View;
use src\Model\Project\Mapper\ProjectMapper;
use src\Model\Project\Project;
use src\Service\Qr\QrCodeGenerator;

class ProjectSummary
{
    private Dompdf $pdf;

    public function __construct(int $projectId)
    {
        $project = ProjectMapper::getInstance()?->read($projectId);

        if ($project instanceof Project) {
            $options = new Options();
            $options->set('isRemoteEnabled',true);

            $this->pdf = new Dompdf($options);

            $this->pdf->loadHtml($this->loadContent($project));

            $this->pdf->render();
            $this->pdf->stream('file.pdf',
                [
                    'Attachment' => 0
                ]
            );
        }
    }

    private function loadContent(Project $project): string
    {
        $projectSummaryService = new ProjectSummaryService();
        $taskList = $projectSummaryService->getTasksByProject($project->getID());
        $tasks = $projectSummaryService->buildTaskList($taskList);

        $url = "https://{$_SERVER['HTTP_HOST']}/project/{$project->getID()}";

        $pathToQRCode = QrCodeGenerator::generateQrCode($url, 'Projekt einsehen', 200);

        return View::load(
            'pdf/projectSummary',
            [
                'projectId' => $project->getID(),
                'projectTitle' => $project->getTitle(),
                'projectStart' => $this->getDateTimeByString($project->getStart() ?? ""),
                'projectEnd' => $this->getDateTimeByString($project->getEnd() ?? ""),
                'soll' => $project->getSollCount(),
                'is' => $project->getIstCount(),
                'pathToQRCode' => $pathToQRCode,
                'tasks' => $tasks
            ]
        );
    }

    private function getDateTimeByString(string $dateTime): string
    {
        try {
            $dateTime = new DateTime($dateTime);
        } catch (Exception $e) {
            $dateTime = new DateTime();
        }


        return $dateTime->format('d.m.Y');
    }
}