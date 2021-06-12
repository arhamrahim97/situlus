<div class="row">
	<div class="col-lg-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Syarat dan Ketentuan</h4>
				<div class="card-header-action">
					<div class="input-group-btn">
						<button class="btn btn-primary" href="#card-form-peminjaman" id="btn-ajukan-peminjaman" data-target="#modalTambah" data-toggle="modal"><i class="fas fa-plus"></i> Tambah Syarat dan Ketentuan</button>
					</div>
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div class="table-reponsive">
					<table class="table table-sm table-striped" id="table-grade">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Isi</th>
								<th>Kategori</th>
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
					<h5 class="modal-title" id="exampleModalLabel">Tambah Syarat dan Ketentuan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" id="formTambah">
					<div class="modal-body">
						<div class="form-group">
							<label>Nomor</label>
							<input type="text" class="form-control mt-2" id="nomor" placeholder="Masukkan nomor" name="nomor" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
						</div>
						<div class="form-group">
							<label>Kategori</label>
							<select name="kategori" id="kategori" class="form-control mt-2">
								<option value="Voucher Belanja">Voucher Belanja</option>
								<option value="Peminjaman">Peminjaman</option>
							</select>
						</div>
						<div class="form-group">
							<label>Isi</label>
							<textarea class="form-control mt-2" id="isi" style="height:100%;" name="isi"></textarea>
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
					<h5 class="modal-title" id="exampleModalLabel">Ubah Syarat dan Ketentuan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" id="formEdit">
					<div class="modal-body">
						<div class="form-group">
							<label>Nomor</label>
							<input type="text" class="form-control mt-2" id="id" placeholder="Masukkan nomor" name="id" hidden>
							<input type="text" class="form-control mt-2" id="nomor_edit" placeholder="Masukkan nomor" name="nomor" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
						</div>

						<!-- <input type="text" class="form-control mt-2" id="kategori_edit" placeholder="Masukkan nomor" name="kategori" hidden> -->

						<div class="form-group">
							<label>Kategori</label>
							<select name="kategori" id="kategori_edit" class="form-control mt-2">
								<option value="Voucher Belanja">Voucher Belanja</option>
								<option value="Peminjaman">Peminjaman</option>
							</select>
						</div>
						<div class="form-group">
							<label>Isi</label>
							<textarea class="form-control mt-2" id="isi_edit" style="height:100%;" name="isi"></textarea>
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
</div>

<script>
	$(document).ready(function() {
		$("#table-grade").DataTable({
			"autoWidth": false,
			ajax: {
				url: '<?php echo base_url('getSK') ?>',
				dataSrc: ''
			},
			"order": [
				[2, "desc"],
				[0, "asc"],

			],
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
					data: 'nomor',
					className: 'text-center'
				},
				{
					data: 'isi',
					render: function(data, type, row) {
						return data.substr(0, 25);
					},
					className: 'text-center'
				},
				{
					data: 'kategori',
					className: 'text-center'
				},
				{
					data: 'id',
					render: function(data, type, row, meta) {
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
		var table = $("#table-grade").DataTable();
		table.ajax.reload();
	}

	function edit(id) {
		$.ajax({
			url: '<?= base_url('get-detail-SK') ?>',
			type: 'post',
			data: {
				id: id
			},
			dataType: "JSON",
			success: function(data) {
				$('#nomor_edit').val(data.nomor);
				$('#isi_edit').val(data.isi);
				$('#kategori_edit').val(data.kategori);
				$('#id').val(id);
				$('#modalEdit').modal('show');
			}
		})
	}

	function hapus(id) {
		Swal.fire({
			title: 'Apakah anda yakin ingin menghapus syarat dan ketentuan ini ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Yakin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('hapus-SK') ?>',
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
		var nomor = $('#nomor').val();
		var isi = $('#isi').val();
		if (nomor == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Nomor Tidak Boleh Kosong',
				'warning'
			);
		} else if (isi == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Isi Tidak Boleh Kosong',
				'warning'
			);
		} else {
			$.ajax({
				url: '<?= base_url('simpan-SK') ?>',
				type: 'post',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(data) {
					if (data.res == 'nomor') {
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
						$('#modalTambah').modal('hide');
						$('#nomor').val('');
						$('#isi').val('');
						refreshTable();
					}
				}
			});
		}
	})

	$('#formEdit').submit(function(e) {
		e.preventDefault();
		var fd = new FormData();
		var nomor = $('#nomor_edit').val();
		var isi = $('#isi_edit').val();
		if (nomor == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Nomor Tidak Boleh Kosong',
				'warning'
			);
		} else if (isi == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Isi Tidak Boleh Kosong',
				'warning'
			);
		} else {
			Swal.fire({
				title: 'Apakah anda yakin ingin mengubah syarat dan ketentuan ini ?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Yakin',
				cancelButtonText: 'Batalkan'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url('edit-SK') ?>',
						type: 'post',
						data: $(this).serialize(),
						dataType: 'json',
						success: function(data) {
							if (data.res == 'nomor') {
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
