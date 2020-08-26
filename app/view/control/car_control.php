<!--IN PROGRESS-->
<?php //
//ob_start();
//?>
<?php //include "../php/session.php"; ?>
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    --><?php //include_once "../php/meta_data.php" ?>
<!--    <link rel="stylesheet" href="../../../public/css/general_style.css" type="text/css" />-->
<!--    <link rel="stylesheet" href="../../../public/css/class_style.css" type="text/css" />-->
<!--    <link rel="stylesheet" href="../../../public/css/id_style.css?" type="text/css" />-->
<!--    <title>CAR CONTROL</title>-->
<!--</head>-->
<!--<body>-->
<!--    --><?php
//        include_once "../php/pages_nav.php";
//        include_once "../data/NrsDatabase.php";
//        $allowedExt = ['jpg', 'jpeg', 'png'];
//        $msg = '';
//        if(isset($_POST['sub-btn']) || isset($_POST['edit-btn'])){
//            $file = $_FILES['img-file'];
//            $fileName = $file['name'];
//            $fileError = $file['error'];
//            $fileTmp = $file['tmp_name'];
//            $fileExt = explode('.',$fileName);
//            $fileExtFixed = strtolower(end($fileExt));
//
//            $ime = $_POST['ime'];
//            $razredId = $_POST['carClass'];
//            $tipId = $_POST['carType'];
//            $pogonId = $_POST['carPogon'];
//            $menjalnikId = $_POST['carMenjalnik'];
//            $gorivoId = $_POST['carFuel'];
//            $kilovati = $_POST['kilovati'];
//            $navor = $_POST['navor'];
//            $prostornina = $_POST['prostornina'];
//            $letoIzdaje = $_POST['letoIzdaje'];
//            $steviloVrat = $_POST['steviloVrat'];
//            $teza = $_POST['teza'];
//            $dolzina = $_POST['dolzina'];
//            $sirina = $_POST['sirina'];
//            $visina = $_POST['visina'];
//            $topSpeed = $_POST['topSpeed'];
//            $osnovnaCena = $_POST['basePrice'];
//            if(in_array($fileExtFixed, $allowedExt)){
//                if($fileError === 0){
//                    $fileDest = "../assets/img/$fileName";
//                    move_uploaded_file($fileTmp, $fileDest);
//                    if(isset($_POST['sub-btn'])){
//                        NrsDatabase::addSlika($fileName, "assets/img/$fileName");
//                        NrsDatabase::addMotor($gorivoId, $kilovati, $navor, $prostornina);
//                        NrsDatabase::addAvto($razredId, $tipId, $pogonId, $menjalnikId, $ime, $letoIzdaje, $steviloVrat, $teza, $dolzina, $sirina, $visina, $topSpeed, $osnovnaCena);
//                        $msg = "<p class='success'>Avto je bil uspešno doddan!</p>";
//                    } else {
//                        $slikaID = $_POST['imgID'];
//                        NrsDatabase::updateSlika($slikaID, $fileName, "assets/img/$fileName");
//                        $msg = "<p class='success'>Avto je bil uspešno posodobljen</p>";
//                    }
//                }
//                else  $msg = "<p class='error'>Prišlo je do napake!</p>";
//            }
//            else isset($_POST['sub-btn']) ? $msg = "<p class='error'>File tipa: <b>$fileExtFixed</b> ne moreš naložiti kot sliko!</p>" : null;
//
//            if(isset($_POST['edit-btn'])) {
//                $avtoId = $_POST['avtoID'];
//                $motorId = $_POST['motorID'];
//                NrsDatabase::updateMotor($motorId, $gorivoId, $kilovati, $navor, $prostornina);
//                NrsDatabase::updateAvto($avtoId, $razredId, $tipId, $pogonId, $menjalnikId, $ime, $letoIzdaje, $steviloVrat, $teza, $dolzina, $sirina, $visina, $topSpeed, $osnovnaCena);
//            }
//        }
//
//        $seznamRazredov = NrsDatabase::getRazrede();
//        $seznamTipov = NrsDatabase::getTipe();
//        $seznamPogonov = NrsDatabase::getPogone();
//        $seznamMenjalnikov = NrsDatabase::getMenjalnike();
//        $seznamGoriv = NrsDatabase::getGoriva();
//    ?>
<!--    <main>-->
<!--        <h1>ADD OR EDDIT A CAR</h1>-->
<!--        --><?php //echo $msg ?>
<!--        --><?php //foreach($seznamRazredov as $razred) : ?><!--  -->
<!--            <section id="--><?php //echo $razred->ime; ?><!--" class="razred-list">-->
<!--                --><?php //$seznamAvtov = NrsDatabase::getAvtoFromRazred($razred) ?>
<!--                <h2>Class---><?php //echo $razred->ime ?><!-- Cars</h2>-->
<!--                <articale class="car-galery">-->
<!--                --><?php //foreach($seznamAvtov as $index => $avto) : ?>
<!--                    --><?php //
//                        $slika = NrsDatabase::getSlikaFromAvto($avto);
//                        $motor = NrsDatabase::getMotorFromAvto($avto);
//                    ?>
<!--                    --><?php
//                        if(isset($_POST["del-btn".$index])){
//                            NrsDatabase::deleteAvto($avto->id);
//                            header('location: '.$_SERVER['PHP_SELF']);
//                            ob_end_flush();
//                        }
//                    ?>
<!--                    <form class="galery-item card news-preview-card" action="" method="POST">-->
<!--                        <div>-->
<!--                            <img class="car-card-img" src="../--><?php //echo $slika->img_dir ?><!--" alt="--><?php //echo $slika->ime ?><!--">-->
<!--                            <h2 class="news-preview-title">--><?php //echo $avto->ime ?><!--</h2>-->
<!--                            <div class="delete-edit">-->
<!--                                <!--Ta box se bo pokazal ko bo user hotel izbrisati neakak-->-->
<!--                                <div class="confirmBox" id="--><?php //echo "confirmBox-$index" ?><!--">-->
<!--                                    <h2 class="confirmTitle">Odstranitev vozila</h2>-->
<!--                                    <p class="confirmContent">Ste prepričani da žeilte izbrisati to vozilo: </p>-->
<!--                                    <p><b>--><?php //echo "$avto->ime" ?><!--</b></p>-->
<!--                                    <br>-->
<!--                                    <input type="submit" name="--><?php //echo "del-btn$index" ?><!--" class="btn black" value="Da">-->
<!--                                    <input type="button"  onclick='hideConfirm(--><?php //echo $index ?>//)' class="btn black" value="Ne" >
//                                </div>
//                                <input type="button" onclick="showConfirm(<?php //echo $index ?>//)" class="btn black" value="Odstrani" >
//                                <input type="button"  onclick='editForm(<?php //echo(json_encode($avto))?>//,<?php //echo(json_encode($motor))?>//)' class="btn black" value="Uredi" >
//                            </div>
//                        </div>
//                    </form>
//                <?php //endforeach ?><!--  -->
<!--                </articale>-->
<!--                <hr>-->
<!--            </section>-->
<!--        --><?php //endforeach ?>
<!--        <button class="add-btn" onclick="newForm()">+</button>       -->
<!--        <article class="pop-up-form">-->
<!--            <h2>Dodaj avto</h2>-->
<!--            -->
<!--            <form class='car-edit' action="" method="POST" enctype="multipart/form-data" style="display: block;">-->
<!--                <input type="hidden" name="imgID" id="imgID">-->
<!--                <input type="hidden" name="avtoID" id="avtoID">-->
<!--                <input type="hidden" name="motorID" id="motorID">-->
<!--                <div class="upload-img">-->
<!--                    <input type="file" id="img-file" name="img-file" required>-->
<!--                </div>-->
<!---->
<!--                <div class="news-card-content">-->
<!--                    <input class='news-card-title' type="text" id="ime" name="ime" placeholder="IME" required>-->
<!--                    <label for="carClass"><b>Razred avta</b></label>-->
<!--                    <select name="carClass" id="carClass" required>-->
<!--                        --><?php //foreach($seznamRazredov as $razred) : ?>
<!--                            <option value="--><?php //echo $razred->id?><!--" >Razred: --><?php //echo $razred->ime ?><!--</option>-->
<!--                        --><?php //endforeach ?>
<!--                    </select><br>-->
<!---->
<!--                    <label for="carType"><b>Tip avta</b></label>-->
<!--                    <select name="carType" id="carType" required>-->
<!--                        --><?php //foreach($seznamTipov as $tip) : ?>
<!--                            <option value="--><?php //echo $tip->id?><!--" >--><?php //echo $tip->ime ?><!--</option>-->
<!--                        --><?php //endforeach ?>
<!--                    </select><br>-->
<!---->
<!--                    <label for="carPogon"><b>Vrsta pogona</b></label>-->
<!--                    <select name="carPogon" id="carPogon" required>-->
<!--                        --><?php //foreach($seznamPogonov as $pogon) : ?>
<!--                            <option value="--><?php //echo $pogon->id?><!--" >--><?php //echo $pogon->tip ?><!-- pogon</option>-->
<!--                        --><?php //endforeach ?>
<!--                    </select><br>-->
<!---->
<!--                    <label for="carMenjalnik"><b>Tip menjalnika</b></label>-->
<!--                    <select name="carMenjalnik" id="carMenjalnik" required>-->
<!--                        --><?php //foreach($seznamMenjalnikov as $menjalnik) : ?>
<!--                            <option value="--><?php //echo $menjalnik->id?><!--" >--><?php //echo $menjalnik->tip ?><!-- menjalnik</option>-->
<!--                        --><?php //endforeach ?>
<!--                    </select><br>-->
<!--                    <!-- Za tabelo motorji -->-->
<!--                    <label for="carFuel"><b>Vrsta goriva</b></label>-->
<!--                    <select name="carFuel" id="carFuel" required>-->
<!--                        --><?php //foreach($seznamGoriv as $gorivo) : ?>
<!--                            <option value="--><?php //echo $gorivo->id?><!--" >--><?php //echo $gorivo->tip ?><!--</option>-->
<!--                        --><?php //endforeach ?>
<!--                    </select><br>-->
<!---->
<!--                    <label for="kilovati"><b>Število kilovatov: </b></label>-->
<!--                    <input type="number"    name="kilovati"    id="kilovati"    step="any"  placeholder="Kilovati"                  min='1' required>-->
<!---->
<!--                    <label for="navor"><b>Velikost navora</b></label>-->
<!--                    <input type="number"    name="navor"       id="navor"       step="any"  placeholder="Navor"                     min='1' required>-->
<!---->
<!--                    <label for="prostornina"><b>Prostornina motorja(v litrih)</b></label>-->
<!--                    <input type="number"    name="prostornina" id="prostornina" step="any"  placeholder="Prostornina(v litrih)"     min='1' required>-->
<!--                    -->
<!--                    <label for="letoIzdaje"><b>Leto izdaje</b></label>-->
<!--                    <input type="date"      name="letoIzdaje"  id="letoIzdaje"              placeholder="Leto izdaje"                       required>-->
<!--                    -->
<!--                    <label for="steviloVrat"><b>Stevilo vrat</b></label>-->
<!--                    <input type="number"    name="steviloVrat" id="steviloVrat" step="any"  placeholder="Stevilo vrat"              min='1' required>-->
<!--                   -->
<!--                    <label for="teza"><b>Teza(v <i>kg</i>)</b></label>-->
<!--                    <input type="number"    name="teza"        id="teza"        step="any"  placeholder="Teza (v kg)"               min='1' required>-->
<!--                    -->
<!--                    <label for="dolzina"><b>Dolzina(v <i>mm</i>)</b></label>-->
<!--                    <input type="number"    name="dolzina"     id="dolzina"     step="any"  placeholder="Dolzina (v mm)"            min='1' required>-->
<!--                    -->
<!--                    <label for="sirina"><b>Sirina(v <i>mm</i>)</b></label>-->
<!--                    <input type="number"    name="sirina"      id="sirina"      step="any"  placeholder="Sirina (v mm)"             min='1' required>-->
<!--                    -->
<!--                    <label for="visina"><b>Visina(v <i>mm</i>)</b></label>-->
<!--                    <input type="number"    name="visina"      id="visina"      step="any"  placeholder="Visina (v mm)"             min='1' required>-->
<!--                    -->
<!--                    <label for="topSpeed"><b>Najvecja hitrost(v <i>km/h</i>)</b></label>-->
<!--                    <input type="number"    name="topSpeed"    id="topSpeed"    step="any"  placeholder="Najvecja hitrost (v km/h)" min='1' required>-->
<!--                    -->
<!--                    <label for="basePrice"><b>Osnovna cena(v <i>evrih</i>)</b></label>-->
<!--                    <input type="number"    name="basePrice"   id="basePrice"   step="any"  placeholder="Osnovna cena (v km/h)"     min='1' required>-->
<!---->
<!--                </div>-->
<!---->
<!--                <div class="submit-reset" >-->
<!--                    <input type="submit" name="sub-btn" id="sub-btn" class="btn black" value="Dodaj" >-->
<!--                    <input type="reset" id="reset-btn" class="btn black" value="Prekliči" onclick="cancle()">-->
<!--                </div> -->
<!--            </form>            -->
<!--        </article>-->
<!--        <div class="full-overlay"></div>-->
<!--    </main>-->
<!--    --><?php //include_once "../php/footer.php" ?>
<!--    <script src="../../../public/javascript/popUpFormCar.js"></script>-->
<!--    <script src="../../../public/javascript/showConfirmMsg.js"></script>-->
<!--    <script>-->
<!--        let form = document.querySelector('.car-edit');-->
<!--        document.getElementById("sub-btn").addEventListener("click", ()=>{-->
<!--            form.classList.add("submitted");-->
<!--            if(form.querySelector("#img-file:invalid"))-->
<!--                form.querySelector("#img-file:invalid").parentElement.style.border = "2.2px solid #e91e63";   -->
<!--            else   -->
<!--                form.querySelector("#img-file").parentElement.style.border = "2px solid rgb(100, 100, 100)";-->
<!--        });-->
<!--        document.getElementById("edit-btn").addEventListener("click", ()=>{-->
<!--	        form.classList.add("submitted");-->
<!--        });-->
<!--        -->
<!--        -->
<!--    </script>-->
<!--</body>-->
<!--</html>-->