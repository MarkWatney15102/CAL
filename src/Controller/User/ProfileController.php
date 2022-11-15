<?php

namespace src\Controller\User;

use Exception;
use lib\Controller\AbstractController;
use src\Form\User\Profile\ProfileFormFactory;
use src\Helper\HTML;
use src\Helper\Redirect;
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

    public function saveAction(): void
    {
        $email = HTML::cleanString($_POST['email']);
        $password = HTML::cleanString(password_hash($_POST['username'], PASSWORD_DEFAULT));

        $mapper = UserMapper::getInstance();

        $user = $mapper->read($_COOKIE['UID']);

        if($user instanceof User){
            if(!(empty($password))) { $user->setPassword($password); }
            if(!(empty($email))) { $user->setMail($email); }

            UserMapper::getInstance()->update($user);
            Redirect::to('/profile');
        }
    }
}