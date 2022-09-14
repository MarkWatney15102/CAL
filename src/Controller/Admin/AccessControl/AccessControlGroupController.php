<?php

namespace src\Controller\Admin\AccessControl;

use lib\Controller\AbstractController;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Form\AccessControl\Group\AccessControlGroupFormFactory;
use src\Model\AccessControlGroup\Mapper\AccessControlGroupContainer;
use src\Service\AccessControl\AccessControlGroupService;
use src\Service\AccessControl\AccessControlService;

class AccessControlGroupController extends AbstractController
{
    public function groupAction(): void
    {
        $groups = AccessControlGroupContainer::getInstance()?->findBy([]);

        $this->render(
            'admin/accessControl/group-overview',
            [
                'renderWithBasicBody' => true,
                'groups' => $groups
            ]
        );
    }

    public function editGroupAction(): void
    {
        $groupId = (int)$this->urlParams[0];

        if ($groupId !== 0) {
            $this->editGroup($groupId);
        } else {
            $this->createGroup();
        }
    }

    private function editGroup(int $groupId): void
    {
        $this->form = AccessControlGroupFormFactory::make($groupId);

        $service = new AccessControlGroupService($groupId);
        $permissionList = $service->getPermissionsWithStatus();

        $this->render(
            'admin/accessControl/group/edit',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form,
                'permissionList' => $permissionList,
                'groupId' => $groupId
            ]
        );
    }

    private function createGroup(): void
    {
        $this->form = AccessControlGroupFormFactory::makeWithoutModel();

        $this->render(
            'admin/accessControl/group/create',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form
            ]
        );
    }

    public function saveGroupAction(): void
    {
        $roleId = (int)$this->urlParams[0];

        $this->form = AccessControlGroupFormFactory::make($roleId);

        $messageGroup = MessageGroup::getInstance();

        if ($messageGroup instanceof MessageGroup) {
            $messageGroup->addMessage(Message::SUCCESS, 'Formular', 'Speicherung war erfolgreich');
        }

        $this->form->save();
    }

    public function changePermissionAction(): void
    {
        $success = false;
        $data = json_decode(file_get_contents('php://input'));

        if (is_int($data->status) && !empty($data->groupId) && !empty($data->permissionId)) {
            $service = new AccessControlService();

            try {
                switch ($data->status) {
                    case 0:
                        $service->addPermissionToGroup($data->permissionId, $data->groupId);
                        $success = true;
                        break;
                    case 1:
                        $service->removePermissionFromGroup($data->permissionId, $data->groupId);
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