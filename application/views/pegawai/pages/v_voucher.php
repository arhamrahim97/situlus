<div class="row">
	<div class="col-lg-5 col-sm-12 pr-1">
		<div class="card">
			<div class="card-header">
				<h4>Syarat dan Ketentuan Voucher</h4>
			</div>
			<div class="card-body py-1">
				<ul class="list-group list-group-flush">
					<?php foreach ($skVoucher as $sk) : ?>
						<li class="list-group-item px-2">
							<table>
								<tr>
									<td class="pr-4"><?= $sk->nomor ?>.</td>
									<td><?= $sk->isi ?></td>
								</tr>
							</table>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>

	</div>
	<div class="col-lg-7 col-sm-12">
		<div class="row">
			<div class="col">
				<div id="pemberitahuan-konfirmasi">

				</div>
			</div>
		</div>
		<div class="row" id="data-voucher">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<h4>Data Voucher Belanja</h4>
						<div class="card-header-action">
							<div class="input-group-btn">
								<a class="btn btn-primary" href="#" id="btn-ajukan-voucher"><i class="fas fa-shopping-cart"></i> Ajukan voucher belanja</a>
							</div>
						</div>
					</div>
					<div class="card-body py-3 px-2">
						<div class="table-reponsive">
							<table class="table table-sm table-striped" id="table">
								<thead>
									<tr class="text-center">
										<th>ID Voucher</th>
										<th>Digunakan</th>
										<th>Dibayar</th>
										<th>Barcode Voucher</th>
										<th>Detail</th>
										<!-- <th>Tanggal Pengusulan</th>
										<th>Konfirmasi Admin</th>
										<th>Tanggal Konfirmasi Admin</th>
										<th>Kadaluarsa</th>
										<th>Tanggal Konfirmasi Kasir</th>
										<th>Tanggal Pembayaran</th> -->
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

<!-- Modal Barcode Voucher-->
<div class="modal fade" id="modal-qrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Barcode</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col text-center">
						<img src="" alt="" id="imgQrcode" class="img-responsive">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
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

<form action="<?= base_url('detail-pembayaran-pegawai') ?>" hidden method="POST" id="detailPembayaran">
	<input type="text" id="idDetailPembayaran" name="id">
</form>

<form action="<?= base_url('cetak-voucher-pegawai') ?>" hidden method="POST" target="_blank" id="cetakVoucher">
	<input type="text" id="idCetak" name="id">
</form>

<script>
	$('.modal').appendTo("body");

	function pemberitahuanKonfirmasi() {
		$.ajax({
			url: `<?= base_url('pemberitahuan-konfirmasi-voucher') ?>`,
			type: 'get',
			success: function(data) {
				$('#pemberitahuan-konfirmasi').html(data)
				// $('.nominal-pinjaman-ditolak').mask('000.000.000.000.000', {
				// 	reverse: true
				// });
			}
		})
	}

	$(document).ready(function() {
		pemberitahuanKonfirmasi()

		$("#table").DataTable({
			"autoWidth": false,
			ajax: {
				url: '<?php echo base_url('get-voucher') ?>',
				dataSrc: ''
			},
			"order": [
				[0, "desc"]
			],
			columns: [{
					data: 'id',
					className: 'text-center'
				},
				{
					data: 'konfirmasi_kasir',
					render: function(data) {
						if (data == 0) {
							return '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Belum digunakan"><i class="fas fa-times"></i></div>';
						} else if (data == 1) {
							return '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Sudah digunakan"><i class="fas fa-check"></i></div>';
						} else if (data == 2) {
							return '<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Voucher ditolak"><i class="fas fa-minus-circle"></i></div>';
						}
					},
					className: 'text-center'
				},
				{
					data: 'konfirmasi_pembayaran',
					render: function(data) {
						if (data == 0) {
							return '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Belum digunakan"><i class="fas fa-times"></i></div>';
						} else if (data == 1) {
							return '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Sudah dibayar"><i class="fas fa-check"></i></div>';
						} else if (data == 2) {
							return '<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Voucher ditolak"><i class="fas fa-minus-circle"></i></div>';
						}
					},
					className: 'text-center'
				},
				{
					data: 'id',
					render: function(data, type, row, meta) {
						if (row.barcode) {
							return '<button class="btn btn-sm btn-primary btn-qrcode" onclick="barcode(' + "'" + data + "'" + ')"><i class="fas fa-qrcode"></i></button>'
						} else {
							return '-'
						}

					},
					className: 'text-center'
				},
				{
					data: 'id',
					render: function(data, type, row, meta) {
						return '<button class="btn btn-sm btn-primary detail-voucher" onclick="detail(' + "'" + data + "'" + ')"><i class="fas fa-info-circle"></i></button>'
					},
					className: 'text-center'
				}
			]
		})
	})

	$(document).on('click', '.hapus-pemberitahuan', function(e) {
		var id = $(this).attr('id')
		$.ajax({
			type: 'post',
			url: `<?= base_url('voucher-hapus-pemberitahuan') ?>`,
			data: {
				id: id
			},
			dataType: 'json',
			success: function(response) {
				if (response.res == 'success') {
					// pemberitahuanDitolak()
				} else {
					Swal.fire({
						icon: 'error',
						title: response.message,
					})
				}
			}

		})
	})

	function detail(id) {
		$.ajax({
			url: '<?= base_url('get-detail-isi-voucher') ?>',
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
	// Konfirmasi ajukan voucher
	$('#btn-ajukan-voucher').click(function() {
		Swal.fire({
			title: 'Apakah anda yakin ingin mengajukan voucher ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Yakin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'post',
					url: `<?= base_url('ajukan-voucher') ?>`,
					dataType: 'json',
					success: function(response) {
						if (response.res == 'success') {
							Swal.fire({
								icon: 'success',
								title: 'Sukses',
								text: response.message
							}).then((result) => {
								window.location.reload();
							})
							// refreshTable();
						} else if (response.res == 'error') {
							Swal.fire({
								icon: 'error',
								title: 'Gagal',
								text: response.message
							})
						} else if (response.res == 'proses') {
							Swal.fire({
								icon: 'error',
								title: 'Gagal',
								text: response.message
							})
						}
					}

				})
			}
		})
	})

	// Lihat qr-code
	$('.btn-qrcode').click(function() {
		$('#modal-qrcode').appendTo("body")
		$('#modal-qrcode').modal('show')
	})

	function barcode(id) {
		$.ajax({
			url: '<?= base_url('get-detail-voucher') ?>',
			type: 'post',
			data: {
				id: id
			},
			dataType: "JSON",
			success: function(data) {
				$("#imgQrcode").attr("src", "<?= base_url('/uploads/img/qrCode/') ?>" + data.barcode);
				$('#modal-qrcode').modal('show');
			}
		})
	}

	function refreshTable() {
		var table = $("#table").DataTable();
		table.ajax.reload();
	}

	function cetakVoucher(id) {
		$('#idCetak').val(id);
		$('#cetakVoucher').submit();
	}

	function detailPembayaran(id) {
		$('#idDetailPembayaran').val(id);
		$('#detailPembayaran').submit();
	}
</script>
