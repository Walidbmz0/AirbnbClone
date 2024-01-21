<?php

namespace App\Model;

use Core\Model;


class Logements extends Model

{

    public string $titre;

    public string $description;

    public float $prix;

    public float $taille;

    public int $couchage;

    public string $image;

    public int $adresse_id;

    public int $utilisateur_id;

    public int $type_logement_id;
}