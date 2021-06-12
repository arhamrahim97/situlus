<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pegawai_beranda extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_pengaturan');
	}

	public function index()
	{
		$data = [
			'info' => $this->m_pengaturan->getSettings()->row()
		];
		$this->load->view('pegawai/pages/v_beranda', $data);
	}
}
