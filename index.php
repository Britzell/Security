<?php

define('ROOT', __DIR__ . '/');
require_once ROOT . 'vendor/autoload.php';

function d($v)
{
    echo '<pre>';
    var_dump($v);
    echo '</pre>';
}

$authentication = new Britzel\Security\Authentication(Britzel\Security\Tests\Entity\User::class, Britzel\Security\Tests\Repository\UserRepository::class);

$user = new Britzel\Security\Tests\Entity\User();
$user->setEmail('ok@google.fr');
$user->setPassword('123');
$user->setPasswordConfirm('123');

d($authentication->register($user));

$user = new Britzel\Security\Tests\Entity\User();
$user->setEmail('ok@google.fr');
$user->setPassword('123');

d($authentication->login($user));

$security = new Britzel\Security\Security([
    '/admin' => ['ADMIN']
], $user);

d($security->authorized('/admin'));

