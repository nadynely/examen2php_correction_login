<?php

class UsersController
{
    public function signup()

    {
        //traitement pour le cas de la route POST

        if (!empty($_POST)) {

            var_dump($_POST);
            /**
             * Valider l'existence de l'email  Vérifier qu'il est unique
             */

         $userDb = User::findBy([''=>'']),
         
        }

        view('users.signup');
    }

    public function logout()
    {
        view('users.logout');
    }

    public function login()
    {
        view('users.login');
    }

}