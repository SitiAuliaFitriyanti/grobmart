<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<script src='https://www.google.com/recaptcha/api.js' async defer></script>
	<style>
		.input {
			margin-top: 150px;
		}
	</style>
<?php
if (isset($_SESSION['loggrobdesk'])) {
    header("Location: admin.php");
}
?>
</head>

<body>
	<div class="input">
		<div class="container">
			<div class="row justify-content-center mt-5">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header bg-transparent mb-0">
							<h5 class="text-center">Login <span class="font-weight-bold text-primary"></span></h5>
						</div>
						<div class="card-body">
							<form name="stmt" method="post" action="login_post.php">
								<div class="form-group">
									<label>Email:</label></br>
									<input class="form-control" type="email" id="inputEmail" name="email" placeholder="Email" autofocus required="required">
								</div>
								<div class="form-group">
									<label>Password:</label></br>
									<input class="form-control" type="password" id="inputPassword" name="password" placeholder="Password" required="required"></br>
								</div>
								<div class="form-group">
									<div class="g-recaptcha" data-sitekey="6LcwwVghAAAAALPN5Rqbk9ETks38BXPJFyDQGI8Z"></div></br>
								</div>
								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Login</button></br>
								</div>
							</form>
							<p class="small">Don't have an account? <a href="register.php">Register</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>






	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>