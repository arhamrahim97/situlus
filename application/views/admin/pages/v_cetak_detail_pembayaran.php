<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title_header . ' - ' . $title ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/stisla/modules/bootstrap/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/stisla/modules/fontawesome/css/all.min.css' ?>">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/stisla/modules/datatables/Responsive-2.2.1/css/responsive.bootstrap4.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/stisla/modules/select2/dist/css/select2.min.css' ?>">


    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/stisla/css/style.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/stisla/css/components.css' ?>">

    <style>
        .card {
            box-shadow: 0px 0px 5px rgb(0 0 0 / 10%) !important;
        }

        .btn-outline-white:hover {
            color: #2299aa;
        }

        select.form-control.form-control-sm {
            height: 31px !important;
            padding: 0px !important;
        }

        label {
            margin-bottom: 0px !important;
        }

        div.dataTables_wrapper div.dataTables_paginate {
            margin-top: 12px !important;
        }

        .has-error {
            /*border: 1px solid #a94442;
    border-radius: 4px;*/
            border-color: rgb(185, 74, 72) !important;
        }

        .modal {
            overflow-y: auto;
        }

        .dataTables_filter {
            display: inline !important;
            float: right;
        }

        .dt-buttons {
            display: inline !important;
        }

        .dataTables_length {
            display: inline !important;

        }

        /* .select2 {
			width: 340px !important;
		} */
    </style>

    <!-- General JS Scripts -->
    <script src=" <?= base_url() . 'assets/stisla/modules/jquery.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/popper.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/tooltip.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/bootstrap/js/bootstrap.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/nicescroll/jquery.nicescroll.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/moment.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/js/stisla.js' ?>"></script>

    <!-- JS Libraies -->
    <script src="<?= base_url() . 'assets/stisla/modules/datatables/jquery.dataTables.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/datatables/Responsive-2.2.1/js/dataTables.responsive.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/datatables/Responsive-2.2.1/js/responsive.bootstrap4.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/datatables/dataTables.buttons.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/datatables/jszip.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/datatables/vfs_fonts.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/datatables/buttons.html5.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/datatables/buttons.print.min.js' ?>"></script>

    <script src="<?= base_url() . 'assets/stisla/modules/moment/moment-with-locales.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/bs-custom-file-input/bs-custom-file-input.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/sweetalert/sweetalert2.all.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/jquery-mask/jquery.mask.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/modules/select2/dist/js/select2.min.js' ?>"></script>


    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url() . 'assets/stisla/js/scripts.js' ?>"></script>
    <script src="<?= base_url() . 'assets/stisla/js/custom.js' ?>"></script>
</head>

<div class="row" id="detailPembayaran">
    <div class="col-lg-12 col-sm-12">
        <div class="row" id="data-voucher">
            <div class="col">
                <div class="card px-5">
                    <h5 class="text-center mt-5">Detail Pembayaran Voucher</h5>
                    <div class="card-body py-3 px-2">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-1 py-1">
                                <p style="display: inline;">ID Voucher :</p>
                                <strong style="float: right;"><?= $voucher->id ?></strong>
                            </li>
                            <li class="list-group-item px-1 py-1">
                                <p style="display: inline;">Tgl Pengajuan Voucher :</p>
                                <strong style="float: right;"><?= date("d-m-Y", strtotime($voucher->tgl_pengusulan)) ?></strong>
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
                                <p style="display: inline;">Total Pembayaran Voucher :</p>
                                <strong style="float: right;"><?= "Rp. " . number_format($totalPembayaran, 0, '', '.') ?></strong>
                            </li>
                            <li class="list-group-item px-1 py-1">
                                <p style="display: inline;">Tgl Konfirmasi Admin :</p>
                                <strong style="float: right;"><?= date("d-m-Y", strtotime($voucher->tgl_konfirmasi_admin)) . ' (' . $this->m_admin_voucher->getNama($voucher->id_admin) ?>)</strong>
                            </li>
                            <li class="list-group-item px-1 py-1">
                                <p style="display: inline;">Tgl Konfirmasi Kasir :</p>
                                <strong style="float: right;"><?= date("d-m-Y", strtotime($voucher->tgl_konfirmasi_admin)) . ' (' . $this->m_admin_voucher->getNama($voucher->id_kasir) ?>)</strong>
                            </li>
                            <li class="list-group-item px-1 py-1">
                                <p style="display: inline;">Tgl Konfirmasi Pembayaran :</p>
                                <strong style="float: right;"><?= date("d-m-Y", strtotime($voucher->tgl_konfirmasi_pembayaran)) . ' (' . $this->m_admin_voucher->getNama($voucher->id_admin_pembayaran) ?>)</strong>
                            </li>

                        </ul>
                    </div>
                    <h5 class="text-center">Daftar Barang</h5>
                    <div class="card-body py-3 px-2">
                        <div class="list_barang">
                            <table class="table">
                                <thead class="text-center">
                                    <tr style="border-bottom: 2px solid grey;">
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="listDaftarBarang">
                                    <?php foreach ($detailBarang as $barang) : ?>
                                        <tr class="text-center" style="border-bottom: 2px solid grey;">
                                            <td>
                                                <p class="mt-3"><?= $barang->nama_barang ?></p>
                                            </td>
                                            <td>
                                                <?= "Rp. " . number_format($barang->harga_barang, 0, '', '.') ?>
                                            </td>
                                            <td>
                                                <?= $barang->jumlah_barang ?>
                                            </td>
                                            <td>
                                                <?= "Rp. " . number_format($barang->harga_barang * $barang->jumlah_barang, 0, '', '.') ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot id="detailAkhirBelanja">
                                    <tr id="pajak" class="text-center table-primary" style="border-bottom: 2px solid grey;">
                                        <td colspan="1">
                                            <p class="mt-3 font-weight-bold">Pajak Struk</p>
                                        </td>
                                        <td colspan="4">
                                            <p class="mt-3"><?= "Rp. " . number_format($voucher->pajak_struk, 0, '', '.') ?></p>
                                        </td>
                                    </tr>
                                    <tr id="totalBelanja">
                                        <td colspan="3" class="text-right">
                                            <p class="font-weight-bold">Total Belanja : </p>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <p class="font-weight-bold totalBelanjaAkhir"><?= "Rp. " . number_format($totalBelanja, 0, '', '.')  ?></p>
                                        </td>
                                    </tr>
                                    <tr id="bunga">
                                        <td colspan="3" class="text-right">
                                            <p class="font-weight-bold">Bunga (<?= $voucher->persen_bunga ?>%) : </p>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <p class="font-weight-bold bunga"><?= "Rp. " . number_format($voucher->bunga, 0, '', '.')  ?></p>
                                        </td>
                                    </tr>
                                    <tr id="totalPembayaran">
                                        <td colspan="3" class="text-right">
                                            <p class="font-weight-bold">Total Pembayaran : </p>
                                        </td>
                                        <td colspan="2" class="text-left">
                                            <p class="font-weight-bold totalPembayaran"><?= "Rp. " . number_format($totalPembayaran, 0, '', '.')  ?></p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
</script>