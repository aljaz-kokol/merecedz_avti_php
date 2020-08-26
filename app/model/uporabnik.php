<?php
    class Uporabnik{
        public static $db_id = 'id';
        var $id;

        public static $db_username = 'username';
        var $username;

        public static $db_email = 'email';
        var $email;

        public static $db_password = 'password';
        var $password;

        public static $db_status = 'status';
        var $status;

        public static $db_vkey = 'vkey';
        var $vkey;

        public static $db_verified = 'verified';
        var $verified;

        public function __construct($id, $username, $email, $password, $status, $vkey, $verified) {
            $this->id = $id;
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->status = $status;
            $this->vkey = $vkey;
            $this->verified = $verified;
        }

        public static function fromMap($map){
            return new Uporabnik(
                $map[Uporabnik::$db_id],
                $map[Uporabnik::$db_username],
                $map[Uporabnik::$db_email],
                $map[Uporabnik::$db_password],
                $map[Uporabnik::$db_status],
                $map[Uporabnik::$db_vkey],
                $map[Uporabnik::$db_verified]
            );
        }

        public function toMap(){
            return [
                Uporabnik::$db_id => $this->id,
                Uporabnik::$db_username => $this->username,
                Uporabnik::$db_email => $this->email,
                Uporabnik::$db_password => $this->password,
                Uporabnik::$db_status => $this->status,
                Uporabnik::$db_vkey => $this->vkey,
                Uporabnik::$db_verified => $this->verified
            ];
        }

    }
?>