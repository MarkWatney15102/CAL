<?php

namespace src\Form\Task;

use Exception;
use lib\Element\Element;
use lib\Form\AbstractFormData;
use src\Helper\Task\TaskHelper;
use src\Model\Order\Mapper\OrderContainer;
use src\Model\Order\Order;
use src\Model\Project\Project;
use src\Model\Task\Task;

class TaskFormData extends AbstractFormData
{
    /**
     * @throws Exception
     */
    public function initStructure(): void
    {
        $taskHelper = new TaskHelper();

        /** @var Project $project */
        $project = $this->getModel('project');

        /** @var Task $task */
        $task = $this->getModel('task');

        $this->addElement(
            [
                'id' => 'projectId',
                'type' => Element::HIDDEN,
                'read' => function () use ($project) {
                    if ($project instanceof Project) {
                        return $project->getID();
                    }
                },
                'write' => function ($value) use ($project, $task) {
                    if ($project instanceof Project && $task instanceof Task) {
                        $task->setProjectId($project->getID());
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'name',
                'type' => Element::TEXT,
                'label' => 'Name',
                'read' => function () use ($task) {
                    if($task instanceof Task && !empty($task->getName())) {
                        return $task->getName();
                    }
                    return "";
                },
                'write' => function ($value) use ($task) {
                    $task->setName($value);
                }
            ]
        )->addElement(
            [
                'id' => 'creator',
                'type' => Element::SELECT,
                'label' => 'Ersteller des Auftrages',
                'defaultOption' => true,
                'options' => $taskHelper->getUserList(),
                'read' => function () use ($task) {
                    if($task instanceof Task && !empty($task->getCreator())) {
                        return $task->getCreator();
                    }
                    return 0;
                },
                'write' => function ($value) use ($task) {
                    $task->setCreator($value);
                }
            ]
        )->addElement(
            [
                'id' => 'assignedUserId',
                'type' => Element::SELECT,
                'label' => 'Verantwortlicher',
                'defaultOption' => true,
                'options' => $taskHelper->getUserList(),
                'read' => function () use ($task) {
                    if($task instanceof Task && !empty($task->getAssignedUserId())) {
                        return $task->getAssignedUserId();
                    }
                    return 0;
                },
                'write' => function ($value) use ($task) {
                    $task->setAssignedUserId($value);
                }
            ]
        )->addElement(
            [
                'id' => 'childOf',
                'type' => Element::SELECT,
                'label' => 'Unterauftrag von',
                'defaultOption' => true,
                'options' => $taskHelper->getTaskList($project->getID(), $task->getID() ?? 0),
                'read' => function () use ($task) {
                    if($task instanceof Task && !empty($task->getChildOf())) {
                        return $task->getChildOf();
                    }
                    return 0;
                },
                'write' => function ($value) use ($task) {
                    $task->setChildOf($value);
                }
            ]
        )->addElement(
            [
                'id' => 'status',
                'type' => Element::SELECT,
                'label' => 'Status',
                'defaultOption' => true,
                'options' => $taskHelper->getTaskStatus(),
                'read' => function () use ($task) {
                    if ($task instanceof Task && !empty($task->getStatus())) {
                        return $task->getStatus();
                    }

                    return 0;
                },
                'write' => function ($value) use ($task) {
                    $task->setStatus($value);
                }
            ]
        )->addElement(
            [
                'id' => 'order',
                'type' => Element::SELECT,
                'label' => 'Bestellung notwendig',
                'defaultOption' => true,
                'options' => [
                    ['value' => 1, 'text' => 'Ja'],
                    ['value' => 2, 'text' => 'Nein']
                ],
                'read' => function () use ($task) {
                    if ($task instanceof Task && !empty($task->getOrderNeeded())) {
                        return $task->getOrderNeeded();
                    }

                    return 0;
                },
                'write' => function ($value) use ($task) {
                    $task->setOrderNeeded($value);
                }
            ]
        )->addElement(
            [
                'id' => 'save',
                'type' => Element::SUBMIT,
                'label' => 'Speichern'
            ]
        )->addElement(
            [
                'id' => 'description',
                'type' => Element::TEXTAREA,
                'label' => 'Beschreibung',
                'read' => function () use ($task) {
                    if ($task instanceof Task && !empty($task->getDescription())) {
                        return $task->getDescription();
                    }

                    return '';
                },
                'write' => function ($value) use ($task) {
                    if ($task instanceof Task) {
                        $task->setDescription($value);
                    }
                }
            ]
        );

        if ((int)$task->getOrderNeeded() === 1) {
            $this->addElement(
                [
                    'id' => 'orderId',
                    'type' => Element::SELECT,
                    'label' => 'Bestellnummer',
                    'defaultOption' => true,
                    'options' => $this->getOrdersForTask($task->getID()),
                    'read' => function () use ($task) {
                        if ($task instanceof Task && !empty($task->getOrderId())) {
                            return $task->getOrderId();
                        }
                        return 0;
                    },
                    'write' => function ($value) use ($task) {
                        $task->setOrderId($value);
                    }
                ]
            )->addElement(
                [
                    'id' => 'information',
                    'type' => Element::TEXTAREA,
                    'label' => 'Informationen',
                    'read' => function () use ($task) {
                        if ($task instanceof Task && !empty($task->getOrderInformation())) {
                            return $task->getOrderInformation();
                        }
                        return "";
                    },
                    'write' => function ($value) use ($task) {
                        $task->setOrderInformation($value);
                    }
                ]
            );
        }
    }

    private function getOrdersForTask(int $taskId): array
    {
        $options = [];

        /** @var Order[] $orders */
        $orders = OrderContainer::getInstance()?->findBy(['taskId' => $taskId]);

        foreach ($orders as $order) {
            $text = "[" . $order->getID() . "] " . $order->getSupplier() . " - " . $order->getTrackingCode();

            $options[] = ['value' => $order->getID(), 'text' => $text];
        }

        return $options;
    }
}