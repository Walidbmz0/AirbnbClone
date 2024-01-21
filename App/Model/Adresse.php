<?php

namespace App\Model;

use Core\Model;

// On déclare la classe Adresse qui hérite de la classe Model
Class Adresse extends Model 
{
    // Propriétés correspondant aux collones de la table
    public string $pays;
    
    public string $ville;
}