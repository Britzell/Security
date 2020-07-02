<?php

namespace Britzel\Security;


class Authentication
{

    private $user;
    private $userRepository;
    private $sessionName;

    public function __construct(string $userEntityClass, string $userRepositoryClass, string $sessionName = 'user')
    {
        $this->user = new $userEntityClass;
        $this->userRepository = new $userRepositoryClass;
        $this->sessionName = $sessionName;
    }

    public function getIdentifier(): string
    {
        $methods = get_class_methods($this->user);

        foreach ($methods as $name) {
            if ($name === 'setUsername')
                return 'username';
        }
        return 'email';
    }

    public function login($user): array
    {
        $errors = [];

        if ($user->getUsername() === null)
            $errors[] = Error::getError(Error::LOGIN_USERNAME);

        if ($user->getPassword() === null)
            $errors[] = Error::getError(Error::LOGIN_PASSWORD);

        if (!empty($errors))
            return $errors;

        $userBdd = $this->userRepository->findBy($this->getIdentifier(), $user->getUsername());

        if (empty($userBdd) && $userBdd[0]->getId() === null) {
            $errors[] = Error::getError(Error::LOGIN_NOT_FOUND);
            return $errors;
        }

        if (!password_verify($user->getPassword(), $userBdd[0]->getPassword()))
            $errors[] = Error::getError(Error::LOGIN_PASSWORD_NOT_FOUND);

        if (empty($errors))
            $_SESSION[$this->sessionName] = $userBdd;

        return $errors;
    }

    public function register($user): array
    {
        $errors = [];

        $methods = get_class_methods($this->user);

        $methodsToValidate = [];
        foreach ($methods as $name) {
            if (substr($name, 0, 3) === 'set' && $name != 'setId')
                $methodsToValidate[] = $name;
        }

        foreach ($methodsToValidate as $value) {
            $method = 'get' . substr($value, 3);
            if ($user->$method() === null)
                $errors[] = Error::getErrorRegister(substr($value, 3));
        }

        if ($user->getPassword() != $user->getPasswordConfirm())
            $errors[] = Error::getErrorRegister('passwordConfirm');

        if (empty($errors)) {
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT, ['cost' => 12]));
            $user = $this->userRepository->persist($user);
            if ($user->getId() === null)
                $errors[] = Error::getErrorRegister('notFound');
            else
                $_SESSION[$this->sessionName] = $user;
        }

        return $errors;
    }

}