<?php


namespace Britzel\Security\Tests\Repository;


use Britzel\Security\Tests\Entity\User;

class UserRepository
{

    public function findBy(string $criteria, string $value)
    {
        $user = new User();
        $user->setId(1);
        $user->setEmail('ok@google.com');
        $user->setPassword('$2y$10$lH1dl1MvuTj46UhTazNIue0pAd8NccQ023vEx81grPJ9DmO48Tz8e');
        return $user;
    }

    public function persist($user)
    {
        $user->setId(1);
        return $user;
    }

}