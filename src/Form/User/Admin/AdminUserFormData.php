<?php

namespace src\Form\User\Admin;

use Exception;
use lib\Element\Element;
use lib\Form\AbstractFormData;
use src\Model\User\User;
use src\Service\User\AdminUserService;

class AdminUserFormData extends AbstractFormData
{
    /**
     * @throws Exception
     */
    public function initStructure(): void
    {
        /** @var User $user */
        $user = $this->getModel('user');

        $adminUserService = new AdminUserService();

        $this->addElement(
            [
                'id' => 'email',
                'type' => Element::EMAIL,
                'label' => 'E-Mail',
                'read' => function () use ($user) {
                    if ($user instanceof User && !empty($user->getMail())) {
                        return $user->getMail();
                    }

                    return '';
                },
                'write' => function ($value) use ($user) {
                    if ($user instanceof User) {
                        $user->setMail($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'username',
                'type' => Element::TEXT,
                'label' => 'Benutzername',
                'read' => function () use ($user) {
                    if ($user instanceof User && !empty($user->getUsername())) {
                        return $user->getUsername();
                    }

                    return '';
                },
                'write' => function ($value) use ($user) {
                    if ($user instanceof User) {
                        $user->setUsername($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'firstname',
                'type' => Element::TEXT,
                'label' => 'Vorname',
                'read' => function () use ($user) {
                    if ($user instanceof User && !empty($user->getFirstname())) {
                        return $user->getFirstname();
                    }

                    return '';
                },
                'write' => function ($value) use ($user) {
                    if ($user instanceof User) {
                        $user->setFirstname($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'lastname',
                'type' => Element::TEXT,
                'label' => 'Nachname',
                'read' => function () use ($user) {
                    if ($user instanceof User && !empty($user->getLastname())) {
                        return $user->getLastname();
                    }

                    return '';
                },
                'write' => function ($value) use ($user) {
                    if ($user instanceof User) {
                        $user->setLastname($value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'level',
                'type' => Element::SELECT,
                'label' => 'Level',
                'defaultOption' => true,
                'options' => $adminUserService->getLevelOption(),
                'read' => function () use ($user) {
                    if ($user instanceof User && !empty($user->getLevel())) {
                        return $user->getLevel();
                    }

                    return 0;
                },
                'write' => function ($value) use ($user) {
                    if ($user instanceof User) {
                        $user->setLevel((int)$value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'role',
                'type' => Element::SELECT,
                'label' => 'Rolle',
                'defaultOption' => true,
                'options' => $adminUserService->getRoleOptions(),
                'read' => function () use ($user) {
                    if ($user instanceof User && !empty($user->getRole())) {
                        return $user->getRole();
                    }

                    return 0;
                },
                'write' => function ($value) use ($user) {
                    if ($user instanceof User) {
                        $user->setRole((int)$value);
                    }
                }
            ]
        )->addElement(
            [
                'id' => 'status',
                'type' => Element::HIDDEN,
                'read' => function () use ($user) {
                    return 1;
                },
                'write' => function () use ($user) {
                    $user->setStatus(1);
                }
            ]
        )->addElement(
            [
                'id' => 'submit',
                'type' => Element::SUBMIT,
                'label' => 'Speichern'
            ]
        );
    }
}