<?php

namespace App;

use MiladRahimi\PhpRouter\Router;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Controllers\hostController;
use Core\Database\DatabaseConfigInterface;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;


// on déclare la classe App qui implémente l'interface DatabaseConfigInterface
class App implements DatabaseConfigInterface
{
    // on déclare les constantes
    private const DB_host = 'database';
    private const DB_NAME = 'lamp';
    private const DB_USER = 'lamp';
    private const DB_PASS = 'lamp';
    private static ?self $instance = null;

    // méthode appelée au démarrage de l'appli (dans index.php)
    public static function getApp(): self
    {
        if (is_null(self::$instance)) self::$instance = new self();
        return self::$instance;
    }

    //On gère la partie router
    private Router $router;

    public function getRouter(): Router
    {
        return $this->router;
    }

    // on déclare le constructeur en private pour empêcher l'instanciation de la classe
    private function __construct()
    {
        $this->router = Router::create();
    }
    //on a 3 méthodes à déclarer
    // 1: méthode start: activation du router
    public function start()
    {
        session_start();
        $this->registerRoutes();
        $this->startRouter();
    }
    //2: méthode qui enregistre les routes
    public function registerRoutes()
    {
        $auth = AuthController::class;
        //déclarations des patterns pour tester les valeurs des arguments
        $this->router->pattern('id', '[1-9]\d*');
        $this->router->pattern('slug', '(\d+-)?[a-z]+(-[a-z-\d]+)*');

        $this->router->get('/', [HomeController::class, 'index']);
        $this->router->get('/logement/{id}', [HomeController::class, 'logementByID']);


        $this->router->get('/connexion', [AuthController::class, 'index']);
        $this->router->post('/login', [AuthController::class, 'login']);
        $this->router->get('/logout', [AuthController::class, 'logout']);
        $this->router->get('/inscription', [AuthController::class, 'retour']);
        $this->router->post('/register', [AuthController::class, 'test']);
        $this->router->get('/addlogement', [HomeController::class, 'addLogement']);
        $this->router->post('/createlogement', [HomeController::class, 'ajout']);
        $this->router->get('/logement/delete/{id}', [HomeController::class, 'delete']);



        if ($auth::ishost()) {
            $this->router->get('/host/user', [hostController::class, 'index']);
            $this->router->get('/host/update/{id}', [hostController::class, 'updateUser']);
            $this->router->get('/host/addUser', [hostController::class, 'addUser']);
            $this->router->post('/update', [hostController::class, 'update']);
            $this->router->post('/add', [hostController::class, 'add']);
        }
    }
    //3: méthode qui démarre le router
    public function startRouter()
    {
        try {
            $this->router->dispatch();
        } catch (RouteNotFoundException | InvalidCallableException $e) {
            echo $e;
        }
    }

    // on déclare les méthodes de l'interface DatabaseConfigInterface

    public function gethost(): string
    {
        return self::DB_host;
    }

    public function getName(): string
    {
        return self::DB_NAME;
    }

    public function getUser(): string
    {
        return self::DB_USER;
    }

    public function getPass(): string
    {
        return self::DB_PASS;
    }
    /**
     * @return string
     */
}
