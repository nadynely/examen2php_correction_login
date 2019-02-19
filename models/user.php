<?php

class User extends Db
{

    protected $id;
    protected $pseudo;
    protected $email;
    protected $password;
    protected $created_at;

    const TABLE_NAME = "user";

    public function __construct(string $pseudo, string $email, string $password, $id = null) {
        
        $this->setPseudo($pseudo);
        $this->setEmail($email);
        // On ne passe par setPassword, qui hashe le mdp, que si on n'a pas d'ID (si on a un nouveau user)

        if ($id !== null) {
            $this->password = $password;
        } else {
        $this->setPassword($password);
        }
        $this->setId($id);
    }

    /**
     * Get the value of id
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of pseudo
     */
    public function pseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        /**TODO:Valider l'email
         * 
         */
        $this->email = $email;

        /*throw new**/

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function createdAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function password()
    {
        return $this->password;
    }
    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        // TODO: FACULTATIF : valider le mot de passe
        // (pas trop court, avec des chars speciaux, maj + min ...)
        // on n'enregistre pas $password dans $this->password directement !
        // Il faut hasher le mot de passe en utilisant la fonction password_hash()
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function save()
    {
        $data = [
            'email' => $this->email(),
            'pseudo' => $this->pseudo(),
            'password_hash' => $this->password(),
        ];
        $this->setId(Db::dbCreate(self::TABLE_NAME, $data));
        return $this;
    }

    public static function findByEmail(string $email)
    {
        $data = Db::dbFind(self::TABLE_NAME, [
            ['email', '=', $email]
        ]);
        if (count($data) > 0) $data = $data[0];
        else return; // throw new Exception('Le user n\'existe pas.');

        $user = new User(
            $data['pseudo'],
            $data['email'],
            $data['password_hash'],
            intval($data['id'])
        );
        return $user;
    }

    public static function findByCredentials(string $email, string $password)
    {
        $data = Db::dbFind(self::TABLE_NAME, [
            ['email', '=', $email],
            ['email', '=', password_verify($password, PASSWORD_DEFAULT)]
        ]);
        if (count($data) > 0) $data = $data[0];
        else return; // throw new Exception('Le user n\'existe pas.');
        $user = new User(
            $data['pseudo'],
            $data['email'],
            $data['password_hash'],
            intval($data['id'])
        );
        return $user;
    }
}