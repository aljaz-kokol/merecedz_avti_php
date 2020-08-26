<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once VIEW."shared/meta_data.php";
        require_once VIEW."shared/css.php";
    ?>
    <title><?= $this->avto->ime ?></title>
</head>
<body>
    <?php require_once VIEW."shared/nav.php"; ?>
    <main>
        <h1><?= $this->avto->ime ?></h1>
        <scetion class="card news-card">
            <img class="news-card-img" src="<?= $this->avto->getImg()->img_dir?>" alt="<?= $this->avto->getImg()->ime?>">
            <article class="news-card-content">
                <h2 class="news-card-title">SEZNAM POMEBNIH PODATKOV</h2>
                <ul class="car-info-item-list">
                    <li class="car-info-item">Ime: <?= $this->avto->ime ?></li>
                    <li class="car-info-item">Osnovna cena: <?= $this->avto->fixedCena ?> &euro;</li>
                    <li class="car-info-item">Kilovati: <?= $this->avto->getMotor()->kilovati ?> kW</li>
                    <li class="car-info-item">Konjska moc: <?= $this->avto->getMotor()->kilovati*1.34 ?> KM</li>
                    <li class="car-info-item">Navor: <?= $this->avto->getMotor()->navor ?> Nm</li>
                    <li class="car-info-item">Vrsta-goriva: <?= ucfirst($this->avto->getGorivo()->tip) ?></li>
                    <li class="car-info-item">Leto-izdaje: <?= $this->avto->getDate() ?></li>
                    <li class="car-info-item">Število vrat: <?php echo $this->avto->stevilo_vrat?></li>
                </ul>
            </article>
        </scetion>

        <section class="card news-card" id="car-details">
            <article class="news-card-content" >
                <h2 class="news-card-title">SEZNAM VSEH PODATKOV</h2>
                <ul class="car-info-item-list">
                    <li class="car-info-item">Razred: <?= $this->avto->getClass()->ime ?></li>
                    <li class="car-info-item">Ime: <?= $this->avto->ime ?></li>
                    <li class="car-info-item">Tip avtomobila: <?= $this->avto->getTip()->ime ?></li>
                    <li class="car-info-item">Osnovna cena: <?= $this->avto->fixedCena ?> &euro;</li>
                    <li class="car-info-item">Najvecja hitrost: <?= $this->avto->najvecja_hitrost ?> km/h</li>
                    <li class="car-info-item">Kilovati: <?= $this->avto->getMotor()->kilovati ?> kW</li>
                    <li class="car-info-item">Konjska moc: <?= $this->avto->getMotor()->kilovati*1.34 ?> KM</li>
                    <li class="car-info-item">Navor: <?= $this->avto->getMotor()->navor ?> Nm</li>
                    <li class="car-info-item">Vrsta-goriva: <?= ucfirst($this->avto->getGorivo()->tip) ?></li>
                    <li class="car-info-item">Leto-izdaje: <?= $this->avto->getDate() ?></li>
                    <li class="car-info-item">Število vrat: <?= $this->avto->stevilo_vrat?></li>
                    <li class="car-info-item">Vrsta pogona: <?= ucfirst($this->avto->getPogon()->tip) ?></li>
                    <li class="car-info-item">Menjalnik: <?= ucfirst($this->avto->getMenjalnik()->tip) ?></li>
                    <li class="car-info-item">Teza: <?= $this->avto->teza ?> Kg</li>
                    <li class="car-info-item">Dolzina: <?= $this->avto->dolzina_mm ?> mm</li>
                    <li class="car-info-item">Sirina: <?= $this->avto->sirina_mm ?> mm</li>
                    <li class="car-info-item">Visina: <?= $this->avto->visina_mm ?> mm</li>
                    
                </ul>
            </article>
        </section>
                    
        <section class="form">
            <h2 class="news-card-title">VAŠE MNENJE</h2>
            <form class="rating-form" method="POST">
                <?php if(isset($this->viewData['uporabnik'])) : ?>
                    <table>
                        <tr>
                            <td><label for="komentar">Komentar: </label></td>
                            <td><textarea name="komentar" id="komentar" rows="7" placeholder="Vaš komentar" required></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="star1">Ocena: </label></td>
                            <td class="stars-container">
                                <input type="radio" class="star-btn" name="star" id="star5" value="5" required>
                                <label class="star" for="star5"></label>

                                <input type="radio"class="star-btn" name="star" id="star4" value="4" required>
                                <label class="star" for="star4"></label>

                                <input type="radio" class="star-btn" name="star" id="star3" value="3" required>
                                <label class="star" for="star3"></label>

                                <input type="radio" class="star-btn" name="star" id="star2" value="2" required>
                                <label class="star" for="star2"></label>

                                <input type="radio" class="star-btn" name="star" id="star1" value="1" required>
                                <label class="star" for="star1"></label>
                            </td>
                        </tr>  
                    </table>
                    <br>
                    <div class="submit-reset">
                        <input type="submit" name="reg-btn" id="comment" class="btn black" value="Komentiraj">
                        <input type="reset" class="btn black" value="Ponastavi">
                    </div>       
                <?php endif ?>

                <?php if(!isset($this->viewData['uporabnik'])) : ?>
                    <article>
                        <h3 class="error">Če želite podati svoje mnenje se morate najprej prijaviti</h3>
                        <div class="registration">
                            <a href="/auth/login" class="login-btn">Login</a>
                            <a href="/auth/register" class="login-btn">Signup</a>
                        </div>
                    </article>
                    
                <?php endif ?>
            </form>
        </section>
    </main>
    <?php require_once VIEW."shared/footer.php"; ?>
    <script>
        document.getElementById("comment").addEventListener("click", ()=>{
	        document.querySelector('.rating-form').classList.add("submitted");
        });
    </script>
</body>
</html>