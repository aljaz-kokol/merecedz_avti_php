<?php
    class Avto{
        public static $db_id = 'id';
        var $id;

        public static $db_fk_razred_id = 'fk_razred_id';
        var $fk_razred_id;

        public static $db_fk_tip_avtomobila_id = 'fk_tip_avtomobila_id';
        var $fk_tip_avtomobila_id;

        public static $db_fk_motor_id = 'fk_motor_id';
        var $fk_motor_id;

        public static $db_fk_pogon_id = 'fk_pogon_id';
        var $fk_pogon_id;

        public static $db_fk_menjalnik_id = 'fk_menjalnik_id';
        var $fk_menjalnik_id;

        public static $db_fk_slika_id = 'fk_slika_id';
        var $fk_slika_id;

        public static $db_ime = 'ime';
        var $ime;

        public static $db_leto_izdaje = 'leto_izdaje';
        var $leto_izdaje;

        public static $db_stevilo_vrat = 'stevilo_vrat';
        var $stevilo_vrat;

        public static $db_teza = 'teza';
        var $teza; //V Kg

        public static $db_dolzina_mm = 'dolzina_mm';
        var $dolzina_mm; //V mm

        public static $db_sirina_mm = 'sirina_mm';
        var $sirina_mm; //B mm

        public static $db_visina_mm = 'visina_mm';
        var $visina_mm;

        public static $db_najvecja_hitrost = 'najvecja_hitrost';
        var $najvecja_hitrost; //V Km/h

        public static $db_vsota_ocen = 'vsota_ocen';
        var $vsota_ocen;
        
        public static $db_povprecna_ocena = 'povprecna_ocena';
        var $povprecna_ocena;

        public static $db_osnovna_cena = 'osnovna_cena';
        var $osnovna_cena; //V evrih
        var $fixedCena; //? Cena ki ima na vsake tri "0" dodano "." za lažje branje

        public function __construct($id, $fk_razred_id, $fk_tip_avtomobila_id, $fk_motor_id, $fk_pogon_id, $fk_menjalnik_id, $fk_slika_id, $ime, $leto_izdaje, $stevilo_vrat, $teza, $dolzina_mm, $sirina_mm, $visina_mm, $najvecja_hitrost, $vsota_ocen, $povprecna_ocena, $osnovna_cena) {
            $this->id = $id;
            $this->fk_razred_id = $fk_razred_id;
            $this->fk_tip_avtomobila_id = $fk_tip_avtomobila_id;
            $this->fk_motor_id = $fk_motor_id;
            $this->fk_pogon_id = $fk_pogon_id;
            $this->fk_menjalnik_id = $fk_menjalnik_id;
            $this->fk_slika_id = $fk_slika_id;
            $this->ime = $ime;
            $this->leto_izdaje = $leto_izdaje;
            $this->stevilo_vrat = $stevilo_vrat;
            $this->teza = $teza;
            $this->dolzina_mm = $dolzina_mm;
            $this->sirina_mm = $sirina_mm;
            $this->visina_mm = $visina_mm;
            $this->najvecja_hitrost = $najvecja_hitrost;
            $this->vsota_ocen = $vsota_ocen;
            $this->povprecna_ocena = $povprecna_ocena;
            $this->osnovna_cena = $osnovna_cena;
            $this->fixedCena = $this->fixCena($osnovna_cena);
        }
        
        public static function fromMap($map) {
            return new Avto(
                $map[Avto::$db_id],
                $map[Avto::$db_fk_razred_id],
                $map[Avto::$db_fk_tip_avtomobila_id],
                $map[Avto::$db_fk_motor_id],
                $map[Avto::$db_fk_pogon_id],
                $map[Avto::$db_fk_menjalnik_id],
                $map[Avto::$db_fk_slika_id],
                $map[Avto::$db_ime],
                $map[Avto::$db_leto_izdaje],
                $map[Avto::$db_stevilo_vrat],
                $map[Avto::$db_teza],
                $map[Avto::$db_dolzina_mm],
                $map[Avto::$db_sirina_mm],
                $map[Avto::$db_visina_mm],
                $map[Avto::$db_najvecja_hitrost],
                $map[Avto::$db_vsota_ocen],
                $map[Avto::$db_povprecna_ocena],
                $map[Avto::$db_osnovna_cena]
            );
        }

        public function toMap() {
            return [
                Avto::$db_id => $this->id,
                Avto::$db_fk_razred_id => $this->fk_razred_id,
                Avto::$db_fk_tip_avtomobila_id => $this->fk_tip_avtomobila_id,
                Avto::$db_fk_motor_id => $this->fk_motor_id,
                Avto::$db_fk_pogon_id => $this->fk_pogon_id,
                Avto::$db_fk_menjalnik_id => $this->fk_menjalnik_id,
                Avto::$db_fk_slika_id => $this->fk_slika_id,
                Avto::$db_ime => $this->ime,
                Avto::$db_leto_izdaje => $this->leto_izdaje,
                Avto::$db_stevilo_vrat => $this->stevilo_vrat,
                Avto::$db_teza => $this->teza,
                Avto::$db_dolzina_mm => $this->dolzina_mm,
                Avto::$db_sirina_mm => $this->sirina_mm,
                Avto::$db_visina_mm => $this->visina_mm,
                Avto::$db_najvecja_hitrost => $this->najvecja_hitrost,
                Avto::$db_vsota_ocen => $this->vsota_ocen,
                Avto::$db_povprecna_ocena => $this->povprecna_ocena,
                Avto::$db_osnovna_cena => $this->osnovna_cena
            ];
        }

        private function fixCena($cena) {
            $counter = 0; //* Za preverjane če smo že šli skozi 3 mesta
            $cenaStr = strval($cena);
            $cenaStr = str_replace(".", ",", $cenaStr);
            $fixedCena = "";
            for($i = (strlen($cenaStr) - 4); $i >= 0; $i-- ){
                if($counter === 3){
                    $fixedCena = ".".$fixedCena;
                    $counter = 0;
                }
                $fixedCena= $cenaStr[$i].$fixedCena;
                $counter++;
            }
            return "$fixedCena,".$cenaStr[strlen($cenaStr)-1].$cenaStr[strlen($cenaStr)-2];
        }

        public function getImg() {
            $slika = NrsDatabase::getSlikaFromAvto($this);
            return $slika;
        }

        public function getClass() {
            $razred = NrsDatabase::getRazredFromAvto($this);
            return $razred;
        }

        public function getTip() {
            $tip = NrsDatabase::getTipFromAvto($this);
            return $tip;
        }

        public function getPogon() {
            $pogon = NrsDatabase::getPogonFromAvto($this);
            return $pogon;
        }

        public function getMenjalnik() {
            $menjalnik = NrsDatabase::getMenjalnikFromAvto($this);
            return $menjalnik;
        }

        public function getMotor() {
            $motor = NrsDatabase::getMotorFromAvto($this);
            return $motor;
        }

        public function getGorivo() {
            $gorivo = NrsDatabase::getGorivoFromMotor($this->getMotor());
            return $gorivo;
        }

        public function getDate() {
            $date = new DateTime($this->leto_izdaje);
            return $date->format('Y');
        }

        public function getReviews() {
            $reviews = NrsDatabase::getKomentareFromAvto($this);
            return $reviews;
        }

        public function numOfReviews() {
            return count(NrsDatabase::getKomentareFromAvto($this));
        }

        public function averageGrade() {
            $stKomentarjev = count($this->getReviews());
            $average = 0;
            if ($stKomentarjev  > 0) {
                $average = round($this->vsota_ocen / $stKomentarjev);
            }
            return $average;
        }
    }
?>