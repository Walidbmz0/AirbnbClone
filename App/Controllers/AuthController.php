<?php

namespace App\Controllers;

use App\AppRepoManager;
use App\Model\User;
use App\Session;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\View;
use Laminas\Diactoros\ServerRequest;
use App\Controllers\Controller;

//on déclare la classe AuthController qui hérite de la classe Controller
class AuthController extends Controller
{
   
    public const AUTH_SALT = 'c56a752';
    public const AUTH_PEPPER = '8d7466';

    // on déclare la méthode index
    public function index(): void
    {
        $view = new View('auth/login', true);

        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT)
        ];

        $view->render($view_data);
    }

    // on déclare la méthode retour

    public function retour(): void
    {
        $view = new View('auth/register', true);

        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT)
        ];

        $view->render($view_data);
    }

    // on déclare la méthode login

    public function login(ServerRequest $request): void
    {
        $post_data = $request->getParsedBody();
        $form_result = new FormResult();
        $user = new User();

        //si un des champs n'est pas rempli on ajoute l'erreur
        if (empty($post_data['email']) || empty($post_data['password'])) {
            $form_result->addError(new FormError('Veuillez remplir tous les champs'));
        }
        // sinon on compare les valeurs en BDD
        else {
            $email = $post_data['email'];
            $password = self::hash($post_data['password']);

            //Appel au repository
            $user = AppRepoManager::getRm()->getUserRepo()->checkAuth($email, $password);
            //Si on a un retour négatif, on ajoute l'erreur
            if (is_null($user)) {
                $form_result->addError(new FormError('Email et/ou mot de passe invalide'));
            }
        }
        // si il y a des erreurs on renvoie vers la page de connexion
        if ($form_result->hasError()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/connexion');
        }

        //Si tout est OK on enregistre la session
        $user->password = '';
        Session::set(Session::USER, $user);

        //enfin, on redirige sur l'accueil
        self::redirect('/');
    }

// on déclare la méthode d'inscription

    public function test(ServerRequest $request)
    {
        $post_data = $request->getParsedBody();
        $form_result = new FormResult();


        //si un des champs n'est pas rempli on ajoute l'erreur
        if (empty($post_data['nom']) || empty($post_data['prenom']) || empty($post_data['email']) || empty($post_data['password'])) {
            $form_result->addError(new FormError('Veuillez remplir tous les champs'));
        }
        // sinon on compare les valeurs en BDD
        else {
            $nom = $post_data['nom'];
            $prenom = $post_data['prenom'];
            $email = $post_data['email'];
            $password = self::hash($post_data['password']);
            $is_host = $post_data['is_host'];

            //Appel au repository
            AppRepoManager::getRm()->getUserRepo()->addNewuser($nom, $prenom, $email, $password, $is_host);
            //Si on a un retour négatif, on ajoute l'erreur

        }
        // si il y a des erreurs on renvoie vers la page de connexion
        if ($form_result->hasError()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/inscription');
        }
        self::redirect('/connexion');
    }

    public function logout(): void
    {
        Session::remove(Session::USER);
        self::redirect('/');
    }

    public static function hash(string $str): string
    {
        $data = self::AUTH_SALT . $str . self::AUTH_PEPPER;
        return hash('sha512', $data);
    }

    public static function isAuth(): bool
    {
        return !is_null(Session::get(Session::USER));
    }

    public static function isRegister(): bool
    {
        return !is_null(Session::get(Session::USER));
    }

    // gestion des rôles
    public static function hasRole(int $role)
    {
        $user = Session::get(Session::USER);
        if (!($user instanceof User))
            return false;
        return $user->is_host === $role;
    }

    public static function isStandard()
    {
        return self::hasRole(User::ROLE_STANDARD);
    }

    public static function ishost()
    {
        return self::hasRole(User::ROLE_host);
    }
}
