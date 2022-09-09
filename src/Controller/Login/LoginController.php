<?php

namespace src\Controller\Login;

use lib\Auth\Auth;
use lib\Controller\AbstractController;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Form\LoginFormFactory;
use src\Helper\HTML;
use src\Helper\Redirect;
use src\Model\User\Mapper\UserContainer;
use src\Model\User\User;

class LoginController extends AbstractController
{
    public function login(): void
    {
        $this->form = LoginFormFactory::make();

        $this->render('login/login', [
            'renderWithBasicBody' => false,
            'form' => $this->form
        ]);
    }

    public function tryLogin(): void
    {
        $auth = new Auth();

        $username = HTML::cleanString($_POST['username']);
        $passwordInput = HTML::cleanString($_POST['password']);

        $user = UserContainer::getInstance()?->findOne(['username' => $username]);

        if ($user instanceof User) {
            $passwordHash = $user->getPassword();

            if ($auth->isPasswordValid($passwordHash, $passwordInput)) {
                $auth->setUidCookie($user->getID());

                MessageGroup::getInstance()?->addMessage(Message::SUCCESS, 'Login erfolgreich', 'Der Login in das System war erfolgreich');
                Redirect::to('/dashboard');
            } else {
                MessageGroup::getInstance()?->addMessage(Message::ERROR, 'Login fehlgeschlagen', 'Der Login in das System ist fehlgeschlagen');
                Redirect::to('/login');
            }
        } else {
            MessageGroup::getInstance()?->addMessage(Message::ERROR, 'Login fehlgeschlagen', 'Der Login in das System ist fehlgeschlagen');
            Redirect::to('/login');
        }
    }

    public function logoutAction(): void
    {
        MessageGroup::getInstance()?->addMessage(Message::INFO, 'Logout', 'Logout war erfolgreich');

        setcookie('UID', null, -1);
        Redirect::to('/login');
    }
}