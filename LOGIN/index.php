<?php
//esto es en caso de que no exista la session me llevara al login index
session_start();
if (isset($_SESSION["id_usu"])) {
	header("location: ../ADMIN/");
}
?>

<!doctype html>
<html lang="en">

<head>
	<title>Login sistema</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">

</head>

<body>
	<br>
	<br>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 col-lg-10">
				<div class="wrap d-md-flex">
					<div class="img" style="background-image: url(images/banano.png);">
					</div>
					<div class="login-wrap p-4 p-md-5">
						<div class="d-flex">
							<div class="w-100">
								<h3 class="mb-4"><center>Login del sistema</center></h3>
							</div>
						</div>

						<div class="alert alert-danger text-center" id="none_usu" style="display:none;">
							<span> Ingrese un usuario para continuar</span>
						</div>

						<div class="alert alert-danger text-center" id="none_pass" style="display:none;">
							<span> Ingrese un password para continuar</span>
						</div>

						<div class="form-group mb-3">
							<label class="label" for="name">Usuario</label>
							<input type="text" id="usuario" class="form-control" placeholder="Username" required>
						</div>
						<div class="form-group mb-3">
							<label class="label" for="password">Password</label>
							<input type="password" id="password" class="form-control" placeholder="Password" required>
						</div>

						<div class="alert alert-danger text-center" id="error_logeo" style="display:none;">
							<span> Usuario o contraseña incorrectos</span>
						</div>

						<div class="form-group">
							<button id="ingresar" class="form-control btn btn-primary rounded submit px-3">Ingresar</button>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

	<script src="../ADMIN/js/usuario.js"></script>
	<script src="../ADMIN/plugins/sweetalert2/sweetalert2.all.min.js"></script>

</body>

<!-- <body class="img js-fullheight" style="background-image: url(images/banano.png);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login sistema</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center"><p>Ingrese sus credenciales de usuario</p></h3>

						<div class="alert alert-danger text-center" id="none_usu" style="display:none;">
							<span> Ingrese un usuario para continuar</span>
						</div>

						<div class="alert alert-danger text-center" id="none_pass" style="display:none;">
							<span> Ingrese un password para continuar</span>
						</div>

						<div class="form-group">
							<input id="usuario" type="text" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<input id="password" type="password" class="form-control" placeholder="Password">
							<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>

						<div class="alert alert-danger text-center" id="error_logeo" style="display:none;">
							<span> Usuario o contraseña incorrectos</span>
						</div>

						<div class="form-group">
							<button id="ingresar" class="form-control btn btn-primary submit px-3">Ingresar</button>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

	<script src="../ADMIN/js/usuario.js"></script>
	<script src="../ADMIN/plugins/sweetalert2/sweetalert2.all.min.js"></script>

</body> -->

</html>