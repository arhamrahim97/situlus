<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="row" id="data-voucher">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-warning align-items-right" id="btnCetak" onclick="cetakDetailPembayaran()">
                            Cetak Detail Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                    <tr>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="listDaftarBarang">
                                    <?php foreach ($detailBarang as $barang) : ?>
                                        <tr class="text-center">
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
                                    <tr id="pajak" class="text-center table-primary">
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

<form action="<?= base_url('cetak-detail-pembayaran') ?>" hidden method="POST" id="cetakDetailPembayaran" target="_blank">
    <input type="text" id="idDetailPembayaran" name="id" value="<?= $voucher->id ?>">
</form>

<script>
    function cetakDetailPembayaran() {
        $('#cetakDetailPembayaran').submit();
    }
</script>