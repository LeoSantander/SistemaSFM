<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Lib\fpdf181\fpdf;

abstract class Controller
{
    protected $app;
    private $viewVar;

    public function __construct($app)
    {
        $this->setViewParam('nameController',$app->getControllerName());
    }

    public function render($view)
    {
        $viewVar = $this->getViewVar();
        $Sessao  = Sessao::class;

        require_once PATH . '/App/Views/layouts/header.php';
        require_once PATH . '/App/Views/layouts/menu.php';
        require_once PATH . '/App/Views/' . $view . '.php';
        require_once PATH . '/App/Views/layouts/footer.php';
    }

    public function renderLogin($view)
    {
        $viewVar = $this->getViewVar();
        $Sessao  = Sessao::class;

        require_once PATH . '/App/Views/layouts/header.php';
        require_once PATH . '/App/Views/' . $view . '.php';
        require_once PATH . '/App/Views/layouts/footer.php';
    }

    public function renderDetalhes($view)
    {
        $viewVar = $this->getViewVar();
        $Sessao  = Sessao::class;

        require_once PATH . '/App/Views/layouts/header.php';
        require_once PATH . '/App/Views/' . $view . '.php';
    }

    public function redirect($view)
    {
        header('Location: http://' . APP_HOST . $view);
        exit;
    }


    public function redirectMain($view)
    {

        ?>
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=">
        <?php
        exit;
    }

    public function getViewVar()
    {
        return $this->viewVar;
    }

    public function setViewParam($varName, $varValue)
    {
        if ($varName != "" && $varValue != "") {
            $this->viewVar[$varName] = $varValue;
        }
    }
}
