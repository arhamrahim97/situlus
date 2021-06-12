<div class="row">
	<div class="col-lg-5 col-sm-12 pr-1">
		<div class="card">
			<div class="card-header">
				<h4>Syarat dan Ketentuan Peminjaman</h4>
			</div>
			<div class="card-body py-1">
				<ul class="list-group list-group-flush">
					<?php foreach ($s_k as $s) : ?>
						<li class="list-group-item px-2">
							<table>
								<tr>
									<td class="pr-4"><?= $s->nomor ?>.</td>
									<td><?= $s->isi ?></td>
								</tr>
							</table>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-lg-7 col-sm-12 mx-auto">
		<div class="row">
			<div class="col">
				<div id="pemberitahuan-konfirmasi">

				</div>
			</div>
		</div>
		<div class="row" id="card-form-peminjaman" style="display: none;">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<h4>Form Peminjaman</h4>
						<div class="card-header-action">
							<div class="input-group-btn">
								<a class="btn btn-danger" href="#data-peminjaman" id="btn-tutup-peminjaman"><i class="fas fa-times"></i> Tutup</a>
							</div>
						</div>
					</div>
					<div class="form" id="form-peminjaman">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<div class="form-group mb-3">
										<label>Upload surat pernyataan tidak meminjam di Bank</label>
										<div class="custom-file custom-file-sm">
											<input type="file" class="custom-file-input form-control " id="input-surat" name="input_surat" accept=".pdf,.doc,.docx">
											<label class="custom-file-label" for="customFile">Pilih file</label>
											<div class="mt-1 ml-1">
												<small>* Ukuran file maksimal 2MB.</small>
											</div>
										</div>
									</div>
									<div class="form-group mb-3">
										<label>Nominal Peminjaman:</label>
										<input type="text" class="form-control " id="input-nominal" name="input_nominal">
									</div>
									<div class="form-group mb-3">
										<label>Tenor / Jangka Waktu Peminjaman (Bulan):</label>
										<input type="number" class="form-control " id="input-tenor" name="input_tenor">
									</div>
									<div class="float-right">
										<a class="btn btn-primary btn-sm" href="#hasil-kalkukasi-pinjaman" id="btn-kalkulasi-pinjaman"><i class="fas fa-calculator"></i> Hitung</a>
									</div>
								</div>
							</div>
							<div class="row" id="hasil-kalkulasi-pinjaman" style="display: none;">
								<div class="col">
									<h6 class="mt-2">Hasil Kalkulasi</h6>
									<hr>
									<table class="table">
										<tbody>
											<tr>
												<td class="px-2" style="height: 35px !important;">
													Total Pinjaman
												</td>
												<td class="px-2" style="height: 35px !important;">=</td>
												<td class="px-2" style="height: 35px !important;">
													Rp. <input type="text" class="p-0 m-0" id="hasil-total" name="hasil_total" style="display: inline; font-weight: bold; width: 90px; border: 0px; cursor: default;" readonly></input>
												</td>
											</tr>
											<tr>
												<td class="px-2" style="height: 35px !important;">
													Total + Bunga (<?= $bunga . '%' ?>)
													<input class="form-control" type="hidden" name="input_bunga" id="input-bunga" value="<?= $bunga ?>">
												</td>
												<td class="px-2" style="height: 35px !important;">=</td>
												<td class="px-2" style="height: 35px !important;">
													Rp. <input type="text" class="p-0 m-0" id="hasil-total-bunga" name="hasil_total_bunga" style="display: inline; width: 90px; border: 0px; cursor: default;" readonly></input>
												</td>
											</tr>

											<tr>
												<td class="px-2" style="height: 35px !important;">
													Pembayaran (<p id="tenor-label" style="display: inline;"></p>x)
												</td>
												<td class="px-2" style="height: 35px !important;">=</td>
												<td class="px-2" style="height: 35px !important; font-weight: bold;">
													Rp. <input class="p-0 m-0" id="hasil-tenor" name="hasil_tenor" style="display: inline; font-weight: bold; width: 80px; border: 0px; cursor: default;" readonly></input> / bulan
												</td>
											</tr>
										</tbody>
									</table>
									<div class="float-right" style="display: block;">
										<button class="btn btn-primary btn-sm" id="btn-proses-peminjaman"><i class="fas fa-arrow-circle-right"></i> Proses Peminjaman</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="data-peminjaman">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<h4>Data Peminjaman</h4>
						<div class="card-header-action">
							<div class="input-group-btn">
								<a class="btn btn-primary" href="#card-form-peminjaman" id="btn-ajukan-peminjaman"><i class="fas fa-hand-holding-usd"></i> Ajukan Peminjaman</a>
							</div>
						</div>
					</div>
					<div class="card-body py-3 px-3">
						<div class="table-reponsive">
							<table class="table table-sm table-striped" id="peminjaman-table">
								<thead>
									<tr class="text-center">
										<th>Kode Pinjaman</th>
										<th>Total Pinjaman (Rp)</th>
										<th>Lunas</th>
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




<!-- Modal Detail Peminjaman -->
<div class="modal fade modal-peminjaman" id="modal-peminjaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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


<script>
	function dataPeminjaman() {
		$.ajax({
			type: 'get',
			url: `<?= base_url('peminjaman-data') ?>`,
			dataType: 'json',
			success: function(response) {
				$('#peminjaman-table').DataTable({
					data: response,
					order: [
						[0, "desc"]
					],
					columns: [{
							data: "id",
							className: 'text-center',
							width: '15%'
						},
						{
							data: "total_pinjaman",
							className: 'text-center',
							render: $.fn.dataTable.render.number('.')

						},
						{
							data: function(row) {
								if (row.status_pinjaman == 0) {
									return `
								<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Belum Lunas"><i class="fas fa-times"></i></div>`
								} else if (row.status_pinjaman == 1) {
									return `
								<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Sudah Lunas"><i class="fas fa-check"></i></div>`
								}
							},
							className: 'text-center'
						},
						{
							orderable: false,
							searchable: false,
							data: function(row) {
								return `
							<button class="btn btn-sm btn-primary detailpinjaman" id="${row.id}"><i class="fas fa-info-circle"></i></button>`
							},
							className: 'text-center'
						}
					]
				})
			}

		})
	}

	function pemberitahuanDitolak() {
		$.ajax({
			url: `<?= base_url('pemberitahuan-konfirmasi-admin') ?>`,
			type: 'get',
			success: function(data) {
				$('#pemberitahuan-konfirmasi').html(data)
				$('.nominal-pinjaman-ditolak').mask('000.000.000.000.000', {
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



	$(document).ready(function() {
		dataPeminjaman()
		pemberitahuanDitolak()
		bsCustomFileInput.init()

	});

	$(document).on('click', '.detailpinjaman', function(e) {

		$('#peminjaman-table').DataTable().destroy()
		dataPeminjaman()


		var id = $(this).attr('id')
		$.ajax({
			url: `<?= base_url('peminjaman-detail') ?>`,
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#detail').html(data)
				$('#modal-peminjaman').modal('show')
				$('#modal-peminjaman').appendTo('body')
				$('#det-total-pinjaman').mask('000.000.000.000.000', {
					reverse: true
				});
				$('#det-pembayaran-perbulan').mask('000.000.000.000.000', {
					reverse: true
				});
			}
		})
	})


	$(document).on('click', '.hapus-pemberitahuan', function(e) {
		var id = $(this).attr('id')
		$.ajax({
			type: 'post',
			url: `<?= base_url('peminjaman-hapus-pemberitahuan') ?>`,
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


	$('#btn-ajukan-peminjaman').click(function() {
		$.ajax({
			type: 'post',
			url: `<?= base_url('cek-peminjaman') ?>`,
			dataType: 'json',
			success: function(response) {
				if (response.res == 'success') {
					$('#card-form-peminjaman').slideDown()
				} else if (response.res == 'error1') {
					Swal.fire({
						icon: 'error',
						title: 'Gagal',
						text: 'Maaf, anda belum dapat mengajukan pinjaman sampai pinjaman anda sebelumnya telah dikonfirmasi oleh admin.'
					})
				} else if (response.res == 'error2') {
					Swal.fire({
						icon: 'error',
						title: 'Gagal',
						text: 'Maaf, anda belum dapat mengajukan pinjaman apabila masih terdapat pinjaman yang belum lunas.'
					})
				}
			}

		})

	})

	$('#btn-tutup-peminjaman').click(function() {
		$('#card-form-peminjaman').slideUp()
	})

	$('#input-nominal').click(function() {
		$('#input-nominal').mask('000.000.000.000.000', {
			reverse: true
		});
		$('#hasil-total').val('')
		$('#hasil-total-bunga').val('')
		$('#hasil-tenor').val('')
		$('#tenor-label').text('')
	})

	$('#input-tenor').click(function() {
		$('#input-tenor').mask('000.000.000.000.000', {
			reverse: true
		});
		$('#hasil-total').val('')
		$('#hasil-total-bunga').val('')
		$('#hasil-tenor').val('')
		$('#tenor-label').text('')
	})


	$('#btn-kalkulasi-pinjaman').click(function() {
		var total_pinjaman = $('#input-nominal').val()
		var tenor_pinjaman = $('#input-tenor').val()
		var surat_pernyataan = $('#input-surat').val()
		if ((total_pinjaman == "") || (tenor_pinjaman == "") || (surat_pernyataan == "")) {
			Swal.fire(
				'Inputan tidak lengkap',
				'Nominal Pinjaman, Tenor Pinjaman, ataupun Surat Pernyataan tidak boleh kosong',
				'warning'
			)
			// alert('inputan tidak lengkap')
		} else {
			$('#input-nominal').unmask()
			$('#hasil-total').unmask()
			$('#hasil-total-bunga').unmask()
			$('#hasil-tenor').unmask()

			$('#tenor-label').text($('#input-tenor').val())
			$('#hasil-total').val($('#input-nominal').val()).mask('000.000.000.000.000', {
				reverse: true
			})
			var bunga = (<?= $bunga ?> / 100) * parseFloat($('#input-nominal').val())
			var total = parseFloat($('#input-nominal').val()) + parseFloat(bunga)
			$('#hasil-total-bunga').val(total.toFixed()).mask('000.000.000.000.000', {
				reverse: true
			})

			var tenor = parseFloat(total) / parseFloat($('#input-tenor').val())
			$('#hasil-tenor').val(tenor.toFixed()).mask('000.000.000.000.000', {
				reverse: true
			})
			$('#hasil-kalkulasi-pinjaman').slideDown()
		}


	})

	$('#btn-proses-peminjaman').click(function(e) {
		e.preventDefault()
		$('#hasil-total').unmask()
		$('#hasil-total-bunga').unmask()
		$('#hasil-tenor').unmask()
		var total_pinjaman = $('#hasil-total').val()
		var tenor_pinjaman = $('#input-tenor').val()
		var bunga_pinjaman = $('#input-bunga').val()
		var total_pinjaman_bunga = $('#hasil-total-bunga').val()
		var pembayaran_perbulan = $('#hasil-tenor').val()
		var surat_pernyataan = $('#input-surat')[0].files[0]

		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Pengajuan peminjaman akan diteruskan ke Admin, jika disetujui maka data pinjaman akan muncul otomatis ditabel Data Pinjaman",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, teruskan ke Admin',
			cancelButtonText: 'Batalkan'
		}).then((result) => {
			if (result.isConfirmed) {
				var fd = new FormData()
				fd.append('total_pinjaman', total_pinjaman)
				fd.append('tenor_pinjaman', tenor_pinjaman)
				fd.append('total_pinjaman_bunga', total_pinjaman_bunga)
				fd.append('pembayaran_perbulan', pembayaran_perbulan)
				fd.append('bunga_pinjaman', bunga_pinjaman)
				fd.append('surat_pernyataan', surat_pernyataan)

				$.ajax({
					type: 'post',
					url: `<?= base_url('peminjaman-insert') ?>`,
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
								timer: 3000
							})
							$('#card-form-peminjaman').slideUp();
							$('#input-surat').val('')
							$('.custom-file-label').text('Pilih file')
							$('#input-nominal').val('')
							$('#input-tenor').val('')
							$('#hasil-kalkulasi-pinjaman').slideUp()
							$('#peminjaman-table').DataTable().destroy()
							dataPeminjaman();
							pemberitahuanDitolak()
						} else {
							Swal.fire({
								icon: 'error',
								title: response.message,
							})
							$('#hasil-total').mask('000.000.000.000.000', {
								reverse: true
							})
							$('#hasil-total-bunga').mask('000.000.000.000.000', {
								reverse: true
							})
							$('#hasil-tenor').mask('000.000.000.000.000', {
								reverse: true
							})
						}
					}

				})
			} else {
				$('#hasil-total').mask('000.000.000.000.000', {
					reverse: true
				})
				$('#hasil-total-bunga').mask('000.000.000.000.000', {
					reverse: true
				})
				$('#hasil-tenor').mask('000.000.000.000.000', {
					reverse: true
				})
			}
		})
	})
</script>
