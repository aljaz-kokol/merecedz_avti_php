<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once VIEW."shared/meta_data.php";
        require_once VIEW."shared/css.php";
    ?>
    <title>Write Story</title>
</head>
<body>
    <?php require_once VIEW."shared/nav.php" ?>
    <main>
        <h1>CONTROL PANEL</h1>
        <section id="control-panel-view">
            <a href="/control/news" id="story-control-link" class="card">
                <h2 class="link-title">WRITE AND EDIT STORYS</h2>
                <div class="overlay"></div>
            </a>

            <a href="/control/car" id="car-control-link" class="card">
                <h2 class="link-title">ADD, DELETE AND EDIT CARS</h2>
                <div class="overlay"></div>
            </a>
        </section>
    </main>
</body>
</html>