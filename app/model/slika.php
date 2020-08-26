<?php
    class Slika{
        public static $db_id = 'id';
        var $id;

        public static $db_ime = 'ime';
        var $ime;

        public static $db_img_dir = 'img_dir';
        var $img_dir;

        public function __construct($id, $ime, $img_dir) {
            $this->id = $id;
            $this->ime = $ime;
            $this->img_dir = $img_dir;
        }

        public static function fromMap($map) {
            return new Slika(
                $map[Slika::$db_id],
                $map[Slika::$db_ime],
                $map[Slika::$db_img_dir],
            );
        }

        public function toMap() {
            return [
                Slika::$db_id => $this->id,
                Slika::$db_ime => $this->ime,
                Slika::$db_img_dir => $this->img_dir,
            ];
        }
    }
?>