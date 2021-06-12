<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_grade_manage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin_grade_manage');
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_konfigurasi');
		if ($this->session->userdata('role') == 'admin') {
		} else {
			redirect('login');
		}
	}

	public function grade()
	{
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Grade',
			'nama' => $this->session->userdata('nama')
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_grade');
		$this->load->view('admin/templates/footer', $footer);
	}

	public function getGrade()
	{
		$data = $this->m_admin_grade_manage->getGrade();
		echo json_encode($data);
	}

	public function simpanGrade()
	{
		$grade = $this->input->post('grade');
		$limit_voucher = str_replace('.', '', $this->input->post('limit_voucher'));
		$simpanan_wajib = str_replace('.', '', $this->input->post('simpanan_wajib'));
		if ($this->m_admin_grade_manage->cekGrade($grade)) {
			$data = array('res' => 'grade', 'message' => 'Grade sudah ada');
		} else {
			$dataGrade = array(
				'grade' => $grade,
				'limit_voucher' => $limit_voucher,
				'simpanan_wajib' => $simpanan_wajib
			);
			if ($this->m_admin_grade_manage->insert($dataGrade)) {
				$data = array('res' => 'success', 'message' => 'Grade Berhasil Ditambahkan');
			} else {
				$data = array('res' => 'error', 'message' => 'Gagal Menambahkan Grade');
			}
		}
		echo json_encode($data);
	}

	public function getDetailGrade()
	{
		$id = $this->input->post('id');
		$data = $this->db->where('id', $id)->get('grade')->row();
		echo json_encode($data);
	}

	public function hapusGrade()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		if ($this->db->delete('grade')) {
			$data = array('res' => 'success', 'message' => 'Grade Berhasil Dihapus');
		} else {
			$data = array('res' => 'error', 'message' => 'Grade Gagal Dihapus');
		}
		echo json_encode($data);
	}

	public function editGrade()
	{
		$id = $this->input->post('id');
		$grade = $this->input->post('grade');
		$limit_voucher = str_replace('.', '', $this->input->post('limit_voucher'));
		$simpanan_wajib = str_replace('.', '', $this->input->post('simpanan_wajib'));
		$data = array(
			'grade' => $grade,
			'limit_voucher' => $limit_voucher,
			'simpanan_wajib' => $simpanan_wajib,
			'updated_at' => date("Y-m-d H:i:s")
		);
		$data_grade = $this->db->where('id', $id)->get('grade')->row()->grade;
		if ($grade == $data_grade) {
			if ($this->m_admin_grade_manage->update($id, $data)) {
				$response = array('res' => 'success', 'message' => 'Grade Berhasil Diubah');
			} else {
				$response = array('res' => 'error', 'message' => 'Grade Gagal Diubah');
			}
		} else {
			if ($this->m_admin_grade_manage->cekGrade($grade)) {
				$response = array('res' => 'grade', 'message' => 'Grade sudah ada');
			} else {
				if ($this->m_admin_grade_manage->update($id, $data)) {
					$response = array('res' => 'success', 'message' => 'Grade Berhasil Diubah');
				} else {
					$response = array('res' => 'error', 'message' => 'Grade Gagal Diubah');
				}
			}
		}

		// $response = array('res' => 'error', 'message' => $limit_voucher);

		echo json_encode($response);
	}
}
