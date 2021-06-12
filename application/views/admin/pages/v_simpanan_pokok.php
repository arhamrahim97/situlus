<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Simpanan Pokok</h4>
			</div>
			<div class="form-row mt-2 mb-0 px-3">
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
					<label for="inputEmail4">Status Simpanan :</label>
					<select class="form-control" id="statusSimpanan" onchange="refreshTable()">
						<option value="">Semua</option>
						<option value="1">Sudah Bayar</option>
						<option value="2">Dana Sudah Dicairkan</option>
					</select>
				</div>
				<div class="form-group col-lg-4 col-md-12 mb-2">
					<label for="inputEmail4">Status Akun :</label>
					<select class="form-control" id="statusAkun" onchange="refreshTable()">
						<option value="">Semua</option>
						<option value="1">Aktif</option>
						<option value="2">Tidak Aktif</option>
					</select>
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div class="table-reponsive">
					<table class="table table-sm table-striped" id="table">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Nama Pegawai</th>
								<th>Total Simpanan</th>
								<th>Status Simpanan</th>
								<th>Status Akun</th>
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
</div>

<div class="modal fade" id="modalDetail" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Simpanan Pokok</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="kontenDetail">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<script>
	$('.modal').appendTo("body");

	function refreshTable() {
		var table = $("#table").DataTable();
		table.ajax.reload();
	}
</script>

<script>
	$(document).ready(function() {
		$("#table").DataTable({
			"autoWidth": false,
			ajax: {
				url: '<?php echo base_url('get-simpanan-pokok-admin') ?>',
				data: function(d) {
					d.namaPegawai = $('#namaPegawai').val();
					d.statusSimpanan = $('#statusSimpanan').val();
					d.statusAkun = $('#statusAkun').val();
				},
				dataSrc: '',
				type: 'post',

			},
			"scrollX": true,
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
					data: 'nama',
					className: 'text-center'
				},
				{
					data: 'total_simpanan_pokok',
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
						} else if (data == 2) {
							return `<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Ditolak">Dana Sudah Dicairkan</div>`
						}
					},
					className: 'text-center'
				},
				{
					data: 'status_akun',
					render: function(data, type, row, meta) {
						if (data == 1) {
							return `<div class="badge badge-success" data-toggle="tooltip" data-placement="left">Aktif</div>`
						} else if (data == 2) {
							return `<div class="badge badge-danger" data-toggle="tooltip" data-placement="left">Tidak Aktif</div>`
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
	})
</script>

<script>
	function detail(id) {
		$.ajax({
			url: '<?= base_url('get-detail-simpanan-pokok-admin') ?>',
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

	function bayar(id) {
		Swal.fire({
			title: 'Anda yakin ingin mengkonfirmasi pembayaran ini ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Yakin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('proses-simpanan-pokok') ?>',
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

	function cairkan(id) {
		Swal.fire({
			title: 'Anda yakin ingin mencairkan dana pinjaman ini ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Yakin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('proses-simpanan-pokok-cairkan') ?>',
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
</script>
