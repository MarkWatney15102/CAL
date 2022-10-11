<?php

namespace src\Controller\Admin\User;

use lib\Controller\AbstractController;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Form\User\Admin\AdminUserFormFactory;
use src\Model\User\Mapper\UserMapper;
use src\Model\User\User;

class UserEditController extends AbstractController
{
    public function editUserAction(): void
    {
        $userId = $this->urlParams[0];

        $user = UserMapper::getInstance()?->read($userId);

        if (!$user instanceof User) {
            throw new \Exception('User not found');
        }

        $this->form = AdminUserFormFactory::make($userId);

        $this->render(
            'admin/user/edit',
            [
                'renderWithBasicBody' => true,
                'user' => $user,
                'form' => $this->form
            ]
        );
    }

    public function createUserAction(): void
    {
        $this->form = AdminUserFormFactory::makeWithoutModel();

        $this->render(
            'admin/user/create',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form
            ]
        );
    }

    public function saveUserAction(): void
    {
        $userId = (int)$this->urlParams[0];

        $this->form = AdminUserFormFactory::make($userId);

        $messageGroup = MessageGroup::getInstance();

        if ($messageGroup instanceof MessageGroup) {
            $messageGroup->addMessage(Message::SUCCESS, 'Formular', 'Speicherung war erfolgreich');
        }

        $this->form->save();
    }
}