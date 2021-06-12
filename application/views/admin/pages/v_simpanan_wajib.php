<div class="row">
	<div class="col-lg-7 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Simpanan Wajib Perbulan</h4>
			</div>
			<div class="card-header-action">
			</div>
			<div class="form-row mt-2 mb-0 px-3">
				<div class="form-group col-lg-4 col-md-12 mb-2">
					<label for="inputEmail4">Tagihan :</label>
					<select class="form-control select2" id="tagihan" onchange="refreshTable()">
						<option value="">Semua</option>
						<?php foreach ($simpananWajib as $row) : ?>
							<option value="<?= $row->created_at ?>"><?= strftime("%B %Y", strtotime($row->created_at)) ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group col-lg-4 col-md-12 mb-2">
					<label for="inputEmail4">Nama Pegawai :</label>
					<select class="form-control select2" id="namaPegawai" onchange="refreshTable()">
						<option value="">Semua</option>
						<?php foreach ($pegawai as $row) : ?>
							<option value="<?= $row->nama ?>"><?= $row->nama ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group col-lg-4 col-md-12 mb-2">
					<label for="inputEmail4">Status Bayar :</label>
					<select class="form-control" id="statusBayar" onchange="refreshTable()">
						<option value="">Semua</option>
						<option value="3">Belum Bayar</option>
						<option value="1">Sudah Bayar</option>
					</select>
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div class="table-reponsive">
					<table class="table table-sm table-striped" id="table">
						<thead>
							<tr class="text-center">
								<!-- <th>created_at</th> -->
								<th>No</th>
								<th>Tagihan</th>
								<th>Nama Pegawai</th>
								<th>Total Bayar</th>
								<th>Status Bayar</th>
								<th>Tanggal Bayar</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-5 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Total Simpanan Wajib Tiap Pegawai</h4>
				<div class="card-header-action">
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div class="table-reponsive">
					<table class="table table-sm table-striped" id="table2">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Nama Pegawai</th>
								<th>Total Simpanan Wajib</th>
								<th>Aksi</th>
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

<div class="modal fade" id="modalDetail" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Simpanan Wajib</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="kontenDetail">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalDetailTotalSimpananWajib" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="max-width: 700px !important;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Total Simpanan Wajib</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="" id="kontenDetailTotalSimpnanWajib">
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalCairkanDana" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Nominal Pencairan</h5>
				<button type="button" class="close btl-cairkan" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="">
					<div class="col-12 px-0 mb-3">
						<label>Masukkan Nominal Pencairan:</label>
						<input type="text" class="form-control d-none" id="id-nominal-pencairan">
						<input type="text" class="form-control d-none" id="id-pegawai-nominal-pencairan">
						<input type="text" class="form-control " id="nominal-pencairan">
						<small><i>* Nominal yang dimasukkan tidak boleh melebihi dari total simpanan</i></small>
					</div>
					<button type="button" class="btn btn-sm btn-primary btn-cairkan d-inline" id="btn-cairkan" style="float: right;"><i class="fas fa-arrow-circle-right"></i> Proses</button>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger btl-cairkan" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
			</div>
		</div>
	</div>
</div>


<script>
	$('.modal').appendTo("body");

	function refreshTable() {
		var table = $("#table").DataTable();
		var table2 = $("#table2").DataTable();
		table.ajax.reload();
		table2.ajax.reload();
	}
</script>

<script>
	$(document).ready(function() {
		$("#table").DataTable({
			"autoWidth": false,
			ajax: {
				url: '<?php echo base_url('get-simpanan-wajib-admin') ?>',
				data: function(d) {
					d.tagihan = $('#tagihan').val();
					d.namaPegawai = $('#namaPegawai').val();
					d.statusBayar = $('#statusBayar').val();
				},
				dataSrc: '',
				type: 'post',
			},
			"processing": true, //Feature control the processing indicator.
			"deferRender": true,
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
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
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					},
					className: 'text-center'
				},

				{
					data: 'created_at',
					render: function(data, type, row, meta) {
						var locale = 'id';
						return moment(data).locale(locale).format('MMMM YYYY');
					},
					className: 'text-center'
				},
				{
					data: 'nama',
					className: 'text-center'
				},
				{
					data: 'total_simpanan_wajib',
					render: $.fn.dataTable.render.number('.'),
					className: 'text-center'
				},
				{
					data: 'status',
					render: function(data, type, row, meta) {
						if (data == 0) {
							return `<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak">Belum Bayar</div>`
						} else if (data == 1) {
							return `<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Ditolak">Sudah Bayar</div>`
						}
					},
					className: 'text-center'
				},
				{
					data: 'tgl_konfirmasi_admin',
					render: function(data, type, row, meta) {
						if (data == null) {
							return '-';
						} else {
							return moment(data).format('DD-MM-YYYY');
						}
					},
					className: 'text-center'
				},
				{
					data: 'id',
					render: function(data, type, row, meta) {
						return '<button class="btn btn-info btn-sm" onclick="detail(' + data + ')">' + 'Proses' + '</button>';
					},
					className: 'text-center'
				}
			]
		})

		$("#table2").DataTable({
			"autoWidth": false,
			ajax: {
				url: '<?php echo base_url('get-simpanan-wajib-total-admin') ?>',
				dataSrc: ''
			},
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
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					},
					className: 'text-center'
				},
				{
					data: 'nama',
					className: 'text-center'
				},
				{
					data: 'total_simpanan',
					render: $.fn.dataTable.render.number('.'),
					className: 'text-center'
				},
				{
					data: 'id',
					render: function(data, type, row, meta) {
						return '<button class="btn btn-info btn-sm" id="detailTotalSimpananWajib" onclick="detailTotalSimpananWajib(' + data + ')">' + 'Proses' + '</button>';
					},
					className: 'text-center'
				}
			]
		})
	})

	$('.btl-cairkan').click(function() {
		$('#modalDetailTotalSimpananWajib').modal('show')
		$('#modalCairkanDana').modal('hide')
	})

	$('#btn-cairkan').click(function() {
		$('#nominal-pencairan').unmask()
		var id2 = $('#id-nominal-pencairan').val()
		var id3 = parseFloat(id2) + 1
		var nominal = $('#nominal-pencairan').val()
		if (nominal == '') {
			Swal.fire({
				icon: 'error',
				title: 'Terjadi Kesalahan',
				text: 'Nominal pencairan tidak boleh dikosongkan',
			})
			$('#nominal-pencairan').mask('000.000.000.000.000', {
				reverse: true
			});
		} else {
			Swal.fire({
				// title: '',
				text: "Apakah anda yakin ingin melakukan pencairan dana simpanan?",
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
						url: `<?= base_url('proses-pencairan') ?>`,
						data: {
							id: id2,
							nominal: nominal
						},
						dataType: 'json',
						success: function(response) {
							if (response.res == 'success') {
								Swal.fire({
									icon: 'success',
									title: 'Berhasil',
									text: response.message,
									showConfirmButton: false,
									timer: 3000
								})
								refreshTable()
								$('#nominal-pencairan').val('')
								$('#modalCairkanDana').modal('hide')

							} else {
								Swal.fire({
									icon: 'error',
									title: 'Terjadi Kesalahan',
									text: response.message,
								})
								$('#nominal-pencairan').mask('000.000.000.000.000', {
									reverse: true
								});
							}
						}
					})
				} else {
					$('#nominal-pencairan').mask('000.000.000.000.000', {
						reverse: true
					});
				}
			})
		}




	})
</script>

<script>
	function detail(id) {
		$.ajax({
			url: '<?= base_url('get-detail-simpanan-wajib-admin') ?>',
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#kontenDetail').html(data);
				$('#modalDetail').modal('show');
			}
		})
	}

	function detailTotalSimpananWajib(id) {
		$.ajax({
			url: '<?= base_url('get-detail-simpanan-wajib-total-admin') ?>',
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#kontenDetailTotalSimpnanWajib').html(data)
				$('#modalDetailTotalSimpananWajib').modal('show')

				$("#table3").DataTable({
					"paging": false,
					"order": [
						[0, "desc"]
					],
					dom: 'lBfrtip',
					buttons: [{
						extend: 'excel',
						className: 'btn btn-sm btn-primary mt-1 mb-2 btn-export-table d-inline',
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
				});
			}
		})

	}

	function bayar(id) {
		Swal.fire({
			title: 'Anda yakin ingin mengkonfirmasi pembayaran ini ? ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Yakin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('proses-simpanan-wajib') ?>',
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
							);
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

	function modalCairkanDana(id) {
		$('#id-nominal-pencairan').val(id)
		$('#modalDetailTotalSimpananWajib').modal('hide')
		$('#nominal-pencairan').mask('000.000.000.000.000', {
			reverse: true
		});
		$('#modalCairkanDana').modal('show')
	}
</script>
