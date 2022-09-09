<?php
declare(strict_types=1);

namespace src\Service\HomeController;

use src\Helper\DateFormatHelper;
use src\Model\Project\Project;

class HomeControllerService
{
    public function buildTableBody(array $projects): string
    {
        $return = "";

        foreach ($projects as $project) {
            if ($project instanceof Project) {
                $projectId = $project->getId();
                $projectTitle = $project->getTitle();
                $projectStart = DateFormatHelper::format($project->getStart());
                $projectEnd = DateFormatHelper::format($project->getEnd());

                $return .= <<<HTML
                    <tr>
                        <td>{$projectId}</td>
                        <td>{$projectTitle}</td>
                        <td>{$projectStart}</td>
                        <td>{$projectEnd}</td>
                        <td><a href="/project/{$projectId}" class="btn btn-outline-primary">Öffnen</a></td>
                    </tr>
                HTML;
            }
        }

        return $return;
    }
}
