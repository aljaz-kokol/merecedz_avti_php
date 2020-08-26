<?php
class ReviewController extends Controller {
    public function comment($carId) {
        $avto = NrsDatabase::getAvto($carId);
        if ($avto) {
            $komentar = $_POST['komentar'];
            $ocena = $_POST['star'];
            $stKomentarjev = count(NrsDatabase::getKomentareFromAvto($avto)) + 1;
            $uporabnik = NrsDatabase::getUporabnikFromUsername($_SESSION['username']);
            NrsDatabase::addKomentar($uporabnik->id, $avto->id, $komentar, $ocena);
            NrsDatabase::updateAvtoOcena($avto, $ocena, $stKomentarjev);
            $this->view('car/details', ['avto' => $avto]);
        } else {
            $this->view('error/404');
        }
    }

    public function reviews() {
        $avti = NrsDatabase::getAvteByOcena();
        $this->view('reviews/reviews', ['listAvtov' => $avti]);
    }

    public function remove() {
        $deleteList = $_POST['delete'];
        foreach($deleteList as $item){
            NrsDatabase::deleteKomentar($item);
        }
        $this->redirect('/reviews');
    }
}