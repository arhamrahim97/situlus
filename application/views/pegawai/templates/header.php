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
	<link rel="stylesheet" href="<?= base_url() . 'assets/stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css' ?>">
	<link rel="stylesheet" href="<?= base_url() . 'assets/stisla/modules/datatables/Responsive-2.2.1/css/responsive.bootstrap4.min.css' ?>">


	<!-- Template CSS -->
	<link rel="stylesheet" href="<?= base_url() . 'assets/stisla/css/style.css' ?>">
	<link rel="stylesheet" href="<?= base_url() . 'assets/stisla/css/components.css' ?>">

	<style>
		.card {
			box-shadow: 0px 0px 5px rgb(0 0 0 / 10%) !important;
		}

		a.nav-link::before {
			background: #2299aa !important;
		}

		body.sidebar-mini .main-sidebar .sidebar-menu>li.active>a {
			background-color: #2299aa;
			color: white !important;
		}

		.active .nav-link {
			color: #2299aa !important;
		}

		.btn-outline-white:hover {
			color: #2299aa;
		}

		select.form-control.form-control-sm {
			height: 31px !important;
			padding: 0px !important;
		}

		.modal {
			overflow-y: auto;
		}
	</style>

	<!-- General JS Scripts -->
	<script src="<?= base_url() . 'assets/stisla/modules/jquery.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/popper.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/tooltip.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/bootstrap/js/bootstrap.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/nicescroll/jquery.nicescroll.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/moment.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/js/stisla.js' ?>"></script>

	<!-- JS Libraies -->
	<script src="<?= base_url() . 'assets/stisla/modules/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/datatables/Responsive-2.2.1/js/dataTables.responsive.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/datatables/Responsive-2.2.1/js/responsive.bootstrap4.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/moment/moment-with-locales.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/bs-custom-file-input/bs-custom-file-input.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/sweetalert/sweetalert2.all.min.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/modules/jquery-mask/jquery.mask.min.js' ?>"></script>

	<!-- Page Specific JS File -->

	<!-- Template JS File -->
	<script src="<?= base_url() . 'assets/stisla/js/scripts.js' ?>"></script>
	<script src="<?= base_url() . 'assets/stisla/js/custom.js' ?>"></script>
</head>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<div class="navbar-bg" style="background-color: #2299aa;"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<form class="form-inline mr-auto">
					<ul class="navbar-nav mr-3">
						<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
					</ul>
				</form>
				<ul class="navbar-nav navbar-right ml-auto">
					<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
							<img alt="image" src="<?= base_url() . 'uploads/img/' . $this->session->userdata('foto_profil') ?>" class="rounded-circle mr-1">
							<div class="d-sm-none d-lg-inline-block">Hai, <?= $nama ?></div>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item has-icon" onclick="profilPegawai(<?= $this->session->userdata('id') ?>)">
								<i class="far fa-user"></i> Profile
							</a>
							<div class="dropdown-divider"></div>
							<a href="<?= base_url() . 'logout' ?>" class="dropdown-item has-icon text-danger">
								<i class="fas fa-sign-out-alt"></i> Logout
							</a>
						</div>
					</li>
				</ul>
			</nav>
			<div class="main-sidebar sidebar-style-2">
				<aside id="sidebar-wrapper">
					<div class="sidebar-brand">
						<a href="<?= base_url('dashboard') ?>"><?= $title_header ?></a>
					</div>
					<div class="sidebar-brand sidebar-brand-sm">
						<a href="<?= base_url('dashboard') ?>"><?= $title_header[0] ?></a>
					</div>
					<ul class="sidebar-menu">
						<li class="menu-header">Dashboard</li>
						<li <?php if ($title == 'Dashboard') : ?> class="active" <?php endif ?>><a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
						<li class="menu-header">Layanan</li>
						<li <?php if ($title == 'Voucher Belanja') : ?> class="active" <?php endif ?>><a class="nav-link" href="<?= base_url('voucher') ?>"><i class="fas fa-shopping-cart"></i> <span>Voucher Belanja</span></a></li>
						<li <?php if ($title == 'Peminjaman') : ?> class=active <?php endif ?>><a class="nav-link" href="<?= base_url('peminjaman') ?>"><i class="fas fa-hand-holding-usd"></i> <span>Peminjaman</span></a></li>
						<li <?php if ($title == 'Simpanan Wajib & Simpanan Pokok') : ?> class=active <?php endif ?>><a class="nav-link" href="<?= base_url('simpanan') ?>"><i class="fas fa-archive"></i> <span>Simpanan</span></a></li>
					</ul>
				</aside>
			</div>

			<!-- Main Content -->
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1><?= $title ?></h1>
					</div>

					<div class="section-body" style="margin-right: -15px; margin-left: -15px;">
