<?php
    class Menjalnik{
        public static $db_id = 'id';
        var $id;

        public static $db_tip = 'tip';
        var $tip; //Ročni ali avtomatski

        public function __construct($id, $tip) {
            $this->id = $id;
            $this->tip = $tip;
        }

        public static function fromMap($map) {
            return new Menjalnik(
                $map[Menjalnik::$db_id],
                $map[Menjalnik::$db_tip]
            );
        }
        
        public function toMap() {
            return [
                Menjalnik::$db_id => $this->id,
                Menjalnik::$db_tip => $this->tip
            ];
        }

    }
?>