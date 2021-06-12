<div class="row">
	<div class="col-lg-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Grade</h4>
				<div class="card-header-action">
					<div class="input-group-btn">
						<button class="btn btn-primary" href="#card-form-peminjaman" id="btn-ajukan-peminjaman" data-target="#modalTambah" data-toggle="modal"><i class="fas fa-plus"></i> Tambah Grade</button>
					</div>
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div class="table-reponsive">
					<table class="table table-sm table-striped" id="table-grade">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Grade</th>
								<th>Limit Voucher</th>
								<th>Simpanan Wajib</th>
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
					<h5 class="modal-title" id="exampleModalLabel">Tambah Grade</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" id="formTambah">
					<div class="modal-body">
						<div class="form-group">
							<label>Grade</label>
							<input type="text" class="form-control mt-2" id="grade" placeholder="Masukkan Grade" name="grade">
						</div>
						<div class="form-group">
							<label>Limit Voucher</label>
							<input type="text" class="form-control mt-2" id="limit_voucher" placeholder="Masukkan Limit Voucher" onkeyup="hitung_limit_voucher()" name="limit_voucher" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
						</div>
						<div class="form-group">
							<label>Simpanan Wajib</label>
							<input type="text" class="form-control mt-2" id="simpanan_wajib" placeholder="Masukkan Simpanan Wajib" onkeyup="hitung_simpanan_wajib()" name="simpanan_wajib" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Grade</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="" id="formEdit">
					<div class="modal-body">
						<div class="form-group">
							<label>Grade</label>
							<input type="text" class="form-control mt-2" id="id" placeholder="Masukkan Grade" name="id" hidden>
							<input type="text" class="form-control mt-2" id="grade_edit" placeholder="Masukkan Grade" name="grade">
						</div>
						<div class="form-group">
							<label>Limit Voucher</label>
							<input type="text" class="form-control mt-2" id="limit_voucher_edit" placeholder="Masukkan Limit Voucher" onkeyup="hitung_limit_voucher()" name="limit_voucher" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
						</div>
						<div class="form-group">
							<label>Simpanan Wajib</label>
							<input type="text" class="form-control mt-2" id="simpanan_wajib_edit" placeholder="Masukkan Simpanan Wajib" onkeyup="hitung_simpanan_wajib()" name="simpanan_wajib" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
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
				url: '<?php echo base_url('get-grade') ?>',
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
					data: 'grade',
					className: 'text-center'
				},
				{
					data: 'limit_voucher',
					render: $.fn.dataTable.render.number('.'),
					className: 'text-center'
				},
				{
					data: 'simpanan_wajib',
					render: $.fn.dataTable.render.number('.'),
					className: 'text-center'
				},
				{
					data: 'id',
					render: function(data, type, row, meta) {
						// return '<button class="btn btn-info btn-sm" onclick="edit(' + data + ')">' + 'Edit' + '</button>  <button class="btn btn-danger btn-sm" onclick="hapus(' + data + ')">' + 'Hapus' + '</button>';
						return '<button class="btn btn-primary btn-sm" onclick="edit(' + data + ')"><i class="fas fa-edit"></i> ' + 'Ubah' + '</button>';
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

	function hitung_simpanan_wajib() {
		$('#simpanan_wajib_edit').mask('000.000.000.000.000', {
			reverse: true
		});
		$('#simpanan_wajib').mask('000.000.000.000.000', {
			reverse: true
		});
	}

	function refreshTable() {
		var table = $("#table-grade").DataTable();
		table.ajax.reload();
	}

	function edit(id) {
		$.ajax({
			url: '<?= base_url('get-detail-grade') ?>',
			type: 'post',
			data: {
				id: id
			},
			dataType: "JSON",
			success: function(data) {
				$('#grade_edit').val(data.grade);
				$('#limit_voucher_edit').val(data.limit_voucher);
				$('#simpanan_wajib_edit').val(data.simpanan_wajib);
				$('#id').val(id);
				$('#simpanan_wajib_edit').keyup();
				$('#limit_voucher_edit').keyup();
				$('#modalEdit').modal('show');
			}
		})
	}

	function hapus(id) {
		Swal.fire({
			title: 'Apakah anda yakin ingin menghapus grade ini ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Yakin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('hapus-grade') ?>',
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
		var grade = $('#grade').val();
		var limit_voucher = $('#limit_voucher').val();
		var simpanan_wajib = $('#simpanan_wajib').val();
		if (grade == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Grade Tidak Boleh Kosong',
				'warning'
			);
		} else if (limit_voucher == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Limit Voucher Tidak Boleh Kosong',
				'warning'
			);
		} else if (simpanan_wajib == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Simpanan Wajib Tidak Boleh Kosong',
				'warning'
			);
		} else {
			$.ajax({
				url: '<?= base_url('simpan-grade') ?>',
				type: 'post',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(data) {
					if (data.res == 'grade') {
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
						$('#grade').val('');
						$('#limit_voucher').val('');
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
		var grade = $('#grade_edit').val();
		var limit_voucher = $('#limit_voucher_edit').val();
		var simpanan_wajib = $('#simpanan_wajib_edit').val();
		if (grade == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Grade Tidak Boleh Kosong',
				'warning'
			);
		} else if (limit_voucher == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Limit Voucher Tidak Boleh Kosong',
				'warning'
			);
		} else if (simpanan_wajib == "") {
			Swal.fire(
				'Inputan tidak lengkap',
				'Simpanan Wajib Tidak Boleh Kosong',
				'warning'
			);
		} else {
			Swal.fire({
				title: 'Apakah anda yakin ingin mengubah grade ini ?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Yakin',
				cancelButtonText: 'Batalkan'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url('edit-grade') ?>',
						type: 'post',
						data: $(this).serialize(),
						dataType: 'json',
						success: function(data) {
							if (data.res == 'grade') {
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