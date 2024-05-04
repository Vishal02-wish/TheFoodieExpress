<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Admin | The foodie express</title>


	<?php include('./header.php'); ?>
	<?php include('./db_connect.php'); ?>
	<?php
	session_start();
	if (isset($_SESSION['login_id']))
		header("location:index.php?page=home");

	$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach ($query as $key => $value) {
		if (!is_numeric($key))
			$_SESSION['setting_' . $key] = $value;
	}
	?>

</head>
<style>
	body {
		width: 100%;
		height: calc(100%);
	}

	main#main {
		width: 100%;
		height: calc(100%);
		background: white;
	}

	#login-left {
		position: absolute;
		right: 0;
		width: 50%;
		height: calc(100%);
		background-color: #ff6000;
		display: flex;
		align-items: center;
	}

	#login-right {
		position: absolute;
		left: 0;
		width: 50%;
		height: calc(100%);
		background-color: #bd4c12fc;
		display: flex;
		align-items: center;
	}

	#login-right .card {
		margin: auto
	}

	.top {
		margin: auto;
		position: relative;
		display: -ms-flexbox;
		display: flex;
		-ms-flex-direction: column;
		flex-direction: column;
		color: black;
		font-style: ;
		min-width: 0;
		box-shadow: 0px 0px 15px 2px;
		background-color: green;
		border: 3px solid black;
		border-radius: 10px;
	}

	.logo {
		margin: auto;
		font-size: 8rem;
		background: white;
		border-radius: 50% 50%;
		height: 29vh;
		box-shadow: 0px 0px 15px 15px;
		width: 13vw;
		display: flex;
		align-items: center;
	}

	.logo img {
		height: 80%;
		width: 80%;
		margin: auto
	}
</style>

<body>


	<main id="main" class=" bg-dark">
		<div id="login-left">
			<div class="logo">
				<img src="https://png.pngtree.com/png-vector/20220706/ourmid/pngtree-food-logo-png-image_5687717.png"
					alt="">
			</div>
		</div>
		<div id="login-right">
			<div class="top col-md-8">
				<div class="card-body">
					<form id="login-form">
						<div class="form-group">
							<label for="username" class="control-label">Username</label>
							<input type="text" id="username" name="username" placeholder="Username" class="form-control">
						</div>
						<div class="form-group">
							<label for="password" class="control-label">Password</label>
							<input type="password" id="password" placeholder="Password" name="password" class="form-control">
						</div>
						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
					</form>
				</div>
			</div>
		</div>


	</main>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function (e) {
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'ajax.php?action=login',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success: function (resp) {
				console.log(resp)
				if (resp == 1) {
					location.href = 'index.php?page=home';
				} else if (resp == 2) {
					location.href = 'voting.php';
				} else {
					$('#login-form').prepend('<div class="alert alert-danger">Invalid username and password.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>

</html>