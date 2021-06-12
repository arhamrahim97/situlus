<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
      font-family: "Roboto", sans-serif;
    }

    .kartu {
      height: 408px;
      border: 1px solid black;
      width: 646px;
      background: url("././assets/stisla/img/kartu_anggota2.png");
      background-size: cover;
      border-radius: 10px;
      margin-left: 15px;
      margin-top: 20px;
    }

    .nama {
      font-weight: bold;
      display: inline-block;
      text-shadow: 1px 1px 0px rgba(255, 255, 255, 1);
      max-width: 300px;
      margin-bottom: 30px;
    }

    .nama .jabatan {
      color: red;
    }

    .keterangan {
      float: right;
      text-align: right;
      font-size: 24px;
      margin-top: 40px;
      margin-right: 40px;
    }

    .nomor {
      font-style: italic;
      font-weight: bold;
      margin-top: 80px;
      text-shadow: 1px 1px 0px rgba(255, 255, 255, 1);
    }
  </style>
  <title>Kartu Anggota <?= $pengguna->nama ?></title>
</head>

<body>
  <div class="kartu" id="kartu">
    <div class="keterangan">
      <p class="nama">
        <?= $pengguna->nama ?><br />
        <span class="jabatan">ANGGOTA</span>
      </p>
      <p class="nomor">Nomor : <br /><?= $pengguna->nip ?></p>
    </div>
  </div>
</body>
<script type="text/javascript" src="<?= 'assets/stisla/js/' ?>html2canvas.js"></script>
<script type="text/javascript" src="<?= 'assets/stisla/js/' ?>jspdf.min.js"></script>
<script>
  getImage();

  function getImage() {
    var nama = 'Kartu Anggota ' + '<?= $pengguna->nama ?>';
    html2canvas(document.getElementById('kartu'), {
      background: '#FFFFFF',
      scale: 3,
      dpi: 300,
      onrendered: function(canvas) {
        // var pageData = canvas.toDataURL('image/jpeg', 1.0);
        // var pdf = new jsPDF('', 'pt', 'a4');
        // pdf.addImage(pageData, 'JPEG', 0, 0, 595.28, 592.28 / canvas.width * canvas.height);
        // pdf.save(nama + '.pdf');

        var a = document.createElement('a');
        // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
        a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
        a.download = nama + '.jpg';
        a.click();
        setTimeout(function() {
          window.close()
        }, 2000);
      }
    })
  };
  // html2canvas(document.body).then(function(canvas) {
  //     document.body.appendChild(canvas);
  // });
</script>

</html>