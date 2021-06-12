<div class="row">
	<div class="col-12">
		<div class="hero text-white py-5 px-5" style="background: #2299aa; box-shadow: 0px 0px 15px rgb(0 0 0 / 15%);">
			<div class="hero-inner">
				<h2>Selamat Datang, <?= $nama ?></h2>
				<p class="lead">Ingin mengajukan Voucher silahkan ke menu "Voucher Belanja" dan untuk mengajukan Pinjaman silahkan ke menu "Peminjaman". Untuk lebih cepatnya silahkan klik tombol dibawah ini.</p>
				<div class="mt-3">
					<a href="<?= base_url('voucher') ?>" class="btn btn-outline-white btn-icon icon-left mr-1 mt-1"><i class="fas fa-money-check-alt"></i> Voucher Belanja</a>
					<a href="<?= base_url('peminjaman') ?>" class="btn btn-outline-white btn-icon icon-left mt-1"><i class="fas fa-hand-holding-usd"></i> Peminjaman</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt-5">
	<div class="col-lg-3 col-sm-12">
		<div class="card card-statistic-2 pt-4 px-0">
			<div class="card-stats">
				<div class="card-stats-items w-100">
					<div class="card-stats-item w-100">
						<h5>Status Voucher</h5>
						<?php if ($voucherLatest) {
							if ($voucherLatest->konfirmasi_pembayaran == 0) {
								echo '<h6 style="color: red;">Belum Bayar</h6>';
							} else if ($voucherLatest->konfirmasi_pembayaran == 1) {
								echo '<h6 style="color: green;">Sudah Bayar</h6>';
							}
							else {
							    echo '<h6 style="color: red;">Ditolak</h6>';
							}
						} ?>
					</div>
				</div>
			</div>
			<div class="card-icon shadow-info bg-info">
				<i class="fas fa-money-check-alt"></i>
			</div>
			<div class="card-wrap pt-1">
				<div class="card-header mb-1">
					<h4>Limit Voucher</h4>
				</div>
				<div class="card-body">
				    <h5>
						<?php if ($voucherLatest) : ?>
							Rp. <?= number_format($voucherLatest->limit_voucher, 0, '', '.') ?>
						<?php endif; ?>
					</h5>
				</div>
				<div class="card-footer w-100 text-center">
					<a href="<?= base_url('voucher') ?>" class="badge badge-light">Tampilkan Semua Data <i class="fas fa-chevron-right"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-12">
		<div class="card card-statistic-2 pt-4 px-0">
			<div class="card-stats">
				<div class="card-stats-items w-100">
					<div class="card-stats-item w-100">
						<h5>Status Peminjaman</h5>
						<?php if ($pinjamanLatest) {
							if ($pinjamanLatest->status_pinjaman == 0) {
								echo '<h6 style="color: red;">Belum Lunas</h6>';
							} else {
								echo '<h6 style="color: green;">Sudah Lunas</h6>';
							}
						} else {
							echo
							'<h6 style="color: black;">Belum Ada</h6>';
						}
						?>
					</div>
				</div>
			</div>
			<div class="card-icon shadow-primary bg-primary">
				<i class="fas fa-hand-holding-usd"></i>
			</div>
			<div class="card-wrap pt-1">
				<div class="card-header mb-1">
					<h4>Peminjaman Terakhir</h4>
				</div>
				<div class="card-body">
					<h5>
						<?php if (($countPeminjaman !== 0)) : ?>
							Rp. <?= number_format($pinjamanLatest->total_pinjaman, 0, '', '.') ?>
						<?php else : ?>
							Rp. 0
						<?php endif; ?>
					</h5>

				</div>
				<div class="card-footer text-center mx-0">
					<a href="<?= base_url('peminjaman') ?>" class="badge badge-light">Tampilkan Semua Data <i class="fas fa-chevron-right"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-12">
		<div class="card card-statistic-2 pt-4 px-0">
			<div class="card-stats">
				<div class="card-stats-items w-100">
					<div class="card-stats-item w-100">
						<h5>Simpanan Wajib </h5>
						<?php if ($simpananWajibLatest) {
							if ($simpananWajibLatest->status == 0) {
								echo '<h6 style="color: red;">Belum Bayar</h6>';
							} else {
								echo '<h6 style="color: green;">Sudah Bayar</h6>';
							}
						} else {
							echo
							'<h6 style="color: black;">Belum Ada</h6>';
						}
						?>
					</div>
				</div>
			</div>
			<div class="card-icon shadow-danger bg-danger">
				<i class="fas fa-archive"></i>
			</div>
			<div class="card-wrap pt-1">
				<div class="card-header mb-1">
					<h4>
						<?php if ($countSimpananWajib !== 0) : ?>
							<?php setlocale(LC_ALL, 'id-ID', 'id_ID');
							echo strftime("%B %Y", strtotime($simpananWajibLatest->created_at)); ?>
						<?php else : ?>

						<?php endif; ?>
					</h4>
				</div>
				<div class="card-body">
					<?php if ($simpananWajibLatest) { ?>
						<h5><?= number_format($simpananWajibLatest->total_simpanan_wajib, 0, '', '.') ?></h5>
					<?php } else { ?>
						<h5>0</h5>
					<?php } ?>
				</div>
				<div class="card-footer text-center mx-0">
					<a href="<?= base_url('simpanan') ?>" class="badge badge-light">Tampilkan Semua Data <i class="fas fa-chevron-right"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-sm-12">
		<div class="card card-statistic-2 pt-4 px-0">
			<div class="card-stats">
				<div class="card-stats-items w-100">
					<div class="card-stats-item w-100">
						<h5>Simpanan Pokok</h5>
						<?php
						if ($simpanan_pokok) {
							if ($simpanan_pokok->status == 0) {
								echo '<h6 style="color: red;">Belum Bayar</h6>';
							} else if ($simpanan_pokok->status == 1) {
								echo '<h6 style="color: green;">Sudah Bayar</h6>';
							} else {
								echo '<h6 style="color: orange;">Dana Sudah Dicairkan</h6>';
							}
						} else {
							echo '<h6 style="color: black;">Belum Ada</h6>';
						}
						?>
					</div>
				</div>
			</div>
			<div class="card-icon shadow-warning bg-warning">
				<i class="fas fa-archive"></i>
			</div>
			<div class="card-wrap pt-1">
				<div class="card-header mb-1">
					<h4>Total Simpanan</h4>
				</div>
				<div class="card-body">
					<?php if ($simpanan_pokok) { ?>
						<h5><?= number_format($simpanan_pokok->total_simpanan_pokok, 0, '', '.') ?></h5>
					<?php } else { ?>
						<h5>0</h5>
					<?php } ?>
				</div>
				<div class="card-footer text-center mx-0">
					<a href="<?= base_url('simpanan') ?>" class="badge badge-light">Tampilkan Data <i class="fas fa-chevron-right"></i></a>
				</div>
			</div>
		</div>
	</div>

</div>

<!-- <div class="row">
	<div class="col-lg-7 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Pengambilan Voucher <?= date('Y') ?></h4>
				<div class="card-header-action">
					<a href="#" class="btn btn-info">Tampilkan Semua Data <i class="fas fa-chevron-right"></i></a>
				</div>
			</div>
			<div class="card-body px-2">
				<div class="table-reponsive">
					<table class="table table-sm table-striped">
						<tbody>
							<tr class="text-center">
								<th>ID Voucher</th>
								<th>Diterbitkan</th>
								<th>Kadaluarsa</th>
								<th>Status Bayar</th>
							</tr>
							<tr>
								<td class="text-center">00023</td>
								<td class="text-center">12/04/2021</td>
								<td class="text-center">12/05/2021</td>
								<td class="text-center">
									<div class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="left" title="Belum dibayar"><i class="fas fa-times"></i></div>
								</td>
							</tr>
							<tr>
								<td class="text-center">00022</td>
								<td class="text-center">10/03/2021</td>
								<td class="text-center">10/04/2021</td>
								<td class="text-center">
									<div class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Sudah dibayar"><i class="fas fa-check"></i></div>
								</td>
							</tr>
							<tr>
								<td class="text-center">00021</td>
								<td class="text-center">05/02/2021</td>
								<td class="text-center">05/03/2021</td>
								<td class="text-center">
									<div class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Sudah dibayar"><i class="fas fa-check"></i></div>
								</td>
							</tr>
							<tr>
								<td class="text-center">00020</td>
								<td class="text-center">02/01/2021</td>
								<td class="text-center">02/02/2021</td>
								<td class="text-center">
									<div class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Sudah dibayar"><i class="fas fa-check"></i></div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-5 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Simpanan Wajib <?= date('Y') ?></h4>
				<div class="card-header-action">
					<a href="#" class="btn btn-info">Tampilkan Semua Data <i class="fas fa-chevron-right"></i></a>
				</div>
			</div>
			<div class="card-body px-2">
				<div class="table-reponsive">
					<table class="table table-sm table-striped">
						<tbody>
							<tr class="text-center">
								<th>ID Simpnan</th>
								<th>Bulan</th>
								<th>Status</th>
							</tr>
							<tr>
								<td class="text-center">00024</td>
								<td class="text-center">Mei</td>
								<td class="text-center">
									<div class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="left" title="Belum dibayar"><i class="fas fa-times"></i></div>
								</td>
							</tr>
							<tr>
								<td class="text-center">00023</td>
								<td class="text-center">April</td>
								<td class="text-center">
									<div class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Sudah dibayar"><i class="fas fa-check"></i></div>
								</td>
							</tr>
							<tr>
								<td class="text-center">00022</td>
								<td class="text-center">Maret</td>
								<td class="text-center">
									<div class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Sudah dibayar"><i class="fas fa-check"></i></div>
								</td>
							</tr>
							<tr>
								<td class="text-center">00021</td>
								<td class="text-center">Februari</td>
								<td class="text-center">
									<div class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Sudah dibayar"><i class="fas fa-check"></i></div>
								</td>
							</tr>
							<tr>
								<td class="text-center">00020</td>
								<td class="text-center">Januari</td>
								<td class="text-center">
									<div class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="Sudah dibayar"><i class="fas fa-check"></i></div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div> -->