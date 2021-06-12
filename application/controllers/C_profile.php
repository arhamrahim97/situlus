<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_admin_pp');
		$this->load->model('m_admin_pk');
		$this->load->model('m_admin_pa');
		$this->load->model('m_wilayah');
		if ($this->session->userdata('success_login') == TRUE) {
		} else {
			redirect('login');
		}
	}


	public function fotoKTP($nama)
	{
		$config['upload_path']          = APPPATH . '../uploads/img/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = '2048';
		$config['max_width']            = '5000';
		$config['max_height']           = '5000';
		$config['file_name'] 			= 'Foto KTP ' . str_replace(".", " ", $nama);
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto_ktp')) {
			return array('res' => 'error', 'message' => 'Foto KTP :' . $this->upload->display_errors());
		} else {
			return array('res' => 'success', 'message' => $this->upload->data('file_name'));
		}
	}

	public function ubahFotoKTP()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$fileKTP = null;
		$fileKTP = $this->fotoKTP($nama);
		if ($fileKTP['res'] == 'error') {
			echo json_encode($fileKTP);
		} else {
			$ajax_data['foto_ktp'] = $fileKTP['message'];
			if ($this->m_admin_pp->update($id, $ajax_data)) {
				$data = array('res' => 'success', 'message' => 'Foto KTP berhasil diubah');
			} else {
				$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
			}
			echo json_encode($data);
		}
	}

	public function fotoKK($nama)
	{
		$config['upload_path']          = APPPATH . '../uploads/img/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = '2048';
		$config['max_width']            = '5000';
		$config['max_height']           = '5000';
		$config['file_name'] 			= 'Foto KK ' . str_replace(".", " ", $nama);
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto_kk')) {
			return array('res' => 'error', 'message' => 'Foto KK :' . $this->upload->display_errors());
		} else {
			return array('res' => 'success', 'message' => $this->upload->data('file_name'));
		}
	}

	public function ubahFotoKK()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$fileKK = null;
		$fileKK = $this->fotoKK($nama);
		if ($fileKK['res'] == 'error') {
			echo json_encode($fileKK);
		} else {
			$ajax_data['foto_kk'] = $fileKK['message'];
			if ($this->m_admin_pp->update($id, $ajax_data)) {
				$data = array('res' => 'success', 'message' => 'Foto KK berhasil diubah');
			} else {
				$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
			}
			echo json_encode($data);
		}
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

	public function ubahFotoProfil()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$fileProfil = null;
		$fileProfil = $this->fotoProfil($nama);
		if ($fileProfil['res'] == 'error') {
			echo json_encode($fileProfil);
		} else {
			$ajax_data['foto_profil'] = $fileProfil['message'];
			if ($this->m_admin_pp->update($id, $ajax_data)) {
				$data = array('res' => 'success', 'message' => 'Foto Profil berhasil diubah');
			} else {
				$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
			}
			echo json_encode($data);
		}
	}

	public function detailPegawai()
	{
		$id = $this->input->post('id');
		$detail = $this->m_admin_pp->getDetailPegawai($id);
		echo json_encode($detail);
	}

	public function cekDataPegawaiDetail()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');

		if ($this->m_admin_pp->cekNamaDetail($id, $nama)) {
			$data = array('res' => 'nama', 'message' => 'Nama sudah ada');
		} else if ($this->m_admin_pp->cekUsernameDetail($id, $username)) {
			$data = array('res' => 'username', 'message' => 'Username sudah digunakan');
		} else {
			$data = array('res' => 'success');
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

	public function cekDataAdminDetail()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');

		if ($this->m_admin_pa->cekNamaDetail($id, $nama)) {
			$data = array('res' => 'nama', 'message' => 'Nama sudah ada');
		} else if ($this->m_admin_pa->cekUsernameDetail($id, $username)) {
			$data = array('res' => 'username', 'message' => 'Username sudah digunakan');
		} else {
			$data = array('res' => 'success');
		}
		echo json_encode($data);
	}

	public function ubahDataPegawai()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$ajax_data['password'] = md5($this->input->post('password'));
		$ajax_data['password_show'] = $this->input->post('password');

		if ($this->m_admin_pp->update($id, $ajax_data)) {
			$data = array('res' => 'success', 'message' => 'Data pegawai berhasil diubah');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
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

	public function ubahDataAdmin()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$ajax_data['password'] = md5($this->input->post('password'));
		$ajax_data['password_show'] = $this->input->post('password');

		if ($this->m_admin_pa->update($id, $ajax_data)) {
			$data = array('res' => 'success', 'message' => 'Data admin berhasil diubah');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}
}
