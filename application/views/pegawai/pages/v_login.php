<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title_header . ' - ' . $title ?></title>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href=" <?= base_url() . 'assets/favicon/favicon.ico' ?>" type="image/x-icon">
	<link rel="icon" href="<?= base_url() . 'assets/favicon/favicon.ico' ?>" type="image/x-icon">

	<!-- General CSS Files -->
	<link rel="stylesheet" href="<?= base_url() . 'assets/stisla/modules/bootstrap/css/bootstrap.min.css' ?>">
	<link rel="stylesheet" href="<?= base_url() . 'assets/stisla/modules/fontawesome/css/all.min.css' ?>">

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?= base_url() . 'assets/stisla/modules/bootstrap-social/bootstrap-social.css' ?>">

	<!-- Template CSS -->
	<link rel="stylesheet" href="<?= base_url() . 'assets/stisla/css/style.css' ?>">
	<link rel="stylesheet" href="<?= base_url() . 'assets/stisla/css/components.css' ?>">

	<style>
		.btn-secondary {
			background-color: #2299aa;
			border-color: #2299aa;
		}
	</style>
</head>

<body>
	<div id="app">
		<section class="section">
			<div class="container mt-4">
				<div class="row">
					<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="login-brand mb-4">
							<img src="<?= base_url() . 'assets/beranda/images/logo-121x123.png' ?>" alt="logo" width="100" class="shadow-light rounded-circle">
						</div>
						<div class="card card-primary" style="border-top: 2px solid #2299aa;">
							<div class="card-header">
								<h4>Login</h4>
							</div>
							<div class="card-body pb-0">
								<form class="needs-validation">
									<div class="form-group">
										<label for="username">Username</label>
										<input id="username" type="username" class="form-control login" name="username" tabindex="1" required>
									</div>

									<div class="form-group">
										<div class="d-block">
											<label for="password" class="control-label">Password</label>
											<div class="float-right">
												<!-- <a href="#" class="text-small">
													Lupa Password?
												</a> -->
											</div>
										</div>
										<input id="password" type="password" class="form-control login" name="password" tabindex="2" required>
									</div>
									<div class="form-group">
										<input type="button" class="btn btn-secondary btn-lg btn-block" id="btn-login" tabindex="4" value="Login">
									</div>
								</form>
							</div>

							<div class="card-footer bg-whitesmoke text-center">
								<strong class="simple-footer">
									Copyright &copy; <?= date('Y') . ' ' . $title_footer ?>
								</strong>
								<p class="mb-0">Template powered by Stisla</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- General JS Scripts -->
	<script src="<?= base_url() . 'assets/stisla/modules/jquery.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/popper.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/tooltip.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/bootstrap/js/bootstrap.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/sweetalert/sweetalert2.all.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/nicescroll/jquery.nicescroll.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/moment.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/js/stisla.js' ?>"></script>

	<!-- JS Libraies -->

	<!-- Page Specific JS File -->

	<!-- Template JS File -->
	<script src="<?= base_url() . 'assets/stisla/js/scripts.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/js/custom.js' ?>"></script>


	<script>
		$('.login').bind("enterKey", function(e) {
			//do stuff here
		});
		$('.login').keyup(function(e) {
			if (e.keyCode == 13) {
				// $(this).trigger("enterKey");
				$('#btn-login').click();
			}
		});

		$('#btn-login').click(function() {
			if (($('#username').val() == '') && ($('#password').val() == '')) {
				Swal.fire(
					'Username dan Password tidak boleh kosong',
					'',
					'error'
				)
			} else if ($('#username').val() == '') {
				Swal.fire(
					'Username tidak boleh kosong',
					'',
					'error'
				)
			} else if ($('#password').val() == '') {
				Swal.fire(
					'Password tidak boleh kosong',
					'',
					'error'
				)
			} else {
				var username = $('#username').val()
				var password = $('#password').val()
				// alert(username + ' ' + password)
				$.ajax({
					type: 'post',
					url: `<?= base_url('cek-data-login') ?>`,
					data: {
						username: username,
						password: password
					},
					dataType: 'json',
					success: function(response) {
						if (response.res !== 'success') {
							Swal.fire(
								'Gagal',
								'Username atau password salah. Silahkan di cek kembali.',
								'error'
							)
						} else {
							$.ajax({
								type: 'post',
								url: `<?= base_url('cek_login') ?>`,
								data: {
									username: username,
									password: password
								},
								dataType: 'json',
								success: function(response) {
									if (response.res == 'pegawai') {
										window.location.href = `<?= base_url('dashboard') ?>`
									} else if (response.res == 'admin') {
										window.location.href = `<?= base_url('dashboard-admin') ?>`
									} else if (response.res == 'kasir') {
										window.location.href = `<?= base_url('dashboard-kasir') ?>`
									} else if (response.res == 'tidakAktif') {
										Swal.fire(
											'Gagal',
											'Maaf, akun anda saat ini dalam status "Tidak Aktif". Silahkan hubungi admin untuk mengaktifkan akun.',
											'error'
										)
									} else {
										Swal.fire(
											'Gagal',
											'Periksa Kembali Username dan Password Anda',
											'error'
										)
									}
									// else {
									// 	window.location.href = `<?= base_url('login') ?>`
									// }
								}
							})
						}
					}
				})
			}
		})
	</script>
</body>

</html>