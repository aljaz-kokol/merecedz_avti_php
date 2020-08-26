<?php
    class TipAvtomobila{
        public static $db_id = 'id';
        var $id;

        public static $db_ime = 'ime';
        var $ime;

        public static $db_kratica = 'kratica';
        var $kratica;

        public function __construct($id, $ime, $kratica) {
            $this->id = $id;
            $this->ime = $ime;
            $this->kratica = $kratica;
        }

        public static function fromMap($map) {
            return new TipAvtomobila(
                $map[TipAvtomobila::$db_id],
                $map[TipAvtomobila::$db_ime],
                $map[TipAvtomobila::$db_kratica]
            );
        }

        public function toMap() {
            return [
                TipAvtomobila::$db_id => $this->id,
                TipAvtomobila::$db_ime => $this->ime,
                TipAvtomobila::$db_kratica => $this->kratica
            ];
        }
    }
?>