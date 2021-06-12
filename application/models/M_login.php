<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model
{
	function getUser($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where('status', 1);
		if ($this->db->get('pengguna')->row()) {
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$this->db->where('status', 1);

			$this->session->set_userdata($this->db->get('pengguna')->row_array());
			$this->session->set_userdata('success_login', TRUE);
			return true;
		} else {
			return false;
		}
	}

	function cekDataLogin($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$a = $this->db->get('pengguna')->num_rows();
		if ($a > 0) {
			return TRUE;
		}
	}

	function getPengguna()
	{
		$this->db->select('pengguna.*,grade.simpanan_wajib');
		$this->db->from('pengguna');
		$this->db->join('grade', 'grade.id = pengguna.grade');
		$this->db->where('pengguna.role', 'pegawai');
		$this->db->where('pengguna.status', '1');
		return $this->db->get()->result();
	}
}

/* End of file mainModel.php */
/* Location: ./application/models/mainModel.php */
