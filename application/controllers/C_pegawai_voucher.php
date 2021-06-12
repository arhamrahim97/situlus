<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pegawai_voucher extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_pegawai_voucher');
		if ($this->session->userdata('role') == 'pegawai') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$skVoucher = $this->db->where('kategori', 'Voucher Belanja')->order_by('nomor', 'asc')->get('syarat_dan_ketentuan')->result();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Voucher Belanja',
			'nama' => $this->session->userdata('nama')
		];
		$body = [
			'skVoucher' => $skVoucher
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('pegawai/templates/header', $header);
		$this->load->view('pegawai/pages/v_voucher', $body);
		$this->load->view('pegawai/templates/footer', $footer);
	}

	public function ajukanVoucher()
	{
		$idPegawai = $this->session->userdata('id');
		$pengguna = $this->m_pegawai_voucher->getPengguna($idPegawai);
		$lastVoucher = $this->m_pegawai_voucher->getLastVoucher($idPegawai);

		$query = $this->db->query('SELECT max(id) as maxKode FROM voucher_belanja')->row();
		$id = $query->maxKode;
		$urutan = (int) substr($id, 4, 5);
		$urutan++;
		$huruf = "VCR-";
		$kode = $huruf . sprintf("%05s", $urutan);

		$dataVoucher = array(
			'id' => $kode,
			'id_pegawai' => $idPegawai,
			'grade' => $pengguna->grade,
			'limit_voucher' => $pengguna->limit_voucher,
			'tgl_pengusulan' => date("Y-m-d H:i:s")
		);

		if (!$lastVoucher) {
			if ($this->m_pegawai_voucher->insertVoucher($dataVoucher)) {
				$data = array('res' => 'success', 'message' => 'Voucher Belanja Berhasil Diajukan');
			} else {
				$data = array('res' => 'error', 'message' => 'Voucher Belanja Gagal Diajukan');
			}
		} else {
			// Tolak Admin
			if ($lastVoucher->konfirmasi_admin == 2 && $lastVoucher->konfirmasi_kasir == 2 && $lastVoucher->konfirmasi_pembayaran == 2) {
				if ($this->m_pegawai_voucher->insertVoucher($dataVoucher)) {
					$data = array('res' => 'success', 'message' => 'Voucher Belanja Berhasil Diajukan');
				} else {
					$data = array('res' => 'error', 'message' => 'Voucher Belanja Gagal Diajukan');
				}
			} else if ($lastVoucher->konfirmasi_admin == 1 && $lastVoucher->konfirmasi_kasir == 2 && $lastVoucher->konfirmasi_pembayaran == 2) {
				// Tolak Kasir
				if ($this->m_pegawai_voucher->insertVoucher($dataVoucher)) {
					$data = array('res' => 'success', 'message' => 'Voucher Belanja Berhasil Diajukan');
				} else {
					$data = array('res' => 'error', 'message' => 'Voucher Belanja Gagal Diajukan');
				}
			} else if ($lastVoucher->konfirmasi_admin == 1 && $lastVoucher->konfirmasi_kasir == 1 && $lastVoucher->konfirmasi_pembayaran == 1) {
				if ($this->m_pegawai_voucher->insertVoucher($dataVoucher)) {
					$data = array('res' => 'success', 'message' => 'Voucher Belanja Berhasil Diajukan');
				} else {
					$data = array('res' => 'error', 'message' => 'Voucher Belanja Gagal Diajukan');
				}
			} else if ($lastVoucher->konfirmasi_admin == 1 && $lastVoucher->konfirmasi_kasir == 0 && $lastVoucher->konfirmasi_pembayaran == 0 && $lastVoucher->kadaluarsa && strtotime(date("Y-m-d H:i:s")) > strtotime($lastVoucher->kadaluarsa)) {
				if ($this->m_pegawai_voucher->insertVoucher($dataVoucher)) {
					$data = array('res' => 'success', 'message' => 'Voucher Belanja Berhasil Diajukan');
				} else {
					$data = array('res' => 'error', 'message' => 'Voucher Belanja Gagal Diajukan');
				}
			} else {
				$data = array('res' => 'proses', 'message' => 'Anda Memiliki Voucher Yang Masih Di Proses');
			}
		}

		// Metode Cek Voucher
		// 1. Ambil Data Terakhir
		// 2. Cek Apakah voucher sudah ada atau belum, kalau belum buat voucher
		// 3. Jika Belum, ambil data terakhir, kemudian cek apakah statusnya voucher ditolak admin (konfirmasi_admin = 2, Konfirmasi_kasir = 2,konfirmasi pembayaran = 2). Jika voucher ditolak admin, buat voucher
		// 4. Jika Tidak, ambil data terakhir, kemudian cek apakah statusnya voucher ditolak kasir (konfirmasi_admin = 1, Konfirmasi_kasir = 2,konfirmasi pembayaran = 2). Jika voucher ditolak kasir, buat voucher
		// 5. Jika Tidak, ambil data terakhir, kemudian cek apakah voucher sudah selesai diproses, jika sudah buat voucher
		// 6. Jika tidak, maka status voucher adalah masih di proses
		echo json_encode($data);
	}

	public function getVoucher()
	{
		$id = $this->session->userdata('id');
		$voucher = $this->m_pegawai_voucher->getVoucher($id);
		echo json_encode($voucher);
	}

	public function pemberitahuanVoucher()
	{
		$getVoucherDitolak = $this->m_pegawai_voucher->getVoucherditolak();
		if ($getVoucherDitolak->num_rows() !== 0) {
			$output = '';
			foreach ($getVoucherDitolak->result() as $row) {
				$output .= '
					<div class="alert alert-danger alert-dismissible show fade">
						<div class="alert-body">
							<button class="close hapus-pemberitahuan" id="' . $row->id . '" data-dismiss="alert">
								<span>×</span>
							</button>
							Pengajuan voucher anda sebelumnya ditolak.	
							<div>
							<p>Alasan : ' . $row->alasan_admin . '</p>
							</div>						
						</div>
					</div>
				';
			}
			echo $output;
		}

		$menugguKonfirmasi = $this->m_pegawai_voucher->menugguKonfirmasi();
		if ($menugguKonfirmasi) {
			$output = '';
			$output .= '
					<div class="alert alert-warning alert-dismissible show fade">
						<div class="alert-body">
						<i class="fas fa-history"></i> Pengajuan voucher anda sedang menunuggu konfirmasi dari Admin. 																					
						</div>
					</div>
				';
			echo $output;
		}
	}

	public function hapusPemberitahuan()
	{
		$id = $this->input->post('id');

		if ($this->m_pegawai_voucher->hapusPemberitahuan($id)) {
			$data = array('res' => 'success');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}

	public function getDetailVoucher()
	{
		$id = $this->input->post('id');
		$data = $this->m_pegawai_voucher->getDetailVoucher($id);
		echo json_encode($data);
	}

	public function getDetailIsiVoucher()
	{
		$id = $this->input->post('id');
		$voucher = $this->m_pegawai_voucher->getDetailVoucher($id);

		$namaAdmin = '';
		if ($voucher->konfirmasi_admin != 0) {
			$namaAdmin = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Konfirmasi Admin :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($voucher->tgl_konfirmasi_admin)) . ' (' . $this->m_pegawai_voucher->getNama($voucher->id_admin) . ')</strong>
					</li>';
		}

		$statusAdmin = '';
		if ($voucher->konfirmasi_admin == 0) {
			$statusAdmin = "Menunggu Konfirmasi Admin";
		} else if ($voucher->konfirmasi_admin == 1) {
			$statusAdmin = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Disetujui Admin">Disetujui Admin</div>';
		} else {
			$statusAdmin = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak Admin">Ditolak Admin</div>';
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

		$namaAdminPembayaran = '';
		$totalPembayaran = '';
		if ($voucher->konfirmasi_pembayaran == 1) {
			$namaAdminPembayaran = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Konfirmasi Pembayaran :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($voucher->tgl_konfirmasi_pembayaran)) . ' (' . $this->m_pegawai_voucher->getNama($voucher->id_admin_pembayaran) . ')</strong>
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
					' .  $namaAdmin;
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
							<strong style="float: right;">' .  date("d-m-Y", strtotime($voucher->tgl_konfirmasi_admin)) . ' (' . $this->m_pegawai_voucher->getNama($voucher->id_kasir)  . ')</strong>
						</li>	
						<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Total Belanja Struk :</p>
							<strong style="float: right;">' . "Rp. " . number_format($voucher->total_belanja_kasir, 0, '', '.')  . '</strong>
						</li>							
						<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Status Bayar :</p>
							<strong style="float: right;">' . $statusBayar . '</strong>
						</li>' .
				$prosesPembayaran;
		}
		if ($voucher->konfirmasi_pembayaran == 1) {
			$output .= $namaAdminPembayaran . $totalPembayaran . $detailPembayaran;
		}
		$output .= '	
				</ul>
				';
		echo $output;
	}

	public function detailPembayaran()
	{
		$id = $this->input->post('id');
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$voucher = $this->m_pegawai_voucher->getDetailVoucher($id);
		$daftarBarang = $this->m_pegawai_voucher->getDaftarBarang($id);
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

		$this->load->view('pegawai/templates/header', $header);
		$this->load->view('pegawai/pages/v_detail_pembayaran', $body);
		$this->load->view('pegawai/templates/footer', $footer);
	}

	public function cetakDetailPembayaran()
	{
		$id = $this->input->post('id');
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$voucher = $this->m_pegawai_voucher->getDetailVoucher($id);
		$daftarBarang = $this->m_pegawai_voucher->getDaftarBarang($id);
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
		$this->load->view('pegawai/pages/v_cetak_detail_pembayaran', $body);
		// $this->load->view('admin/templates/footer', $footer);
	}

	public function cetakVoucher()
	{
		$id = $this->input->post('id');
		// $id = 'VCR-00015';
		$detailVoucher = $this->m_pegawai_voucher->getDetailVoucher($id);
		$data = [
			'voucher' => $detailVoucher
		];

		$this->load->view('pegawai/templates/voucher', $data);
	}
}
