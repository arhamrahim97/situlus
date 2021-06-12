<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_syarat_ketentuan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_syarat_dan_ketentuan');
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
			'title' => 'Syarat & Ketentuan',
			'nama' => $this->session->userdata('nama')
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_syarat_ketentuan');
		$this->load->view('admin/templates/footer', $footer);
	}

	public function getSK()
	{
		$data = $this->m_admin_syarat_dan_ketentuan->getSK();
		echo json_encode($data);
	}

	public function simpanSK()
	{
		$nomor = $this->input->post('nomor');
		$isi = html_escape($this->input->post('isi'));
		$kategori = $this->input->post('kategori');
		if ($this->m_admin_syarat_dan_ketentuan->cekSK($nomor, $kategori)) {
			$data = array('res' => 'nomor', 'message' => 'Nomor sudah ada pada kategori ' . $kategori);
		} else {
			$dataSK = array(
				'nomor' => $nomor,
				'kategori' => $kategori,
				'isi' => $isi
			);
			if ($this->m_admin_syarat_dan_ketentuan->insert($dataSK)) {
				$data = array('res' => 'success', 'message' => 'Syarat dan Ketentuan Berhasil Ditambahkan');
			} else {
				$data = array('res' => 'error', 'message' => 'Gagal Menambahkan Syarat dan Ketentuan');
			}
		}
		echo json_encode($data);
	}

	public function hapusSK()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		if ($this->db->delete('syarat_dan_ketentuan')) {
			$data = array('res' => 'success', 'message' => 'Syarat dan Ketentuan Berhasil Dihapus');
		} else {
			$data = array('res' => 'error', 'message' => 'Syarat dan Ketentuan Gagal Dihapus');
		}
		echo json_encode($data);
	}

	public function getDetailSK()
	{
		$id = $this->input->post('id');
		$data = $this->db->where('id', $id)->get('syarat_dan_ketentuan')->row();
		echo json_encode($data);
	}

	public function editSK()
	{
		$id = $this->input->post('id');
		$nomor = $this->input->post('nomor');
		$kategori = $this->input->post('kategori');
		$isi = html_escape($this->input->post('isi'));
		$data = array(
			'nomor' => $nomor,
			'kategori' => $kategori,
			'isi' => $isi,
			'modified_at' => date("Y-m-d H:i:s")
		);
		$data_SK = $this->db->where('id', $id)->where('kategori', $kategori)->get('syarat_dan_ketentuan')->row()->nomor;
		if ($nomor == $data_SK) {
			if ($this->m_admin_syarat_dan_ketentuan->update($id, $data)) {
				$response = array('res' => 'success', 'message' => 'Syarat dan Ketentuan Berhasil Diubah');
			} else {
				$response = array('res' => 'error', 'message' => 'Syarat dan Ketentuan Gagal Diubah');
			}
		} else {
			if ($this->m_admin_syarat_dan_ketentuan->cekSK($nomor, $kategori)) {
				$response = array('res' => 'nomor', 'message' => 'Nomor sudah ada');
			} else {
				if ($this->m_admin_syarat_dan_ketentuan->update($id, $data)) {
					$response = array('res' => 'success', 'message' => 'Syarat dan Ketentuan Berhasil Diubah');
				} else {
					$response = array('res' => 'error', 'message' => 'Syarat dan Ketentuan Gagal Diubah');
				}
			}
		}
		echo json_encode($response);
	}
}
