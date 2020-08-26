<?php
    class Razred{
        public static $db_id = 'id';
        var $id;

        public static $db_ime = 'ime';
        var $ime;

        public function __construct($id, $ime) {
            $this->id = $id;
            $this->ime = $ime;
        }

        public static function fromMap($map) {
            return new Razred(
                $map[Razred::$db_id],
                $map[Razred::$db_ime]
            );
        }

        public function toMap() {
            return [
                Razred::$db_id => $this->id,
                Razred::$db_ime => $this->ime
            ];
        }
    }
?>