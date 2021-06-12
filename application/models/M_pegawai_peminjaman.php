<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pegawai_peminjaman extends CI_Model
{


	function getData()
	{
		$id_pegawai = $this->session->userdata('id');
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->where('konfirmasi_admin', 1);
		return $this->db->get('peminjaman')->result();
	}

	function getPinjamanditolak()
	{
		$id_pegawai = $this->session->userdata('id');
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->where('konfirmasi_admin', 2);
		$this->db->where('status_pinjaman', 0);
		return $this->db->get('peminjaman');
	}

	function menugguKonfirmasi()
	{
		$id_pegawai = $this->session->userdata('id');
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->where('konfirmasi_admin', 0);
		$this->db->where('status_pinjaman', 0);
		return $this->db->get('peminjaman')->row();
	}

	function getDetail($id)
	{
		$this->db->select('*, peminjaman.id, tgl_pengusulan, total_pinjaman, tenor_pinjaman, pembayaran_perbulan, tgl_konfirmasi_admin, status_pinjaman, peminjaman.updated_at, nama');
		$this->db->from('peminjaman');
		$this->db->join('pengguna', 'pengguna.id = peminjaman.id_admin');
		$this->db->where('peminjaman.id', $id);
		return $this->db->get()->row();
	}

	function cekPeminjaman()
	{
		$idPegawai = $this->session->userdata('id');
		$this->db->where('id_pegawai', $idPegawai);
		$data = $this->db->get('peminjaman')->result();

		foreach ($data as $d) {
			if (($d->status_pinjaman == 0) && ($d->konfirmasi_admin == 0)) {
				return array('res' => 'error1');
			} else if (($d->status_pinjaman == 0) && ($d->konfirmasi_admin == 1)) {
				return array('res' => 'error2');
			}
		}
	}

	function insert($ajax_data)
	{
		return $this->db->insert('peminjaman', $ajax_data);
	}

	function hapusPemberitahuan($id)
	{
		$update = array(
			'status_pinjaman' => '2',
			'updated_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('id', $id);
		return $this->db->update('peminjaman', $update);
	}

	function getTenor($id)
	{
		$this->db->select('*, tenor_pinjaman.id, tenor_pinjaman.konfirmasi_admin, tenor_pinjaman.tgl_konfirmasi_admin');
		$this->db->from('tenor_pinjaman');
		$this->db->join('peminjaman', 'peminjaman.id = tenor_pinjaman.id_pinjaman', 'left');
		$this->db->join('pengguna', 'pengguna.id = tenor_pinjaman.id_admin', 'left');
		$this->db->where('tenor_pinjaman.id_pinjaman', $id);
		return $this->db->get()->result();
	}
}

/* End of file mainModel.php */
/* Location: ./application/models/mainModel.php */
