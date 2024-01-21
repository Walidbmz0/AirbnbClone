<?php

namespace App;

use App\App;
use App\Model\Repository\AdresseRepository;
use App\Model\Repository\TypeLogementRepository;
use App\Model\Repository\UserRepository;
use Core\RepositoryManagerTrait;
use App\Model\Repository\LogementsRepository;


// on déclare la classe AppRepoManager
class AppRepoManager
{
    //on utilise le trait
    use RepositoryManagerTrait;

    private LogementsRepository $LogementsRepository;

    public function getLogementsRepository():LogementsRepository
    {
        return $this->LogementsRepository;
    }

    private UserRepository $userRepository;

    public function getUserRepo():UserRepository
    {
        return $this->userRepository;
    }
    public function getLogementsRepo(): LogementsRepository
    {
        return $this->LogementsRepository;
    }

    private AdresseRepository $adresseRepository;
    public function getAdresseRepo():AdresseRepository
    {
        //on retourne l'instance de AdresseRepository
        return $this->adresseRepository;
    }


    private TypeLogementRepository $typeLogementRepository;
    public function getTypeLogementRepo():TypeLogementRepository
    {
        //on retourne l'instance de TypelogementRepository
        return $this->typeLogementRepository;
    }
    public function __construct()
    {
        $config = App::getApp();
        $this->LogementsRepository = new LogementsRepository($config);
        $this->typeLogementRepository = new TypeLogementRepository($config);
        $this->userRepository = new UserRepository($config);
        $this->adresseRepository = new AdresseRepository($config);

        
    }

    
    
}