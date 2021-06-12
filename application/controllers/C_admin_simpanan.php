<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_simpanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
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
			'title' => 'Simpanan Wajib & Simpanan Pokok',
			'nama' => $this->session->userdata('nama')
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];
		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_simpanan');
		$this->load->view('admin/templates/footer', $footer);
	}
}
