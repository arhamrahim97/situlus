 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class C_kartu_anggota extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			if ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'pegawai') {
			} else {
				redirect('login');
			}

			if (!$this->input->post('id')) {
				redirect('login');
			}
		}
		public function cetakKartuAnggota()
		{
			$id = $this->input->post('id');
			$pengguna = $this->db->where('id', $id)->get('pengguna')->row();
			$data = [
				'pengguna' => $pengguna
			];
			$this->load->view('print/kartu_anggota', $data);
		}
	}
