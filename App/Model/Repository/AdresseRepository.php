<?php

namespace App\Model\Repository;

use Core\Repository;
use App\Model\Adresse;
use App\AppRepoManager;

class AdresseRepository extends Repository 
{
	public function getTableName(): string 
	{ 
		return 'adresse'; 
	}

	public function getAdresseByName(): ?array 
	{
		$arr_result = [];
		$q_adresse = sprintf(
		// Création de la requête sprintf()
		// On passe les variables 
			'SELECT %1$s.ville, %1$s.id
			FROM %1$s
			JOIN %2$s
			ON %1$s.id = %2$s.%1$s_id
			GROUP BY %1$s.id',
			$this->getTableName(),
			AppRepoManager::getRm()->getLogementsRepo()->getTableName()
		);
        // On prépare la requête
		$sth_adresse = $this->pdo->query($q_adresse);
        // Si la requête n'est pas valide, on retourne null
		if (!$sth_adresse) return null;
        // On exécute la requête
		while ($row_data_adresse = $sth_adresse->fetch()) $r_adresse[] = new Adresse($row_data_adresse);
        // On retourne le résultat
		return $r_adresse;
	}

	public function dernierId() :int
	{
		return $this->pdo->lastInsertId(Adresse::class);
	}

	public function insert(string $pays, string $ville)
    {
        $q = sprintf(
            'INSERT INTO `%s` (`pays`,`ville`) 
                    VALUES (:pays, :ville)',
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($q);
        if (!$stmt) return null;
        $stmt->execute([
            'pays' => $pays,
            'ville' => $ville
        ]);
	}
}