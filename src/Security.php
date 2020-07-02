<?php


namespace Britzel\Security;


class Security
{

    private $config;
    private $user;

    public function __construct(array $config, $entityUser)
    {
        $this->config = $config;
        $this->user = $entityUser;
    }

    public function authorized(string $route): bool
    {
        foreach ($this->config as $key => $value) {
            if (preg_match("#$key#", $route)) {
                foreach ($value as $role) {
                    if ($role === $this->user->getRole())
                        return true;
                }
                return false;
            }
        }
        return true;
    }

}