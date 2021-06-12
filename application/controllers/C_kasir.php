<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_kasir extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_kasir');
		$this->load->model('m_pengaturan');
		if ($this->session->userdata('role') == 'kasir') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$jumlahBelumBayarRekanan = $this->m_kasir->getBelumBayarRekanan()->num_rows();
		$biayaBelumBayarRekanan = $this->m_kasir->getBelumBayarRekanan()->result();

		$totalBelumBayar = 0;
		if ($biayaBelumBayarRekanan) {
			foreach ($biayaBelumBayarRekanan as $biaya) {
				$totalBelumBayar += $biaya->total_belanja_kasir;
			}
		}
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Voucher Belanja',
			'nama' => $this->session->userdata('nama')
		];
		$body = [
			'jumlahBelumBayarRekanan' => $jumlahBelumBayarRekanan,
			'totalBelumBayar' => $totalBelumBayar
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('kasir/templates/header', $header);
		$this->load->view('kasir/pages/v_voucher', $body);
		$this->load->view('kasir/templates/footer', $footer);
	}

	public function prosesVoucher()
	{
		$kodeVoucher = $this->input->post('kodeVoucher');
		$detailVoucher = $this->m_kasir->detailVoucher($kodeVoucher);
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Detail Voucher',
			'nama' => $this->session->userdata('nama')
		];
		$data = [
			'voucher' => $detailVoucher
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];
		$this->load->view('kasir/templates/header', $header);
		$this->load->view('kasir/pages/v_detail_voucher', $data);
		$this->load->view('kasir/templates/footer', $footer);
	}

	public function prosesKonfirmasiVoucher()
	{
		$id = $this->input->post('id');
		$totalBelanja = $this->input->post('totalBelanja');
		$idKasir = $this->session->userdata('id');
		$fotoStruk = $this->_fotoStruk($id);
		if ($fotoStruk['res'] == 'error') {
			echo json_encode($fotoStruk['message']);
		} else {
			$dataStruk = array(
				'konfirmasi_kasir' => 1,
				'id_kasir' => $idKasir,
				'tgl_konfirmasi_kasir' => date("Y-m-d H:i:s"),
				'struk' => $fotoStruk['message'],
				'total_belanja_kasir' => str_replace(".", "", $totalBelanja)
			);
			if ($this->m_kasir->update($id, $dataStruk)) {
				$response = array('res' => 'success', 'message' => 'Voucher Berhasil Diproses');
			} else {
				$response = array('res' => 'error', 'message' => 'Voucher Gagal Diproses');
			}
			echo json_encode($response);
		}
	}

	public function prosesBayarRekanan()
	{
		$id = $this->input->post('id');
		$idKasir = $this->session->userdata('id');

		$data = array(
			'status_bayar_rekanan' => 1,
			'id_kasir_bayar_rekanan' => $idKasir,
			'tgl_bayar_rekanan' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		);
		if ($this->m_kasir->update($id, $data)) {
			$response = array('res' => 'success', 'message' => 'Bayar Rekanan Berhasil Di Proses');
		} else {
			$response = array('res' => 'error', 'message' => 'Bayar Rekanan Gagal Di Proses');
		}
		echo json_encode($response);
	}

	public function getVoucher()
	{
		$statusBayarRekanan = $this->input->post('statusBayarRekanan');
		$voucher = $this->m_kasir->getVoucher($statusBayarRekanan);
		$dataVoucher = [];
		foreach ($voucher as $vouc) {
			if ($vouc->konfirmasi_admin == 0 && $vouc->konfirmasi_kasir == 0 && $vouc->konfirmasi_pembayaran == 0) {
				$status = '<div class="badge badge-info" data-toggle="tooltip" data-placement="left" title="Menunggu Konfirmasi Admin">Menunggu Konfirmasi Admin</div>';
			} else if ($vouc->konfirmasi_admin == 1 && $vouc->konfirmasi_kasir == 0 && $vouc->konfirmasi_pembayaran == 0 && $vouc->kadaluarsa && strtotime(date("Y-m-d H:i:s")) > strtotime($vouc->kadaluarsa)) {
				$status = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Voucher Kadaluarsa">Voucher Kadaluarsa</div>';
			} else if ($vouc->konfirmasi_admin == 1 && $vouc->konfirmasi_kasir == 0 && $vouc->konfirmasi_pembayaran == 0) {
				$status = '<div class="badge badge-info" data-toggle="tooltip" data-placement="left" title="Menunggu Konfirmasi Kasir">Menunggu Konfirmasi Kasir</div>';
			} else if ($vouc->konfirmasi_admin == 1 && $vouc->konfirmasi_kasir == 1 && $vouc->konfirmasi_pembayaran == 0) {
				$status = '<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Selesai">Belum Bayar Rekanan (Pegawai Belum Membayar)</div>';
			} else if ($vouc->konfirmasi_admin == 2 && $vouc->konfirmasi_kasir == 2 && $vouc->konfirmasi_pembayaran == 2) {
				$status = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak Admin">Ditolak Admin</div>';
			} else if ($vouc->konfirmasi_admin == 1 && $vouc->konfirmasi_kasir == 1 && $vouc->konfirmasi_pembayaran == 1 && $vouc->status_bayar_rekanan == 1) {
				$status = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Selesai">Sudah Bayar Rekanan</div>';
			} else if ($vouc->konfirmasi_admin == 1 && $vouc->konfirmasi_kasir == 1 && $vouc->konfirmasi_pembayaran == 1 && $vouc->status_bayar_rekanan == 0) {
				$status = '<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Selesai">Belum Bayar Rekanan</div>';
			} else if ($vouc->kadaluarsa && strtotime(date("Y-m-d H:i:s")) > strtotime($vouc->kadaluarsa)) {
				$status = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Voucher Kadaluarsa">Voucher Kadaluarsa</div>';
			}
			$data = array(
				'id' => $vouc->id,
				'nama' => $vouc->nama,
				'tgl_konfirmasi_admin' => $vouc->tgl_konfirmasi_admin,
				'tgl_konfirmasi_kasir' => $vouc->tgl_konfirmasi_kasir,
				'total_belanja_kasir' => $vouc->total_belanja_kasir,
				'status_bayar_rekanan' => $status
			);
			array_push($dataVoucher, $data);
		}
		echo json_encode($dataVoucher);
	}

	private function _fotoStruk($id)
	{
		$config['upload_path']          = APPPATH . '../uploads/img/fotoStruk/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = '6144';
		$config['max_width']            = '5000';
		$config['max_height']           = '5000';
		$config['file_name'] 			= $id;
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('struk')) {
			return array('res' => 'error', 'message' => 'Foto Struk :' . $this->upload->display_errors());
		} else {
			return array('res' => 'success', 'message' => $this->upload->data('file_name'));
		}
	}

	public function getDetailVoucher()
	{
		$id = $this->input->post('id');
		$voucher = $this->m_kasir->getDetailVoucher($id);

		$namaAdmin = '';
		if ($voucher->konfirmasi_admin != 0) {
			$namaAdmin = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Konfirmasi Admin :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($voucher->tgl_konfirmasi_admin)) . ' (' . $this->m_kasir->getNama($voucher->id_admin) . ')</strong>
					</li>';
		}

		$statusAdmin = '';
		$prosesAdmin = '';
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
		}

		$statusKasir = '';
		if ($voucher->konfirmasi_kasir == 0 && $voucher->kadaluarsa && strtotime(date("Y-m-d H:i:s")) > strtotime($voucher->kadaluarsa)) {
			$statusKasir = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Voucher Kadaluarsa">Voucher Kadaluarsa</div>';
		} else if ($voucher->konfirmasi_kasir == 0) {
			$statusKasir = '<div class="badge badge-info" data-toggle="tooltip" data-placement="left" title="Menunggu Kasir">Menunggu Kasir</div>';
		} else if ($voucher->konfirmasi_kasir == 1) {
			$statusKasir = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Disetujui Kasir">Disetujui Kasir</div>';
		}

		$prosesRekanan = '';
		if ($voucher->konfirmasi_pembayaran == 1 && $voucher->status_bayar_rekanan == 0) {
			$prosesRekanan = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Proses Bayar Rekanan :</p>
						<strong style="float: right;"><button class="btn btn-sm btn-success detail-voucher mr-2" onclick="prosesBayarRekanan(' . "'" . $voucher->id . "'" . ')">Proses Bayar Rekanan</button>
					</li>';
		} else if ($voucher->konfirmasi_pembayaran == 1 && $voucher->status_bayar_rekanan == 1) {
			$prosesRekanan = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Konfirmasi Bayar Rekanan :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($voucher->tgl_bayar_rekanan)) . ' (' . $this->m_kasir->getNama($voucher->id_kasir_bayar_rekanan) . ')</strong>
					</li>';
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
					' . $prosesAdmin . $namaAdmin;
		if ($voucher->konfirmasi_admin == 1) {
			$output .= '						<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Status Kasir :</p>
							<strong style="float: right;">' . $statusKasir . '</strong>
						</li>				
						';
		}
		if ($voucher->konfirmasi_kasir == 1) {
			$output .= '
			<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Tgl Konfirmasi Kasir :</p>
							<strong style="float: right;">' .  date("d-m-Y", strtotime($voucher->tgl_konfirmasi_admin)) . ' (' . $this->m_kasir->getNama($voucher->id_kasir)  . ')</strong>
						</li>	
						<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Total Belanja Struk :</p>
							<strong style="float: right;">' . "Rp. " . number_format($voucher->total_belanja_kasir, 0, '', '.')  . '</strong>
						</li>
						<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Struk Pembayaran :</p>
						<strong style="float: right;"><button class="btn btn-sm btn-primary detail-voucher mr-2" onclick="lihatStruk(' . "'" . $voucher->id . "'" . ')">Lihat Struk</button></strong>
					</li>';
		}
		if ($voucher->konfirmasi_pembayaran == 1) {
			$output .= $prosesRekanan;
		}
		$output .= '	
				</ul>
				';
		echo $output;
	}

	public function getVoucherId()
	{
		$id = $this->input->post('id');
		$voucher = $this->m_kasir->detailVoucher($id);
		echo json_encode($voucher);
	}
}
