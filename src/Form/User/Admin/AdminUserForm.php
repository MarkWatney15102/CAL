<?php

namespace src\Form\User\Admin;

use lib\Element\AbstractElement;
use lib\Element\Elements\ElementSubmit;
use lib\Form\AbstractForm;
use src\Model\User\Mapper\UserMapper;
use src\Model\User\User;

class AdminUserForm extends AbstractForm
{
    public function save(): void
    {
        $elements = $this->formData->getElements();
        /** @var User $user */
        $user = $this->formData->getModel('user');

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

        if ($user->getID() !== null) {
            $userId = UserMapper::getInstance()?->update($user);
        } else {
            $userId = UserMapper::getInstance()?->create($user);
        }

        header('Location: /admin/user/edit/' . $userId);
    }
}