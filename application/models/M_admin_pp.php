<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_pp extends CI_Model
{
	function getData()
	{
		$this->db->select('pengguna.id, pengguna.nama as nama_pengguna, pengguna.nip, pengguna.telepon, pengguna.status, pengguna.alamat, grade.grade, wilayah_provinsi.nama as provinsi, wilayah_kabupaten.nama as kabupaten, wilayah_kecamatan.nama as kecamatan, wilayah_desa.nama as kelurahan, pengguna.created_at, pengguna.updated_at');
		$this->db->where('role', 'pegawai');
		$this->db->from('pengguna');
		$this->db->join('grade', 'grade.id = pengguna.grade', 'left');
		$this->db->join('wilayah_provinsi', 'wilayah_provinsi.id = pengguna.provinsi', 'left');
		$this->db->join('wilayah_kabupaten', 'wilayah_kabupaten.id = pengguna.kabupaten', 'left');
		$this->db->join('wilayah_kecamatan', 'wilayah_kecamatan.id = pengguna.kecamatan', 'left');
		$this->db->join('wilayah_desa', 'wilayah_desa.id = pengguna.kelurahan', 'left');
		$this->db->order_by('pengguna.id', 'DESC');
		return $this->db->get()->result();
	}

	function cekNama($nama)
	{
		$this->db->where('nama', $nama);
		$this->db->where('role', 'pegawai');
		return $this->db->get('pengguna')->row();
	}

	function cekNamaDetail($id, $nama)
	{
		$this->db->where('id !=', $id);
		$this->db->where('nama', $nama);
		$this->db->where('role', 'pegawai');
		return $this->db->get('pengguna')->row();
	}

	function cekUsername($username)
	{
		$this->db->where('username', $username);
		// $this->db->where('role', 'pegawai');
		return $this->db->get('pengguna')->row();
	}

	function cekUsernameDetail($id, $username)
	{
		$this->db->where('id !=', $id);
		$this->db->where('username', $username);
		// $this->db->where('role', 'pegawai');
		return $this->db->get('pengguna')->row();
	}

	function cekPassword($password)
	{
		$this->db->where('password', md5($password));
		return $this->db->get('pengguna')->row();
	}

	function insert($ajaxData)
	{
		return $this->db->insert('pengguna', $ajaxData);
	}


	function insert_sp()
	{
		$this->db->order_by('id', 'DESC');
		$pengguna = $this->db->get('pengguna')->first_row();

		$pengaturan = $this->db->get('pengaturan')->first_row();

		// $ajaxData2['id_pegawai'] = $pengguna->id;
		$data = array(
			'id_pegawai' => $pengguna->id,
			'total_simpanan_pokok' => $pengaturan->simpanan_pokok
		);
		$this->db->insert('simpanan_pokok', $data);
	}

	public function update($id, $ajax_data)
	{
		$this->db->where('id', $id);
		return $this->db->update('pengguna', $ajax_data);
	}

	function getDetailPegawai($id)
	{
		$this->db->select('*, pengguna.id, pengguna.nama as nama_pengguna,pengguna.created_at, pengguna.updated_at');
		$this->db->from('pengguna');
		$this->db->where('pengguna.id', $id);
		// $this->db->join('wilayah_provinsi', 'wilayah_provinsi.id = pengguna.provinsi', 'left');
		// $this->db->join('wilayah_kabupaten', 'wilayah_kabupaten.id = pengguna.kabupaten', 'left');
		// $this->db->join('wilayah_kecamatan', 'wilayah_kecamatan.id = pengguna.kecamatan', 'left');
		// $this->db->join('wilayah_desa', 'wilayah_desa.id = pengguna.kelurahan', 'left');
		return $this->db->get()->row();
	}

	function nonaktifkanPegawai($id)
	{
		$this->db->set('status', 2);
		$this->db->where('id', $id);
		return $this->db->update('pengguna');
	}

	function aktifkanPegawai($id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $id);
		return $this->db->update('pengguna');
	}

	function updatePegawai($id, $data_insert)
	{
		$this->db->where('id', $id);
		return $this->db->update('pengguna', $data_insert);
	}
}
