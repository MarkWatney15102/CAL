<?php

namespace src\Controller\Register;

use lib\Controller\AbstractController;
use lib\Message\Message;
use lib\Message\MessageGroup;
use src\Form\RegisterFormFactory;
use src\Helper\HTML;
use src\Helper\Redirect;
use src\Model\User\Mapper\UserMapper;
use src\Model\User\User;

class RegisterController extends AbstractController
{
    public function register(): void
    {
        $this->form = RegisterFormFactory::make();

        $this->render('register/register', [
            'renderWithBasicBody' => false,
            'form' => $this->form
        ]);
    }

    public function tryRegister(): void
    {
        $firstname = HTML::cleanString($_POST['firstname']);
        $lastname = HTML::cleanString($_POST['lastname']);
        $username = substr($firstname, 0, 3) . substr($lastname, 0, 3);
        $email = HTML::cleanString($_POST['email']);
        $password = HTML::cleanString($_POST['password']);

        if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {
            $date = date('Y-m-d H:i:s', time());

            $user = new User();
            $user->setCreateTime($date);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setLevel(5);
            $user->setMail($email);
            $user->setPassword($password); //TODO hashen
            $user->setUsername($username);

            UserMapper::getInstance()->create($user);
        } else {
            MessageGroup::getInstance()?->addMessage(Message::ERROR, 'Registrierung Fehlgeschlagen', 'Bitte fülle alle Felder aus');
            Redirect::to('/register');
        }

        //TODO Funktioniert, nur noch Sachen in Datenbank einschreiben
    }
}