<div class="row">
	<div class="col-lg-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Master Barang</h4>
				<div class="card-header-action">
					<div class="input-group-btn">
						<button class="btn btn-primary" href="#card-form-peminjaman" id="btn-ajukan-peminjaman" data-target="#modalTambah" data-toggle="modal"><i class="fas fa-plus"></i> Tambah Master Barang</button>
					</div>
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div class="table-reponsive">
					<table class="table table-sm table-striped" id="table">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Nama Barang</th>
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

	<!-- Modal -->
	<div class="modal fade" id="modalTambah" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Master Barang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" id="formTambah">
					<div class="modal-body">
						<div class="form-group">
							<label>Nama Barang</label>
							<input type="text" class="form-control mt-2" id="nama_barang" placeholder="Masukkan Nama Barang" name="nama_barang">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
						<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-arrow-right"></i> Simpan</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ubah Master Barang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" id="formEdit">
					<div class="modal-body">
						<div class="form-group">
							<label>Nama Barang :</label>
							<input type="text" class="form-control mt-2" id="id" placeholder="Masukkan Grade" name="id" hidden>
							<input type="text" class="form-control mt-2" id="nama_barang_edit" placeholder="Masukkan Nama Barang" name="nama_barang">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
						<button type="submit" class="btn btn-primary"><i class="fas fa-arrow-right"></i> Simpan</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#table").DataTable({
			"autoWidth": false,
			ajax: {
				url: '<?php echo base_url('get-master-barang') ?>',
				dataSrc: ''
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
					data: 'nama_barang',
					className: 'text-center'
				},
				{
					data: 'id',
					render: function(data, type, row, meta) {
						// return '<button class="btn btn-info btn-sm" onclick="edit(' + data + ')">' + 'Edit' + '</button>  <button class="btn btn-danger btn-sm" onclick="hapus(' + data + ')">' + 'Hapus' + '</button>';
						return '<button class="btn btn-primary btn-sm" onclick="edit(' + data + ')"><i class="fas fa-edit"></i> ' + 'Ubah' + '</button>  <button class="btn btn-danger btn-sm" onclick="hapus(' + data + ')"><i class="fas fa-trash"></i> ' + 'Hapus' + '</button>';
					},
					className: 'text-center'
				}
			]
		})
	})
</script>

<script>
	$('.modal').appendTo("body");

	function hitung_limit_voucher() {
		$('#limit_voucher_edit').mask('000.000.000.000.000', {
			reverse: true
		});
		$('#limit_voucher').mask('000.000.000.000.000', {
			reverse: true
		});
	}

	function refreshTable() {
		var table = $("#table").DataTable();
		table.ajax.reload();
	}

	function edit(id) {
		$.ajax({
			url: '<?= base_url('get-detail-master-barang') ?>',
			type: 'post',
			data: {
				id: id
			},
			dataType: "JSON",
			success: function(data) {
				$('#nama_barang_edit').val(data.nama_barang);
				$('#id').val(id);
				$('#modalEdit').modal('show');
			}
		})
	}

	function hapus(id) {
		Swal.fire({
			title: 'Apakah anda yakin ingin menghapus barang ini ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Yakin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('hapus-master-barang') ?>',
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
							$('#modalEdit').modal('hide');
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

<script>
	$('#formTambah').submit(function(e) {
		e.preventDefault();
		var fd = new FormData();
		var nama_barang = $('#nama_barang').val();
		if (nama_barang == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Nama Barang Tidak Boleh Kosong',
				'warning'
			);
		} else {
			$.ajax({
				url: '<?= base_url('simpan-master-barang') ?>',
				type: 'post',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(data) {
					if (data.res == 'nama_barang') {
						Swal.fire(
							data.message,
							'',
							'warning'
						);
					} else if (data.res == 'error') {
						Swal.fire(
							data.message,
							'',
							'warning'
						);
					} else if (data.res == 'success') {
						Swal.fire(
							data.message,
							'',
							'success'
						);
						$('#nama_barang').val('');
						$('#modalTambah').modal('hide');
						refreshTable();
					}
				}
			});
		}
	})

	$('#formEdit').submit(function(e) {
		e.preventDefault();
		var fd = new FormData();
		var nama_barang = $('#nama_barang_edit').val();
		if (nama_barang == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Barang Tidak Boleh Kosong',
				'warning'
			);
		} else {
			Swal.fire({
				title: 'Apakah anda yakin ingin mengubah barang ini ?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Yakin',
				cancelButtonText: 'Batalkan'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url('edit-master-barang') ?>',
						type: 'post',
						data: $(this).serialize(),
						dataType: 'json',
						success: function(data) {
							if (data.res == 'nama_barang') {
								Swal.fire(
									data.message,
									'',
									'warning'
								);
							} else if (data.res == 'error') {
								Swal.fire(
									data.message,
									'',
									'warning'
								);
							} else if (data.res == 'success') {
								Swal.fire(
									data.message,
									'',
									'success'
								);
								$('#modalEdit').modal('hide');
								refreshTable();
							}
						}
					});
				}
			})
		}
	})
</script>
