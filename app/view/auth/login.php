<!DOCTYPE html>
<html>
<head>
    <?php
        require_once VIEW."shared/meta_data.php";
        require_once VIEW."shared/css.php";
    ?>
	<title>Login</title>
</head>
<body>
	<div class="register-header">
		<h2>Login</h2>
	</div>

	<form class="register-form" method="POST">
		<?php if (isset($this->viewData['error'])) : ?>
            <div class="error"><?= $this->error ?></div>
        <?php endif; ?>
		<div class="register-group">
			<label for="username">Username or Email: </label>
			<input type="text" id="username" required name="username">
		</div>
		<div class="register-group">
			<label for="password">Password: </label>
			<input type="password" id="password" required name="password">
		</div>
		<div class="register-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<p>
			Not yet a member? <a href="/auth/register">Signup</a>
		</p>
	</form>
</body>
</html>