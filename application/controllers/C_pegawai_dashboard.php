<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pegawai_dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_pp');
		if ($this->session->userdata('role') == 'pegawai') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$voucherLatest = $this->db->where('id_pegawai', $this->session->userdata('id'))->order_by('created_at', 'DESC')->get('voucher_belanja')->first_row();
		$simpanan_pokok = $this->db->where('id_pegawai', $this->session->userdata('id'))->get('simpanan_pokok')->row();
		$countSimpananWajib = $this->db->where('id_pegawai', $this->session->userdata('id'))->order_by('created_at', 'DESC')->get('simpanan_wajib')->num_rows();
		$simpananWajibLatest = $this->db->where('id_pegawai', $this->session->userdata('id'))->order_by('created_at', 'DESC')->get('simpanan_wajib')->first_row();
		$countPeminjaman = $this->db->where('id_pegawai', $this->session->userdata('id'))->where('konfirmasi_admin', 1)->order_by('created_at', 'DESC')->get('peminjaman')->num_rows();
		$peminjamanLatest = $this->db->where('id_pegawai', $this->session->userdata('id'))->where('konfirmasi_admin', 1)->order_by('created_at', 'DESC')->get('peminjaman')->first_row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Dashboard',
			'nama' => $this->session->userdata('nama'),
		];
		$data = [
			'nama' => $this->session->userdata('nama'),
			'voucherLatest' => $voucherLatest,
			'simpanan_pokok' => $simpanan_pokok,
			'countSimpananWajib' => $countSimpananWajib,
			'simpananWajibLatest' => $simpananWajibLatest,
			'countPeminjaman' => $countPeminjaman,
			'pinjamanLatest' => $peminjamanLatest,

		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];
		$this->load->view('pegawai/templates/header', $header);
		$this->load->view('pegawai/pages/v_dashboard', $data);
		$this->load->view('pegawai/templates/footer', $footer);
	}
}
