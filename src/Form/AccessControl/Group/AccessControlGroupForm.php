<?php

namespace src\Form\AccessControl\Group;

use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSubmit;
use lib\Form\AbstractForm;
use src\Model\AccessControlGroup\AccessControlGroup;
use src\Model\AccessControlGroup\Mapper\AccessControlGroupMapper;

class AccessControlGroupForm extends AbstractForm
{
    public function save(): void
    {
        $elements = $this->formData->getElements();
        /** @var AccessControlGroup $group */
        $group = $this->formData->getModel('group');

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

        if ($group->getID() !== null) {
            $groupId = AccessControlGroupMapper::getInstance()?->update($group);
        } else {
            $groupId = AccessControlGroupMapper::getInstance()?->create($group);
        }

        header('Location: /admin/ac/group/edit/' . $groupId);
    }
}