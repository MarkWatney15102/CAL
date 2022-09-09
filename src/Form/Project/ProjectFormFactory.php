<?php

declare(strict_types=1);

namespace src\Form\Project;

use src\Model\Project\Mapper\ProjectMapper;
use src\Model\Project\Project;

class ProjectFormFactory
{
    public static function make(): ProjectForm
    {
        $formData = new ProjectFormData();

        $project = new Project();
        $formData->addModel($project, 'project');

        $formData->initStructure();

        return new ProjectForm('projectForm', $formData);
    }

    public static function makeWithData(int $projectId): ProjectForm
    {
        $project = ProjectMapper::getInstance()?->read($projectId);

        $formData = new ProjectFormData();

        if ($project instanceof Project) {
            $formData->addModel($project, 'project');
        }

        $formData->initStructure();

        return new ProjectForm('projectForm', $formData);
    }
}
