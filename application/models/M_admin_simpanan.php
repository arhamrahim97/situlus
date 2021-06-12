<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_simpanan extends CI_Model
{
	function getData()
	{
		$this->db->where('id_pegawai', $this->session->userdata('id'));
		return $this->db->get('simpanan_pokok')->row();
	}

	function getSimpananPokok($namaPegawai, $statusSimpanan, $statusAkun)
	{
		$this->db->select('simpanan_pokok.*,pengguna.nama,pengguna.id as id_pengguna,pengguna.status as status_akun');
		$this->db->from('simpanan_pokok');
		$this->db->join('pengguna', 'pengguna.id = simpanan_pokok.id_pegawai', 'left');
		$this->db->order_by('pengguna.id', 'DESC');
		if ($namaPegawai) {
			$this->db->where('pengguna.nama', $namaPegawai);
		}
		if ($statusSimpanan) {
			$this->db->where('simpanan_pokok.status', $statusSimpanan);
		}
		if ($statusAkun) {
			$this->db->where('pengguna.status', $statusAkun);
		}
		return $this->db->get()->result();
	}

	function getDetailSimpananPokok($id)
	{
		$this->db->select('simpanan_pokok.*,pengguna.nama,pengguna.id as id_pengguna,pengguna.status as status_akun');
		$this->db->from('simpanan_pokok');
		$this->db->join('pengguna', 'pengguna.id = simpanan_pokok.id_pegawai', 'left');
		$this->db->where('simpanan_pokok.id', $id);
		return $this->db->get()->row();
	}

	function getAdmin($id)
	{
		$admin = $this->db->where('id', $id)->get('pengguna')->row()->nama;
		return $admin;
	}

	function updateSimpananPokok($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('simpanan_pokok', $data);
	}

	function getSimpananWajib($tagihan, $namaPegawai, $statusBayar)
	{
		$this->db->select('simpanan_wajib.*,pengguna.nama,pengguna.id as id_pengguna,pengguna.status as status_akun');
		$this->db->from('simpanan_wajib');
		$this->db->order_by('created_at', 'DESC');
		$this->db->join('pengguna', 'pengguna.id = simpanan_wajib.id_pegawai', 'left');
		$status = $statusBayar;
		if ($status == 3) {
			$status = 0;
		}
		if ($tagihan) {
			$this->db->where('simpanan_wajib.created_at', $tagihan);
		}
		if ($namaPegawai) {
			$this->db->where('nama', $namaPegawai);
		}
		if ($statusBayar) {
			$this->db->where('simpanan_wajib.status', $status);
		}
		return $this->db->get()->result();
	}

	function getSimpananWajibTotal()
	{
		$sql = 'SELECT n.id, n.id_pegawai as id_pegawai, pengguna.nama as nama,  n.total_simpanan as total_simpanan, n.penambahan_pencairan as penambahan_pencairan, n.created_at
		FROM simpanan_wajib_total n LEFT JOIN pengguna ON pengguna.id = id_pegawai
		WHERE n.created_at = (SELECT MAX(created_at)
									  FROM simpanan_wajib_total
									  GROUP BY id_pegawai
									  HAVING id_pegawai = n.id_pegawai) ORDER BY n.updated_at DESC';

		return $this->db->query($sql)->result();
	}

	function getDetailSimpananWajib($id)
	{
		$this->db->select('simpanan_wajib.*,pengguna.nama,pengguna.id as id_pengguna,pengguna.status as status_akun');
		$this->db->from('simpanan_wajib');
		$this->db->join('pengguna', 'pengguna.id = simpanan_wajib.id_pegawai', 'left');
		$this->db->where('simpanan_wajib.id', $id);
		return $this->db->get()->row();
	}

	function getDetailSimpananWajibTotal($id)
	{
		$sql = 'SELECT n.id, n.id_pegawai as id_pegawai, pengguna.nama as nama,  n.total_simpanan as total_simpanan, n.penambahan_pencairan as penambahan_pencairan, n.created_at
		FROM simpanan_wajib_total n LEFT JOIN pengguna ON pengguna.id = id_pegawai
		WHERE n.created_at = (SELECT MAX(created_at)
									  FROM simpanan_wajib_total
									  GROUP BY id_pegawai
									  HAVING id_pegawai = n.id_pegawai) and n.id = ' . $id . ' ORDER BY n.created_at DESC';

		return $this->db->query($sql)->row();
	}

	function getDetailSimpananWajibTabel($id)
	{
		$this->db->select('simpanan_wajib_total.*, simpanan_wajib_total.created_at, pengguna.nama, pengguna.id as id_pengguna');
		$this->db->from('simpanan_wajib_total');
		// $this->db->join('pengguna', 'pengguna.id = simpanan_wajib_total.id_pegawai', 'left');
		$this->db->join('pengguna', 'pengguna.id = simpanan_wajib_total.id_admin', 'left');
		$this->db->where('simpanan_wajib_total.id_pegawai', $id);
		$this->db->where('simpanan_wajib_total.konfirmasi_admin', 1);
		$this->db->order_by('updated_at', 'DESC');
		return $this->db->get()->result();
	}



	function updateSimpananWajib($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('simpanan_wajib', $data);
	}

	function totalSimpananWajib($id)
	{
		$simpananWajib = $this->db->where('id', $id)->get('simpanan_wajib');
		$simpananWajibPegawai = $simpananWajib->row();
		$simpananWajibTotal = $this->db->where('id_pegawai', $simpananWajibPegawai->id_pegawai)->order_by('created_at', 'DESC')->get('simpanan_wajib_total');
		if ($simpananWajibTotal->num_rows() == 0) {
			$data = array(
				'id_pegawai' => $simpananWajibPegawai->id_pegawai,
				'total_simpanan' => $simpananWajibPegawai->total_simpanan_wajib,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s"),
			);
			$this->db->insert('simpanan_wajib_total', $data);
		} else {
			$simpananWajibTotalLatest = $simpananWajibTotal->first_row();
			$data = array(
				'id_pegawai' => $simpananWajibPegawai->id_pegawai,
				'total_simpanan' => $simpananWajibTotalLatest->total_simpanan + $simpananWajibPegawai->total_simpanan_wajib,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s"),

			);
			$this->db->insert('simpanan_wajib_total', $data);
			// if ($simpananWajibTotalLatest->konfirmasi_admin == 1) {
			// 	$data = array(
			// 		'id_pegawai' => $simpananWajibPegawai->id_pegawai,
			// 		'total_simpanan' => $simpananWajibTotalLatest->total_simpanan + $pengaturan->simpanan_wajib,
			// 		'created_at' => date("Y-m-d H:i:s"),
			// 		'updated_at' => date("Y-m-d H:i:s"),

			// 	);
			// 	$this->db->insert('simpanan_wajib_total', $data);
			// } else if ($simpananWajibTotalLatest->konfirmasi_admin == 0) {
			// 	$data = array(
			// 		'total_simpanan' => $simpananWajibTotalLatest->total_simpanan + $pengaturan->simpanan_wajib,
			// 		'updated_at' => date("Y-m-d H:i:s"),
			// 	);
			// 	$this->db->where('id', $simpananWajibTotalLatest->id);
			// 	$this->db->update('simpanan_wajib_total', $data);
			// }
		}
	}

	function getPegawaiSimpananWajib()
	{
		$this->db->select('simpanan_wajib.*,pengguna.nama,pengguna.id as id_pengguna,pengguna.status as status_akun');
		$this->db->from('simpanan_wajib');
		$this->db->join('pengguna', 'pengguna.id = simpanan_wajib.id_admin', 'left');
		$this->db->where('id_pegawai', $this->session->userdata('id'));
		return $this->db->get()->result();
	}

	function cekPencairan($id, $nominal)
	{
		$simpananWajibTotal = $this->db->where('id', $id)->get('simpanan_wajib_total')->row();
		if ($nominal > $simpananWajibTotal->total_simpanan) {
			return false;
		} else {
			return true;
		}
	}

	function prosesPencairan($id, $nominal)
	{
		$simpananWajibTotal = $this->db->where('id', $id)->get('simpanan_wajib_total')->row();
		if ($simpananWajibTotal->konfirmasi_admin == 0) {
			$data = array(
				'total_simpanan' => $simpananWajibTotal->total_simpanan - $nominal,
				'penambahan_pencairan' => $nominal,
				'konfirmasi_admin' => 1,
				'id_admin' => $this->session->userdata('id'),
				'tgl_konfirmasi' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			);
			$this->db->where('id', $id);
			return $this->db->update('simpanan_wajib_total', $data);
		} else {
			$data = array(
				'id_pegawai' => $simpananWajibTotal->id_pegawai,
				'total_simpanan' => $simpananWajibTotal->total_simpanan - $nominal,
				'penambahan_pencairan' => $nominal,
				'konfirmasi_admin' => 1,
				'id_admin' => $this->session->userdata('id'),
				'tgl_konfirmasi' => date("Y-m-d H:i:s"),
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			);
			$this->db->where('id', $id);
			return $this->db->insert('simpanan_wajib_total', $data);
		}
	}

	function getDetailSimpananWajibTotalPegawai($id)
	{
		$sql = 'SELECT n.id, n.id_pegawai as id_pegawai, pengguna.nama as nama,  n.total_simpanan as total_simpanan, n.penambahan_pencairan as penambahan_pencairan, n.created_at
		FROM simpanan_wajib_total n LEFT JOIN pengguna ON pengguna.id = id_pegawai
		WHERE n.created_at = (SELECT MAX(created_at)
									  FROM simpanan_wajib_total
									  GROUP BY id_pegawai
									  HAVING id_pegawai = n.id_pegawai) and n.id_pegawai = ' . $id . ' ORDER BY n.created_at DESC';

		return $this->db->query($sql)->first_row();
	}

	function countSimpananWajibTotalPegawai($id)
	{
		$sql = 'SELECT n.id, n.id_pegawai as id_pegawai, pengguna.nama as nama,  n.total_simpanan as total_simpanan, n.penambahan_pencairan as penambahan_pencairan, n.created_at
		FROM simpanan_wajib_total n LEFT JOIN pengguna ON pengguna.id = id_pegawai
		WHERE n.created_at = (SELECT MAX(created_at)
									  FROM simpanan_wajib_total
									  GROUP BY id_pegawai
									  HAVING id_pegawai = n.id_pegawai) and n.id_pegawai = ' . $id . ' ORDER BY n.created_at DESC';

		return $this->db->query($sql)->num_rows();
	}
}
