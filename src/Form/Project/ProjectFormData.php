<?php

declare(strict_types=1);

namespace src\Form\Project;

use lib\Element\Element;
use lib\Form\AbstractFormData;
use src\Model\Project\Project;
use src\Service\Form\ProjectFormDataService\ProjectFormDataService;

class ProjectFormData extends AbstractFormData
{
    public function initStructure(): void
    {
        $project = $this->getModel('project');

        $projectFormDataService = new ProjectFormDataService();

        $this->addElement(
            [
                'id' => 'title',
                'type' => Element::TEXT,
                'label' => 'Titel',
                'read' => function () use ($project) {
                    if ($project instanceof Project && !empty($project->getTitle())) {
                        return $project->getTitle();
                    }

                    return "";
                },
                'write' => function ($value) use ($project) {
                    if ($project instanceof Project) {
                        $project->setTitle($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'description',
                'type' => Element::TEXT,
                'label' => 'Beschreibung',
                'read' => function () use ($project) {
                    if ($project instanceof Project && !empty($project->getDescription())) {
                        return $project->getDescription();
                    }

                    return "";
                },
                'write' => function ($value) use ($project) {
                    if ($project instanceof Project) {
                        $project->setDescription($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'start',
                'type' => Element::DATE,
                'label' => 'Start',
                'read' => function () use ($project) {
                    if ($project instanceof Project && !empty($project->getStart())) {
                        return $project->getStart();
                    }

                    return "";
                },
                'write' => function ($value) use ($project) {
                    if ($project instanceof Project) {
                        $project->setStart($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'end',
                'type' => Element::DATE,
                'label' => 'Ende',
                'read' => function () use ($project) {
                    if ($project instanceof Project && !empty($project->getEnd())) {
                        return $project->getEnd();
                    }

                    return "";
                },
                'write' => function ($value) use ($project) {
                    if ($project instanceof Project) {
                        $project->setEnd($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'creator_user_id',
                'type' => Element::SELECT,
                'label' => 'Angenommen durch',
                'options' => $projectFormDataService->makeSelectOptions(),
                'defaultOption' => true,
                'read' => function () use ($project) {
                    if ($project instanceof Project && !empty($project->getCreator_user_id())) {
                        return $project->getCreator_user_id();
                    }

                    return 0;
                },
                'write' => function ($value) use ($project) {
                    if ($project instanceof Project) {
                        $project->setCreator_user_id($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'current_worker_user_id',
                'type' => Element::SELECT,
                'label' => 'Verantwortlicher Nutzer',
                'options' => $projectFormDataService->makeSelectOptions(),
                'defaultOption' => true,
                'read' => function () use ($project) {
                    if ($project instanceof Project && !empty($project->getCurrent_worker_user_id())) {
                        return $project->getCurrent_worker_user_id();
                    }

                    return 0;
                },
                'write' => function ($value) use ($project) {
                    if ($project instanceof Project) {
                        $project->setCurrent_worker_user_id($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'status',
                'type' => Element::SELECT,
                'label' => 'Status',
                'options' => $projectFormDataService->makeStatusSelectOptions(),
                'defaultOption' => true,
                'read' => function () use ($project) {
                    if ($project instanceof Project && !empty($project->getStatus())) {
                        return $project->getStatus();
                    }

                    return 0;
                },
                'write' => function ($value) use ($project) {
                    if ($project instanceof Project) {
                        $project->setStatus($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'sollCount',
                'type' => Element::NUMBER,
                'label' => 'Soll Stückzahl',
                'read' => function () use ($project) {
                    if ($project instanceof Project && !empty($project->getSollCount())) {
                        return $project->getSollCount();
                    }

                    return 0;
                },
                'write' => function ($val) use ($project) {
                    if ($project instanceof Project) {
                        $project->setSollCount($val);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'istCount',
                'type' => Element::NUMBER,
                'label' => 'Aktuelle Stückzahl',
                'read' => function () use ($project) {
                    if ($project instanceof Project && !empty($project->getIstCount())) {
                        return $project->getIstCount();
                    }

                    return 0;
                },
                'write' => function ($val) use ($project) {
                    if ($project instanceof Project) {
                        $project->setIstCount($val);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'save',
                'type' => Element::SUBMIT,
                'label' => 'Speichern'
            ]
        );
    }
}
