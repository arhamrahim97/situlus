

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
	}

	public function index()
	{
		$role = $this->session->userdata('role');
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$data = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Login',
			'title_footer' => $pengaturan->title_footer
		];

		if ($role == 'pegawai') {
			redirect('dashboard');
		} else if ($role == 'admin') {
			redirect('dashboard-admin');
		} else {
			$this->load->view('pegawai/pages/v_login', $data);
		}
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));


		if ($this->m_login->getUser($username, $password)) {
			$role = $this->session->userdata('role');
			if ($role == "pegawai") {
				// redirect('dashboard');
				$response = array('res' => 'pegawai');
			} else if ($role == 'admin') {
				$this->_createSimpananWajib();
				// redirect('dashboard-admin');
				$response = array('res' => 'admin');
			} else if ($role == 'kasir') {
				// redirect('dashboard-kasir');
				$response = array('res' => 'kasir');
			}
		} else {
			// redirect('login');
			$response = array('res' => 'tidakAktif');
		}
		echo json_encode($response);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function cekDataLogin()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		if ($this->m_login->cekDataLogin($username, $password) == TRUE) {
			$response = array('res' => 'success');
		} else {
			$response = array('res' => 'error');
		}
		echo json_encode($response);
	}

	private function _createSimpananWajib()
	{
		$pengguna = $this->m_login->getPengguna();
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$cek_simpanan_wajib = $this->db->like('created_at', date('Y-m'))->get('simpanan_wajib')->num_rows();
		if ($cek_simpanan_wajib == 0) {
			foreach ($pengguna as $user) {
				$this->db->like('created_at', date('Y-m'));
				$this->db->where('id_pegawai', $user->id);
				$simpanan_wajib = $this->db->get('simpanan_wajib')->row();
				if (!$simpanan_wajib) {
					$data = array(
						'id_pegawai' => $user->id,
						'total_simpanan_wajib' => $user->simpanan_wajib,
						'status' => 0
					);
					$this->db->insert('simpanan_wajib', $data);
				}
			}
		}
	}
}
