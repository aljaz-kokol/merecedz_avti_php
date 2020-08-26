<header>
    <section id="website_info">
        <h1 class="website_title">
            <a href="index.php" class="website_title_link">Mercedes Benz</a>
        </h1>
        <div class="registration">
            <?php if(isset($this->viewData['uporabnik'])) : ?>
                <p class="username"><?= $this->uporabnik->username ?></p>
                <a href="/sign-out"><button class="login-btn">Logout</button></a>
            <?php else : ?>
                <a href="/auth/login"><button class="login-btn">Login</button></a>
                <a href="/auth/register"><button class="login-btn">Signup</button></a>
            <?php endif ?>
        </div>
    </section>

    <nav>
        <div class="burger-bar">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <ul class="navigation">
            <li class="nav-item-container"><a class="nav-item" href="/">Home</a></li>
            <?php foreach ($this->listRazredov as $razred) : ?>
                <li class='nav-item-container'><a class='nav-item' href='/class/<?= $razred->ime ?>'><?= $razred->ime ?>-Class</a></li>
            <?php endforeach; ?>

            <?php if (isset($this->viewData['uporabnik']) && $this->uporabnik->status == 1) : ?>
                <li class='nav-item-container' id='sub-nav-container'>
                    <a class='nav-item' href='/control'>Control panel</a>
                    <ul class='sub-nav'>
                        <li class='nav-item-container'><a href='/control/news' class='nav-item'>Write, edit, delete storys</a></li>
                        <li class='nav-item-container'><a href='/control/car' class='nav-item'>Add, edit, delete cars</a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <li class="nav-item-container"><a class="nav-item" href="/reviews">Reviews</a></li>
        </ul>
    </nav>
</header>