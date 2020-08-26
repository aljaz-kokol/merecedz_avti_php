<?php
    class Komentar{
        public static $db_id = 'id';
        var $id;

        public static $db_fk_uporabnik_id = 'fk_uporabnik_id';
        var $fk_uporabnik_id;

        public static $db_fk_avto_id = 'fk_avto_id';
        var $fk_avto_id;

        public static $db_besedilo = 'besedilo';
        var $besedilo;

        public static $db_datum_objave = 'datum_objave';
        var $datum_objave;

        public static $db_ocena = 'ocena';
        var $ocena;

        public function __construct($id, $fk_uporabnik_id, $fk_avto_id, $besedilo, $datum_objave,$ocena){
            $this->id = $id;
            $this->fk_uporabnik_id = $fk_uporabnik_id;
            $this->fk_avto_id = $fk_avto_id;
            $this->besedilo = $besedilo;
            $this->datum_objave = $datum_objave;
            $this->ocena = $ocena;
        }

        public static function fromMap($map){
            return new Komentar(
                $map[Komentar::$db_id],
                $map[Komentar::$db_fk_uporabnik_id],
                $map[Komentar::$db_fk_avto_id],
                $map[Komentar::$db_besedilo],
                $map[Komentar::$db_datum_objave],
                $map[Komentar::$db_ocena]
            );
        }

        public function toMap(){
            return [
                Komentar::$db_id => $this->id,
                Komentar::$db_fk_uporabnik_id => $this->fk_uporabnik_id,
                Komentar::$db_fk_avto_id => $this->fk_avto_id,
                Komentar::$db_besedilo => $this->besedilo,
                Komentar::$db_datum_objave => $this->datum_objave,
                Komentar::$db_ocena => $this->ocena
            ];
        }

        public function getDate() {
            $date = new DateTime($this->datum_objave);
            return $date->format('d.m.Y');
        }

        public function getUser() {
            $user = NrsDatabase::getUporabnikFromKomentar($this);
            return $user;
        }

    }
?>