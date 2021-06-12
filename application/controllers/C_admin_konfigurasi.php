<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_konfigurasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_konfigurasi');
		if ($this->session->userdata('role') == 'admin') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Konfigurasi',
			'nama' => $this->session->userdata('nama')
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_konfigurasi');
		$this->load->view('admin/templates/footer', $footer);
	}

	public function konfigurasiLayanan()
	{
		$konfigurasi = $this->m_admin_konfigurasi->getKonfigurasi();
		$output = '';
		$output .= '
				<div class="form-group">
					<label>Bunga Pinjaman (%) :</label>
					<input type="number" class="form-control " id="bunga-pinjaman" disabled value="' . $konfigurasi->bunga_pinjaman . '">
				</div>
				<div class="form-group">
					<label>Bunga Voucher (%) :</label>
					<input type="number" class="form-control " id="bunga-voucher" disabled value="' . $konfigurasi->bunga_voucher . '">
				</div>
				<div class="form-group">
					<label>Nominal Simpanan Pokok :</label>
					<input type="text" class="form-control " id="simpanan-pokok" disabled value="' . $konfigurasi->simpanan_pokok . '">
				</div>
				<div class="float-right" id="btn-perbarui-layanan" style="display: none;">
					<button class="btn btn-sm btn-danger mr-1" id="btl-konfiguras-layanan"><i class="fas fa-times"></i> Batal</button>
					<button class="btn btn-primary btn-sm btn-perbarui-layanan2" id="' . $konfigurasi->id . '"><i class="fas fa-check-circle"></i> Perbarui</button>
				</div>
			';
		echo $output;
	}

	public function perbaruiLayanan()
	{
		$id = $this->input->post('id');
		$bunga_pinjaman = $this->input->post('bunga_pinjaman');
		$bunga_voucher = $this->input->post('bunga_voucher');
		$simpanan_pokok = $this->input->post('simpanan_pokok');
		if ($this->m_admin_konfigurasi->perbaruiLayanan($id, $bunga_voucher, $bunga_pinjaman, $simpanan_pokok)) {
			$data = array('res' => 'success', 'message' => 'Data berhasil diperbarui');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}

	public function konfigurasiWeb()
	{
		$konfigurasi = $this->m_admin_konfigurasi->getKonfigurasi();
		$output = '';
		$output .= '
				<div class="form-group">
					<label>Title Header :</label>
					<input type="text" class="form-control " id="title-header" disabled value="' . $konfigurasi->title_header . '">
				</div>
				<div class="form-group">
					<label>Title Footer :</label>
					<input type="text" class="form-control " id="title-footer" disabled value="' . $konfigurasi->title_footer . '">
				</div>
				<div class="form-group">
					<label>Title Background :</label>
					<input type="text" class="form-control " id="title-background" disabled value="' . $konfigurasi->title_carousel . '">
				</div>
				<div class="form-group">
					<label>Jam Buka :</label>
					<input type="text" class="form-control " id="jam-buka" disabled value="' . $konfigurasi->jam_buka . '">
				</div>
				<div class="form-group">
					<label>Telepon :</label>
					<input type="number" class="form-control " id="telepon" disabled value="' . $konfigurasi->telepon . '">
				</div>
				<div class="form-group">
					<label>Email :</label>
					<input type="email" class="form-control " id="email" disabled value="' . $konfigurasi->email . '">
				</div>
				<div class="form-group">
					<label>Link Facebook :</label>
					<input type="text" class="form-control " id="facebook" disabled value="' . $konfigurasi->facebook . '">
				</div>
				<div class="form-group">
					<label>Link Twitter :</label>
					<input type="text" class="form-control " id="twitter" disabled value="' . $konfigurasi->twitter . '">
				</div>
				<div class="form-group">
					<label>Link Instagram :</label>
					<input type="text" class="form-control " id="instagram" disabled value="' . $konfigurasi->instagram . '">
				</div>
				<div class="float-right" id="btn-perbarui-web" style="display: none;">			
					<button class="btn btn-sm btn-danger mr-1" id="btl-konfiguras-web"><i class="fas fa-times"></i> Batal</button>
					<button class="btn btn-primary btn-sm btn-perbarui-web2" id="' . $konfigurasi->id . '"><i class="fas fa-check-circle"></i> Perbarui</button>
				</div>
			';
		echo $output;
	}

	public function perbaruiWeb()
	{
		$id = $this->input->post('id');
		$title_header = $this->input->post('title_header');
		$title_footer = $this->input->post('title_footer');
		$title_carousel = $this->input->post('title_background');
		$jam_buka = $this->input->post('jam_buka');
		$telepon = $this->input->post('telepon');
		$email = $this->input->post('email');
		$facebook = $this->input->post('facebook');
		$twitter = $this->input->post('twitter');
		$instagram = $this->input->post('instagram');
		if ($this->m_admin_konfigurasi->perbaruiWeb($id, $title_header, $title_footer, $title_carousel, $jam_buka, $telepon, $email, $facebook, $twitter, $instagram)) {
			$data = array('res' => 'success', 'message' => 'Data berhasil diperbarui');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}
}
