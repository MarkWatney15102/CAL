<?php

namespace src\Form\Task;

use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSubmit;
use lib\Form\AbstractForm;
use src\Model\Task\Mapper\TaskMapper;
use src\Model\Task\Task;

class TaskForm extends AbstractForm
{
    public function save(): void
    {
        $elements = $this->formData->getElements();
        /** @var Task $task */
        $task = $this->formData->getModel('task');

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

        if ($task->getID() !== null) {
            $taskId = TaskMapper::getInstance()?->update($task);
        } else {
            $taskId = TaskMapper::getInstance()?->create($task);
        }

        header('Location: /task/' . $task->getProjectId() . '/' . $taskId);
    }
}