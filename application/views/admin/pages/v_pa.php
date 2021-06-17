<div class="row">
	<div class="col mx-auto">
		<div class="card">
			<div class="card-header">
				<h4>Data Admin</h4>
				<div class="card-header-action">
					<div class="input-group-btn" id="">
						<a name="" id="btn-tambah-admin" class="btn btn-primary" href="#form-tambah-kasir" role="button"><i class="fas fa-plus"></i> Tambah Admin</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-reponsive">
					<table class="table table-sm table-striped" id="pengguna-admin-table" style="width: 100%;">
						<thead>
							<tr class="text-center">
								<th>Aksi</th>
								<th>Nama</th>
								<th>Telepon</th>
								<th>Alamat</th>
								<th>Kelurahan</th>
								<th>Kecamatan</th>
								<th>Kabupaten</th>
								<th>Status</th>
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

<section id="form-tambah-kasir" style="display: none;">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h4>Tambah Data Admin</h4>
					<div class="card-header-action">
						<div class="input-group-btn" id="">
							<a name="" id="tutup-tambah-admin" class="btn btn-danger" href="#" role="button"><i class="fas fa-times"></i> Tutup</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form action="#" id="form-tambah-akun-pegawai">
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12 ml-0" style="line-height: 2.6;">
											<label>Nama Lengkap:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control" name="namaPegawai" id="namaPegawai" placeholder="Masukkan nama lengkap">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Tempat Lahir:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control" name="tempatPegawai" id="tempatPegawai" placeholder="Masukkan tempat lahir">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Tanggal Lahir:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="date" class="form-control" name="tanggalPegawai" id="tanggalPegawai" placeholder="Masukkan tanggal lahir">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Email:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control" name="emailPegawai" id="emailPegawai" placeholder="Masukkan email">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Telepon:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="number" class="form-control" name="teleponPegawai" id="teleponPegawai" placeholder="Masukkan telepon">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Provinsi:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<select data-width="100%" class="form-control  select2 select2-hidden-accessible" name="provinsiPegawai" id="provinsiPegawai">
												<option value=""> - Pilih Provinsi -</option>
												<?php foreach ($provinsi as $prov) : ?>
													<option value="<?= $prov->id ?>"><?= $prov->nama ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Kabupaten:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<select data-width="100%" class="form-control  select2 select2-hidden-accessible kabupatenPegawai" tabindex="-1" aria-hidden="true" name="kabupatenPegawai" id="kabupatenPegawai" disabled>
												<option value=""> - Pilih Kabupaten -</option>
											</select>

										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Kecamatan:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<select data-width="100%" class="form-control  select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="kecamatanPegawai" id="kecamatanPegawai" disabled>
												<option value=""> - Pilih Kecamatan -</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Kelurahan/Desa:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<select data-width="100%" class="form-control  select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="kelurahanPegawai" id="kelurahanPegawai" disabled>
												<option value=""> - Pilih Kelurahan/Desa -</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Alamat:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control" name="alamatPegawai" id="alamatPegawai" placeholder="Masukkan alamat">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Username:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control" name="usernamePegawai" id="usernamePegawai" placeholder="Masukkan username">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Password:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control" name="passwordPegawai" id="passwordPegawai" placeholder="Masukkan password">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group mb-0">
									<div class="row">
										<div class="col-lg-3 col-sm-12" style="line-height: 2.6;">
											<label>Foto Profil:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<div id="form-foto-ktp">
												<div class="form-group mb-1">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="input-foto-profil" name="input-foto-profil" accept=".png, .jpg, .jpeg">
														<label class="custom-file-label" for="customFile">Pilih file foto</label>
													</div>
												</div>
												<div class="ml-1">
													<small>* Ukuran file maksimal 2MB.</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="float-right">
									<button name="" id="btn-tambah-data-kasir" class="btn btn-sm btn-primary btn-tambah-data-kasir" href="#" role="button"><i class="fas fa-plus"></i> Tambah Data</button>

								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal Detail Pegawai -->
<div class="modal fade bd-example-modal-lg" id="modal-detail-pegawai" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" style="max-width: 1000px !important;">
		<div class="modal-content">
			<div class="modal-header px-4">
				<h5 class="modal-title" id="exampleModalLongTitle">Detail Pegawai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-4">
				<div class="row mt-1">
					<div class="col">
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<input type="text" id="idPegawai2" value="" style="display: none;">
									<div class="row">
										<div class="col-lg-3 col-sm-12 ml-0">
											<label>Nama:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control " id="namaPegawai2" value="" disabled>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Tempat Lahir:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control " id="tempatPegawai2" value="" disabled>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Tanggal Lahir:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="date" class="form-control " id="tanggalPegawai2" value="" disabled>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Email:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control " id="emailPegawai2" value="" disabled>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Telepon:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control " id="teleponPegawai2" value="" disabled>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Provinsi:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<select data-width="100%" class="form-control select2" id="provinsiPegawai2" onchange="kabupatenDetail()" disabled>

											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Kabupaten:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<select data-width="100%" class="form-control select2" aria-hidden="true" id="kabupatenPegawai2" onchange="kecamatanDetail()" disabled>

											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Kecamatan:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<select data-width="100%" class="form-control  select2" aria-hidden="true" id="kecamatanPegawai2" onchange="kelurahanDetail()" disabled>

											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Kelurahan:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<select data-width="100%" class="form-control  select2" aria-hidden="true" id="kelurahanPegawai2" disabled>

											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row mb-4">
							<div class="col-lg-1 col-sm-12">
								<label>Alamat:</label>
							</div>
							<div class="col-lg-11 col-sm-12">
								<textarea class="form-control" style="width: 95%; float: right;" name="" cols="30" rows="10" id="alamatPegawai2" disabled></textarea>
							</div>
						</div>
						<?php if ($this->session->userdata('id') == 1) : ?>
							<div class="row">
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<div class="row">
											<div class="col-lg-3 col-sm-12">
												<label>Username:</label>
											</div>
											<div class="col-lg-9 col-sm-12">
												<input type="text" class="form-control " id="usernamePegawai2" value="" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<div class="row">
											<div class="col-lg-3 col-sm-12">
												<label>Password:</label>
											</div>
											<div class="col-lg-9 col-sm-12">
												<input type="text" class="form-control " id="passwordPegawai2" value="" disabled>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif ?>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Status Akun:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<div id="status-akun-aktif" style="display: none;">
												<div class="badge badge-success mr-3" data-toggle="tooltip" data-placement="left" title="Aktif">Aktif</div>
												<?php if ($this->session->userdata('id') == 1) : ?>
													<button type="button" id="btn-nonaktifkan" class="btn btn-sm btn-danger btn-nonaktifkan" href="#" style="display: none">Non-aktifkan</button>
												<?php endif; ?>
											</div>
											<div id="status-akun-nonaktif" style="display: none;">
												<div class="badge badge-danger mr-3" data-toggle="tooltip" data-placement="left" title="Tidak Aktif">Tidak Aktif</div>
												<button type="button" id="btn-aktifkan" class="btn btn-sm btn-success btn-aktifkan" href="#" style="display: none">Aktifkan</button>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Foto Profil:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<div id="profil-pegawai">
												<a href="" id="img-profil-show" target="_blank">
													<img src="" id="img-profil" alt="" style="width: 95%; margin-top: 20px;">
												</a>
											</div>
											<div id="inputfoto-profil" style="display:none">
												<div class="form-group mb-1">
													<input type="file" id="foto-profil2" name="input-foto" class="form-control" accept=".png, .jpg, .jpeg">
												</div>
												<div class="ml-1">
													<small>* Ukuran file maksimal 2MB.</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="float-right" id="btn-ubah-data-pegawai2">
									<button type="button" class="btn btn-sm btn-danger mr-1 btn-ubahFoto" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
									<?php if ($this->session->userdata('id') == 1) : ?>
										<button name="" id="btn-ubah-profil" class="btn btn-sm btn-primary btn-ubahFoto" href="#" role="button"><i class="fas fa-image"></i> Ubah Foto Profil</button>
										<button name="" id="btn-ubah-data-pegawai" class="btn btn-sm btn-primary btn-ubahFoto btn-ubah-data-pegawai" href="#" role="button"><i class="fas fa-edit"></i> Ubah Data</button>
									<?php endif; ?>
								</div>
								<div class="float-right btn-perbarui-pegawai" id="' . $detail->id . '" style="display:none">
									<button type="button" class="btn btn-sm btn-danger mr-1" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
									<button class="btn btn-primary btn-sm btn-perbarui-pegawai2" id="1"><i class="fas fa-check-circle"></i> Perbarui</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Ubah Foto -->
<div class="modal fade" id="modal-ubah-foto" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header px-4">
				<h5 class="modal-title title-modal-foto" id="exampleModalLongTitle"></h5>
				<button type="button" class="close close-ubah-foto" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-4">
				<input type="hidden" class="foto-ubah-id" id="foto-ubah-id">
				<div class="form-group mb-0">
					<div class="form-group mb-1">
						<div class="custom-file">
							<input type="file" class="custom-file-input input-foto2" name="input_foto_ktp2" accept=".png, .jpg, .jpeg">
							<label class="custom-file-label" for="customFile">Pilih file foto</label>
						</div>
					</div>
					<div class="ml-1">
						<small>* Ukuran file maksimal 2MB.</small>
					</div>
				</div>
				<button style="float: right" class="btn btn-sm btn-primary mt-3 btn-perbarui-foto"><i class="fas fa-check-circle"></i>
					<div class="btn-perbarui-title" style="display: inline;"> </div>
				</button>
				<button style="float: right;" class="btn btn-sm btn-danger mt-3 mr-2 close-ubah-foto"><i class="fas fa-times"></i> Batal</button>

			</div>
		</div>
	</div>
</div>


<script>
	// Script Pengguna Pegawai
	$(document).ready(function() {
		$.fn.modal.Constructor.prototype._enforceFocus = function() {};
		// refreshTable()
		dataKasir()
		provinsi()
		// 		grade()
		$("select").select2();
		bsCustomFileInput.init();

	})

	function refreshTable() {
		var table = $("#pengguna-admin-table").DataTable();
		table.ajax.reload();
	}

	function dataKasir() {
		$.ajax({
			type: 'get',
			url: `<?= base_url('pengguna-admin-data') ?>`,
			dataType: 'json',
			success: function(response) {
				$('#pengguna-admin-table').DataTable({
					processing: true,
					data: response,
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
							orderable: false,
							searchable: false,
							data: function(row) {
								return `
									<button class="btn btn-sm btn-primary mr-1 detailPegawai" id="${row.id}"><i class="fas fa-info-circle"></i> Detail</button>									
									`
							},
							className: 'text-center'
						},
						{
							data: "nama_pengguna",
							className: 'text-center',
						},
						{
							data: "telepon",
							className: 'text-center',
						},
						{
							data: "alamat",
							className: 'text-center',
						},
						{
							data: "kelurahan",
							className: 'text-center',
						},
						{
							data: "kecamatan",
							className: 'text-center',
						},
						{
							data: "kabupaten",
							className: 'text-center',
						},

						{
							data: function(row) {
								if (row.status == 1) {
									return `
											<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Aktif">Aktif</div>`
								} else if (row.status !== 1) {
									return `
											<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Tidak Aktif">Tidak Aktif</div>`
								}
							},
							className: 'text-center'
						},
					]
				})
			}

		})
	}

	function provinsi() {
		$.ajax({
			type: 'POST',
			url: `<?= base_url('get-provinsi') ?>`,
			success: function(data) {
				$('#provinsiPegawai2').html(data)
			},
			error: function(data) {
				console.log(data);
			}
		})
	}

	// 	function grade() {
	// 		$.ajax({
	// 			type: 'POST',
	// 			url: `<?= base_url('get-grade-detail') ?>`,
	// 			success: function(data) {
	// 				$('#gradePegawai2').html(data)
	// 			},
	// 			error: function(data) {
	// 				console.log(data);
	// 			}
	// 		})
	// 	}

	function kabupaten(id) {
		$.ajax({
			url: `<?= base_url('get-kabupaten') ?>`,
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#kabupatenPegawai').html(data)
			}
		})
	}

	function kabupatenDetail() {
		var id_provinsi = $('#provinsiPegawai2').val();
		$.ajax({
			url: `<?= base_url('get-kabupaten') ?>`,
			type: 'post',
			data: {
				id: id_provinsi
			},
			success: function(data) {
				$('#kabupatenPegawai2').html(data)
			},
			error: function(data) {
				console.log(data);
			}
		})
	}

	function kecamatan(id) {
		$.ajax({
			url: `<?= base_url('get-kecamatan') ?>`,
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#kecamatanPegawai').html(data)
			}
		})
	}

	function kecamatanDetail() {
		var id_provinsi = $('#kabupatenPegawai2').val();
		$.ajax({
			url: `<?= base_url('get-kecamatan') ?>`,
			type: 'post',
			data: {
				id: id_provinsi
			},
			success: function(data) {
				$('#kecamatanPegawai2').html(data)
			}
		})
	}

	function kelurahan(id) {
		$.ajax({
			url: `<?= base_url('get-kelurahan') ?>`,
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#kelurahanPegawai').html(data)
			}
		})
	}

	function kelurahanDetail() {
		var id_kelurahan = $('#kecamatanPegawai2').val();
		$.ajax({
			url: `<?= base_url('get-kelurahan') ?>`,
			type: 'post',
			data: {
				id: id_kelurahan
			},
			success: function(data) {
				$('#kelurahanPegawai2').html(data)
			}
		})
	}


	$('#provinsiPegawai').change(function() {
		$('#kabupatenPegawai').removeAttr('disabled')
		id = $(this).val()
		kabupaten(id)
	})

	$('#kabupatenPegawai').change(function() {
		$('#kecamatanPegawai').removeAttr('disabled')
		id = $(this).val()
		kecamatan(id)
	})

	$('#kecamatanPegawai').change(function() {
		$('#kelurahanPegawai').removeAttr('disabled')
		id = $(this).val()
		kelurahan(id)
	})

	$('#namaPegawai').keydown(function() {
		$('#namaPegawai').removeClass('is-invalid')
	})

	$('#usernamePegawai').keydown(function() {
		$('#usernamePegawai').removeClass('is-invalid')
	})

	// 	$('#gradePegawai').change(function() {
	// 		$('#gradePegawai').removeClass('is-invalid')
	// 	})

	$('#passwordPegawai').keydown(function() {
		$('#passwordPegawai').removeClass('is-invalid')
	})

	$('#input-foto-profil').change(function() {
		$('#input-foto-profil').removeClass('is-invalid')
	})

	$('#btn-tambah-admin').click(function() {
		$('#form-tambah-kasir').show()
		$('#btn-tambah-admin').hide()
	})

	$('#tutup-tambah-admin').click(function() {
		$('#form-tambah-kasir').hide()
		$('#btn-tambah-admin').show()
	})



	$('#btn-tambah-data-kasir').click(function(e) {
		e.preventDefault()
		var foto_profil = $('#input-foto-profil').val()

		if ($('#namaPegawai').val() == '') {
			Swal.fire(
				'Nama Lengkap wajib diisi',
				'',
				'error'
			).then(function() {
				$('#namaPegawai').addClass('is-invalid')
			})
		} else if ($('#usernamePegawai').val() == '') {
			Swal.fire(
				'Username wajib diisi',
				'',
				'error'
			).then(function() {
				$('#usernamePegawai').addClass('is-invalid')
			})
		} else if ($('#passwordPegawai').val() == '') {
			Swal.fire(
				'Password wajib diisi',
				'',
				'error'
			).then(function() {
				$('#passwordPegawai').addClass('is-invalid')
			})
		} else {
			var nama = $('#namaPegawai').val()
			var username = $('#usernamePegawai').val()
			$.ajax({
				type: 'post',
				url: `<?= base_url('cek-data-admin') ?>`,
				data: {
					nama: nama,
					username: username,
				},
				dataType: 'json',
				success: function(response) {
					if (response.res == 'nama') {
						Swal.fire(
							response.message,
							'',
							'error'
						).then(function() {
							$('#namaPegawai').addClass('is-invalid')
						})
					} else if (response.res == 'username') {
						Swal.fire(
							response.message,
							'',
							'error'
						).then(function() {
							$('#usernamePegawai').addClass('is-invalid')
						})
					} else if (response.res == 'success') {
						Swal.fire({
							title: 'Apakah anda yakin ingin menambahkan data admin ?',
							icon: 'question',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Ya, Yakin',
							cancelButtonText: 'Batalkan'
						}).then((result) => {
							if (result.isConfirmed) {
								var fd = new FormData()
								fd.append('nama', $('#namaPegawai').val())
								fd.append('tempat_lahir', $('#tempatPegawai').val())
								if ($('#tanggalPegawai').val() !== '') {
									fd.append('tgl_lahir', $('#tanggalPegawai').val())
								}
								fd.append('email', $('#emailPegawai').val())
								fd.append('telepon', $('#teleponPegawai').val())
								if ($('#provinsiPegawai').val() !== '') {
									fd.append('provinsi', $('#provinsiPegawai').val())
								}
								if ($('#kabupatenPegawai').val() !== '') {
									fd.append('kabupaten', $('#kabupatenPegawai').val())
								}
								if ($('#kecamatanPegawai').val() !== '') {
									fd.append('kecamatan', $('#kecamatanPegawai').val())
								}
								if ($('#kelurahanPegawai').val() !== '') {
									fd.append('kelurahan', $('#kelurahanPegawai').val())
								}
								fd.append('alamat', $('#alamatPegawai').val())
								fd.append('username', $('#usernamePegawai').val())
								fd.append('password', $('#passwordPegawai').val())
								fd.append('foto_profil', $('#input-foto-profil')[0].files[0])
								$.ajax({
									type: 'post',
									url: `<?= base_url('tambah-data-admin') ?>`,
									data: fd,
									processData: false,
									contentType: false,
									dataType: 'json',
									success: function(response) {
										if (response.res == 'success') {
											Swal.fire({
												icon: 'success',
												title: response.message,
												showConfirmButton: false,
												timer: 2000
											}).then((result) => {
												window.location.reload();
											})


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
					}
				}
			})
		}
	})

	function detailPegawai(id) {
		$.ajax({
			type: 'POST',
			url: `<?= base_url('detail-pegawai') ?>`,
			data: {
				id: id
			},
			dataType: "JSON",
			success: function(data) {
				$('#idPegawai2').val(data.id)
				$('#namaPegawai2').val(data.nama_pengguna)
				// $('#nipPegawai2').val(data.nip)
				$('#tempatPegawai2').val(data.tempat_lahir)
				$('#tanggalPegawai2').val(data.tgl_lahir)
				$('#emailPegawai2').val(data.email)
				$('#teleponPegawai2').val(data.telepon)
				$("#provinsiPegawai2").val(data.provinsi).trigger('change');
				setTimeout(function() {
					$("#kabupatenPegawai2").val(data.kabupaten).trigger('change');
				}, 1000);
				setTimeout(function() {
					$("#kecamatanPegawai2").val(data.kecamatan).trigger('change');
				}, 2000);
				setTimeout(function() {
					$("#kelurahanPegawai2").val(data.kelurahan).trigger('change');
				}, 3000);
				$('#alamatPegawai2').val(data.alamat)
				$('#usernamePegawai2').val(data.username)
				$('#passwordPegawai2').val(data.password_show)
				// $('#gradePegawai2').val(data.grade).trigger('change')
				setTimeout(function() {
					$("#img-profil").attr("src", "./uploads/img/" + data.foto_profil).trigger('change');
				}, 800);
				$("#img-profil-show").attr("href", "./uploads/img/" + data.foto_profil)


				if (data.status == 1) {
					$('#status-akun-aktif').show();
					$('#status-akun-nonaktif').hide();
					$('#btn-nonaktifkan').show()

				} else if (data.status == 2) {
					$('#status-akun-nonaktif').show();
					$('#status-akun-aktif').hide();
					$('#btn-aktifkan').show()

				}
			}
		})
		$('#modal-ubah-foto').modal('hide')
		$('#modal-detail-pegawai').appendTo("body")
		$('#modal-detail-pegawai').modal('show')


	}

	function disabled() {
		$('#namaPegawai2').prop('disabled', true);
		// 		$('#nipPegawai2').prop('disabled', true);
		$('#tempatPegawai2').prop('disabled', true);
		$('#tanggalPegawai2').prop('disabled', true);
		$('#emailPegawai2').prop('disabled', true);
		$('#teleponPegawai2').prop('disabled', true);
		$('#provinsiPegawai2').prop('disabled', true);
		$('#kabupatenPegawai2').prop('disabled', true);
		$('#kecamatanPegawai2').prop('disabled', true);
		$('#kelurahanPegawai2').prop('disabled', true);
		$('#alamatPegawai2').prop('disabled', true);
		$('#usernamePegawai2').prop('disabled', true);
		$('#passwordPegawai2').prop('disabled', true);
		// 		$('#gradePegawai2').prop('disabled', true);
		$('.btn-ubahFoto').show()
		$('.btn-perbarui-pegawai').hide()
		$('#btn-ubah-data-pegawai').show()
	}

	$(document).on('click', '.detailPegawai', function(e) {
		id = $(this).attr('id')
		detailPegawai(id)
		disabled()
	})

	$('#btn-ubah-data-pegawai').click(function() {
		$('#namaPegawai2').removeAttr('disabled')
		// 		$('#nipPegawai2').removeAttr('disabled')
		$('#tempatPegawai2').removeAttr('disabled')
		$('#tanggalPegawai2').removeAttr('disabled')
		$('#emailPegawai2').removeAttr('disabled')
		$('#teleponPegawai2').removeAttr('disabled')
		$('#provinsiPegawai2').removeAttr('disabled')
		$('#kabupatenPegawai2').removeAttr('disabled')
		$('#kecamatanPegawai2').removeAttr('disabled')
		$('#kelurahanPegawai2').removeAttr('disabled')
		$('#alamatPegawai2').removeAttr('disabled')
		$('#usernamePegawai2').removeAttr('disabled')
		$('#passwordPegawai2').removeAttr('disabled')
		// 		$('#gradePegawai2').removeAttr('disabled')
		$('.btn-ubahFoto').hide()
		$('.btn-perbarui-pegawai').show()
		$('#btn-ubah-data-pegawai').hide()
	})


	$('#btn-nonaktifkan').click(function() {
		id = $('#idPegawai2').val()
		Swal.fire({
			title: 'Apakah anda yakin ingin menonaktikan akun ?',
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
					url: `<?= base_url('nonaktifkan-pegawai') ?>`,
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
								timer: 2500
							})

							$('#status-akun-aktif').hide()
							detailPegawai(id)
							$('#pengguna-admin-table').DataTable().destroy()
							dataKasir()
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

	$('#btn-aktifkan').click(function() {
		id = $('#idPegawai2').val()
		Swal.fire({
			title: 'Apakah anda yakin ingin mengaktifkan akun ?',
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
					url: `<?= base_url('aktifkan-pegawai') ?>`,
					data: {
						id: id,
					},
					dataType: 'json',
					success: function(response) {
						if (response.res == 'success') {
							Swal.fire({
								icon: 'success',
								title: response.message,
								showConfirmButton: false,
								timer: 2500
							})
							$('#status-akun-nonaktif').hide()
							detailPegawai(id)
							$('#pengguna-admin-table').DataTable().destroy()
							dataKasir()
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



	$('#btn-ubah-profil').click(function() {
		var id = $('#idPegawai2').val();
		$('#modal-detail-pegawai').modal('hide')
		$('#modal-ubah-foto').appendTo("body")
		$('#modal-ubah-foto').modal('show')
		$('.foto-ubah-id').val(id)
		$('.title-modal-foto').text('Ubah Foto Profil')
		$('.btn-perbarui-title').text('Perbarui Foto Profil')
		$('.btn-perbarui-foto').attr('id', 'perbarui-foto-profil')
		$('.input-foto2').attr('id', 'input-foto-profil2')
	})

	$(document).on('click', '#perbarui-foto-profil', function(e) {
		var id = $('#idPegawai2').val()
		Swal.fire({
			title: 'Apakah anda yakin ingin mengubah foto profil ?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Yakin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				var fd = new FormData()
				fd.append('id', $('#idPegawai2').val())
				fd.append('nama', $('#namaPegawai2').val())
				fd.append('foto_profil', $('#input-foto-profil2')[0].files[0])
				$.ajax({
					type: 'post',
					url: `<?= base_url('ubah-foto-profil') ?>`,
					data: fd,
					processData: false,
					contentType: false,
					dataType: 'json',
					success: function(response) {
						if (response.res == 'success') {
							Swal.fire({
								icon: 'success',
								title: response.message,
								showConfirmButton: false,
								timer: 2500
							})
							$('#pengguna-admin-table').DataTable().destroy()
							dataKasir()
							disabled()
							detailPegawai(id)

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

	$('.close-ubah-foto').click(function() {
		var id = $('.foto-ubah-id').val();
		detailPegawai(id)
	})

	$('.btn-perbarui-pegawai').click(function() {
		var id = $('#idPegawai2').val();
		var nama = $('#namaPegawai2').val()
		var username = $('#usernamePegawai2').val()
		$.ajax({
			type: 'post',
			url: `<?= base_url('cek-data-admin-detail') ?>`,
			data: {
				id: id,
				nama: nama,
				username: username,
			},
			dataType: 'json',
			success: function(response) {
				if (response.res == 'nama') {
					Swal.fire(
						response.message,
						'',
						'error'
					).then(function() {
						$('#namaPegawai').addClass('is-invalid')
					})
				} else if (response.res == 'username') {
					Swal.fire(
						response.message,
						'',
						'error'
					).then(function() {
						$('#usernamePegawai').addClass('is-invalid')
					})
				} else if (response.res == 'success') {
					Swal.fire({
						title: 'Apakah anda yakin ingin mengubah data ?',
						icon: 'question',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ya, Yakin',
						cancelButtonText: 'Batalkan'
					}).then((result) => {
						if (result.isConfirmed) {
							var fd = new FormData()
							fd.append('id', $('#idPegawai2').val())
							fd.append('nama', $('#namaPegawai2').val())
							// 			fd.append('nip', $('#nipPegawai2').val())
							fd.append('tempat_lahir', $('#tempatPegawai2').val())
							if ($('#tanggalPegawai2').val() !== '') {
								fd.append('tgl_lahir', $('#tanggalPegawai2').val())
							}
							fd.append('email', $('#emailPegawai2').val())
							fd.append('telepon', $('#teleponPegawai2').val())
							if ($('#provinsiPegawai2').val() !== '') {
								fd.append('provinsi', $('#provinsiPegawai2').val())
							}
							if ($('#kabupatenPegawai2').val() !== '') {
								fd.append('kabupaten', $('#kabupatenPegawai2').val())
							}
							if ($('#kecamatanPegawai2').val() !== '') {
								fd.append('kecamatan', $('#kecamatanPegawai2').val())
							}
							if ($('#kelurahanPegawai2').val() !== '') {
								fd.append('kelurahan', $('#kelurahanPegawai2').val())
							}
							// 			fd.append('provinsi', $('#provinsiPegawai2').val())
							// 			fd.append('kabupaten', $('#kabupatenPegawai2').val())
							// 			fd.append('kecamatan', $('#kecamatanPegawai2').val())
							// 			fd.append('kelurahan', $('#kelurahanPegawai2').val())
							fd.append('alamat', $('#alamatPegawai2').val())
							fd.append('username', $('#usernamePegawai2').val())
							fd.append('password', $('#passwordPegawai2').val())
							// 			fd.append('grade', $('#gradePegawai2').val())
							$.ajax({
								type: 'post',
								url: `<?= base_url('ubah-data-kasir') ?>`,
								data: fd,
								processData: false,
								contentType: false,
								dataType: 'json',
								success: function(response) {
									if (response.res == 'success') {
										Swal.fire({
											icon: 'success',
											title: response.message,
											showConfirmButton: false,
											timer: 2500
										})
										detailPegawai(id)
										$('#pengguna-admin-table').DataTable().destroy()
										dataKasir()
										disabled()
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
				}
			}
		})

	})
</script>