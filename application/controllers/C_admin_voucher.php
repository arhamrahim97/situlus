<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_voucher extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_voucher');
		if ($this->session->userdata('role') == 'admin') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$jumlahPengajuan = $this->m_admin_voucher->countPengajuan();
		$getPengajuan = $this->m_admin_voucher->getPengajuan();
		$pegawai = $this->m_admin_voucher->getPegawai();
		$jumlahBelumBayarRekanan = $this->m_admin_voucher->getBelumBayarRekanan()->num_rows();
		$biayaBelumBayarRekanan = $this->m_admin_voucher->getBelumBayarRekanan()->result();

		$totalBelumBayar = 0;
		if ($biayaBelumBayarRekanan) {
			foreach ($biayaBelumBayarRekanan as $biaya) {
				$totalBelumBayar += $biaya->total_belanja_kasir;
			}
		}

		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Voucher Belanja',
			'nama' => $this->session->userdata('nama'),
			'jumlahPengajuan' => $jumlahPengajuan,
			'getPengajuan' => $getPengajuan
		];
		$body = [
			'pegawai' => $pegawai,
			'jumlahBelumBayarRekanan' => $jumlahBelumBayarRekanan,
			'totalBelumBayar' => $totalBelumBayar
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_voucher', $body);
		$this->load->view('admin/templates/footer', $footer);
	}

	public function getVoucher()
	{
		$statusProsesVoucher = $this->input->post('statusProsesVoucher');
		$statusBayarAnggota = $this->input->post('statusBayarAnggota');
		$statusDigunakan = $this->input->post('statusDigunakan');
		$namaPegawai = $this->input->post('namaPegawai');
		$voucher = $this->m_admin_voucher->getVoucher($namaPegawai, $statusDigunakan, $statusBayarAnggota, $statusProsesVoucher);
		$status = '';
		$totalBelanjaKasir = '';
		$dataVoucher = [];
		foreach ($voucher as $vouc) {
			if ($vouc->konfirmasi_admin == 0 && $vouc->konfirmasi_kasir == 0 && $vouc->konfirmasi_pembayaran == 0) {
				$status = '<div class="badge badge-info" data-toggle="tooltip" data-placement="left" title="Menunggu Konfirmasi Admin">Menunggu Konfirmasi Admin</div>';
			} else if ($vouc->konfirmasi_admin == 1 && $vouc->konfirmasi_kasir == 0 && $vouc->konfirmasi_pembayaran == 0 && $vouc->kadaluarsa && strtotime(date("Y-m-d H:i:s")) > strtotime($vouc->kadaluarsa)) {
				$status = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Voucher Kadaluarsa">Voucher Kadaluarsa</div>';
			} else if ($vouc->konfirmasi_admin == 1 && $vouc->konfirmasi_kasir == 0 && $vouc->konfirmasi_pembayaran == 0) {
				$status = '<div class="badge badge-info" data-toggle="tooltip" data-placement="left" title="Menunggu Konfirmasi Kasir">Menunggu Konfirmasi Kasir</div>';
			} else if ($vouc->konfirmasi_admin == 1 && $vouc->konfirmasi_kasir == 1 && $vouc->konfirmasi_pembayaran == 0) {
				$status = '<div class="badge badge-info" data-toggle="tooltip" data-placement="left" title="Menunggu Konfirmasi Pembayaran">Menunggu Konfirmasi Pembayaran</div>';
			} else if ($vouc->konfirmasi_admin == 2 && $vouc->konfirmasi_kasir == 2 && $vouc->konfirmasi_pembayaran == 2) {
				$status = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak Admin">Ditolak Admin</div>';
			} else if ($vouc->konfirmasi_admin == 1 && $vouc->konfirmasi_kasir == 1 && $vouc->konfirmasi_pembayaran == 1 && $vouc->status_bayar_rekanan == 1) {
				$status = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Selesai">Sudah Bayar Rekanan</div>';
			} else if ($vouc->konfirmasi_admin == 1 && $vouc->konfirmasi_kasir == 1 && $vouc->konfirmasi_pembayaran == 1 && $vouc->status_bayar_rekanan == 0) {
				$status = '<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Selesai">Belum Bayar Rekanan</div>';
			} else if ($vouc->kadaluarsa && strtotime(date("Y-m-d H:i:s")) > strtotime($vouc->kadaluarsa)) {
				$status = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Voucher Kadaluarsa">Voucher Kadaluarsa</div>';
			}

			if ($vouc->total_belanja_kasir == "") {
				$totalBelanjaKasir = '-';
			} else {
				$totalBelanjaKasir = "Rp. " . number_format($vouc->total_belanja_kasir, 0, '', '.');
			}

			$data = array(
				'id' => $vouc->id,
				'nama' => $vouc->nama,
				'konfirmasi_kasir' => $vouc->konfirmasi_kasir,
				'konfirmasi_pembayaran' => $vouc->konfirmasi_pembayaran,
				'status' => $status,
				'total_struk' => $totalBelanjaKasir,
				'tanggal_pengajuan' =>  date("d-m-Y", strtotime($vouc->created_at))
			);
			array_push($dataVoucher, $data);
		}
		echo json_encode($dataVoucher);
	}

	public function getDetailVoucher()
	{
		$id = $this->input->post('id');
		$voucher = $this->m_admin_voucher->getDetailVoucher($id);

		$namaAdmin = '';
		if ($voucher->konfirmasi_admin != 0) {
			$namaAdmin = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Konfirmasi Admin :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($voucher->tgl_konfirmasi_admin)) . ' (' . $this->m_admin_voucher->getNama($voucher->id_admin) . ')</strong>
					</li>';
		}

		$statusAdmin = '';
		$prosesAdmin = '';
		$alasanTolak = '';
		if ($voucher->konfirmasi_admin == 0) {
			$statusAdmin = "Menunggu Konfirmasi Admin";
			$prosesAdmin = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Proses Admin :</p>
						<strong style="float: right;"><button class="btn btn-sm btn-success detail-voucher mr-2" onclick="adminSetuju(' . "'" . $voucher->id . "'" . ')"><i class="fas fa-check"></i></button><button class="btn btn-sm btn-danger detail-voucher" onclick="adminTolak(' . "'" . $voucher->id . "'" . ')"><i class="fas fa-times"></i></button></strong>
					</li>';
		} else if ($voucher->konfirmasi_admin == 1) {
			$statusAdmin = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Disetujui Admin">Disetujui Admin</div>';
		} else {
			$statusAdmin = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak Admin">Ditolak Admin</div>';
			$alasanTolak = '<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Alasan Ditolak :</p>
							<strong style="float: right;">' . $voucher->alasan_admin  . '</strong>
						</li>';
		}

		$statusKasir = '';
		if ($voucher->konfirmasi_kasir == 0 && $voucher->kadaluarsa && strtotime(date("Y-m-d H:i:s")) > strtotime($voucher->kadaluarsa)) {
			$statusKasir = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Voucher Kadaluarsa">Voucher Kadaluarsa</div>';
		} else if ($voucher->konfirmasi_kasir == 0) {
			$statusKasir = '<div class="badge badge-info" data-toggle="tooltip" data-placement="left" title="Menunggu Kasir">Menunggu Kasir</div>';
		} else if ($voucher->konfirmasi_kasir == 1) {
			$statusKasir = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Disetujui Kasir">Disetujui Kasir</div>';
		}

		$statusBayar = '';
		$prosesPembayaran = '';
		if ($voucher->konfirmasi_pembayaran == 0) {
			$statusBayar = '<div class="badge badge-info" data-toggle="tooltip" data-placement="left" title=Menunggu Pembayaran">Menunggu Pembayaran</div>';
		} else if ($voucher->konfirmasi_kasir == 1) {
			$statusBayar = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Pembayaran Disetujui">Pembayaran Disetujui</div>';
		} else if ($voucher->konfirmasi_kasir == 2) {
			$statusBayar = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Pembayaran Ditolak"Pembayaran Ditolak</div>';
		}

		if ($voucher->konfirmasi_kasir == 1 && $voucher->konfirmasi_pembayaran == 0) {
			$prosesPembayaran = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Proses Pembayaran :</p>
						<strong style="float: right;"><button class="btn btn-sm btn-success detail-voucher mr-2" onclick="prosesPembayaran(' . "'" . $voucher->id . "'" . ')">Proses Pembayaran</button></strong>
					</li>';
		}

		$prosesRekanan = '';
		if ($voucher->konfirmasi_pembayaran == 1 && $voucher->status_bayar_rekanan == 1) {
			$prosesRekanan = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Konfirmasi Bayar Rekanan :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($voucher->tgl_bayar_rekanan)) . ' (' . $this->m_admin_voucher->getNama($voucher->id_kasir_bayar_rekanan) . ')</strong>
					</li>';
		} else {
			$prosesRekanan = '';
		}

		$namaAdminPembayaran = '';
		$totalPembayaran = '';
		if ($voucher->konfirmasi_pembayaran == 1) {
			$namaAdminPembayaran = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Konfirmasi Pembayaran :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($voucher->tgl_konfirmasi_pembayaran)) . ' (' . $this->m_admin_voucher->getNama($voucher->id_admin_pembayaran) . ')</strong>
					</li>';
			$totalPembayaran = '<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Total Pembayaran :</p>
							<strong style="float: right;">' . "Rp. " . number_format($voucher->total_pembayaran, 0, '', '.')  . '</strong>
						</li>';
			$detailPembayaran = '<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Lihat Detail Pembayaran :</p>
							<strong style="float: right;"><button class="btn btn-sm btn-primary detail-voucher mr-2" onclick="detailPembayaran(' . "'" . $voucher->id . "'" . ')">Detail Pembayaran</button></strong>
						</li>	';
		}

		$output = '';
		$output .= '
				<ul class="list-group list-group-flush">
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">ID Voucher :</p>
						<strong style="float: right;">' . $voucher->id . '</strong>
					</li>					
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Nama Pengaju :</p>
						<strong style="float: right;">' . $voucher->nama . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Grade :</p>
						<strong style="float: right;">' . $voucher->grade . " (Rp." . number_format($voucher->limit_voucher, 0, '', '.') . ")" . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Pengajuan :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($voucher->created_at)) . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Status Admin :</p>
						<strong style="float: right;">' . $statusAdmin . '</strong>
					</li>
					' . $alasanTolak . $prosesAdmin . $namaAdmin;
		if ($voucher->konfirmasi_admin == 1) {
			$output .= '
			<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Cetak Voucher :</p>
							<strong style="float: right;"><button class="btn btn-sm btn-primary detail-voucher mr-2" onclick="cetakVoucher(' . "'" . $voucher->id . "'" . ')">Cetak Voucher</button></strong>
						</li>	
						<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Status Kasir :</p>
							<strong style="float: right;">' . $statusKasir . '</strong>
						</li>				
						';
		}
		if ($voucher->konfirmasi_kasir == 1) {
			$output .= '
			<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Tgl Konfirmasi Kasir :</p>
							<strong style="float: right;">' .  date("d-m-Y", strtotime($voucher->tgl_konfirmasi_admin)) . ' (' . $this->m_admin_voucher->getNama($voucher->id_kasir)  . ')</strong>
						</li>	
						<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Total Belanja Kasir :</p>
							<strong style="float: right;">' . "Rp. " . number_format($voucher->total_belanja_kasir, 0, '', '.')  . '</strong>
						</li>							
						<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Status Bayar :</p>
							<strong style="float: right;">' . $statusBayar . '</strong>
						</li>' .
				$prosesPembayaran;
		}
		if ($voucher->konfirmasi_pembayaran == 1) {
			$output .= $namaAdminPembayaran . $totalPembayaran . $detailPembayaran . $prosesRekanan;
		}
		$output .= '	
				</ul>
				';
		echo $output;
	}

	public function adminSetuju()
	{
		$id = $this->input->post('id');
		$idAdmin = $this->session->userdata('id');

		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable']    = true; //boolean, the default is true
		$config['cachedir']     = './uploads/'; //string, the default is application/cache/
		$config['errorlog']     = './uploads/'; //string, the default is application/logs/
		$config['imagedir']     = './uploads/img/qrCode/'; //direktori penyimpanan qr code
		$config['quality']      = true; //boolean, the default is true
		$config['size']         = '1024'; //interger, the default is 1024
		$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
		$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$image_name = $id . '.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $id; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

		$data = array(
			'konfirmasi_admin' => 1,
			'id_admin' => $idAdmin,
			'tgl_konfirmasi_admin' => date("Y-m-d H:i:s"),
			'kadaluarsa' => date('Y-m-d H:i:s', strtotime('+30 days', strtotime(date("Y-m-d H:i:s")))),
			'barcode' => $image_name
		);

		if ($this->m_admin_voucher->update($id, $data)) {
			$response = array('res' => 'success', 'message' => 'Berhasil Menyetujui Voucher');
		} else {
			$response = array('res' => 'error', 'message' => 'Gagal Menyetujui Voucher');
		}

		echo json_encode($response);
	}

	public function adminTolak()
	{
		$id = $this->input->post('id');
		$alasanAdmin = $this->input->post('alasanAdmin');
		$idAdmin = $this->session->userdata('id');
		$data = array(
			'konfirmasi_admin' => 2,
			'konfirmasi_kasir' => 2,
			'konfirmasi_pembayaran' => 2,
			'id_admin' => $idAdmin,
			'alasan_admin' => $alasanAdmin,
			'tgl_konfirmasi_admin' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);

		if ($this->m_admin_voucher->update($id, $data)) {
			$response = array('res' => 'success', 'message' => 'Berhasil Menolak Voucher');
		} else {
			$response = array('res' => 'error', 'message' => 'Gagal Menolak Voucher');
		}

		echo json_encode($response);
	}

	public function cetakVoucher()
	{
		$id = $this->input->post('id');
		// $id = 'VCR-00015';
		$detailVoucher = $this->m_admin_voucher->getDetailVoucher($id);
		$data = [
			'voucher' => $detailVoucher
		];

		$this->load->view('admin/templates/voucher', $data);
	}

	public function prosesPembayaran()
	{
		$id = $this->input->post('id');
		$voucher = $this->m_admin_voucher->getDetailVoucher($id);

		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Voucher Belanja',
			'nama' => $this->session->userdata('nama'),
			'voucher' => $voucher
		];
		$body = [
			'pengaturan' => $pengaturan
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_proses_pembayaran', $body);
		$this->load->view('admin/templates/footer', $footer);
	}

	public function daftarBarang()
	{
		$listBarang = $this->m_admin_voucher->getListBarang();
		$output = '';
		$output .= '<option selected value="">Pilih Barang</option>';
		foreach ($listBarang as $barang) {
			$output .= '<option value="' . $barang->id . '">' . $barang->nama_barang  . '</option>';
		}
		echo $output;
	}

	public function tambahDaftarBarang()
	{
		$id = $this->input->post('id');
		$i = $this->input->post('i');
		$barang = $this->m_admin_voucher->getBarang($id);
		$output = '                 <tr id="barang' . $i . '" class="text-center listBarang">
										<td><input type="text" class="form-control namaBarang" id="namaBarang' . $i . '" name="namaBarang[]" value="' . $barang->nama_barang . '" hidden><p class="mt-3">' . $barang->nama_barang . ' </p></td>
                                        <td><div class="input-group "><div class="input-group-prepend"><div class="input-group-text">Rp.</div></div><input type="text" class="form-control hargaBarang" id="hargaBarang' . $i . '"placeholder="Harga Barang" name="hargaBarang[]" onkeyup="hitungTotalHarga(' . $i . ')" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"></div></td>
                                        <td><input type="text" class="form-control jumlahBarang" id="jumlahBarang' . $i . '"placeholder="Jumlah Barang" name="jumlahBarang[]" onkeyup="hitungTotalHarga(' . $i . ')" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"></td>
                                        <td><p id="totalHarga' . $i . '" class="mt-3">Rp.0</p></td>
                                        <td><button type="button" class="btn btn-danger btn-hapus" id="' . $i . '">X</button></td>
                                    </tr>';
		echo $output;
	}

	public function simpanProsesPembayaran()
	{
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$id = $this->input->post('id');
		$idAdmin = $this->session->userdata('id');
		$namaBarang = $this->input->post('namaBarang');
		$hargaBarang = $this->input->post('hargaBarang');
		$jumlahBarang = $this->input->post('jumlahBarang');
		$pajakStruk = str_replace(".", "", $this->input->post('pajak'));
		$totalHargaBarang = 0;
		$bunga = 0;
		$totalPembayaran = 0;
		$dataBarang = array();

		for ($i = 0; $i < count($hargaBarang); $i++) {
			$totalHargaBarang += str_replace(".", "", $hargaBarang[$i]) * $jumlahBarang[$i];
		}

		$totalHargaBarang += $pajakStruk;

		$bunga = ($pengaturan->bunga_voucher / 100) * $totalHargaBarang;

		$totalPembayaran = $bunga + $totalHargaBarang;

		for ($i = 0; $i < count($namaBarang); $i++) {
			array_push($dataBarang, array(
				'id_voucher' => $id,
				'nama_barang' => $namaBarang[$i],
				'harga_barang' => str_replace(".", "", $hargaBarang[$i]),
				'jumlah_barang' => $jumlahBarang[$i],
				'total_harga' => str_replace(".", "", $hargaBarang[$i]) * $jumlahBarang[$i]
			));
		}
		$this->db->insert_batch('daftar_barang', $dataBarang);

		$data = array(
			'konfirmasi_pembayaran' => 1,
			'id_admin_pembayaran' => $idAdmin,
			'total_pembayaran' => $totalPembayaran,
			'pajak_struk' => str_replace(".", "", $pajakStruk),
			'bunga' => $bunga,
			'persen_bunga' => $pengaturan->bunga_voucher,
			'tgl_konfirmasi_pembayaran' => date("Y-m-d H:i:s"),
			'status' => 1,
			'updated_at' => date("Y-m-d H:i:s")
		);

		if ($this->m_admin_voucher->update($id, $data)) {
			$response = array('res' => 'success', 'message' => 'Berhasil Memproses Pembayaran Voucher');
		} else {
			$response = array('res' => 'error', 'message' => 'Gagal Memproses Pembayaran Voucher');
		}

		echo json_encode($response);
	}

	public function detailPembayaran()
	{
		$id = $this->input->post('id');
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$voucher = $this->m_admin_voucher->getDetailVoucher($id);
		$daftarBarang = $this->m_admin_voucher->getDaftarBarang($id);
		$totalBelanja = 0;

		foreach ($daftarBarang as $barang) {
			$totalBelanja += $barang->total_harga;
		}

		$totalBelanja += $voucher->pajak_struk;
		$totalPembayaran = $totalBelanja + $voucher->bunga;

		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Voucher Belanja',
			'nama' => $this->session->userdata('nama'),
			'voucher' => $voucher
		];
		$body = [
			'pengaturan' => $pengaturan,
			'detailBarang' => $daftarBarang,
			'totalBelanja' => $totalBelanja,
			'totalPembayaran' => $totalPembayaran
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_detail_pembayaran', $body);
		$this->load->view('admin/templates/footer', $footer);
	}

	public function cetakDetailPembayaran()
	{
		$id = $this->input->post('id');
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$voucher = $this->m_admin_voucher->getDetailVoucher($id);
		$daftarBarang = $this->m_admin_voucher->getDaftarBarang($id);
		$totalBelanja = 0;

		foreach ($daftarBarang as $barang) {
			$totalBelanja += $barang->total_harga;
		}

		$totalBelanja += $voucher->pajak_struk;
		$totalPembayaran = $totalBelanja + $voucher->bunga;

		$header = [];
		$body = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Voucher Belanja',
			'nama' => $this->session->userdata('nama'),
			'voucher' => $voucher,
			'pengaturan' => $pengaturan,
			'detailBarang' => $daftarBarang,
			'totalBelanja' => $totalBelanja,
			'totalPembayaran' => $totalPembayaran
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		// $this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_cetak_detail_pembayaran', $body);
		// $this->load->view('admin/templates/footer', $footer);
	}
}
