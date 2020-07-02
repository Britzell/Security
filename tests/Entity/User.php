<?php


namespace Britzel\Security\Tests\Entity;


class User
{

    private $id;
    private $email;
    private $password;
    private $password_confirm;
    private $role = 'USER';

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPasswordConfirm()
    {
        return $this->password_confirm;
    }

    /**
     * @param mixed $password_confirm
     */
    public function setPasswordConfirm($password_confirm): void
    {
        $this->password_confirm = $password_confirm;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function hydrate($data) {
        if (isset($data['id']))
            $this->setId($data['id']);
        if (isset($data['email']))
            $this->setEmail($data['email']);
        if (isset($data['password']))
            $this->setPassword($data['password']);
        if (isset($data['password_confirm']))
            $this->setPasswordConfirm($data['password_confirm']);
        if (isset($data['role']))
            $this->setRole($data['role']);
    }

}