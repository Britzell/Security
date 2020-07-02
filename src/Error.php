<?php


namespace Britzel\Security;


class Error
{

    const NOT_PARAMETERS = 1;

    const LOGIN_USERNAME = 10;
    const LOGIN_PASSWORD = 11;
    const LOGIN_NOT_FOUND = 12;
    const LOGIN_PASSWORD_NOT_FOUND = 12;

    static $errors = [
        2 => 'Aucun paramamètres trouvé',
        10 => 'Aucun identifiant trouvé',
        11 => 'Aucun mot de passe trouvé',
        12 => 'Identifiant ou mot de passe incorrecte',
    ];

    static $registerErrors = [
        0 => ' invalide',
        'email' => 'Email invalide ou déjà utiliser',
        'passwordConfirm' => 'Les mots de passe entrés ne sont pas identiques',
        'notFound' => 'Veillez ressayai'
    ];

    public static function getError(int $error)
    {
        return self::$errors[$error];
    }

    public static function getErrorRegister(string $error)
    {
        if (empty(self::$registerErrors[$error]))
            return ucfirst($error) . self::$registerErrors[0];
        return self::$registerErrors[$error];
    }

}