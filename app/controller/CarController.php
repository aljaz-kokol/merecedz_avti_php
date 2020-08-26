<?php
class CarController extends Controller {
    public function getCars($className) {
        $razred = NrsDatabase::getRazredFromIme($className);
        if ($razred) {
            $avti = NrsDatabase::getAvtoFromRazred($razred);
            $this->view('car/class', ['razred' => $razred, 'listAvtov' => $avti]);
        } else {
            $this->view('error/404');
        }
    }

    public function details($carId) {
        $avto = NrsDatabase::getAvto($carId);
        if ($avto) {
            $this->view('car/details', ['avto' => $avto]);
        } else {
            $this->view('error/404');
        }
    }
}