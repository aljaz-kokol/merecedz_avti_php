<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once VIEW."shared/meta_data.php";
        require_once VIEW."shared/css.php";
    ?>
    <title>Mercedes Benz</title>
</head>
<body>
<?php require_once VIEW."shared/nav.php" ?>
<main>
    <section id="news-card-list">
        <?php foreach($this->newsCardList as $newsCard) : ?>
            <article class='card news-card'>
                <img class='news-card-img' src='<?= $newsCard->getImg()->img_dir ?>' alt='<?= $newsCard->getImg()->ime ?>'>
                <div class='news-card-content'>
                    <h2 class='news-card-title'><?= $newsCard->naslov ?></h2>
                    <p class='news-card-description'><?= $newsCard->kratek_opis ?></p>
                </div>
                <p class='news-card-date'>Objavljeno: <?= $newsCard->getDate() ?></p>
            </article>
        <?php endforeach; ?>
    </section>
</main>
<?php require_once VIEW."shared/footer.php" ?>
</body>
</html>