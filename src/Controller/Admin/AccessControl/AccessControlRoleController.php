<?php

namespace src\Controller\Admin\AccessControl;

use lib\Controller\AbstractController;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Form\AccessControl\Role\AccessControlRoleFormFactory;
use src\Model\AccessControlRole\Mapper\AccessControlRoleContainer;
use src\Service\AccessControl\AccessControlRoleService;
use src\Service\AccessControl\AccessControlService;

class AccessControlRoleController extends AbstractController
{
    public function roleAction(): void
    {
        $roles = AccessControlRoleContainer::getInstance()?->findBy([]);

        $this->render(
            'admin/accessControl/role-overview',
            [
                'renderWithBasicBody' => true,
                'roles' => $roles
            ]
        );
    }

    public function editRoleAction(): void
    {
        $roleId = (int)$this->urlParams[0];

        if ($roleId !== 0) {
            $this->editRole($roleId);
        } else {
            $this->createRole();
        }
    }

    private function editRole(int $roleId): void
    {
        $this->form = AccessControlRoleFormFactory::make($roleId);

        $service = new AccessControlRoleService($roleId);
        $groupList = $service->getGroupsWithStatus();

        $this->render(
            'admin/accessControl/role/edit',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form,
                'groupList' => $groupList,
                'roleId' => $roleId
            ]
        );
    }

    private function createRole(): void
    {
        $this->form = AccessControlRoleFormFactory::makeWithoutModel();

        $this->render(
            'admin/accessControl/role/create',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form
            ]
        );
    }

    public function saveRoleAction(): void
    {
        $roleId = (int)$this->urlParams[0];

        $this->form = AccessControlRoleFormFactory::make($roleId);

        $messageGroup = MessageGroup::getInstance();

        if ($messageGroup instanceof MessageGroup) {
            $messageGroup->addMessage(Message::SUCCESS, 'Formular', 'Speicherung war erfolgreich');
        }

        $this->form->save();
    }

    public function changeGroupAction(): void
    {
        $success = false;
        $data = json_decode(file_get_contents('php://input'));

        if (is_int($data->status) && !empty($data->groupId) && !empty($data->roleId)) {
            $service = new AccessControlService();

            try {
                switch ($data->status) {
                    case 0:
                        $service->addGroupToRole($data->roleId, $data->groupId);
                        $success = true;
                        break;
                    case 1:
                        $service->removeGroupFromRole($data->roleId, $data->groupId);
                        $success = true;
                        break;
                }
            } catch (\Exception $exception) {
                $success = false;
            }
        }

        $this->renderJson(
            [
                'success' => $success
            ]
        );
    }
}