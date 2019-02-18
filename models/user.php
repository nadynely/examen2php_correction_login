<?php

class User extends Db
{

    protected $id;
    protected $pseudo;
    protected $email;
    protected $password_hash;
    protected $created_at;

    public function __construct(string $pseudo, string $email, $id = null)
    {
        $this->
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
        /**Valider l'email
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
}