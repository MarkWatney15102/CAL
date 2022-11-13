<?php

namespace src\Controller\Register;

use lib\Controller\AbstractController;
use src\Form\RegisterFormFactory;
use src\Helper\HTML;

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
        $username = HTML::cleanString($_POST['username']);
        $firstname = HTML::cleanString($_POST['firstname']);
        $lastname = HTML::cleanString($_POST['lastname']);
        $email = HTML::cleanString($_POST['email']);
        $password = HTML::cleanString($_POST['password']);

        var_dump($username,$firstname,$lastname,$email,$password);

        //TODO Funktioniert, nur noch Sachen in Datenbank einschreiben
    }
}