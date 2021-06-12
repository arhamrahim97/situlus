<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_syarat_dan_ketentuan extends CI_Model
{
	function getSK()
	{
		$data = $this->db->order_by('kategori', 'DESC')->get('syarat_dan_ketentuan')->result();
		return $data;
	}

	function cekSK($nomor, $kategori)
	{
		$this->db->where('nomor', $nomor);
		$this->db->where('kategori', $kategori);
		return $this->db->get('syarat_dan_ketentuan')->row();
	}

	function insert($dataSK)
	{
		return $this->db->insert('syarat_dan_ketentuan', $dataSK);
	}

	function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('syarat_dan_ketentuan', $data);
	}
}
