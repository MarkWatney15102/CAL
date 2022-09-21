<?php

namespace src\Controller\Admin\AccessControl;

use lib\Controller\AbstractController;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Form\AccessControl\Permission\AccessControlPermissionFormFactory;
use src\Model\AccessControlPermission\Mapper\AccessControlPermissionContainer;

class AccessControlPermissionController extends AbstractController
{
    public function permissionAction(): void
    {
        $permissions = AccessControlPermissionContainer::getInstance()?->findBy([]);

        $this->render(
            'admin/accessControl/permission-overview',
            [
                'renderWithBasicBody' => true,
                'permissions' => $permissions
            ]
        );
    }

    public function editPermissionAction(): void
    {
        $permissionId = (int)$this->urlParams[0];

        if ($permissionId !== 0) {
            $this->editPermission($permissionId);
        } else {
            $this->createPermission();
        }
    }

    private function editPermission(int $permissionId): void
    {
        $this->form = AccessControlPermissionFormFactory::make($permissionId);

        $this->render(
            'admin/accessControl/permission/edit',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form
            ]
        );
    }

    private function createPermission(): void
    {
        $this->form = AccessControlPermissionFormFactory::makeWithoutModel();

        $this->render(
            'admin/accessControl/permission/create',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form
            ]
        );
    }

    public function savePermissionAction(): void
    {
        $permissionId = (int)$this->urlParams[0];

        $this->form = AccessControlPermissionFormFactory::make($permissionId);

        $messageGroup = MessageGroup::getInstance();

        if ($messageGroup instanceof MessageGroup) {
            $messageGroup->addMessage(Message::SUCCESS, 'Formular', 'Speicherung war erfolgreich');
        }

        $this->form->save();
    }
}