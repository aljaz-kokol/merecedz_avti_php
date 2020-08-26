<?php
    class Motor{
        public static $db_id = 'id';
        var $id;

        public static $db_fk_gorivo_id = 'fk_gorivo_id';
        var $fk_gorivo_id;

        public static $db_kilovati = 'kilovati';
        var $kilovati;

        public static $db_navor = 'navor';
        var $navor;

        public static $db_prostornina = 'prostorina';
        var $prostornina;

        public function __construct($id, $fk_gorivo_id, $kilovati, $navor, $prostornina) {
            $this->id = $id;
            $this->fk_gorivo_id = $fk_gorivo_id;
            $this->kilovati = $kilovati;
            $this->navor = $navor;
            $this->prostornina = $prostornina;
        }
        
        public static function fromMap($map) {
            return new Motor(
                $map[Motor::$db_id],
                $map[Motor::$db_fk_gorivo_id],
                $map[Motor::$db_kilovati],
                $map[Motor::$db_navor],
                $map[Motor::$db_prostornina]
            );
        }

        public function toMap() {
            return [
                Motor::$db_id => $this->id,
                Motor::$db_fk_gorivo_id => $this->fk_gorivo_id,
                Motor::$db_kilovati => $this->kilovati,
                Motor::$db_navor => $this->navor,
                Motor::$db_prostornina => $this->prostornina
            ];
        }

    }
?>