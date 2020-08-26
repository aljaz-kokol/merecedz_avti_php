<?php
class HomeController extends Controller {
    public function index() {
        $newsCardList = NrsDatabase::getAllNewsCards();
        $this->view('home/index', ['newsCardList' => $newsCardList]);
    }
}