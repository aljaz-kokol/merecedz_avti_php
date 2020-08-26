<?php
    class NewsCard{
        public static $db_id = 'id';
        var $id;
        
        public static $db_fk_slika_id = 'fk_slika_id';
        var $fk_slika_id;

        public static $db_datum_objave = 'datum_objave';
        var $datum_objave;

        public static $db_naslov = 'naslov';
        var $naslov;

        public static $db_kratek_opis = 'kratek_opis';
        var $kratek_opis;

        public function __construct($id, $fk_slika_id, $datum_objave, $naslov, $kratek_opis) {
            $this->id = $id;
            $this->fk_slika_id = $fk_slika_id;
            $this->datum_objave = $datum_objave;
            $this->naslov = $naslov;
            $this->kratek_opis = $kratek_opis;
        }

        public static function fromMap($map) {
            return new NewsCard(
                $map[NewsCard::$db_id],
                $map[NewsCard::$db_fk_slika_id],
                $map[NewsCard::$db_datum_objave],
                $map[NewsCard::$db_naslov],
                $map[NewsCard::$db_kratek_opis]
            );
        }
       
        public function toMap() {
            return [
                NewsCard::$db_id => $this->id,
                NewsCard::$db_fk_slika_id => $this->fk_slika_id,
                NewsCard::$db_datum_objave => $this->datum_objave,
                NewsCard::$db_naslov => $this->naslov,
                NewsCard::$db_kratek_opis => $this->kratek_opis
            ];
        }

        public function getImg() {
            $img = NrsDatabase::getSlikaFromNewsCard($this->fk_slika_id);
            return $img;
        }

        public function getDate() {
            $date = new DateTime($this->datum_objave);
            $date = $date->format("d.m.Y");
            return $date;
        }

    }
?>