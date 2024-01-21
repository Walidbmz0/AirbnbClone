<?php

namespace App\Model;

use Core\Model;

// on déclare la classe User qui hérite de la classe Model
class User extends Model
{
    public const ROLE_STANDARD = 0;
    public const ROLE_host = 1;

    public string $nom;
    public string $prenom;
    public string $email;

    public string $password;

    public bool $is_host;
}
