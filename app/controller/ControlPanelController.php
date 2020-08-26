<?php
class ControlPanelController extends Controller {
    public function panel() {
        $this->view('control/control_panel');
    }

    public function newStory($error = null) {
        $newsCards = NrsDatabase::getAllNewsCards();
        $this->view('control/news_control', ['newsCards' => $newsCards, 'error' => $error]);
    }

    public function storeStory() {
        $allowedExt = ['jpg', 'jpeg', 'png'];
        $file = $_FILES['img-file'];
        $fileName = $file['name'];
        $fileError = $file['error'];
        $fileTmp = $file['tmp_name'];
        $fileExt = explode('.',$fileName);
        $fileExtFixed = strtolower(end($fileExt));
        $naslov = $_POST['naslov'];
        $kratekOpis = $_POST['kratek-opis'];
        if(in_array($fileExtFixed, $allowedExt)){
            if($fileError === 0){
                $fileDest = "../assets/img/$fileName";
                move_uploaded_file($fileTmp, $fileDest);
                NrsDatabase::addSlika($fileName, "assets/img/$fileName");
                NrsDatabase::addNewsCard($naslov, $kratekOpis);
                $this->redirect('/control/news');
            } else {
                $this->newStory("Prislo je do napake!");
            }
        } else {
            $this->newStory("File tipa: $fileExtFixed ne mores naloziti kot sliko");
        }

    }

    public function newCar() {
        $this->view('control/car_control');
    }
}