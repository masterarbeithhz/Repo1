<?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: http://192.168.99.100/login/login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Service Catalog</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="header">
		<h2>Service Catalog</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success">
				<h3>
					<?php
					echo $_SESSION['success'];
					unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<img src="images/user_profile.png">

			<div>
				<?php if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>

		<form method="post" action="request.php">
			<?php echo display_error(); ?>
			<div class="input-group">
				<label>Admin Username</label>
				<input type="text" name="username" value="<?php echo $username; ?>">
			</div>
			<div class="input-group">
				<label>Admin Email</label>
				<input type="email" name="email" value="<?php echo $email; ?>">
			</div>
			<div class="input-group">
				<label>Admin Password</label>
				<input type="password" name="password_1">
			</div>
			<div class="input-group">
				<label>Confirm Admin password</label>
				<input type="password" name="password_2">
			</div>
			<div class="input-group">
				<label>Select Use-Case</label>
				<fieldset>
					<input type="radio" id="pax" name="usecase" value="PaxCounter">
					<label for="pax"> PaxCounter</label>
					<input type="radio" id="fah" name="usecase" value="Fahrradzählung">
					<label for="fah"> Fahrradzählung</label>
					<input type="radio" id="par" name="usecase" value="Parkraumüberwachung">
					<label for="par"> Parkraumüberwachung</label>
				</fieldset>
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="register_btn">Register</button>
			</div>
		</form>

	</div>
</body>

</html>