<div class="row">
	<div class="col-lg-12 col-sm-12 mx-auto">
		<div class="row" id="data-voucher">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<h4>Proses Voucher Belanja</h4>
					</div>
					<div class="card-body py-3 px-2">
						<ul class="list-group list-group-flush">
							<li class="list-group-item px-1 py-1">
								<p style="display: inline;">ID Voucher :</p>
								<strong style="float: right;"><?= $voucher->id ?></strong>
							</li>
							<li class="list-group-item px-1 py-1">
								<p style="display: inline;">Nama Pemilik Voucher :</p>
								<strong style="float: right;"><?= $voucher->nama ?></strong>
							</li>
							<li class="list-group-item px-1 py-1">
								<p style="display: inline;">Limit Voucher :</p>
								<strong style="float: right;"><?= "Rp. " . number_format($voucher->limit_voucher, 0, '', '.') ?></strong>
							</li>
							<li class="list-group-item px-1 py-1">
								<p style="display: inline;">Total Belanja Struk :</p>
								<strong style="float: right;"><?= "Rp. " . number_format($voucher->total_belanja_kasir, 0, '', '.') ?></strong>
							</li>
							<li class="list-group-item px-1 py-1">
								<p style="display: inline;">Struk Belanja :</p>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#strukBelanja" style="float:right">
									Lihat Struk Belanja
								</button>
							</li>
						</ul>
					</div>
					<div class="card-header ">
						<h4 class="text-center">Daftar Barang</h4>
					</div>
					<div class="card-body py-3 px-2">
						<div class="form-row align-items-center ml-3">
							<div class="col-auto">
								<button type="submit" class="btn btn-warning" data-target="#modalTambah" data-toggle="modal">Tambah Master Barang</button>
							</div>
							<div class="col-8">
								<label class="sr-only" for="inlineFormInput">Name</label>
								<select class="js-example-basic-single custom-select select2" name="state" style="width: 100%;" id="daftarBarang">

								</select>
							</div>
							<div class="col-auto">
								<button type="submit" class="btn btn-primary" id="btnTambahBarang">Tambah Daftar Barang</button>
							</div>
						</div>
						<form action="<?= base_url('simpan-proses-pembayaran') ?>" id="prosesPembayaran" method="POST">
							<input type="hidden" name="id" value="<?= $voucher->id ?>">
							<div class="list_barang mt-5">
								<table class="table">
									<thead class="text-center">
										<tr>
											<th scope="col">Nama Barang</th>
											<th scope="col">Harga</th>
											<th scope="col">Jumlah</th>
											<th scope="col">Total</th>
											<th scope="col">Aksi</th>
										</tr>
									</thead>
									<tbody id="listDaftarBarang">
										<tr id="barangBelumAda">
											<td colspan="5" class="text-center">
												<p>Daftar Barang Belum Ada</p>
												</th>
										</tr>
									</tbody>
									<tfoot id="detailAkhirBelanja">

									</tfoot>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>

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
				<a href="uploads/img/fotoStruk/<?= $voucher->struk ?>" target="_blank"><img class="img-fluid" src="uploads/img/fotoStruk/<?= $voucher->struk ?>" alt=""></a>
			</div>
		</div>
	</div>
</div>


<script src=" <?= base_url('assets/stisla/js/accounting.min.js') ?>"></script>

<script>
	var i = 0;
	var totalBelanja = false;
	var totalHargaAkhir = 0;
	var bunga = <?= $pengaturan->bunga_voucher ?>;
	var totalBunga = 0;
	var totalPembayaran = 0;
	var jumlahPajak = 0;
	var totalBelanjaKasir = <?= $voucher->total_belanja_kasir ?>

	$('.modal').appendTo("body");

	$(document).ready(function() {
		$('#daftarBarang').select2();
		daftarBarang();
	});

	function daftarBarang() {
		$.ajax({
			url: `<?= base_url('daftar-barang-admin') ?>`,
			type: 'post',
			success: function(data) {
				$('#daftarBarang').html(data)
			}
		})
	}

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
			Swal.fire({
				title: 'Apakah anda yakin ingin menambah barang ini ?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Yakin',
				cancelButtonText: 'Batalkan'
			}).then((result) => {
				if (result.isConfirmed) {
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
								daftarBarang();
							}
						}
					});
				}
			})

		}
	})

	$('#btnTambahBarang').click(function() {
		var barang = $('#daftarBarang').val();
		if (!barang) {
			Swal.fire(
				'Inputan tidak lengkap',
				'Harap Pilih Barang',
				'warning'
			);
		} else {
			$('#barangBelumAda').remove();
			i++;
			$.ajax({
				url: `<?= base_url('tambah-daftar-barang-admin') ?>`,
				type: 'post',
				data: {
					id: barang,
					i: i
				},
				success: function(data) {
					$('#listDaftarBarang').append(data);
					if (totalBelanja == false) {
						$('#detailAkhirBelanja').append('<tr id="pajak" class="text-center"> <td colspan="1"> <p class=" mt-3">Pajak Struk</p> </td> <td colspan="4"> <div class="input-group"> <div class="input-group-prepend"> <div class="input-group-text">Rp.</div> </div> <input type="text" class="form-control pajak" id="jumlahPajak" placeholder="Jumlah Pajak" name="pajak" onkeyup="hitungPajak();" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"> </div> </td> </tr>');
						$('#detailAkhirBelanja').append('<tr id="totalBelanja"><td colspan="3" class="text-right"><p class="font-weight-bold" >Total Belanja : </p></td><td colspan = "2"class ="text-left"><p class="font-weight-bold totalBelanjaAkhir">Rp.0</p></td></tr><tr id="bunga"><td colspan="3" class="text-right"><p class="font-weight-bold" >Bunga(' + <?= $pengaturan->bunga_voucher ?> + '%) : </p></td><td colspan = "2"class ="text-left"><p class="font-weight-bold bunga">Rp.0</p></td></tr><tr id="totalPembayaran"><td colspan="3" class="text-right"><p class="font-weight-bold" >Total Pembayaran : </p></td><td colspan = "2" class ="text-left"><p class="font-weight-bold totalPembayaran">Rp.0</p></td></tr><tr id="btnProses"><td colspan = "5" class ="text-right"><button type="submit" class="btn btn-primary">Proses Pembayaran</button></td></tr>');
						totalBelanja = true;
					}
				}
			})

		}
	})

	function hitungTotalHarga(id) {
		var hargaBarang = $('#hargaBarang' + id).val();
		var jumlahBarang = $('#jumlahBarang' + id).val();
		var jumlahPajak = $('#jumlahPajak').val();
		var totalHarga = hargaBarang.replaceAll('.', '') * jumlahBarang;
		$('#totalHarga' + id).text("Rp. " + accounting.formatNumber(totalHarga, 0, ".", "."));
		$('#hargaBarang' + id).mask('000.000.000.000.000.000.000.000.000.000.000.000.000.000.000', {
			reverse: true
		});

		var lengthHargaBarang = $('.hargaBarang');
		var lengthJumlahBarang = $('.jumlahBarang');

		totalHargaAkhir = 0;
		totalBunga = 0;
		totalPembayaran = 0;

		for (var i = 0; i < lengthHargaBarang.length; i++) {
			totalHargaAkhir += $(lengthHargaBarang[i]).val().replaceAll('.', '') * $(lengthJumlahBarang[i]).val().replaceAll('.', '');
		}
		totalHargaAkhir = totalHargaAkhir + +jumlahPajak.replaceAll('.', '');
		totalBunga = (bunga / 100 * totalHargaAkhir);
		totalPembayaran = (bunga / 100 * totalHargaAkhir) + totalHargaAkhir;

		$('.totalBelanjaAkhir').text("Rp. " + accounting.formatNumber(totalHargaAkhir, 0, ".", "."));
		$('.bunga').text("Rp. " + accounting.formatNumber(totalBunga, 0, ".", "."));
		$('.totalPembayaran').text("Rp. " + accounting.formatNumber(totalPembayaran, 0, ".", "."));
	}

	function hitungPajak() {
		var jumlahPajak = $('#jumlahPajak').val();
		$('#jumlahPajak').mask('000.000.000.000.000.000.000.000.000.000.000.000.000.000.000', {
			reverse: true
		});

		var lengthHargaBarang = $('.hargaBarang');
		var lengthJumlahBarang = $('.jumlahBarang');

		totalHargaAkhir = 0;
		totalBunga = 0;
		totalPembayaran = 0;
		for (var i = 0; i < lengthHargaBarang.length; i++) {
			totalHargaAkhir += $(lengthHargaBarang[i]).val().replaceAll('.', '') * $(lengthJumlahBarang[i]).val().replaceAll('.', '');
		}

		totalHargaAkhir = totalHargaAkhir + +jumlahPajak.replaceAll('.', '');
		totalBunga = (bunga / 100 * totalHargaAkhir);
		totalPembayaran = (bunga / 100 * totalHargaAkhir) + totalHargaAkhir;
		// console.log(totalHargaAkhir);

		$('.totalBelanjaAkhir').text("Rp. " + accounting.formatNumber(totalHargaAkhir, 0, ".", "."));
		$('.bunga').text("Rp. " + accounting.formatNumber(totalBunga, 0, ".", "."));
		$('.totalPembayaran').text("Rp. " + accounting.formatNumber(totalPembayaran, 0, ".", "."));
	}

	$(document).on('click', '.btn-hapus', function() {
		var button_id = $(this).attr("id");
		var listBarang = $('.listBarang').length;
		var hargaBarang = $('#hargaBarang' + button_id).val();
		var jumlahBarang = $('#jumlahBarang' + button_id).val();
		var jumlahPajak = $('#jumlahPajak').val();
		totalHargaAkhir -= hargaBarang.replaceAll('.', '') * jumlahBarang;
		totalBunga = (bunga / 100 * totalHargaAkhir);
		totalPembayaran = (bunga / 100 * totalHargaAkhir) + totalHargaAkhir;

		$('.totalBelanjaAkhir').text("Rp. " + accounting.formatNumber(totalHargaAkhir, 0, ".", "."));
		$('.bunga').text("Rp. " + accounting.formatNumber(totalBunga, 0, ".", "."));
		$('.totalPembayaran').text("Rp. " + accounting.formatNumber(totalPembayaran, 0, ".", "."));
		$('#barang' + button_id + '').remove();

		if (listBarang - 1 == 0) {
			$('#listDaftarBarang').append('<tr id="barangBelumAda"><td colspan = "5"class = "text-center" ><p>Daftar Barang Belum Ada</p></th></tr>');
			$('#totalBelanja').remove();
			$('#bunga').remove();
			$('#totalPembayaran').remove();
			$('#btnProses').remove();
			$('#pajak').remove();
			totalBelanja = false;
		}
	});

	$('#prosesPembayaran').submit(function(e) {
		e.preventDefault();
		var lengthHargaBarang = $('.hargaBarang');
		var lengthJumlahBarang = $('.jumlahBarang');
		var pajak = $('#jumlahPajak').val();

		var totalHargaBarang = 0;
		for (var i = 0; i < lengthHargaBarang.length; i++) {
			if ($(lengthHargaBarang[i]).val()) {
				totalHargaBarang += 1;
			};
		}

		var totalJumlahBarang = 0;
		for (var i = 0; i < lengthJumlahBarang.length; i++) {
			if ($(lengthJumlahBarang[i]).val()) {
				totalJumlahBarang += 1;
			};
		}

		if (totalHargaBarang != lengthHargaBarang.length) {
			Swal.fire(
				'Inputan tidak lengkap',
				'Periksa Kembali Harga Barang',
				'warning'
			);
		} else if (totalJumlahBarang != lengthJumlahBarang.length) {
			Swal.fire(
				'Inputan tidak lengkap',
				'Periksa Kembali Jumlah Barang',
				'warning'
			);
		} else if (!pajak) {
			Swal.fire(
				'Inputan tidak lengkap',
				'Periksa Kembali Pajak Struk',
				'warning'
			);
		} else if (totalHargaAkhir != totalBelanjaKasir) {
			Swal.fire(
				'Terjadi Kesalahan',
				'Jumlah Total Belanja Tidak Sama Dengan Total Belanja Struk',
				'warning'
			);
		} else {
			Swal.fire({
				title: 'Apakah anda yakin ingin memproses pembayaran ini ?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Yakin',
				cancelButtonText: 'Batalkan'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url('simpan-proses-pembayaran') ?>',
						type: 'post',
						data: $(this).serialize(),
						dataType: 'json',
						success: function(data) {
							if (data.res == 'error') {
								Swal.fire(
									data.message,
									'',
									'warning'
								);
							} else if (data.res == 'success') {
								Swal.fire({
									position: 'center',
									icon: 'success',
									title: data.message,
									showConfirmButton: false,
									timer: 1500
								})
								setTimeout(function() {
									window.location.replace("<?= base_url('voucher-admin') ?>");
								}, 2000);
							}
						}
					});
				}
			})
		}
	})
</script>