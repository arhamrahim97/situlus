<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_master_barang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_konfigurasi');
		$this->load->model('m_admin_master_barang');
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
			'title' => 'Master Barang',
			'nama' => $this->session->userdata('nama')
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_master_barang');
		$this->load->view('admin/templates/footer', $footer);
	}

	public function getMasterBarang()
	{
		$data = $this->m_admin_master_barang->getMasterBarang();
		echo json_encode($data);
	}

	public function simpanMasterBarang()
	{
		$namaBarang = $this->input->post('nama_barang');
		if ($this->m_admin_master_barang->cekMasterBarang($namaBarang)) {
			$data = array('res' => 'nama_barang', 'message' => 'Barang sudah ada');
		} else {
			$dataMasterBarang = array(
				'nama_barang' => $namaBarang
			);
			if ($this->m_admin_master_barang->insert($dataMasterBarang)) {
				$data = array('res' => 'success', 'message' => 'Barang Berhasil Ditambahkan');
			} else {
				$data = array('res' => 'error', 'message' => 'Gagal Menambahkan Barang');
			}
		}
		echo json_encode($data);
	}

	public function getDetailMasterBarang()
	{
		$id = $this->input->post('id');
		$data = $this->db->where('id', $id)->get('master_barang')->row();
		echo json_encode($data);
	}

	public function editMasterBarang()
	{
		$id = $this->input->post('id');
		$nama_barang = $this->input->post('nama_barang');
		$data = array(
			'nama_barang' => $nama_barang,
			'modified_at' => date("Y-m-d H:i:s")
		);
		$dataMasterBarang = $this->db->where('id', $id)->get('master_barang')->row()->nama_barang;
		if ($nama_barang == $dataMasterBarang) {
			if ($this->m_admin_master_barang->update($id, $data)) {
				$response = array('res' => 'success', 'message' => 'Barang Berhasil Diubah');
			} else {
				$response = array('res' => 'error', 'message' => 'Barang Gagal Diubah');
			}
		} else {
			if ($this->m_admin_master_barang->cekMasterBarang($nama_barang)) {
				$response = array('res' => 'nama_barang', 'message' => 'Nama Barang sudah ada');
			} else {
				if ($this->m_admin_master_barang->update($id, $data)) {
					$response = array('res' => 'success', 'message' => 'Barang Berhasil Diubah');
				} else {
					$response = array('res' => 'error', 'message' => 'Barang Gagal Diubah');
				}
			}
		}
		echo json_encode($response);
	}

	public function hapusMasterBarang()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		if ($this->db->delete('master_barang')) {
			$data = array('res' => 'success', 'message' => 'Barang Berhasil Dihapus');
		} else {
			$data = array('res' => 'error', 'message' => 'Barang Gagal Dihapus');
		}
		echo json_encode($data);
	}
}
