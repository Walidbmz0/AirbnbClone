<?php

namespace App\Controllers;


use App\Session;
use Core\Form\FormResult;
use Core\View;
use App\AppRepoManager;
use Laminas\Diactoros\ServerRequest;



// On déclare la classe HomeController
class HomeController
{
    public function index(): void
    {

        // On récupère les logements, (Données a afficher dans la vue)
        $view_data = [
            'title_tag' => 'Accueil',
            'h1_tag' => 'Les logements disponibles',
            'logements' => AppRepoManager::getRm()->getLogementsRepo()->getAllLogements()
        ];


        $view = new View('page/home');

        $view->render($view_data);
    }

    // On déclare la méthode logementByID
    public function logementByID(int $id): void
    {
        $logement_result = AppRepoManager::getRm()->getLogementsRepo()->findById($id);

        //Si le logement n'existe pas on lance l'erreur 404
        if (is_null($logement_result)) {
            self::render('404');
        }
        $view_data = [
            'title_tag' => $logement_result->titre,
            'logement' => $logement_result
        ];

        $view = new View('logement/detail');
        $view->titre = $logement_result->titre . ' - Airbnb';

        $view->render($view_data);
    }


    // On déclare la méthode logementByType

    public function addLogement()
    {
        $view_data = [
            'h1_tag' => 'Ajouter un logement',
            'form_result' => Session::get(Session::FORM_RESULT),
            'type_logement' => AppRepoManager::getRm()->getTypelogementRepo()->findAll(),
            'user' => Session::get(Session::USER)
        ];

        $view = new View('Logement/add');
        $view->render($view_data);
    }

// On déclare la méthode logementByType

    public function ajout(ServerRequest $server)
    {
        $form_result = new FormResult();
        $image_data = $_FILES['image'];

        $post_data = $server->getParsedBody();

            $type_logement_id = $post_data['type_logement_id'];
            $user_id = $post_data['user_id'];
            $pays = $post_data['pays'];
            $ville = $post_data['ville'];
            $titre = $post_data['titre'];
            $description = $post_data['description'];
            $prix = intval($post_data['prix']);
            $taille = intval($post_data['taille']);
            $couchages = intval($post_data['couchages']);
            $image = '';
            $pathPublic = PATH_ROOT . 'public/image/' . $image;

            
                AppRepoManager::getRm()->getAdresseRepo()->insert($pays, $ville);
                $adresse_id = AppRepoManager::getRm()->getAdresseRepo()->dernierId();
                AppRepoManager::getRm()->getLogementsRepo()->insertLogement($titre, $description, $prix, $taille, $couchages, $image, $adresse_id, $user_id, $type_logement_id);
                
        }

        // Permet de supprimer les logements
        public function delete(int $id)
        {

            AppRepoManager::getRm()->getLogementsRepo()->delete($id);



        }

}
