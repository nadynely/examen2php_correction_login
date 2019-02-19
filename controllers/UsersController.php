<?php

class UsersController extends Db {

    /**Signup page */

    public function signup() {

            //traitement pour le cas de la route POST

        if (!empty($_POST)) {
            
            $userDb = User::findByEmail($_POST['email']);
            
            //SI $userDb existe, alors l'e-mail n'est pas unique, donc l'utilisateur existe, donc on redirige vers la page Login.
             
            if (!empty($userDb)) {
                Header('Location: ' . url('login'));
            }

            // SINON : l'user n'existe pas, on peut créér l'utilisateur.

            else {

            // Comparaison de password et password_confirm

            if ($_POST['password'] == $_POST['password_confirm']) {

            // Créer l'utilisateur :

                    $user = new User($_POST['pseudo'], $_POST['email'], $_POST['password']);
                    $user->save();

            // Session :
                    // On passe notre objet User en session afin d'y accéder de partout dans le code

                    $_SESSION['user'] = $user;

            // Redirection
                    // Maintenant que l'utilisateur est créé et la session créée, on  redirige vers la page d'accueil
                    Header('Location: ' . url('/'));
                }

            else {
                    throw new Exception('Les mots de passe ne correspondent pas.');
                }
            }
         }

        view('users.signup');
    }

    /**
     * Login page
     */

    public function login() {

        if (!empty($_POST)) {
            
            // vérifier que le User existe en BDD avec par exemple :

            $userDb = User::findByEmail($_POST['email']);

        if (empty($userDb)) {

            throw new Exception('L\'utilisateur n\'existe pas');

            }

            // Si l'user existe
            else {

                if (!password_verify($_POST['password'], $userDb->password())) {
                    throw new Exception('Le mot de passe est incorrect.');
                }

            // Si son mot de passe est valide
                else {
                    // passer en session l'User trouvé en DB
                    $_SESSION['user'] = $userDb;
                    Header('Location: ' . url('/'));
                }
            }


        }

        view('users.login');
    }

    /**
     * Logout action
     */
    public function logout()
    {
        session_destroy();
        Header('Location: ' . url('/'));
    }
}