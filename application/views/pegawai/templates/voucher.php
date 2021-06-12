<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $voucher->id ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300,400');

        .float-left {
            float: left;
            width: 300px;
        }

        body {
            /* background: url('https://unsplash.it/800/1200/?random'); */
            background-size: cover;
            /* background-color: gray; */
        }

        .contenido {
            margin: 30px auto;
            /* max-height: 430px; */
            max-width: 245px;
            overflow: hidden;
            box-shadow: 0 0 10px rgb(202, 202, 204);
            /* background-color: ; */
            border: solid black 2px;
            border-radius: 2px;
        }

        .details {
            padding: 26px;
            background: white;
            border-top: 1px dashed #c3c3c3;
        }

        .tinfo {
            font-size: 0.5em;
            font-weight: 300;
            color: black;
            font-family: 'Roboto', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 10px 0;
        }

        .tdata {
            font-size: 0.7em;
            font-weight: 400;
            font-family: 'Roboto', sans-serif;
            letter-spacing: 0.5px;
            margin: 7px 0;
        }

        .name {
            font-size: 1.3em;
            font-weight: 300;
        }

        .link {
            text-align: center;
            margin-top: 10px;
        }

        a {
            text-decoration: none;
            color: #55C9E6;
            font-weight: 400;
            font-family: 'Roboto', sans-serif;
            letter-spacing: 0.7px;
            font-size: 0.7em;
        }

        .hqr {
            display: table;
            width: 100%;
            table-layout: fixed;
            margin: 0px auto;
        }

        .left-one {
            background-repeat: no-repeat;
            background-image: radial-gradient(circle at 0 96%, rgba(0, 0, 0, 0) .2em, gray .3em, white .1em);
        }

        .right-one {
            background-repeat: no-repeat;
            background-image: radial-gradient(circle at 100% 96%, rgba(0, 0, 0, 0) .2em, gray .3em, white .1em);
        }

        .column {
            display: table-cell;
            padding: 37px 0px;
        }

        .center {
            background: white;
        }

        #qrcode {
            height: 90px;
            width: 90px;
            margin: 0 auto;
            text-align: center;
        }

        .masinfo {
            display: block;
        }

        .left,
        .right {
            width: 49%;
            display: inline-table;
        }

        .nesp {
            letter-spacing: 0px;
        }

        .copyright {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="contenido">
        <div class="ticket">
            <div class="hqr">
                <div class="column left-one"></div>
                <div class="column center">
                    <img src="<?= base_url('/uploads/img/qrCode/') . $voucher->barcode ?>" alt="" id="qrcode">
                </div>
                <div class="column right-one"></div>
            </div>
        </div>
        <div class="details">
            <div class="tinfo">
                ID Voucher
            </div>
            <div class="tdata name">
                <?= $voucher->id ?>
            </div>
            <hr>
            <div class="tinfo">
                Nama
            </div>
            <div class="tdata">
                <?= $voucher->nama ?>
            </div>
            <hr>
            <div class="tinfo">
                Limit
            </div>
            <div class="tdata">
                <?= "Rp. " . number_format($voucher->limit_voucher, 0, '', '.') ?>
            </div>
            <hr>
            <div class="tinfo">
                Kadaluarsa
            </div>
            <div class="tdata">
                <?= date("d-m-Y", strtotime($voucher->kadaluarsa)) ?>
            </div>
            <hr>
            <div class="tinfo copyright">
                KOPERASI VIRTUAL BAWASLU SULTENG
            </div>

        </div>
    </div>
    </div>

</body>

<script>
    window.print();
</script>

</html>