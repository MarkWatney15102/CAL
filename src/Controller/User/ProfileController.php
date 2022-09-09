<?php

namespace src\Controller\User;

use Exception;
use lib\Controller\AbstractController;
use src\Form\User\Profile\ProfileFormFactory;
use src\Model\User\Mapper\UserMapper;
use src\Model\User\User;

class ProfileController extends AbstractController
{
    /**
     * @throws Exception
     */
    public function profileAction(): void
    {
        /** @var User $me */
        $me = UserMapper::getInstance()?->getCurrentUser();

        $this->form = ProfileFormFactory::make($me);

        $this->render(
            'user/profile',
            [
                'renderWithBasicBody' => true,
                'form' => $this->form
            ]
        );
    }

    /**
     * @todo Speicher Logik
     */
    public function saveAction(): void
    {

    }
}