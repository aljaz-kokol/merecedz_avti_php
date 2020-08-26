<?php
class NrsDatabase{

        //* POVEZAVA Z BAZO
        private static function connect(){
            $DB_NAME = 'nrs_seminarska_naloga';//id13086134_seminarskanaloga'
            $DB_USERNAME = 'root'; //'id13086134_seminarskanrs' 
            $DB_SERVER = '127.0.0.1';
            $DB_PASSWORD = 'AgXhCNXqaK82@RF';
            try {
                $connection = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
                return $connection;
            } catch(Exception $e) {
                die("Napak pri povezavi: ".$e->getMessage());
            }
            
        }

        //* NEWS CARDS
        public static function getAllNewsCards() {
            $tableName = 'news_card';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName ORDER BY ".NewsCard::$db_datum_objave." desc;");
            $numRows = $result->num_rows;
            if($numRows > 0){
                $listOfNewsCards = [];
                foreach($result as $map)
                    array_push($listOfNewsCards,NewsCard::fromMap($map));

                $conn->close();
                return $listOfNewsCards;
            }
            return [];
        }
        
        public static function addNewsCard($naslov, $kratekOpis){
            $tableName = 'news_card';
            $slikaID = NrsDatabase::getLastSlika()->id;
            $conn = NrsDatabase::connect();
            $conn->query("INSERT INTO $tableName (fk_slika_id, naslov, kratek_opis) VALUE($slikaID, '$naslov', '$kratekOpis');");
            $conn->close();
        }

        public static function deleteNewsCard($newsCard){
            $tableName = 'news_card';
            $id = $newsCard->id;
            $conn = NrsDatabase::connect();
            $conn->query("DELETE FROM $tableName WHERE id = $id;");
            $conn->close();
        }

        public static function updateNewsCard($id, $naslov, $kratekOpis){
            $tableName = 'news_card';
            $conn = NrsDatabase::connect();
            $conn->query("UPDATE $tableName SET naslov = '$naslov', kratek_opis = '$kratekOpis' WHERE id = $id;");
            $conn->close();
        }

        //* SLIKE
        public static function getSlike(){
            $tableName = 'slika';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName;");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $slike = [];
                foreach($result as $map)
                    array_push($slike, Slika::fromMap($map));
                $conn->close();
                return $slike;
            }
            $conn->close();
            return [];
        }

        public static function getSlikaFromNewsCard($slikaID) {
            $tableName = 'slika';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE ".Slika::$db_id." = '$slikaID'");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $slika = Slika::fromMap($result->fetch_assoc());
                $conn->close();
                return $slika;
            }
            $conn->close();
            return -1;
        }

        public static function getSlikaFromAvto($avto){
            $tableName = 'slika';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE ".Slika::$db_id." = ".$avto->fk_slika_id.";");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $slika = Slika::fromMap($result->fetch_assoc());
                $conn->close();
                return $slika;
            }
            $conn->close();
            return -1;
        }

        public static function getSlikaById($imgID){
            $tableName = 'slika';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE ".Slika::$db_id." = $imgID");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $slika = Slika::fromMap($result->fetch_assoc());
                $conn->close();
                return $slika;
            }
            $conn->close();
            return -1;
        }

        public static function addSlika($ime, $img_dir){
            $tabelName = 'slika';
            $conn = NrsDatabase::connect();
            $conn->query("INSERT INTO $tabelName (ime, img_dir) VALUE('$ime', '$img_dir');");
            $conn->close();
        }

        public static function getLastSlika(){
            $tableName = 'slika';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName ORDER BY id DESC LIMIT 1;");
            $numRows = $result->num_rows;
            if($numRows > 0){
                $slika = Slika::fromMap($result->fetch_assoc());
                return $slika;
            }
            return -1;
        }

        public static function updateSlika($id, $ime, $imgDir){
            $tableName = 'slika';
            $conn = NrsDatabase::connect();
            $conn->query("UPDATE $tableName SET ime = '$ime', img_dir = '$imgDir' WHERE id = $id");
            $conn->close();
        }

        //* MOTORJI
        public static function getMotorFromAvto($avto){
            $tabelName = 'motor';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tabelName WHERE ".Motor::$db_id." = ".$avto->fk_motor_id.";");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $motor = Motor::fromMap($result->fetch_assoc());
                $conn->close();
                return $motor;
            }
            $conn->close();
            return -1;
        }

        public static function addMotor($gorivoID, $kilovati, $navor, $prostorina) {
            $tabelName = 'motor';
            $conn = NrsDatabase::connect();
            $gorivoID = $conn->real_escape_string($gorivoID);
            $kilovati = $conn->real_escape_string($kilovati);
            $navor = $conn->real_escape_string($navor);
            $prostorina = $conn->real_escape_string($prostorina);
            $result = $conn->query("INSERT INTO $tabelName (fk_gorivo_id, kilovati, navor, prostornina) VALUES('$gorivoID', '$kilovati', '$navor', '$prostorina')");
            if($result)
                return true;
            return false;
        }

        public static function updateMotor($id, $gorivoID,$kilovati, $navor, $prostorina){
            $tableName = 'motor';
            $conn = NrsDatabase::connect();
            $gorivoID = $conn->real_escape_string($gorivoID);
            $kilovati = $conn->real_escape_string($kilovati);
            $navor = $conn->real_escape_string($navor);
            $prostorina = $conn->real_escape_string($prostorina);
            $conn->query("UPDATE $tableName SET fk_gorivo_id = $gorivoID, kilovati = $kilovati, navor =$navor, prostornina = $prostorina WHERE id = $id");
        }

        public static function getLastMotor(){
            $tableName = 'motor';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName ORDER BY id DESC LIMIT 1;");
            $numRows = $result->num_rows;
            if($numRows > 0){
                $motor = Motor::fromMap($result->fetch_assoc());
                return $motor;
            }
            return -1;
        }

        //* GORIVO
        public static function getGorivoFromMotor($motor){
            $tabelName = 'gorivo';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tabelName WHERE ".Gorivo::$db_id." = ".$motor->fk_gorivo_id.";");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $gorivo = Gorivo::fromMap($result->fetch_assoc());
                $conn->close();
                return $gorivo;
            }
            $conn->close();
            return -1;
        }

        public static function getGoriva(){
            $tabelName = 'gorivo';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tabelName");
            $numRows = $result->num_rows;
            $conn->close();
            if($numRows > 0){
                $goriva = [];
                foreach($result as $gorivo)
                 array_push($goriva, Gorivo::fromMap($gorivo));
                return $goriva;
            }
            return [];
        }

        //* AVTI
        public static function getAvto($id){
            $tableName = 'avto';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE id = $id");
            if($result->num_rows > 0)
                return Avto::fromMap($result->fetch_assoc());
            return false;
        }

        public static function getAvte(){
            $tableName = 'avto';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName ");
            $numRows = $result->num_rows;
            if($numRows > 0){
                $listAvtov = [];
                foreach($result as $map)
                    array_push($listAvtov, Avto::fromMap($map));
                $conn->close();
                return $listAvtov;
            }
            $conn->close();
            return [];
        }
        
        public static function getAvteByOcena(){
            $tabelName = 'avto';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tabelName ORDER BY ".Avto::$db_povprecna_ocena." desc;");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $listAvtov = [];
                foreach($result as $map)
                    array_push($listAvtov, Avto::fromMap($map));

                $conn->close();
                return $listAvtov;
            }
            $conn->close();
            return [];
        }

        public static function getAvtoFromRazred($razred){
            $tabelName = 'avto';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tabelName WHERE ".Avto::$db_fk_razred_id." = ".$razred->id." ORDER BY osnovna_cena DESC");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $listAvtov = [];
                foreach($result as $map){
                    array_push($listAvtov, Avto::fromMap($map));
                }
                $conn->close();
                return $listAvtov;
            }
            $conn->close();
            return [];
        }

        public static function getAvtoFromRazredId($razredId){
            $tabelName = 'avto';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tabelName WHERE ".Avto::$db_fk_razred_id." = $razredId;");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $listAvtov = [];
                foreach($result as $map){
                    array_push($listAvtov, Avto::fromMap($map));
                }
                $conn->close();
                return $listAvtov;
            }
            $conn->close();
            return [];
        }

        public static function addAvto($razredId, $tipId, $pogonId, $menjalnikId, $ime, $letoIzdaje, $steviloVrat, $teza, $dolzina, $sirina, $visina, $topSpeed, $basePrice){
            $tabelName = 'avto';
            $conn = NrsDatabase::connect();
            $razredId = $conn->real_escape_string($razredId);
            $tipId = $conn->real_escape_string($tipId);
            $pogonId = $conn->real_escape_string($pogonId);
            $menjalnikId = $conn->real_escape_string($menjalnikId);
            $ime = $conn->real_escape_string($ime);
            $letoIzdaje = $conn->real_escape_string($letoIzdaje);
            $steviloVrat = $conn->real_escape_string($steviloVrat);
            $teza = $conn->real_escape_string($teza);
            $dolzina = $conn->real_escape_string($dolzina);
            $sirina = $conn->real_escape_string($sirina);
            $visina = $conn->real_escape_string($visina);
            $topSpeed = $conn->real_escape_string($topSpeed);
            $basePrice = $conn->real_escape_string($basePrice);
            $motorId = NrsDatabase::getLastMotor()->id;
            $slikaId = NrsDatabase::getLastSlika()->id;
            $conn->query("INSERT INTO $tabelName (fk_razred_id, fk_tip_avtomobila_id, fk_motor_id, fk_pogon_id, fk_menjalnik_id, fk_slika_id, ime, leto_izdaje, stevilo_vrat, teza, dolzina_mm, sirina_mm, visina_mm, najvecja_hitrost, osnovna_cena)
            VALUES('$razredId', '$tipId', '$motorId', '$pogonId', '$menjalnikId', '$slikaId', '$ime', '$letoIzdaje', '$steviloVrat', '$teza', '$dolzina', '$sirina', '$visina', '$topSpeed', '$basePrice');
            ");
            $conn->close();
        }

        public static function deleteAvto($avtoId){
            $tableName = 'avto';
            $conn = NrsDatabase::connect();
            $conn->query("DELETE FROM $tableName WHERE id = $avtoId LIMIT 1");
        }

        public static function updateAvto($id, $razredId, $tipId, $pogonId, $menjalnikId, $ime, $letoIzdaje, $steviloVrat, $teza, $dolzina, $sirina, $visina, $topSpeed, $basePrice){
            $tabelName = 'avto';
            $conn = NrsDatabase::connect();
            $razredId = $conn->real_escape_string($razredId);
            $tipId = $conn->real_escape_string($tipId);
            $pogonId = $conn->real_escape_string($pogonId);
            $menjalnikId = $conn->real_escape_string($menjalnikId);
            $ime = $conn->real_escape_string($ime);
            $letoIzdaje = $conn->real_escape_string($letoIzdaje);
            $steviloVrat = $conn->real_escape_string($steviloVrat);
            $teza = $conn->real_escape_string($teza);
            $dolzina = $conn->real_escape_string($dolzina);
            $sirina = $conn->real_escape_string($sirina);
            $visina = $conn->real_escape_string($visina);
            $topSpeed = $conn->real_escape_string($topSpeed);
            $basePrice = $conn->real_escape_string($basePrice);
            $conn->query("UPDATE  $tabelName SET fk_razred_id = '$razredId', fk_tip_avtomobila_id = '$tipId', fk_pogon_id = '$pogonId', fk_menjalnik_id = '$menjalnikId', ime = '$ime', leto_izdaje= '$letoIzdaje', stevilo_vrat= '$steviloVrat', teza= '$teza', dolzina_mm='$dolzina', sirina_mm='$sirina', visina_mm = '$visina', najvecja_hitrost = '$topSpeed', osnovna_cena = '$basePrice' WHERE id = $id");
            $conn->close();
        }
       
        public static function removeAvtoOcena($avto, $ocena){
            $tabelName = 'avto';
            $conn = NrsDatabase::connect();
            $stKomentarjev = count(NrsDatabase::getKomentareFromAvto($avto));
            $novaOcena = $avto->vsota_ocen - $ocena;
            if($stKomentarjev >= 2)
                $povprecje = round($novaOcena / ($stKomentarjev - 1));
            else $povprecje = round($novaOcena / 1);
            $conn->query("UPDATE $tabelName SET vsota_ocen = '$novaOcena', povprecna_ocena = '$povprecje' WHERE id = $avto->id");
            $conn->close();
        }
        //* RAZREDI
        public static function getRazred($id){
            $tableName = 'razred';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE id = $id");
            return Razred::fromMap($result->fetch_assoc()); 
        }

    public static function getRazredFromIme($className){
        $tableName = 'razred';
        $conn = NrsDatabase::connect();
        $className = mysqli_real_escape_string($conn, $className);
        $result = $conn->query("SELECT * FROM $tableName WHERE ime = '$className'");
        if ($result->num_rows > 0)
            return Razred::fromMap($result->fetch_assoc());
        return false;
    }

        public static function getRazrede() {
            $tableName = 'razred';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName;");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $listRazredov = [];
                foreach($result as $map)
                    array_push($listRazredov, Razred::fromMap($map));
                $conn->close();
                return $listRazredov;
            }
            $conn->close();
            return [];
        }

        public static function getRazredFromAvto($avto){
            $tabelName = 'razred';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tabelName WHERE ".Razred::$db_id." = ".$avto->fk_razred_id.";");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $razred = Razred::fromMap($result->fetch_assoc());
                $conn->close();
                return $razred;
            }
            $conn->close();
            return -1;
        }

        //* TIPI
        public static function getTipFromAvto($avto){
            $tableName = 'tip_avtomobila';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE ".TipAvtomobila::$db_id." = ".$avto->fk_tip_avtomobila_id.";");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $tip = TipAvtomobila::fromMap($result->fetch_assoc());
                $conn->close();
                return $tip;
            }
            $conn->close();
            return -1;
        }

        public static function getTipe(){
            $tabelName = 'tip_avtomobila';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tabelName");
            $conn->close();
            if($result->num_rows > 0) {
                $tipi = [];
                foreach($result as $map) 
                    array_push($tipi, TipAvtomobila::fromMap($map));
                return $tipi;
            }
            return [];
        }

        //* POGONI
        public static function getPogonFromAvto($avto){
            $tableName = 'pogon';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE ".Pogon::$db_id." = ".$avto->fk_pogon_id.";");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $pogon = Pogon::fromMap($result->fetch_assoc());
                $conn->close();
                return $pogon;
            }
            $conn->close();
            return -1;
        }

        public static function getPogone(){
            $tableName = 'pogon';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName");
            $numRows = $result->num_rows;
            $conn->close();

            if($numRows > 0){
                $pogoni = [];
                foreach($result as $map)
                    array_push($pogoni, Pogon::fromMap($map));
                return $pogoni;
            }
            return [];
        }

        //* MENJALNIKI
        public static function getMenjalnikFromAvto($avto){
            $tableName = 'menjalnik';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE ".Menjalnik::$db_id." = ".$avto->fk_menjalnik_id.";");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $menjalnik = Menjalnik::fromMap($result->fetch_assoc());
                $conn->close();
                return $menjalnik;
            }
            $conn->close();
            return -1;
        }

        public static function getMenjalnike(){
            $tableName = 'menjalnik';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName");
            $numRows = $result->num_rows;
            $conn->close();

            if($numRows > 0){
                $menjalniki = [];
                foreach($result as $menjalnik)
                    array_push($menjalniki, Menjalnik::fromMap($menjalnik));
                return $menjalniki;
            }
            return [];
        }

        //* KOMENTARJI
        public static function getKomentareFromAvto($avto){
            $tableName = 'komentar';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE fk_avto_id = '".$avto->id."';");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $komentarji = [];
                foreach($result as $map)
                    array_push($komentarji, Komentar::fromMap($map));
                $conn->close();
                return $komentarji;
            }
            $conn->close();
            return [];
        }

        public static function getKomentar($id){
            $tableName = 'komentar';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE id = $id");
            $conn->close();
            if($result->num_rows > 0)
                return Komentar::fromMap($result->fetch_assoc());
            return -1;
        }

        public static function addKomentar($uporabnikId, $avtoId, $besedilo, $ocena){
            $tableName = 'komentar';
            $conn = NrsDatabase::connect();
            $conn->query("INSERT INTO $tableName (fk_uporabnik_id, fk_avto_id, besedilo, ocena) VALUES('$uporabnikId', '$avtoId', '$besedilo', '$ocena');");
            $conn->close();
        }
        
        public static function deleteKomentar($id){
            $tableName = 'komentar';
            $conn = NrsDatabase::connect();
            $komentar = NrsDatabase::getKomentar($id);
            $avto = NrsDatabase::getAvto($komentar->fk_avto_id);
            NrsDatabase::removeAvtoOcena($avto, $komentar->ocena);; 
            $conn->query("DELETE FROM $tableName WHERE id = $id");
            $conn->close();
        }

        //* UPORABIKI
        public static function getUporabnikFromKomentar($komentar){
            $tableName = 'uporabnik';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE ".Uporabnik::$db_id." = '".$komentar->fk_uporabnik_id."';");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $uporabnik = Uporabnik::fromMap($result->fetch_assoc());
                $conn->close();   
                return $uporabnik;
            }
            $conn->close();
            return -1;
        }

        public static function getUporabnikFromUsername($username){
            $tableName = 'uporabnik';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE ".Uporabnik::$db_username." = '$username';");
            $numRows = $result->num_rows;

            if($numRows > 0){
                $uporabnik = Uporabnik::fromMap($result->fetch_assoc());
                $conn->close();
                return $uporabnik;
            }
            $conn->close();
            return false;
        }

        public static function doesUserExist($username, $email) {
            $tableName = 'uporabnik';
            $conn = NrsDatabase::connect();
            $result = $conn->query("SELECT * FROM $tableName WHERE username = '$username' OR email = '$email'");
            $conn->close();
            if($result->num_rows > 0)
                return Uporabnik::fromMap($result->fetch_assoc());
            return false;
        }

        //* OCENE
        public static function updateAvtoOcena($avto, $ocena, $stKomentarjev){
            $tabelName = 'avto';
            $novaVsota = $avto->vsota_ocen + $ocena; 
            $povprecna_ocena = round($novaVsota / $stKomentarjev);
            $avtoId = $avto->id;
            $conn = NrsDatabase::connect();
            $conn->query("UPDATE $tabelName SET vsota_ocen = '$novaVsota', povprecna_ocena = '$povprecna_ocena' WHERE id = '$avtoId';");
            $conn->close();
        }

        //* REGISTRACIJA
        public static function registerUser($username, $email, $password, $cPassword) {
            $tableName = 'uporabnik';
            $conn = NrsDatabase::connect();
            $username = $conn->real_escape_string($username);
            $email = $conn->real_escape_string($email);
            $password = $conn->real_escape_string($password);
            $cPassword = $conn->real_escape_string($cPassword);
            $vkey = md5(time().$username);
            if(strlen($username) < 5){
                //?Prekratki username
                return "Username must be at least 5 characters";
            }
            else if(strlen($password) < 8){
                //?Prekratki password
                return "Password must be at least 8 characters";
            }
            else if($password !== $cPassword) {
                //?Gesli se ne ujemata
                return "Passwords do not match";
            } else {
                //?Preveri ce uporabnik že obstaja
                if(NrsDatabase::doesUserExist($cPassword, $email) === false) {
                    $password = md5($password); //?Šifriraj password
                    $insertQuery = "INSERT INTO $tableName (username, email, password, vkey) VALUES ('$username', '$email', '$password', '$vkey')";
                    $result = $conn->query($insertQuery);
                    $conn->close();
                    if($result) {
                        //? Send email
                        $to = $email;
                        $subject = "Email Verification";
                        $message = "To verify your account go to the following link\nhttp://localhost/NRS/Seminarska_Naloga/spletna_stran/";
                        $headers = "From: aljaz.buisness@gmail.com \r\n";
                        $headers .= "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        mail($to, $subject, $message);
                        return true;
                    }
                    else {
                        return "There was an unexpected error";
                    }
                } else {
                    $conn->close();
                    return "User with this email or username already exists";
                }
            }
        }

        //* LOGIN
        public static function loginUser($usernameOrEmail, $password) {
            $conn = NrsDatabase::connect();
            $usernameOrEmail = $conn->real_escape_string($usernameOrEmail);
            $password = $conn->real_escape_string($password);
            $user = NrsDatabase::doesUserExist($usernameOrEmail, $usernameOrEmail);
            if($user !== false) {  
                //?Preveri če je user verified
                if($user->verified == 1) {
                    //? Preveri gesla
                    if(md5($password) === $user->password) {
                        session_start();
                        $_SESSION['username'] = $user->username;
                        return true;
                    }
                    return "Incorect password";
                } else {
                    return "This account is invalid or not verified";
                }

            }
            return "Username or email is incorect";
        }

        //*VERIFIKACIJA
        public static function verifyAccount($vkey) {
            $conn = NrsDatabase::connect();
            $tabelName = "uporabnik";
            $result = $conn->query("SELECT verified, vkey FROM $tabelName WHERE verified = 0 AND vkey = '$vkey' LIMIT 1");
            if($result->num_rows == 1) {
                $update = $conn->query("UPDATE $tabelName SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
                return true;
            } else {
                return "This account is invalid or already verified";
            }
        }
    }
?>