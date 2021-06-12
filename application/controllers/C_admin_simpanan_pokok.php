<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_simpanan_pokok extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_simpanan');
		if ($this->session->userdata('role') == 'admin') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$pengguna = $this->db->where('role', 'pegawai')->group_by('nama')->order_by('nama', 'ASC')->get('pengguna')->result();
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Simpanan Pokok',
			'nama' => $this->session->userdata('nama')
		];
		$data = [
			'pegawai' => $pengguna
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];
		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_simpanan_pokok', $data);
		$this->load->view('admin/templates/footer', $footer);
	}

	public function getSimpananPokok()
	{
		$namaPegawai = $this->input->post('namaPegawai');
		$statusSimpanan = $this->input->post('statusSimpanan');
		$statusAkun = $this->input->post('statusAkun');
		$simpananPokok = $this->m_admin_simpanan->getSimpananPokok($namaPegawai, $statusSimpanan, $statusAkun);
		echo json_encode($simpananPokok);
	}

	public function getDetailSimpananPokok()
	{
		$id = $this->input->post('id');
		$simpananPokok = $this->m_admin_simpanan->getDetailSimpananPokok($id);

		$status_bayar = '';
		$tgl_konfirmasi = '';
		$btn_konfirmasi = '';
		if ($simpananPokok->status == 0) {
			$status_bayar = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak">Belum Bayar</div>';
			$btn_konfirmasi = '<li class="list-group-item px-1 py-1">
						<button style="float: right" class="btn btn-sm btn-primary mt-3" id="btn-bayar" onclick="bayar(' . $simpananPokok->id . ')"><i class="fas fa-question-circle"></i> Konfirmasi Pembayaran</button>
					</li>';
		} else if ($simpananPokok->status == 1) {
			$admin = $this->m_admin_simpanan->getAdmin($simpananPokok->id_admin);
			$status_bayar = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Ditolak">Sudah Bayar</div>';
			$tgl_konfirmasi = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tanggal Konfirmasi :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($simpananPokok->tgl_konfirmasi_admin)) . " (" . $admin . ")" . '</strong>
					</li>';
			$btn_konfirmasi = '<li class="list-group-item px-1 py-1">
						<button style="float: right" class="btn btn-sm btn-primary mt-3" id="btn-bayar" onclick="cairkan(' . $simpananPokok->id . ')"><i class="fas fa-question-circle"></i> Cairkan Dana</button>
					</li>';
		} else if ($simpananPokok->status == 2) {
			$admin = $this->m_admin_simpanan->getAdmin($simpananPokok->id_admin);
			$status_bayar = '<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Ditolak">Sudah Dicairkan</div>';
			$tgl_konfirmasi = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tanggal Konfirmasi :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($simpananPokok->tgl_konfirmasi_admin)) . " (" . $admin . ")" . '</strong>
					</li>';
		}

		$status_akun = '';
		if ($simpananPokok->status_akun == 1) {
			$status_akun = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Ditolak">Aktif</div>';
		} else {
			$status_akun = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak">Tidak Aktif</div>';
		}


		$output = '<ul class="list-group list-group-flush">
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Nama Pegawai :</p>
						<strong style="float: right;">' . $simpananPokok->nama . '</strong>
					</li>					
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Total Simpanan :</p>
						<strong style="float: right;">' . number_format($simpananPokok->total_simpanan_pokok, 0, '', '.') . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Status Akun :</p>
						<strong style="float: right;">' . $status_akun . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Status Simpanan :</p>
						<strong style="float: right;">' . $status_bayar . '</strong>
					</li>' . $tgl_konfirmasi .
			$btn_konfirmasi . '
				</ul>';

		echo $output;
	}

	public function prosesSimpananPokok()
	{
		$id = $this->input->post('id');
		$data = array(
			'status' => 1,
			'id_admin' => $this->session->userdata('id'),
			'updated_at' =>  date("Y-m-d H:i:s"),
			'tgl_konfirmasi_admin' => date("Y-m-d")
		);
		if ($this->m_admin_simpanan->updateSimpananPokok($id, $data)) {
			$response = array('res' => 'success', 'message' => 'Simpanan Pokok Berhasil Diproses');
		} else {
			$response = array('res' => 'error', 'message' => 'Simpanan Pokok Gagal Diproses');
		}
		echo json_encode($response);
	}

	public function prosesCairkanSimpananPokok()
	{
		$id = $this->input->post('id');
		$data = array(
			'status' => 2,
			'id_admin' => $this->session->userdata('id'),
			'updated_at' =>  date("Y-m-d H:i:s"),
			'tgl_konfirmasi_admin' => date("Y-m-d")
		);
		if ($this->m_admin_simpanan->updateSimpananPokok($id, $data)) {
			$response = array('res' => 'success', 'message' => 'Simpanan Pokok Berhasil Dicairkan');
		} else {
			$response = array('res' => 'error', 'message' => 'Simpanan Pokok Gagal Dicairkan');
		}
		echo json_encode($response);
	}
}
