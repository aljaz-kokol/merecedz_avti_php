<?php
    class Gorivo{
        public static $db_id = 'id';
        var $id;

        public static $db_tip = 'tip';
        var $tip;

        public function __construct($id, $tip) {
            $this->id = $id;
            $this->tip = $tip;
        }

        public static function fromMap($map) {
            return new Gorivo(
                $map[Gorivo::$db_id],
                $map[Gorivo::$db_tip]
            );
        }

        public function toMap() {
            return [
                Gorivo::$db_id => $this->id,
                Gorivo::$db_tip => $this->tip
            ];
        }

    }
?>