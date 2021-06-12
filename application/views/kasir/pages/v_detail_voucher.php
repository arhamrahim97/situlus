<div class="row">
    <div class="col-lg-7 col-sm-12 mx-auto">
        <div class="row" id="data-voucher">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Voucher</h4>
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
                                <p style="display: inline;">Tgl Kadaluarsa Voucher :</p>
                                <strong style="float: right;"><?= date("d-m-Y", strtotime($voucher->kadaluarsa)) ?></strong>
                            </li>
                            <li class="list-group-item px-1 py-1">
                                <p style="display: inline;">Status Voucher :</p>
                                <strong style="float: right;">
                                    <?php
                                    if (strtotime(date("Y-m-d H:i:s")) > strtotime($voucher->kadaluarsa)) {
                                        echo
                                        '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" >Voucher Kadaluarsa</div>';
                                    } else {
                                        if ($voucher->konfirmasi_kasir == 0) {
                                            echo
                                            '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" >Voucher Aktif</div>';
                                        } else {
                                            echo '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left">Voucher Sudah Digunakan</div>';
                                        }
                                    }
                                    ?>
                                </strong>
                            </li>
                        </ul>
                        <?php
                        if (strtotime(date("Y-m-d H:i:s")) < strtotime($voucher->kadaluarsa)) {
                            if ($voucher->konfirmasi_kasir == 0) {
                                echo '<button class="btn btn-primary float-right mt-3" data-target="#modalStruk" data-toggle="modal">Proses</button>';
                            } else {
                                echo '<a class="btn btn-primary float-right mt-3" href="' . base_url('dashboard-kasir') . '">Kembali</a>';
                            }
                        } else {
                            echo '<a class="btn btn-primary float-right mt-3" href="' . base_url('dashboard-kasir') . '">Kembali</a>';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalStruk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Struk Belanja</h5>
                <button type="button" class="close closeModalQrcode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formStruk">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Foto Struk Belanja</label>
                                <input type="file" class="form-control-file" id="struk" name="struk">
                                <input type="hidden" value="<?= $voucher->id ?>" name="id">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Total Belanja</label>
                                <input class="form-control" type="text" placeholder="Masukkan Total Belanja" id="totalBelanja" onkeyup="hitungTotalBelanja()" name="totalBelanja" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary" id="btnProses">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('.modal').appendTo("body");

    $('#formStruk').submit(function(e) {
        e.preventDefault();
        var struk = $("#struk")[0].files[0];
        var totalBelanja = $('#totalBelanja').val();
        console.log(totalBelanja);
        if (!struk) {
            Swal.fire({
                icon: 'error',
                title: 'Periksa Kembali Data',
                text: 'Foto Struk Tidak Boleh Kosong',
            })
            return false;
        } else if (!totalBelanja) {
            Swal.fire({
                icon: 'error',
                title: 'Periksa Kembali Data',
                text: 'Total Belanja Tidak Boleh Kosong',
            })
            return false;
        } else if (totalBelanja.replaceAll(".", "") > <?= $voucher->limit_voucher ?>) {
            Swal.fire({
                icon: 'error',
                title: 'Periksa Kembali Data',
                text: 'Total Belanja Tidak Boleh Lebih Dari Limit Voucher',
            })
            return false;
        } else if (struk.size > 10485760) {
            Swal.fire({
                icon: 'error',
                title: 'Periksa Kembali Data',
                text: 'Foto Struk Tidak Boleh Lebih Dari 10 MB',
            })
            return false;
        } else {
            Swal.fire({
                title: 'Apakah anda yakin ingin memproses voucher ini ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Yakin',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('proses-konfirmasi-voucher-kasir') ?>',
                        type: "POST",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        cache: false,
                        async: false,
                        success: function(data) {
                            if (data.res == "success") {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setTimeout(function() {
                                    window.location.replace("<?= base_url('dashboard-kasir') ?>");
                                }, 2000);
                            } else if (data.res == 'error') {
                                Swal.fire(
                                    data.message,
                                    '',
                                    'warning'
                                );
                            }
                        }
                    });
                }
            })
        }
    })

    function hitungTotalBelanja() {
        $('#totalBelanja').mask('000.000.000.000.000', {
            reverse: true
        });
    }
</script>