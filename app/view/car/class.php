<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once VIEW."shared/meta_data.php";
        require_once VIEW."shared/css.php";
    ?>
    <title><?= $this->razred->ime ?>-CLASS</title>
</head>
<body>
    <?php require_once VIEW."shared/nav.php" ?>
    <main>
        <h1><?= $this->razred->ime ?>-CLASS</h1>
        <section class="car-gallery">
            <?php foreach($this->listAvtov as $avto) : ?>
                <a href='/car/<?= $avto->id ?>' class='card car-card car-price-card'>
                    <span class='car-card-price'><?= $avto->fixedCena ?>&euro;</span>
                    <div class='car-card-content'>
                        <img src='../<?= $avto->getImg()->img_dir ?>' alt='<?= $avto->getImg()->img_dir ?>' class='car-card-img'>
                        <h4 class='car-card-title'><?= $avto->ime ?></h4>
                    </div>      
                </a>  
            <?php endforeach ?>
        </section>
    </main>     
    <?php require_once VIEW."shared/footer.php"; ?>
</body>
</html>