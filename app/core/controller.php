<?php
abstract class Controller {
    protected function view($viewName, $viewData = []) {
        $listRaredov = NrsDatabase::getRazrede();
        $viewData["listRazredov"] = $listRaredov;

        if (isset($_SESSION['username'])) {
            $uporabnik = NrsDatabase::getUporabnikFromUsername($_SESSION['username']);
            $viewData["uporabnik"] = $uporabnik;
        }

        $view = new View($viewName, $viewData);
        $view->render();
    }

    protected function redirect($path) {
        header("location: $path");
    }

    protected function model($className) {
        require_once MODEL.$className.'.php';
    }
}