<?php

namespace Core;

use App\Controllers\AuthController;

class View
{
    //definir le chemin absolu du dossier views
    // on utilise la constante d'index.php
    public const PATH_VIEW = PATH_ROOT . 'views' . DS;
    public const PATH_PARTIALS = self::PATH_VIEW . '_templates' . DS;
    public string $titre = 'Titre par defaut';

    public function __construct(
        private string $name,
        private bool   $is_complete = false
    )
    {}

    private function getRequirePath(): string
    {
        $arr_name = explode('/', $this->name);
        $category = $arr_name[0];
        $name = $arr_name[1];
        $name_prefix = $this->is_complete ? '' : '_';

        return self::PATH_VIEW . $category . DS . $name_prefix . $name . '.html.php';
    }
    // on crée la méthode de rendu
    public function render(?array $view_data = []):void
    {
        // on va checker si un utilisateur est en session
        $auth = AuthController::class;

        if(!empty($view_data)) extract($view_data);
        ob_start();
        // on insere le template _top
        if(!$this->is_complete){
            require_once self::PATH_PARTIALS . '_top.html.php';
        }
        //on insère la vue
        require_once $this->getRequirePath();
        
        // on insere le template _bottom
        if(!$this->is_complete){
            require_once self::PATH_PARTIALS . '_bottom.html.php';
        }
        ob_end_flush();
    }
}