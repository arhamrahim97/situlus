<div class="row">
	<div class="col-lg-9 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Data Simpanan Wajib Perbulan</h4>
			</div>
			<div class="card-body py-3 px-3">
				<div class="table-reponsive">
					<table class="table table-sm table-striped" id="table">
						<thead>
							<tr class="text-center">
								<th>created_at</th>
								<th>Tagihan</th>
								<th>Total Bayar</th>
								<th>Tanggal Bayar</th>
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
	<div class="col-lg-3 col-sm-12">
		<div class="row">
			<div class="col">
				<div class="card card-statistic-2 pt-2 pb-1">
					<div class="card-stats">
						<div class="card-stats-items w-100">
							<div class="card-stats-item w-100 py-0">
								<h5 class="mb-0">Simpanan Wajib</h5>
							</div>
						</div>
					</div>
					<div class="card-body px-2 pt-0">
						<div class="card-icon shadow-info bg-info">
							<i class="fas fa-archive"></i>
						</div>
						<div class="card-wrap pt-1">
							<div class="card-header mb-1">
								<h4>Total Simpanan</h4>
							</div>
							<div class="card-body">
								<?php if ($count_simpanan_wajib !== 0) : ?>
									<h5 id="sp-rp">Rp. <?= number_format($simpanan_wajib->total_simpanan, 0, '', '.') ?></h5>
								<?php else : ?>
									Rp. 0
								<?php endif; ?>
							</div>
							<div class="card-footer text-center mx-0">
								<button class="btn btn-sm btn-primary" onclick="detailSW('<?= $this->session->userdata('id') ?>')"><i class="fas fa-info-circle"></i> Detail Riwayat Pencairan </button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="card card-statistic-2 pt-4 pb-1">
					<div class="card-stats">
						<div class="card-stats-items w-100">
							<div class="card-stats-item w-100">
								<h5>Simpanan Pokok</h5>
								<strong>
									<?php if ($simpanan_pokok) { ?>
										<?php if ($simpanan_pokok->status == 1) : ?>
											<div class="badge badge-success" data-toggle="tooltip" data-placement="left">Sudah Lunas</div>
										<?php elseif ($simpanan_pokok->status == 0) : ?>
											<div class="badge badge-danger" data-toggle="tooltip" data-placement="left">Belum Lunas</div>
										<?php elseif ($simpanan_pokok->status == 2) : ?>
											<div class="badge badge-warning" data-toggle="tooltip" data-placement="left">Dana Dicairkan</div>
										<?php endif; ?>
									<?php } else { ?>
										<div class="badge badge-primary" data-toggle="tooltip" data-placement="left">Belum Ada</div>
									<?php } ?>
								</strong>
							</div>
						</div>
					</div>
					<div class="card-body px-2 pt-3">
						<div class="card-icon shadow-warning bg-warning">
							<i class="fas fa-archive"></i>
						</div>
						<div class="card-wrap pt-1">
							<div class="card-header mb-1">
								<h4>Total Simpanan</h4>
							</div>
							<div class="card-body">
								<?php if ($simpanan_pokok) { ?>
									<h5 id="sp-rp">Rp. <?= number_format($simpanan_pokok->total_simpanan_pokok, 0, '', '.') ?></h5>
								<?php } else { ?>
									<h5 id="sp-rp">Rp. 0</h5>
								<?php } ?>
							</div>
							<div class="card-footer text-center mx-0">
								<?php if ($simpanan_pokok) { ?>
									<button class="btn btn-sm btn-primary" onclick="detailSP('<?= $simpanan_pokok->id ?>')"><i class="fas fa-info-circle"></i> Detail Simpanan Pokok </button>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>


<!-- Modal Detail Simpanan Pokok -->
<div class="modal fade modal-sp" id="modal-sp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header px-3">
				<h5 class="modal-title" id="exampleModalLongTitle">Simpanan Pokok</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-3">
				<div class="row">
					<div class="col">
						<div class="div" id="detail-sp">

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

<!-- Modal Detail Simpanan Wajib Total -->
<div class="modal fade modal-sw-total" id="modal-sw-total" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px !important;">
		<div class="modal-content">
			<div class="modal-header px-3">
				<h5 class="modal-title" id="exampleModalLongTitle">Riwayat Pencairan Simpanan Wajib</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-3">
				<div class="row">
					<div class="col">
						<div class="div" id="detail-sw-total">

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
	<?php if ($title == "Simpanan Wajib & Simpanan Pokok") : ?>
		$(document).ready(function() {
			$('.sp-rp').mask('000.000.000.000.000', {
				reverse: true
			});
		});

	<?php endif; ?>
</script>

<script>
	$(document).ready(function() {
		$("#table").DataTable({
			"autoWidth": false,
			ajax: {
				url: '<?php echo base_url('pegawai-get-simpanan-wajib') ?>',
				dataSrc: ''
			},
			"columnDefs": [{
				"visible": false,
				"targets": 0
			}],
			"order": [
				[0, "desc"]
			],
			columns: [{
					data: 'created_at',
				},
				{
					data: 'created_at',
					render: function(data, type, row, meta) {
						var locale = 'id';
						return moment(data).locale(locale).format('MMMM YYYY');
					},
					className: 'text-center'
				},
				{
					data: 'total_simpanan_wajib',
					render: $.fn.dataTable.render.number('.'),
					className: 'text-center'
				},

				// {
				//     data: 'status_akun',
				//     render: function(data, type, row, meta) {
				//         if (data == 1) {
				//             return `<div class="badge badge-success" data-toggle="tooltip" data-placement="left">Aktif</div>`
				//         } else if (data == 2) {
				//             return `<div class="badge badge-danger" data-toggle="tooltip" data-placement="left">Tidak Aktif</div>`
				//         }
				//     },
				//     className: 'text-center'
				// },
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
					data: 'status',
					render: function(data, type, row, meta) {
						if (data == 0) {
							return `<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak">Belum Bayar</div>`
						} else if (data == 1) {
							return `<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Ditolak">Sudah Bayar</div>`
						}
					},
					className: 'text-center'
				},
			]
		})
	})
</script>

<script>
	$('.modal').appendTo("body");

	function detailSP(id) {
		$.ajax({
			url: '<?= base_url('pegawai-get-simpanan-pokok') ?>',
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#detail-sp').html(data);
				$('#modal-sp').modal('show');
			}
		})
	}

	function detailSW(id) {
		$.ajax({
			url: '<?= base_url('pegawai-get-detail-simpanan-wajib') ?>',
			type: 'post',
			data: {
				id: id
			},
			success: function(data) {
				$('#detail-sw-total').html(data);
				$('#modal-sw-total').modal('show');
				$("#table2").DataTable({
					"order": [
						[0, "desc"]
					]
				})
			}
		})
	}
</script>