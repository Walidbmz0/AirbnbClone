<?php

namespace App\Model\Repository;

use Core\Repository;
use App\Model\Typelogement;

// On déclare la classe TypelogementRepository qui hérite de la classe Repository
class TypelogementRepository extends Repository 
{
	public function getTableName(): string 
	{ 
		return 'type_logement'; 
	}

    public function findAll(): array 
    {
        
        return $this->readAll(Typelogement::class);
    }
}