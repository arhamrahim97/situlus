<div class="row">
	<div class="col-lg-12 col-sm-12 pr-1">
		<div class="card">
			<div class="card-header">
				<h4>Pengajuan Voucher</h4>
				<div class="card-header-action">
					<div class="input-group-btn" id="count-pemberitahuan">
						<span class="badge badge-danger shadow-sm"><?= $jumlahPengajuan ?></span>
					</div>
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div id="pemberitahuan">
					<?php if ($getPengajuan) : ?>
						<?php foreach ($getPengajuan as $pengajuan) : ?>
							<div class="alert alert-light shadow-sm px-3">
								<div class="alert-body">
									<div class="mr-auto" style="display: inline;">
										<p><?= $pengajuan->nama ?></p>
										<p class="pinjaman-pegawai" style="display: inline"><?= $pengajuan->id ?></p>
									</div>
									<div class="ml-auto" style="float: right;">
										<button class="btn btn-sm btn-primary detail-pemberitahuan" onclick="detail('<?= $pengajuan->id ?>')"><i class="fas fa-info-circle"></i></button>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<h6 class="text-center"> Belum ada pengajuan voucher</h6>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-sm-12 mx-auto">
		<div class="row" id="data-peminjaman">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<h4>Data Voucher</h4>
					</div>
					<div class="row px-5">
						<div class="col-lg-6 col-sm-12">
							<div class="card card-statistic-2 pt-4 px-0">
								<div class="card-stats">
									<div class="card-stats-items w-100">
										<div class="card-stats-item w-100">
											<h5>Jumlah Voucher Belum Bayar Ke Rekanan</h5>
										</div>
									</div>
								</div>
								<div class="card-wrap pt-1">
									<div class="card-header text-center">
										<h2><?= $jumlahBelumBayarRekanan ?></h2>
									</div>
									<div class="card-footer w-100 text-center">

									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-sm-12">
							<div class="card card-statistic-2 pt-4 px-0">
								<div class="card-stats">
									<div class="card-stats-items w-100">
										<div class="card-stats-item w-100">
											<h5>Total Biaya Belum Bayar Ke Rekanan</h5>
										</div>
									</div>
								</div>
								<div class="card-wrap pt-1">
									<div class="card-header text-center">
										<h2><?= "Rp. " . number_format($totalBelumBayar, 0, '', '.')  ?></h2>
									</div>
									<div class="card-footer w-100 text-center">

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-row mt-2 mb-0 px-3">
						<div class="form-group col-lg-3 col-md-12 mb-2">
							<label for="inputEmail4">Nama Pegawai :</label>
							<select class="form-control select2" id="namaPegawai" onchange="refreshTable()">
								<option value="">Semua</option>
								<?php foreach ($pegawai as $row) : ?>
									<option value="<?= $row->nama ?>"><?= $row->nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-lg-3 col-md-12 mb-2">
							<label for="inputEmail4">Status Digunakan :</label>
							<select class="form-control" id="statusDigunakan" onchange="refreshTable()">
								<option value="">Semua</option>
								<option value="1">Belum</option>
								<option value="2">Sudah</option>
								<option value="3">Ditolak</option>
							</select>
						</div>
						<div class="form-group col-lg-3 col-md-12 mb-2">
							<label for="inputEmail4">Status Bayar Anggota :</label>
							<select class="form-control" id="statusBayarAnggota" onchange="refreshTable()">
								<option value="">Semua</option>
								<option value="1">Belum</option>
								<option value="2">Sudah</option>
								<option value="3">Ditolak</option>
							</select>
						</div>
						<div class="form-group col-lg-3 col-md-12 mb-2">
							<label for="inputEmail4">Status Proses Voucher :</label>
							<select class="form-control" id="statusProsesVoucher" onchange="refreshTable()">
								<option value="">Semua</option>
								<option value="1">Voucher Kadaluarsa</option>
								<option value="2">Ditolak Admin</option>
								<option value="3">Menunggu Konfirmasi Admin</option>
								<option value="4">Menunggu Konfirmasi Kasir</option>
								<option value="5">Menunggu Konfirmasi Pembayaran</option>
								<option value="6">Belum Bayar Rekanan</option>
								<option value="7">Sudah Bayar Rekanan</option>
							</select>
						</div>
					</div>
					<div class="card-body py-3 px-3">
						<div class="table-reponsive">
							<table class="table table-sm table-striped" id="table">
								<thead>
									<tr class="text-center">
										<th>Aksi</th>
										<th>ID Voucher</th>
										<th>Nama</th>
										<th>Digunakan</th>
										<th>Status Bayar Anggota</th>
										<th>Status</th>
										<th>Total Belanja Struk</th>
										<th>Tanggal Pengajuan</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Button trigger modal -->

<!-- Modal -->
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
				<div class="modal-body" id="isiDetail">
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

<form action="<?= base_url('cetak-voucher-admin') ?>" hidden method="POST" target="_blank" id="cetakVoucher">
	<input type="text" id="idCetak" name="id">
</form>

<form action="<?= base_url('proses_pembayaran') ?>" hidden method="POST" id="prosesPembayaran">
	<input type="text" id="idPembayaran" name="id">
</form>

<form action="<?= base_url('detail-pembayaran') ?>" hidden method="POST" id="detailPembayaran">
	<input type="text" id="idDetailPembayaran" name="id">
</form>

<script>
	$('.modal').appendTo("body");


	function pemberitahuan() {
		$.ajax({
			url: `<?= base_url('voucher-pemberitahuan') ?>`,
			type: 'get',
			success: function(data) {
				$('#pemberitahuan').html(data)
				// $('.pinjaman-pegawai').mask('000.000.000.000.000', {
				// 	reverse: true
				// });
			}
		})
	}

	function countPemberitahuan() {
		$.ajax({
			url: `<?= base_url('voucher-pemberitahuan-count') ?>`,
			type: 'get',
			success: function(data) {
				$('#count-pemberitahuan').html(data)
			}
		})
	}


	$(document).ready(function() {
		$("#table").DataTable({
			"autoWidth": false,
			ajax: {
				url: '<?php echo base_url('get-voucher-admin') ?>',
				data: function(d) {
					d.statusProsesVoucher = $('#statusProsesVoucher').val();
					d.statusBayarAnggota = $('#statusBayarAnggota').val();
					d.statusDigunakan = $('#statusDigunakan').val();
					d.namaPegawai = $('#namaPegawai').val();
				},
				dataSrc: '',
				type: 'post',
			},
			"scrollX": true,
			order: [
				[1, "desc"]
			],
			dom: 'lBfrtip',
			buttons: [{
				extend: 'excel',
				className: 'btn btn-sm btn-primary mt-1 mb-2 btn-export-table d-inline ml-3',
				// text: '<br>',
				text: '<i class="fas fa-file-excel"></i> Export Excel',

				exportOptions: {
					modifier: {
						// DataTables core
						order: 'index', // 'current', 'applied', 'index',  'original'
						page: 'current', // 'all',     'current'
						search: 'none' // 'none',    'applied', 'removed'
					}
				}
			}],
			columns: [{
					data: 'id',
					className: 'text-center',
					render: function(data) {
						return '<button class="btn btn-sm btn-sm btn-primary detail-voucher" onclick="detail(' + "'" + data + "'" + ')"><i class="fas fa-info-circle"></i></button>'
					},
				}, {
					data: 'id',
					className: 'text-center'
				},
				{
					data: 'nama',
					className: 'text-center'
				},
				{
					data: 'konfirmasi_kasir',
					className: 'text-center',
					render: function(data) {
						if (data == 0) {
							return '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Belum digunakan"><i class="fas fa-times"></i> Belum</div>';
						} else if (data == 1) {
							return '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Sudah dibayar"><i class="fas fa-check"></i> Sudah</div>';
						} else if (data == 2) {
							return '<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Voucher ditolak"><i class="fas fa-minus-circle"></i> Ditolak</div>';
						}
					},
				},
				{
					data: 'konfirmasi_pembayaran',
					className: 'text-center',
					render: function(data) {
						if (data == 0) {
							return '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Belum digunakan"><i class="fas fa-times"></i> Belum</div>';
						} else if (data == 1) {
							return '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Sudah dibayar"><i class="fas fa-check"></i> Sudah</div>';
						} else if (data == 2) {
							return '<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Voucher ditolak"><i class="fas fa-minus-circle"></i> Ditolak</div>';
						}
					},
				},
				{
					data: 'status',
					className: 'text-center'
				},
				{
					data: 'total_struk',
					className: 'text-center'
				},
				{
					data: 'tanggal_pengajuan',
					className: 'text-center'
				},
			]
		})
	})


	function refreshTable() {
		var table = $("#table").DataTable();
		table.ajax.reload();
	}

	function detail(id) {
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
	}

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
							).then((result) => {
								window.location.reload();
							})
							$('#modalDetail').modal('hide');
							refreshTable();
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
								).then((result) => {
									window.location.reload();
								})
								$('#modalAdminTolak').modal('hide');
								$('#modalDetail').modal('hide');
								refreshTable();
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

	function cetakVoucher(id) {
		$('#idCetak').val(id);
		$('#cetakVoucher').submit();
	}

	function detailPembayaran(id) {
		$('#idDetailPembayaran').val(id);
		$('#detailPembayaran').submit();
	}

	function prosesPembayaran(id) {
		$('#idPembayaran').val(id);
		$('#prosesPembayaran').submit();
	}
</script>
