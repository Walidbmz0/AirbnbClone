<?php 

namespace App\Model\Repository;
use App\AppRepoManager;
use App\Model\Adresse;
use App\Model\Logements;
use Core\Repository;

// on déclare la classe LogementsRepository qui hérite de la classe Repository

class LogementsRepository extends Repository
{
    public function getAllLogements()
    {
        return $this->readAll(Logements::class);
        }
	
        // on déclare la méthode getTableName
        
	public function getTableName(): string {
        return 'Logement';
	}

    // on déclare la méthode findAll
        public function findById(int $id): ?Logements
        {
            return $this->readById(Logements::class, $id);
        }
       
        
        public function findByIdWithAdresse(int $id): ?Logements
        {
            //on va utiliser l'hydratation (Hydrator)
            $q = sprintf(
                'SELECT
                     `%1$s`.*,
                     `%2$s`.ville as adresse_ville,
                     `%2$s`.pays as adresse_pays
        
                FROM `%1$s`
                JOIN `%2$s` ON `%2$s` .id = `%1$s` .adresse_id
                WHERE `%1$s` .id=:id',
                // %1$s représente la table logements
                $this->getTableName(),
                // %2$s représente la table adresse
                AppRepoManager::getRm()->getAdresseRepo()->getTableName()
            );
            //on prépare la requête
            $sth = $this->pdo->prepare($q);
            //si la requête n'est pas valide, on retourne null
            if (!$sth) return null;
            //on exécute la requête
            $sth->execute(['id' => $id]);
            //on récupère les données
            $row_data = $sth->fetch();
        
            //si on n'a pas de données, on retourne null
            if (empty($row_data)) return null;
        
            //on va utiliser l'hydratation (Hydrator)
            $logements = new Logements($row_data);
        
            //on reconstitue un tableau de données
            // pour l'hydrateur de adresse
            $adresse_data = [
                'id' => $logements->adresse_id,
                'ville' => $row_data['adresse_ville'],
                'pays' => $row_data['adresse_pays']
            ];
        
            //on crée l'objet adresse
            $adresse = new Adresse($adresse_data);
        
            //On ajoute l'objet adresse à l'objet logements
            $logements->adresse_id = $adresse;
            return $logements;
        }
        
        public function findAllByAdresse(int $id): ?array
        {
             //on prépare la requête
            $q = sprintf( 'SELECT * FROM %s WHERE adresse_id=:id', $this->getTableName());
        
            $sth = $this->pdo->prepare($q);
        
            if(!$sth) return null;
        
            //on passe l'id de l'adresse
            $sth->execute(['id' => $id]);
        
            //on crée un objet de la classe $class_name
            while($row_data = $sth->fetch()) $arr_result[] = new Logements($row_data);
            //on retourne un tableau d'objets
            return $arr_result;
        }
        
        public function insertLogement(string $titre, string $description, float $prix, float $taille, string $couchages, string $image, int $adresse_id, int $user_id, int $type_logement_id)
        {
            $q = sprintf(
                'INSERT INTO `%s` (`titre`,`description`,`prix`,`taille`,`couchages`, `image`, `adresse_id`, `user_id`, `type_logement_id`) 
                        VALUES (:titre, :description, :prix, :taille, :couchages, :image, :adresse_id, :user_id, :type_logement_id)',
                $this->getTableName()
            );
        
            $stmt = $this->pdo->prepare($q);
            if (!$stmt) return null;
            $stmt->execute([
                'titre' => $titre,
                'description' => $description,
                'prix' => $prix,
                'taille' => $taille,
                'couchages' => $couchages,
                'image' => $image,
                'adresse_id' => $adresse_id,
                'user_id' => $user_id,
                'type_logement_id' => $type_logement_id,
            ]);
        }

        // on déclare la méthode qui permet de delete
        public function delete(int $id)
        {
            $q = sprintf(
                'DELETE FROM `%s` WHERE id=:id',
                $this->getTableName()
            );
            $stmt = $this->pdo->prepare($q);
            if (!$stmt) return null;
            $stmt->execute(['id' => $id]);
        }

}





