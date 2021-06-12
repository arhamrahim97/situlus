<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_pk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_pk');
		$this->load->model('m_wilayah');
		if ($this->session->userdata('role') == 'admin') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$provinsi = $this->m_wilayah->getProvinsi();
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Pengguna (Kasir)',
			'nama' => $this->session->userdata('nama')
		];
		$data = [
			'provinsi' => $provinsi,
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];
		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_pk', $data);
		$this->load->view('admin/templates/footer', $footer);
	}

	public function dataKasir()
	{
		$data = $this->m_admin_pk->getData();
		echo json_encode($data);
	}

	public function cekDataKasir()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');

		if ($this->m_admin_pk->cekNama($nama)) {
			$data = array('res' => 'nama', 'message' => 'Nama sudah terdaftar');
		} else if ($this->m_admin_pk->cekUsername($username)) {
			$data = array('res' => 'username', 'message' => 'Username sudah digunakan');
		} else {
			$data = array('res' => 'success');
		}
		echo json_encode($data);
	}

	public function fotoProfil($nama)
	{
		$config['upload_path']          = APPPATH . '../uploads/img/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['file_name'] 			= 'Foto Profil ' . str_replace(".", " ", $nama);
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto_profil')) {
			return array('res' => 'success', 'message' => 'default.png');
		} else {
			$this->upload->data();
			return array('res' => 'success', 'message' => $this->upload->data('file_name'));
		}
	}

	public function tambahDataKasir()
	{

		$nama = $this->input->post('nama');
		$fileProfil = null;
		$fileProfil = $this->fotoProfil($nama);

		$ajax_data = $this->input->post();
		$ajax_data['foto_profil'] = $fileProfil['message'];
		$ajax_data['password'] = md5($this->input->post('password'));
		$ajax_data['password_show'] = $this->input->post('password');
		$ajax_data['role'] = 'kasir';

		if ($this->m_admin_pk->insert($ajax_data)) {
			$data = array('res' => 'success', 'message' => 'Data Kasir berhasil ditambah');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}

	public function cekDataKasirDetail()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');

		if ($this->m_admin_pk->cekNamaDetail($id, $nama)) {
			$data = array('res' => 'nama', 'message' => 'Nama sudah ada');
		} else if ($this->m_admin_pk->cekUsernameDetail($id, $username)) {
			$data = array('res' => 'username', 'message' => 'Username sudah digunakan');
		} else {
			$data = array('res' => 'success');
		}
		echo json_encode($data);
	}

	public function ubahDataKasir()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$ajax_data['password'] = md5($this->input->post('password'));
		$ajax_data['password_show'] = $this->input->post('password');

		if ($this->m_admin_pk->update($id, $ajax_data)) {
			$data = array('res' => 'success', 'message' => 'Data kasir berhasil diubah');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}
}
