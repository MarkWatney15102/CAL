<?php

namespace src\Form\AccessControl\Group;

use lib\Element\Element;
use lib\Form\AbstractFormData;
use src\Model\AccessControlGroup\AccessControlGroup;

class AccessControlGroupFormData extends AbstractFormData
{
    public function initStructure(): void
    {
        /** @var AccessControlGroup $group */
        $group = $this->getModel('group');

        $this->addElement(
            [
                'id' => 'groupName',
                'type' => Element::TEXT,
                'label' => "Name der Gruppe",
                'read' => function () use ($group) {
                    if ($group instanceof AccessControlGroup && !empty($group->getName())) {
                        return $group->getName();
                    }

                    return "";
                },
                'write' => function ($value) use ($group) {
                    if ($group instanceof AccessControlGroup) {
                        $group->setName($value);
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