<?php

namespace App\Controllers;
use App\AppRepoManager;
use App\Session;
use Core\Form\FormResult;
use Core\View;
use Laminas\Diactoros\ServerRequest;


// On déclare la classe hostController
class hostController extends Controller{
    public function index(){
        $view_data = [
            'title_tag' => 'Dashboard',
            'h1_tag' => 'Liste des utilisateurs',
            'users' => AppRepoManager::getRm()->getUserRepo()->findAll()
        ];

        $view = new View('user/list');
        $view->titre = 'Tous les utilisateurs';
        $view->render($view_data);

    }

    public function updateUser(int $id){
        
        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT),
            'users' => AppRepoManager::getRm()->getUserRepo()->findById($id)
        ];

        $view = new View('user/update');
        $view->render($view_data);
    }

    public function addUser(){
        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT),
            // 'users' => AppRepoManager::getRm()->getUserRepo()->findById($id)
        ];

        $view = new View('user/add');
        $view->render($view_data);
    }

    public function update(ServerRequest $request): void{
        $post_data = $request->getParsedBody();
        $form_result = new FormResult();

        if(empty($post_data['email']) || empty($post_data['role'])){
            $form_result->addError('Saisir tout les champs');
        }
        else{
            $email = $post_data['email'];
            $role = $post_data['role'];
            $id = $post_data['id'];

            $user = AppRepoManager::getRm()->getUserRepo()->updateById($email, $role, $id);
            
            // si il y as des erreurs
            if($form_result->hasError()){
                Session::set(Session::FORM_RESULT, $form_result);
                self::redirect(('/host/update' . $id));
            }
            self::redirect('/host/user');
        }
    }

    public function add(ServerRequest $request): void{
        $post_data = $request->getParsedBody();
        $form_result = new FormResult();

        if(empty($post_data['email']) || empty($post_data['password']) || empty($post_data['role'])){
            $form_result->addError('Saisir tout les champs');
        }
        else{
            $email = $post_data['email'];
            $password = AuthController::hash($post_data['password']);
            $role = $post_data['role'];

            $user = AppRepoManager::getRm()->getUserRepo()->AddNewUser($email, $password, $role);
            
            // si il y as des erreurs
            if($form_result->hasError()){
                Session::set(Session::FORM_RESULT, $form_result);
                self::redirect(('/host/addUser'));
            }
            self::redirect('/host/user');
        }
    }

    // public function delete(int $id){

    //     $form_result = new FormResult();
    //     if(!isset($id)){
    //         $form_result->addError('Une erreur est survenu');
    //     }
    //     else{
    //          $user = AppRepoManager::getRm()->getUserRepo()->deleteUser($id);

    //         //  si il y as des erreurs
    //         if($form_result->hasError()){
    //             Session::set(Session::FORM_RESULT, $form_result);
    //             self::redirect('/host/user');
    //         }

    //         Session::remove(Session::FORM_RESULT);
    //         self::redirect('/host/user');
    //     }
       
    // }

}