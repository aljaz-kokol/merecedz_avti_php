<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once VIEW."shared/meta_data.php";
        require_once VIEW."shared/css.php";
    ?>
    <title>Write a story</title>
</head>
<body>

    <?php
        require_once VIEW."shared/nav.php";

    ?>
    <main>
        <h1>WRITE OR EDIT A STORY</h1>

        <section class="news-preview-list">
            <?php foreach($this->newsCards as $index=>$newsCard) : ?>
                <?php
                    if(isset($_POST["del-btn$index"])){
                        NrsDatabase::deleteNewsCard($newsCard);
                        header('location: '.$_SERVER['PHP_SELF']);
                    }
                ?>
                <form class="card news-preview-card" action="" method="POST">
                    <img class="car-card-img" src="../<?= $newsCard->getImg()->img_dir ?>" alt="<?= $newsCard->getImg()->ime ?>">
                    <h5 class="news-preview-title"><?= $newsCard->naslov ?></h5>
                    <div class="delete-edit">
                        <!--Ta box se bo pokazal ko bo user hotel izbrisati neakak-->
                        <div class="confirmBox" id="<?= "confirmBox-$index" ?>">
                            <h2 class="confirmTitle">Odstranitev zgodbe</h2>
                            <p class="confirmContent">Ste prepričani da žeilte izbrisati to zgodbo:</p>
                            <p><b><?= "$newsCard->naslov" ?></b></p>
                            <br>
                            <input type="submit" name="<?= "del-btn$index" ?>" class="btn black" value="Da">
                            <input type="button"  onclick='hideConfirm(<?= $index ?>)' class="btn black" value="Ne" >
                        </div>

                        <input type="button" onclick="showConfirm(<?= $index ?>)" class="btn black" value="Odstrani" >
                        <input type="button"  onclick='editForm(<?= (json_encode($newsCard))?>)' class="btn black" value="Uredi" >
                        
                    </div>
                </form>
                
            <?php endforeach ?>
        </section>
        <button class="add-btn" onclick="newForm()">+</button>       
        <article class="pop-up-form">
            <h2>Napiši nov članek</h2>
            <form class='news-card' method="POST" enctype="multipart/form-data">
                <input type="hidden" name="imgID" id="imgID">    
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="news-card-id" id="news-card-id" value="">
                <div class="upload-img">
                    <input type="file" id="img-file" name="img-file" required>
                </div>

                <div class="news-card-content">
                    <input class='news-card-title' type="text" name="naslov" placeholder="NASLOV" required>
                    <textarea name="kratek-opis" id="kratek-opis" rows="10" placeholder="Kratek opis..." required></textarea>
                </div>

                <div class="submit-reset">
                    <input type="submit" name="sub-btn" id="sub-btn" class="btn black" value="Objavi" >
                    <input type="reset" id="reset-btn" class="btn black" value="Prekliči" onclick="cancle()">
                </div> 
            </form>
            
        </article>

        <div class="full-overlay"></div>
    </main>
    <?php require_once VIEW."shared/footer.php" ?>
    <script src="../../../public/javascript/popUpFormNewsCard.js"></script>
    <script src="../../../public/javascript/showConfirmMsg.js"></script>
    <script>
        let form = document.querySelector('.news-card');
        document.getElementById("sub-btn").addEventListener("click", ()=>{
            form.classList.add("submitted");
            if(form.querySelector("#img-file:invalid"))
                form.querySelector("#img-file:invalid").parentElement.style.border = "2.2px solid #e91e63";   
            else   
                form.querySelector("#img-file").parentElement.style.border = "2px solid rgb(100, 100, 100)";    
        });

        document.getElementById("edit-btn").addEventListener("click", ()=>{
	        form.classList.add("submitted");
        });
    </script>
</body>
</html>