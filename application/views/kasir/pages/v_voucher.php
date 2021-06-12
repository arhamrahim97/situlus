<div class="row">
	<div class="col-lg-12">
		<form action="<?= base_url('proses-voucher-kasir') ?>" id="formSubmitVoucher" method="POST" hidden>
			<input type="text" id="kodeVoucher" class="col-lg-12" name="kodeVoucher">
		</form>
	</div>
	<div class="col-lg-12 col-sm-12 mx-auto">
		<div class="row" id="data-voucher">
			<div class="col">
				<div class="card">
					<div class="card-header">

						<h4>Data Riwayat Voucher Belanja</h4>
						<div class="card-header-action">
							<div class="input-group-btn">
								<button class="btn btn-primary" id="btnQrcode" data-target="#modalQrcode" data-toggle="modal"><i class="fas fa-qrcode"></i> Scan Barcode</button>
							</div>
						</div>


					</div>
					<div class="form-row mt-2 mb-0 px-3">
						<div class="form-group col-lg-12 col-md-12 mb-2">
							<label for="inputEmail4">Status Bayar Rekanan :</label>
							<select class="form-control" id="statusBayarRekanan" onchange="refreshTable()">
								<option value="">Semua</option>
								<option value="belum">Belum Bayar</option>
								<option value="sudah">Sudah Bayar</option>
							</select>
						</div>
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
					<div class="card-body py-3 px-2">
						<div class="table-reponsive">
							<table class="table table-sm table-striped" id="table1">
								<thead>
									<tr class="text-center">
										<th>Kode Voucher</th>
										<th>Nama Pegawai</th>
										<th>Tanggal Konfirmasi Admin</th>
										<th>Tanggal Konfirmasi Kasir</th>
										<th>Total Biaya Struk</th>
										<th>Status Bayar Rekanan</th>
										<th>Detail</th>
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
<div class="modal fade" id="modalQrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Scan Barcode</h5>
				<button type="button" class="close closeModalQrcode" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col text-center">
						<div id="reader">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger closeModalQrcode" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
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

<div class="modal fade" id="strukBelanja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Struk Belanja</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<img class="img-fluid" src="" alt="" id="imgStruk">
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/stisla/js/') ?>html5-qrcode.min.js"></script>
<script src=" <?= base_url('assets/stisla/js/accounting.min.js') ?>"></script>

<script>
	$('.modal').appendTo("body");
	$(document).ready(function() {
		// dataVoucher()
		$("#table1").DataTable({
			"autoWidth": false,
// 			responsive: true,
			ajax: {
				url: `<?= base_url('get-voucher-kasir') ?>`,
				data: function(d) {
					d.statusBayarRekanan = $('#statusBayarRekanan').val();
				},
				dataSrc: '',
				type: 'post',
			},

			order: [
				[0, "desc"]
			],
			"scrollX": true,
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
					className: 'text-center'
				},
				{
					data: 'nama',
					className: 'text-center'
				},
				{
					data: 'tgl_konfirmasi_admin',
					render: function(data, type, row, meta) {
						var locale = 'id';
						return moment(data).locale(locale).format('DD-MM-YYYY');
					},
					className: 'text-center'
				},
				{
					data: 'tgl_konfirmasi_kasir',
					render: function(data, type, row, meta) {
						var locale = 'id';
						return moment(data).locale(locale).format('DD-MM-YYYY');
					},
					className: 'text-center'
				},
				{
					data: 'total_belanja_kasir',
					className: 'text-center',
					render: function(data) {
						return 'Rp. ' + accounting.formatNumber(data, 0, ".", ".");
					}
				},
				{
					data: 'status_bayar_rekanan',
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

	function dataVoucher() {
		$.ajax({
			type: 'get',
			url: `<?= base_url('get-voucher-kasir') ?>`,
			dataType: 'json',
			success: function(response) {
				$('#tabel1').DataTable({
					data: response,
					order: [
						[0, "desc"]
					],
					columns: [{
							data: "id",
							className: 'text-center',
							width: '15%'
						},


					]
				})
			}

		})
	}

	function refreshTable() {
		var table = $("#table1").DataTable();
		table.ajax.reload();
	}

	function detail(id) {
		$.ajax({
			url: '<?= base_url('get-detail-voucher-kasir') ?>',
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

	$('#btnQrcode').click(function() {
		html5QrcodeScanner.render(onScanSuccess);
	})

	$('.closeModalQrcode').click(function() {
		html5QrcodeScanner.clear();
	})

	function lihatStruk(id) {
		$.ajax({
			url: '<?= base_url('get-voucher-id') ?>',
			type: 'post',
			dataType: 'json',
			data: {
				id: id
			},
			success: function(data) {
				$("#imgStruk").attr("src", "<?= base_url('uploads/img/fotoStruk/') ?>" + data.struk);
				$('#strukBelanja').modal('show');
			}
		})

	}

	function prosesBayarRekanan(id) {
		Swal.fire({
			title: 'Apakah anda yakin ingin memproses bayar rekanan ini ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Yakin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('proses-bayar-rekanan') ?>',
					type: 'post',
					dataType: 'json',
					data: {
						id: id
					},
					success: function(data) {
						if (data.res == "success") {
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: data.message,
								showConfirmButton: false,
								timer: 1500
							})
							refreshTable();
							$('#modalDetail').modal('hide');
							window.location = "<?= base_url('dashboard-kasir') ?>";
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
</script>

<script>
	function onScanSuccess(qrCodeMessage) {
		html5QrcodeScanner.clear();
		$('#kodeVoucher').val(qrCodeMessage);
		$('#modalQrcode').modal('hide');
		$("#formSubmitVoucher").submit();
	}

	var html5QrcodeScanner = new Html5QrcodeScanner(
		"reader", {
			fps: 10,
			qrbox: 250
		});
</script>