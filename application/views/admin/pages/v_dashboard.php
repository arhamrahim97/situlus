<div class="row">
	<div class="col-lg-6 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Pengajuan Voucher</h4>
				<div class="card-header-action">
					<div class="input-group-btn" id="count-pemberitahuan-voucher">
						<span class="badge badge-danger shadow-sm">0</span>
					</div>
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div id="pemberitahuan-voucher">
					<h6 class="text-center"> Belum ada pengajuan pinjaman</h6>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Pengajuan Peminjaman</h4>
				<div class="card-header-action">
					<div class="input-group-btn" id="count-pemberitahuan-pinjaman">
						<span class="badge badge-danger shadow-sm">0</span>
					</div>
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div id="pemberitahuan-peminjaman">
					<h6 class="text-center"> Belum ada pengajuan pinjaman</h6>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-3 col-md-6 col-sm-12">
		<div class="card card-statistic-2 pt-4 ">
			<div class="card-stats">
				<div class="card-stats-item w-100 py-0">
					<h5 class="mb-0">Info Voucher</h5>
				</div>
			</div>
			<div>
				<div class="card-icon shadow-info bg-info">
					<i class="fas fa-money-check-alt"></i>
				</div>
				<div class="card-wrap pt-1 mb-2">
					<div class="card-header mb-1">
						<h4>Status Belum Dibayar</h4>
					</div>
					<div class="card-body">
						<h5><?= $voucherbelumbayar ?></h5>
					</div>
					<div class="card-footer w-100  text-center mx-0">
						<a href="<?= base_url('voucher-admin') ?>" class="badge badge-light">Tampilkan Semua Data <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-12">
		<div class="card card-statistic-2 pt-4 ">
			<div class="card-stats">
				<div class="card-stats-item w-100 py-0">
					<h5 class="mb-0">Info Peminjaman</h5>
				</div>
			</div>
			<div>
				<div class="card-icon shadow-primary bg-primary">
					<i class="fas fa-hand-holding-usd"></i>
				</div>
				<div class="card-wrap pt-1 mb-2">
					<div class="card-header mb-1">
						<h4>Status Belum Lunas</h4>
					</div>
					<div class="card-body">
						<h5><?= $peminjamanbelumlunas ?></h5>
					</div>
					<div class="card-footer w-100  text-center mx-0">
						<a href="<?= base_url('peminjaman-admin') ?>" class="badge badge-light">Tampilkan Semua Data <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-12">
		<div class="card card-statistic-2 pt-4 ">
			<div class="card-stats">
				<div class="card-stats-item w-100 py-0">
					<h5 class="mb-0">Info Simpanan Wajib</h5>
				</div>
			</div>
			<div>
				<div class="card-icon shadow-danger bg-danger">
					<i class="fas fa-archive"></i>
				</div>
				<div class="card-wrap pt-1">
					<div class="card-header mb-1">
						<h4><?php setlocale(LC_ALL, 'id-ID', 'id_ID');
							echo strftime("%B %Y", strtotime(date('Y-m'))); ?> (Belum Bayar)</h4>
					</div>
					<div class="card-body">
						<h5><?= $simpananwajibbelumbayar ?></h5>
					</div>
					<div class="card-footer text-center mx-0 ">
						<a href="<?= base_url('simpanan-wajib-admin') ?>" class="badge badge-light">Tampilkan Semua Data <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-6 col-sm-12">
		<div class="card card-statistic-2 pt-4 ">
			<div class="card-stats">
				<div class="card-stats-item w-100 py-0">
					<h5 class="mb-0">Info Simpanan Pokok</h5>
				</div>
			</div>
			<div>
				<div class="card-icon shadow-warning bg-warning">
					<i class="fas fa-archive"></i>
				</div>
				<div class="card-wrap pt-1">
					<div class="card-header mb-1">
						<h4>Status Belum Bayar</h4>
					</div>
					<div class="card-body">
						<h5><?= $simpananpokokbelumlunas ?></h5>
					</div>
					<div class="card-footer text-center mx-0 ">
						<a href="<?= base_url('simpanan-wajib-admin') ?>" class="badge badge-light">Tampilkan Semua Data <i class="fas fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<!-- Modal Pemberitahuan Detail Peminjaman -->
<div class="modal fade modal-peminjaman" id="modal-peminjaman-pemberitahuan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header px-3">
				<h5 class="modal-title" id="exampleModalLongTitle">Detail Peminjaman</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-3 pb-0">
				<div class="row">
					<div class="col">
						<div class="div" id="detail-pemberitahuan">

						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tolak Peminjaman -->
<div class="modal fade modal-tolak-peminjaman" id="modal-tolak-peminjaman" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header px-3">
				<h5 class="modal-title" id="exampleModalLongTitle">Alasan Tidak Menyetujui</h5>
				<button type="button" class="close btn-btl-tolak" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-3">
				<div class="row">
					<div class="col">
						<div class="div" id="tolak">
							<div class="form-group mb-0">
								<input type="hidden" class="form-control" id="id-catatan">
								<textarea class="form-control" rows="100" id="catatan" name="catatan"></textarea>
							</div>
							<button style="float: right" class="btn btn-sm btn-primary mt-3 btn-tolak-pinjaman" id="btn-tolak-pinjaman"><i class="fas fa-paper-plane"></i> Kirim</button>
							<button style="float: right;" class="btn btn-sm btn-danger mt-3 mr-2 btn-btl-tolak" id="btn-btl-tolak" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Voucher</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="isiDetail">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAdminTolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Alasan Ditolak</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="formTolakAdmin">
				<div class="modal-body" id="isiDetail2">
					<div class="form-group mb-0">
						<input type="text" class="form-control mt-2" id="idTolak" placeholder="Masukkan nomor" name="id" hidden>
						<textarea class="form-control mt-2" id="alasan_admin" style="height:100%;" name="alasanAdmin"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
					<button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-right"></i> Proses</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('.modal').appendTo("body");
	$(document).ready(function() {
		pengajuanPinjaman();
		countPengajuanPeminjaman();
		pemberitahuanVoucher()
		countPemberitahuanVoucher()
		// bsCustomFileInput.init();
	});

	// function detail(id) {
	// 	$.ajax({
	// 		url: '<?= base_url('get-detail-voucher-admin') ?>',
	// 		type: 'post',
	// 		data: {
	// 			id: id
	// 		},
	// 		success: function(data) {
	// 			$('#isiDetail').html(data);
	// 			$('#modalDetail').modal('show');
	// 		}
	// 	})
	// }

	function adminSetuju(id) {
		Swal.fire({
			title: 'Apakah anda yakin ingin menyetujui voucher ini?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Yakin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('admin-setuju-voucher-admin') ?>',
					type: 'post',
					data: {
						id: id
					},
					dataType: "JSON",
					success: function(data) {
						if (data.res == 'success') {
							Swal.fire(
								data.message,
								'',
								'success'
							)
							$('#modalDetail').modal('hide');
							pemberitahuanVoucher()
							countPemberitahuanVoucher()
						} else if (data.res == 'error') {
							Swal.fire(
								data.message,
								'',
								'warning'
							);
						}
					}
				})
			}
		})
	}



	function adminTolak(id) {
		$('#idTolak').val(id);
		$('#modalDetail').modal('hide');
		$('#modalAdminTolak').modal('show');
	}

	$('#formTolakAdmin').submit(function(e) {
		e.preventDefault();
		var fd = new FormData();
		var alasanAdmin = $('#alasan_admin').val();
		if (alasanAdmin == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Alasan Tidak Boleh Kosong',
				'warning'
			);
		} else {
			Swal.fire({
				title: 'Apakah anda yakin ingin menolak voucher ini?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Yakin',
				cancelButtonText: 'Batalkan'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url('admin-tolak-voucher-admin') ?>',
						type: 'post',
						data: $(this).serialize(),
						dataType: 'json',
						success: function(data) {
							if (data.res == 'success') {
								Swal.fire(
									data.message,
									'',
									'success'
								)
								pemberitahuanVoucher()
								countPemberitahuanVoucher()
								$('#modalAdminTolak').modal('hide');
								$('#modalDetail').modal('hide');
							} else if (data.res == 'error') {
								Swal.fire(
									data.message,
									'',
									'warning'
								);
							}
						}
					});
				}
			})

		}
	})

	function pengajuanPinjaman() {
		$.ajax({
			url: `<?= base_url('peminjaman-pemberitahuan') ?>`,
			type: 'get',
			success: function(data) {
				$('#pemberitahuan-peminjaman').html(data)
				$('.pinjaman-pegawai').mask('000.000.000.000.000', {
					reverse: true
				});
			}
		})
	}

	function countPengajuanPeminjaman() {
		$.ajax({
			url: `<?= base_url('peminjaman-pemberitahuan-count') ?>`,
			type: 'get',
			success: function(data) {
				$('#count-pemberitahuan-pinjaman').html(data)
			}
		})
	}

	function pemberitahuanVoucher() {
		$.ajax({
			url: `<?= base_url('voucher-pemberitahuan') ?>`,
			type: 'get',
			success: function(data) {
				$('#pemberitahuan-voucher').html(data)
			}
		})
	}

	function countPemberitahuanVoucher() {
		$.ajax({
			url: `<?= base_url('voucher-pemberitahuan-count') ?>`,
			type: 'get',
			success: function(data) {
				$('#count-pemberitahuan-voucher').html(data)
			}
		})
	}

	$(document).on('click', '.detail-pemberitahuan', function(e) {
		var id = $(this).attr('id')
		$.ajax({
			url: `<?= base_url('peminjaman-pemberitahuan-detail') ?>`,
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#detail-pemberitahuan').html(data)
				$('#modal-tolak-peminjaman').modal('hide')
				$('#modal-peminjaman-pemberitahuan').appendTo('body')
				$('#modal-peminjaman-pemberitahuan').modal('show')


				$('#det-total-pinjaman').mask('000.000.000.000.000', {
					reverse: true
				});
				$('#det-pembayaran-perbulan').mask('000.000.000.000.000', {
					reverse: true
				});
			}
		})
	})

	$(document).on('click', '.detail-pemberitahuan-voucher', function(e) {
		var id = $(this).attr('id')
		$.ajax({
			url: '<?= base_url('get-detail-voucher-admin') ?>',
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#isiDetail').html(data);
				$('#modalDetail').modal('show');
			}
		})
	})


	$(document).on('click', '.btn-konfirmasi-pinjaman', function(e) {
		var id = $(this).attr('id')
		Swal.fire({
			title: 'Apakah anda menyetujui pinjaman?',
			icon: 'question',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: `Ya, Menyetujui`,
			denyButtonText: `Tidak Menyetujui`,
			cancelButtonText: `Batalkan konfirmasi`,
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'post',
					url: `<?= base_url('peminjaman-setuju') ?>`,
					data: {
						id: id
					},
					dataType: 'json',
					success: function(response) {
						if (response.res == 'success') {
							Swal.fire({
								icon: 'success',
								title: response.message,
								showConfirmButton: false,
								timer: 3000
							})
							$('#modal-peminjaman-pemberitahuan').modal('hide')
							pengajuanPinjaman();
							countPengajuanPeminjaman();
						} else {
							Swal.fire({
								icon: 'error',
								title: response.message,
							})
						}
					}
				})
			} else if (result.isDenied) {
				$('#modal-peminjaman-pemberitahuan').modal('hide')
				$('#modal-tolak-peminjaman').modal('show');
				$('#modal-tolak-peminjaman').appendTo('body')
				$('#id-catatan').val(id)
			}
		})
	})

	$('.btn-btl-tolak').click(function() {
		$('#modal-tolak-peminjaman').modal('hide');
		$('#modal-peminjaman-pemberitahuan').modal('show')

	})

	$('#btn-tolak-pinjaman').click(function() {
		id = $('#id-catatan').val()
		catatan = $('#catatan').val()
		if (catatan == '') {
			Swal.fire({
				icon: 'error',
				title: 'Alasan tidak menyetujui harus diisi',
			})
		} else {
			$.ajax({
				type: 'post',
				url: `<?= base_url('peminjaman-ditolak') ?>`,
				data: {
					id: id,
					catatan: catatan
				},
				dataType: 'json',
				success: function(response) {
					if (response.res == 'success') {
						Swal.fire({
							icon: 'success',
							title: response.message,
							showConfirmButton: false,
							timer: 3000
						})
						$('#modal-tolak-peminjaman').modal('hide');
						pengajuanPinjaman();
						countPengajuanPeminjaman();
					} else {
						Swal.fire({
							icon: 'error',
							title: response.message,
						})
					}
				}

			})
		}
	})
</script>
