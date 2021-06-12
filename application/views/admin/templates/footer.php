</div>
</section>
</div>
<footer class="main-footer pb-2 mt-0">
	<div class="footer-left">
		<strong>Copyright &copy; <?= date('Y') . ' ' . $title_footer ?> </strong>
	</div>
	<div class="footer-right">
		<p class="mb-0">Template powered by Stisla</p>
	</div>
</footer>
</div>
</div>


<!-- Modal Detail Pegawai -->
<div class="modal fade bd-example-modal-lg" id="modal-profil-admin2" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" style="max-width: 1000px !important;">
		<div class="modal-content">
			<div class="modal-header px-4">
				<h5 class="modal-title" id="exampleModalLongTitle">Detail Profile</h5>
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
									<input type="text" id="idPegawai22" value="" style="display: none;">

									<div class="row">
										<div class="col-lg-3 col-sm-12 ml-0">
											<label>Nama:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control " id="namaPegawai22" value="" disabled>
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
											<input type="text" class="form-control " id="tempatPegawai22" value="" disabled>
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
											<input type="date" class="form-control " id="tanggalPegawai22" value="" disabled>
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
											<input type="text" class="form-control " id="emailPegawai22" value="" disabled>
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
											<input type="text" class="form-control " id="teleponPegawai22" value="" disabled>
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
											<select data-width="100%" class="form-control select2" id="provinsiPegawai22" onchange="kabupatenDetail2()" disabled>

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
											<select data-width="100%" class="form-control select2" aria-hidden="true" id="kabupatenPegawai22" onchange="kecamatanDetail2()" disabled>

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
											<select data-width="100%" class="form-control  select2" aria-hidden="true" id="kecamatanPegawai22" onchange="kelurahanDetail2()" disabled>

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
											<select data-width="100%" class="form-control  select2" aria-hidden="true" id="kelurahanPegawai22" disabled>

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
								<textarea class="form-control" style="width: 95%; float: right;" name="" cols="30" rows="10" id="alamatPegawai22" disabled></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-3 col-sm-12">
											<label>Username:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<input type="text" class="form-control " id="usernamePegawai22" value="" disabled>
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
											<input type="text" class="form-control " id="passwordPegawai22" value="" disabled>
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
											<label>Foto Profil:</label>
										</div>
										<div class="col-lg-9 col-sm-12">
											<div id="profil-pegawai">
												<a href="" id="img-profil22-show" target="_blank">
													<img src="" id="img-profil22" alt="" style="width: 95%; margin-top: 20px;">
												</a>
											</div>
											<!-- <div id="inputfoto-profil" style="display:none">
												<div class="form-group mb-1">
													<input type="file" id="foto-profil22" name="input-foto" class="form-control" accept=".png, .jpg, .jpeg">
												</div>
												<div class="ml-1">
													<small>* Ukuran file maksimal 2MB.</small>
												</div>
											</div> -->
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="float-right" id="btn-ubah-data-pegawai22">
									<button type="button" class="btn btn-sm btn-danger mr-1 btn-ubahFoto2" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
									<!-- <button name="" id="btn-ubah-ktp" class="btn btn-sm btn-primary btn-ubahFoto2" href="#" role="button"><i class="fas fa-image"></i> Ubah Foto KTP</button>
									<button name="" id="btn-ubah-kk" class="btn btn-sm btn-primary btn-ubahFoto2" href="#" role="button"><i class="fas fa-image"></i> Ubah Foto KK</button> -->
									<button name="" id="btn-ubah-profil22" class="btn btn-sm btn-primary btn-ubahFoto2" href="#" role="button"><i class="fas fa-image"></i> Ubah Foto Profil</button>
									<button name="" id="btn-ubah-data-pegawai22" class="btn btn-sm btn-primary btn-ubahFoto2 btn-ubah-data-pegawai22" href="#" role="button"><i class="fas fa-edit"></i> Ubah Data</button>
								</div>
								<div class="float-right btn-perbarui-pegawai22" id="' . $detail->id . '" style="display:none">
									<button type="button" class="btn btn-sm btn-danger mr-1" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
									<button class="btn btn-primary btn-sm btn-perbarui-pegawai22" id="1"><i class="fas fa-check-circle"></i> Perbarui</button>
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
<div class="modal fade" id="modal-ubah-foto2" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header px-4">
				<h5 class="modal-title title-modal-foto" id="exampleModalLongTitle"></h5>
				<button type="button" class="close close-ubah-foto2" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-4">
				<input type="hidden" class="foto-ubah-id2" id="foto-ubah-id2">
				<div class="form-group mb-0">
					<div class="form-group mb-1">
						<div class="custom-file">
							<input type="file" class="custom-file-input input-foto22" name="input_foto_ktp2" accept=".png, .jpg, .jpeg">
							<label class="custom-file-label" for="customFile">Pilih file foto</label>
						</div>
					</div>
					<div class="ml-1">
						<small>* Ukuran file maksimal 2MB.</small>
					</div>
				</div>
				<button style="float: right" class="btn btn-sm btn-primary mt-3 btn-perbarui-foto2"><i class="fas fa-check-circle"></i>
					<div class="btn-perbarui-title" style="display: inline;"> </div>
				</button>
				<button style="float: right;" class="btn btn-sm btn-danger mt-3 mr-2 close-ubah-foto2"><i class="fas fa-times"></i> Batal</button>

			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$.fn.modal.Constructor.prototype._enforceFocus = function() {};
		provinsi2()
		$(".select2").select2();
	})

	function provinsi2() {
		$.ajax({
			type: 'POST',
			url: `<?= base_url('get-provinsi') ?>`,
			success: function(data) {
				$('#provinsiPegawai22').html(data)
			},
			error: function(data) {
				console.log(data);
			}
		})
	}

	function kabupatenDetail2() {
		var id_provinsi = $('#provinsiPegawai22').val();
		$.ajax({
			url: `<?= base_url('get-kabupaten') ?>`,
			type: 'post',
			data: {
				id: id_provinsi
			},
			success: function(data) {
				$('#kabupatenPegawai22').html(data)
			},
			error: function(data) {
				console.log(data);
			}
		})
	}

	function kecamatanDetail2() {
		var id_provinsi = $('#kabupatenPegawai22').val();
		$.ajax({
			url: `<?= base_url('get-kecamatan') ?>`,
			type: 'post',
			data: {
				id: id_provinsi
			},
			success: function(data) {
				$('#kecamatanPegawai22').html(data)
			}
		})
	}

	function kelurahanDetail2() {
		var id_kelurahan = $('#kecamatanPegawai22').val();
		$.ajax({
			url: `<?= base_url('get-kelurahan') ?>`,
			type: 'post',
			data: {
				id: id_kelurahan
			},
			success: function(data) {
				$('#kelurahanPegawai22').html(data)
			}
		})
	}

	function profilAdmin(id) {
		disabled2()
		$.ajax({
			type: 'POST',
			url: `<?= base_url('detail-admin2') ?>`,
			data: {
				id: id
			},
			dataType: "JSON",
			success: function(data) {
				$('#idPegawai22').val(data.id)
				$('#namaPegawai22').val(data.nama_pengguna)
				// $('#nipPegawai22').val(data.nip)
				$('#tempatPegawai22').val(data.tempat_lahir)
				$('#tanggalPegawai22').val(data.tgl_lahir)
				$('#emailPegawai22').val(data.email)
				$('#teleponPegawai22').val(data.telepon)
				$("#provinsiPegawai22").val(data.provinsi).trigger('change');
				setTimeout(function() {
					$("#kabupatenPegawai22").val(data.kabupaten).trigger('change');
				}, 1000);
				setTimeout(function() {
					$("#kecamatanPegawai22").val(data.kecamatan).trigger('change');
				}, 2000);
				setTimeout(function() {
					$("#kelurahanPegawai22").val(data.kelurahan).trigger('change');
				}, 3000);
				$('#alamatPegawai22').val(data.alamat)
				$('#usernamePegawai22').val(data.username)
				$('#passwordPegawai22').val(data.password_show)
				$('#gradePegawai2').val(data.grade).trigger('change')
				setTimeout(function() {
					$("#img-profil22").attr("src", "./uploads/img/" + data.foto_profil).trigger('change');
				}, 800);
				$("#img-profil22-show").attr("href", "./uploads/img/" + data.foto_profil)


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
		$('#modal-ubah-foto2').modal('hide')
		$('#modal-profil-admin2').appendTo("body")
		$('#modal-profil-admin2').modal('show')
	}

	function disabled2() {
		$('#namaPegawai22').prop('disabled', true);
// 		$('#nipPegawai22').prop('disabled', true);
		$('#tempatPegawai22').prop('disabled', true);
		$('#tanggalPegawai22').prop('disabled', true);
		$('#emailPegawai22').prop('disabled', true);
		$('#teleponPegawai22').prop('disabled', true);
		$('#provinsiPegawai22').prop('disabled', true);
		$('#kabupatenPegawai22').prop('disabled', true);
		$('#kecamatanPegawai22').prop('disabled', true);
		$('#kelurahanPegawai22').prop('disabled', true);
		$('#alamatPegawai22').prop('disabled', true);
		$('#usernamePegawai22').prop('disabled', true);
		$('#passwordPegawai22').prop('disabled', true);
		$('#gradePegawai2').prop('disabled', true);
		$('.btn-ubahFoto2').show()
		$('.btn-perbarui-pegawai22').hide()
		$('#btn-ubah-data-pegawai22').show()
	}

	$('#btn-ubah-data-pegawai22').click(function() {
		$('#namaPegawai22').removeAttr('disabled')
// 		$('#nipPegawai22').removeAttr('disabled')
		$('#tempatPegawai22').removeAttr('disabled')
		$('#tanggalPegawai22').removeAttr('disabled')
		$('#emailPegawai22').removeAttr('disabled')
		$('#teleponPegawai22').removeAttr('disabled')
		$('#provinsiPegawai22').removeAttr('disabled')
		$('#kabupatenPegawai22').removeAttr('disabled')
		$('#kecamatanPegawai22').removeAttr('disabled')
		$('#kelurahanPegawai22').removeAttr('disabled')
		$('#alamatPegawai22').removeAttr('disabled')
		$('#usernamePegawai22').removeAttr('disabled')
		$('#passwordPegawai22').removeAttr('disabled')
		$('#gradePegawai2').removeAttr('disabled')
		$('.btn-ubahFoto2').hide()
		$('.btn-perbarui-pegawai22').show()
		$('#btn-ubah-data-pegawai22').hide()
	})

	$('.close-ubah-foto2').click(function() {
		var id = $('.foto-ubah-id2').val();
		profilAdmin(id)
	})

	$('#btn-ubah-profil22').click(function() {
		var id = $('#idPegawai22').val();
		$('#modal-profil-admin2').modal('hide')
		$('#modal-ubah-foto2').appendTo("body")
		$('#modal-ubah-foto2').modal('show')
		$('.foto-ubah-id2').val(id)
		$('.title-modal-foto').text('Ubah Foto Profil')
		$('.btn-perbarui-title').text('Perbarui Foto Profil')
		$('.btn-perbarui-foto2').attr('id', 'perbarui-foto-profil22')
		$('.input-foto22').attr('id', 'input-foto-profil22')
	})

	$(document).on('click', '#perbarui-foto-profil22', function(e) {
		var id = $('#idPegawai22').val()
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
				fd.append('id', $('#idPegawai22').val())
				fd.append('nama', $('#namaPegawai22').val())
				fd.append('foto_profil', $('#input-foto-profil22')[0].files[0])
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
							profilAdmin(id)
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

	$('.btn-perbarui-pegawai22').click(function() {
		var id = $('#idPegawai22').val();
		var nama = $('#namaPegawai22').val()
		var username = $('#usernamePegawai22').val()
		$.ajax({
			type: 'post',
			url: `<?= base_url('cek-data-admin-detail2') ?>`,
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
							fd.append('id', $('#idPegawai22').val())
							fd.append('nama', $('#namaPegawai22').val())
				// 			fd.append('nip', $('#nipPegawai22').val())
							fd.append('tempat_lahir', $('#tempatPegawai22').val())
							if ($('#tanggalPegawai22').val() !== ''){
							    fd.append('tgl_lahir', $('#tanggalPegawai22').val())
							}
							fd.append('email', $('#emailPegawai22').val())
							fd.append('telepon', $('#teleponPegawai22').val())
							if ($('#provinsiPegawai22').val() !== ''){
							    fd.append('provinsi', $('#provinsiPegawai22').val())
							}
							if ($('#kabupatenPegawai22').val() !== ''){
							    fd.append('kabupaten', $('#kabupatenPegawai22').val())
							}
							if ($('#kecamatanPegawai22').val() !== ''){
							    fd.append('kecamatan', $('#kecamatanPegawai22').val())
							}
							if ($('#kelurahanPegawai22').val() !== ''){
							    fd.append('kelurahan', $('#kelurahanPegawai22').val())
							}
							fd.append('alamat', $('#alamatPegawai22').val())
							fd.append('username', $('#usernamePegawai22').val())
							fd.append('password', $('#passwordPegawai22').val())
							$.ajax({
								type: 'post',
								url: `<?= base_url('ubah-data-admin2') ?>`,
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
										profilAdmin(id)
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



</body>

</html>
