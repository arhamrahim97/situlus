<div class="row">
	<div class="col-lg-12 col-sm-12 pr-1">
		<div class="card">
			<div class="card-header">
				<h4>Pengajuan Peminjaman</h4>
				<div class="card-header-action">
					<div class="input-group-btn" id="count-pemberitahuan">

					</div>
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div id="pemberitahuan">
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-sm-12 mx-auto">
		<div class="row" id="data-peminjaman">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<h4>Data Peminjaman</h4>
					</div>
					<div class="form-row mt-2 mb-0 px-3">
						<div class="form-group col-lg-4 col-md-12 mb-2">
							<label for="inputEmail4">Nama Pegawai :</label>
							<select class="form-control select2" id="namaPeminjam" onchange="refreshTable()">
								<option value="">Semua</option>
								<?php foreach ($pegawai as $row) : ?>
									<option value="<?= $row->nama ?>"><?= $row->nama ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-lg-4 col-md-12 mb-2">
							<label for="inputEmail4">Konfirmasi Admin :</label>
							<select class="form-control" id="konfirmasiAdmin" onchange="refreshTable()">
								<option value="">Semua</option>
								<option value="1">Disetujui</option>
								<option value="2">Ditolak</option>
							</select>
						</div>
						<div class="form-group col-lg-4 col-md-12 mb-2">
							<label for="inputEmail4">Status Pinjaman :</label>
							<select class="form-control" id="statusPeminjam" onchange="refreshTable()">
								<option value="">Semua</option>
								<option value="1">Sudah Lunas</option>
								<option value="2">Ditolak</option>
								<option value="3">Belum Lunas</option>
							</select>
						</div>
					</div>
					<!-- <input type="text" id="testing" onchange="refreshTable()"> -->
					<div class="card-body py-3 px-3">
						<div class="table-reponsive">
							<table class="table table-sm table-striped" id="admin-peminjaman-table">
								<thead>
									<tr class="text-center">
										<th>Aksi</th>
										<th>Kode Pinjaman</th>
										<th>Nama</th>
										<th>Konfirmasi</th>
										<th>Status</th>
										<th>Total Pinjaman</th>
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

<!-- Modal Detail Peminjaman -->
<div class="modal fade modal-peminjaman" id="modal-peminjaman" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header px-3">
				<h5 class="modal-title" id="exampleModalLongTitle">Detail Peminjaman</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-3">
				<div class="row">
					<div class="col">
						<div class="div" id="detail">

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
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
							<button style="float: right;" class="btn btn-sm btn-danger mt-3 mr-2" id="btn-btl-tolak" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<script>
	$('.modal').appendTo("body");

	$(document).ready(function() {
		$('#admin-peminjaman-table').DataTable({
			ajax: {
				url: `<?= base_url('peminjaman-data-admin') ?>`,
				data: function(d) {
					d.namaPeminjam = $('#namaPeminjam').val();
					d.konfirmasiAdmin = $('#konfirmasiAdmin').val();
					d.statusPeminjam = $('#statusPeminjam').val();
				},
				dataSrc: '',
				type: 'post',
			},
			// data: response,
			"processing": true, //Feature control the processing indicator.
			"deferRender": true,
			"autoWidth": false,

			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
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
			columnDefs: [{
				targets: 6,
				render: function(data) {
					return moment(data).format('DD-MM-YYYY');
				}
			}],
			columns: [{
					data: 'id',
					render: function(data, type, row, meta) {
						return '<button class="btn btn-sm btn-primary detailpinjaman" id=' + data + '><i class="fas fa-info-circle"></i></button>';
					},
					className: 'text-center'
				},
				{
					data: "id",
					className: 'text-center',
					width: '15%',
				},
				{
					data: "nama",
					className: 'text-center',
					width: '15%',
				},

				{
					data: function(row) {
						if (row.konfirmasi_admin == 2) {
							return `
									<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Ditolak">Ditolak</div>`
						} else if (row.konfirmasi_admin == 1) {
							return `
									<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Disetujui">Disetujui</div>`
						}
					},
					className: 'text-center'
				},
				{
					data: function(row) {
						if ((row.konfirmasi_admin == 2) || (row.status_pinjaman == 2)) {
							return `
									<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Ditolak">Ditolak</div>`
						} else if ((row.status_pinjaman == 0)) {
							return `
									<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Belum Lunas">Belum Lunas</div>`
						} else if (row.status_pinjaman == 1) {
							return `
									<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Sudah Lunas">Sudah Lunas</div>`
						}

					},
					className: 'text-center'
				},
				{
					data: "total_pinjaman",
					className: 'text-center',
					render: $.fn.dataTable.render.number('.')

				},
				{
					data: "tgl_pengusulan",
					className: 'text-center',
					width: '15%',
				},

			],
		})



	})

	function refreshTable() {
		var table = $("#admin-peminjaman-table").DataTable();
		table.ajax.reload();
	}

	$(document).ready(function() {
		pemberitahuan();
		countPemberitahuan();
		bsCustomFileInput.init();
	});

	function pemberitahuan() {
		$.ajax({
			url: `<?= base_url('peminjaman-pemberitahuan') ?>`,
			type: 'get',
			success: function(data) {
				$('#pemberitahuan').html(data)
				$('.pinjaman-pegawai').mask('000.000.000.000.000', {
					reverse: true
				});
			}
		})
	}

	function countPemberitahuan() {
		$.ajax({
			url: `<?= base_url('peminjaman-pemberitahuan-count') ?>`,
			type: 'get',
			success: function(data) {
				$('#count-pemberitahuan').html(data)
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

	$('#modal-tolak-peminjaman').on('shown.bs.modal', function() {
		$('#catatan').focus();

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
							refreshTable()
							pemberitahuan()
							countPemberitahuan()
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


	$('#btn-btl-tolak').click(function() {
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
						refreshTable()
						pemberitahuan()
						countPemberitahuan()
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

	function detailPeminjamanAdmin(id) {
		$.ajax({
			url: `<?= base_url('peminjaman-detail-admin') ?>`,
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#detail').html(data)
				$('#modal-peminjaman').modal('show')
				$('#modal-peminjaman').appendTo('body')
				$("#table2").DataTable({
				    "autoWidth": false,
					"paging": false,
					"order": [
						[0, "asc"]
					],
					"columnDefs": [{
						"targets": [0],
						"visible": false
					}],
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

				$('#det-total-pinjaman').mask('000.000.000.000.000', {
					reverse: true
				});
				$('#det-pembayaran-perbulan').mask('000.000.000.000.000', {
					reverse: true
				});
			}
		})
	}

	$(document).on('click', '.detailpinjaman', function(e) {
		var id = $(this).attr('id')
		detailPeminjamanAdmin(id);
	})

	$(document).on('click', '.btn-tenor-pinjaman', function(e) {
		var id = $(this).attr('id')
		Swal.fire({
			title: 'Konfirmasi sudah dibayar?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: `Ya`,
			cancelButtonText: `Batal`,
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'post',
					url: `<?= base_url('peminjaman-bayar-tenor') ?>`,
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
								timer: 2000
							})
							detailPeminjamanAdmin(response.id_pinjaman);
							refreshTable()
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

	})
</script>
