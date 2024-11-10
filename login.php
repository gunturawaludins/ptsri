<?php
session_start();
include 'koneksi.php';

?>
<!doctype html>
<html lang="en">

<head>
	<title>Login </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="login/css/style.css">

</head>

<body class="img js-fullheight" style="background-image: url(login/images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">PT SRI NUSANTARA ABADI</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
						<h3 class="mb-4 text-center">Silahkan Login</h3>
						<form method="post" class="signin-form">
							<div class="form-group">
								<input class="form-control" name="email" id="name" type="email" placeholder="Masukkan Email">
							</div>
							<div class="form-group">
								<input class="form-control" name="password" type="password" placeholder="Masukkan Password">
								<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>
							<div class="form-group">
								<button type="submit" name="simpan" class="form-control btn btn-primary submit px-3">LOGIN</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	if (isset($_POST["simpan"])) {
		$email = $_POST["email"];
		$password = $_POST["password"];
		$ambil = $koneksi->query("SELECT * FROM pengguna
		WHERE email='$email' AND password='$password' limit 1");
		$akunyangcocok = $ambil->num_rows;
		if ($akunyangcocok == 1) {
			$akun = $ambil->fetch_assoc();
			if ($akun['level'] == "Pelanggan") {
				$_SESSION["pengguna"] = $akun;
				echo "<script> alert('Anda sukses login');</script>";
				echo "<script> location ='index.php';</script>";
			} elseif ($akun['level'] == "Admin") {
				$_SESSION['admin'] = $akun;
				echo "<script> alert('Anda sukses login');</script>";
				echo "<script> location ='admin/index.php';</script>";
			}
		} else {
			echo "<script> alert('Anda gagal login, Cek akun anda');</script>";
			echo "<script> location ='login.php';</script>";
		}
	}
	?>
	<script src="login/js/jquery.min.js"></script>
	<script src="login/js/popper.js"></script>
	<script src="login/js/bootstrap.min.js"></script>
	<script src="login/js/main.js"></script>

</body>

</html>