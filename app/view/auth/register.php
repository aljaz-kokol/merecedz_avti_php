<!DOCTYPE html>
<html>
<head>
    <?php
        require_once VIEW."shared/meta_data.php";
        require_once VIEW."shared/css.php";
    ?>
    <title>Register</title>
</head>
<body>
    <div class="register-header">
        <h2>Register</h2>
    </div>
    <form class="register-form" method="POST">
        <?php if (isset($this->viewData['error'])) : ?>
            <div class="error"><?= $this->error ?></div>
        <?php endif; ?>
        <div class="register-group">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="register-group">
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="register-group">
            <label for="password">Password: </label>
            <input type="password" id="password" required name="password">
        </div>
        <div class="register-group">
            <label for="c_password">Confirm password: </label>
            <input type="password" id="c_password" required name="c_password">
        </div>
        <div class="register-group">
            <button type="submit" class="btn" name="register_user">Register</button>
        </div>
        <p>
            Already a member? <a href="/auth/login">Login</a>
        </p>
    </form>
</body>
</html>