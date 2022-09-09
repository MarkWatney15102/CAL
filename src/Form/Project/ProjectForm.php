<?php

declare(strict_types=1);

namespace src\Form\Project;

use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSubmit;
use lib\Form\AbstractForm;
use src\Model\Project\Mapper\ProjectMapper;

class ProjectForm extends AbstractForm
{
    public function save(): void
    {
        $elements = $this->formData->getElements();
        $project = $this->formData->getModel('project');

        foreach ($elements as $element) {
            if ($element instanceof AbstractElement && !$element instanceof ElementSubmit) {
                if (array_key_exists($element->getId(), $_POST)) {
                    $newValue = $_POST[$element->getId()];
                    if (!empty($element->getWrite())) {
                        call_user_func($element->getWrite(), $newValue);
                    }
                }
            }
        }

        if ($project->getID() !== null && $project->getID() !== 0) {
            $projectId = ProjectMapper::getInstance()?->update($project);
        } else {
            $projectId = ProjectMapper::getInstance()?->create($project);
        }

        header('Location: /project/' . $projectId);
    }
}
