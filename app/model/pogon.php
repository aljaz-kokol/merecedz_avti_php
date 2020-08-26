<?php
    class Pogon{
        public static $db_id = 'id';
        var $id;

        public static $db_tip = 'tip';
        var $tip; //Dvo kolesni ali Štiri kolesni

        public function __construct($id, $tip) {
            $this->id = $id;
            $this->tip = $tip;
        }

        public static function fromMap($map) {
            return new Pogon(
                $map[Pogon::$db_id],
                $map[Pogon::$db_tip]
            );
        }

        public function toMap() {
            return [
                Pogon::$db_id => $this->id,
                Pogon::$db_tip => $this->tip
            ];
        }
    }
?>