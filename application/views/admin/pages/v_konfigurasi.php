<div class="row">
	<div class="col-lg-6 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Konfigurasi Layanan</h4>
				<div class="card-header-action">
					<div class="input-group-btn">
						<a class="btn btn-primary" href="#" id="btn-ubah-layanan"><i class="fas fa-edit"></i> Ubah</a>
					</div>
				</div>
			</div>
			<div class="card-body py-3 px-3">
				<div id="konfigurasi_layanan">

				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-sm-12 mx-auto">
		<div class="row" id="data-peminjaman">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<h4>Konfigurasi WEB</h4>
						<div class="card-header-action">
							<div class="input-group-btn">
								<a class="btn btn-primary" href="#" id="btn-ubah-web"><i class="fas fa-edit"></i> Ubah</a>
							</div>
						</div>
					</div>
					<div class="card-body py-3 px-3">
						<div id="konfigurasi_web">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	function konfigurasi_layanan() {
		$.ajax({
			url: `<?= base_url('konfigurasi-layanan') ?>`,
			type: 'get',
			success: function(data) {
				$('#konfigurasi_layanan').html(data)
				$('#simpanan-pokok').mask('000.000.000.000.000', {
					reverse: true
				})
				$('#simpanan-wajib').mask('000.000.000.000.000', {
					reverse: true
				})
			}
		})
	}

	function konfigurasi_web() {
		$.ajax({
			url: `<?= base_url('konfigurasi-web') ?>`,
			type: 'get',
			success: function(data) {
				$('#konfigurasi_web').html(data)
			}
		})
	}

	$(document).ready(function() {
		konfigurasi_layanan()
		konfigurasi_web()
	});

	$('#btn-ubah-layanan').click(function() {
		$('#btn-perbarui-layanan').show();
		$('#btn-ubah-layanan').hide();
		$('#bunga-pinjaman').removeAttr('disabled')
		$('#bunga-voucher').removeAttr('disabled')
		$('#simpanan-pokok').removeAttr('disabled')
		$('#simpanan-wajib').removeAttr('disabled')
	})

	$('#btn-ubah-web').click(function() {
		$('#btn-perbarui-web').show();
		$('#btn-ubah-web').hide();
		$('#title-header').removeAttr('disabled')
		$('#title-footer').removeAttr('disabled')
		$('#title-background').removeAttr('disabled')
		$('#jam-buka').removeAttr('disabled')
		$('#telepon').removeAttr('disabled')
		$('#email').removeAttr('disabled')
		$('#facebook').removeAttr('disabled')
		$('#twitter').removeAttr('disabled')
		$('#instagram').removeAttr('disabled')
	})

	$(document).on('click', '.btn-perbarui-layanan2', function(e) {
		$('#simpanan-pokok').unmask()
		$('#simpanan-wajib').unmask()

		var id = $(this).attr('id')
		var bunga_pinjaman = $('#bunga-pinjaman').val()
		var bunga_voucher = $('#bunga-voucher').val()
		var simpanan_pokok = $('#simpanan-pokok').val()
		var simpanan_wajib = $('#simpanan-wajib').val()

		Swal.fire({
			title: 'Apakah anda yakin ingin memperbarui data ?',
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
					url: `<?= base_url('perbarui-layanan') ?>`,
					data: {
						id: id,
						bunga_voucher: bunga_voucher,
						bunga_pinjaman: bunga_pinjaman,
						simpanan_pokok: simpanan_pokok,
						simpanan_wajib: simpanan_wajib
					},
					dataType: 'json',
					success: function(response) {
						if (response.res == 'success') {
							$('#btn-ubah-layanan').show();
							Swal.fire({
								icon: 'success',
								title: response.message,
								showConfirmButton: false,
								timer: 2500
							})
							location.reload()
						} else {
							Swal.fire({
								icon: 'error',
								title: response.message,
							})
						}
					}
				})
			} else {
				konfigurasi_layanan()
				$('#btn-ubah-layanan').show();
			}
		})


	})

	$(document).on('click', '#btl-konfiguras-layanan', function(e) {
		$('#btn-perbarui-layanan').hide();
		$('#btn-ubah-layanan').show();
		$('#bunga-pinjaman').attr('disabled', 'true')
		$('#bunga-voucher').attr('disabled', 'true')
		$('#simpanan-pokok').attr('disabled', 'true')
		$('#simpanan-wajib').attr('disabled', 'true')
	})


	$(document).on('click', '.btn-perbarui-web2', function(e) {
		var id = $(this).attr('id')
		var title_header = $('#title-header').val()
		var title_footer = $('#title-footer').val()
		var title_background = $('#title-background').val()
		var jam_buka = $('#jam-buka').val()
		var telepon = $('#telepon').val()
		var email = $('#email').val()
		var facebook = $('#facebook').val()
		var twitter = $('#twitter').val()
		var instagram = $('#instagram').val()
		Swal.fire({
			title: 'Apakah anda yakin ingin memperbarui data ?',
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
					url: `<?= base_url('perbarui-web') ?>`,
					data: {
						id: id,
						title_header: title_header,
						title_footer: title_footer,
						title_background: title_background,
						jam_buka: jam_buka,
						telepon: telepon,
						email: email,
						facebook: facebook,
						twitter: twitter,
						instagram: instagram
					},
					dataType: 'json',
					success: function(response) {
						if (response.res == 'success') {
							$('#btn-ubah-web').show();
							Swal.fire({
								icon: 'success',
								title: response.message,
								showConfirmButton: false,
								timer: 2500
							})
							location.reload()
						} else {
							Swal.fire({
								icon: 'error',
								title: response.message,
							})
						}
					}
				})
			} else {
				konfigurasi_web()
				$('#btn-ubah-web').show();
			}
		})
	})

	$(document).on('click', '#btl-konfiguras-web', function(e) {
		$('#btn-perbarui-web').hide();
		$('#btn-ubah-web').show();
		$('#title-header').attr('disabled', 'true')
		$('#title-footer').attr('disabled', 'true')
		$('#title-background').attr('disabled', 'true')
		$('#jam-buka').attr('disabled', 'true')
		$('#telepon').attr('disabled', 'true')
		$('#email').attr('disabled', 'true')
		$('#facebook').attr('disabled', 'true')
		$('#twitter').attr('disabled', 'true')
		$('#instagram').attr('disabled', 'true')

	})
</script>