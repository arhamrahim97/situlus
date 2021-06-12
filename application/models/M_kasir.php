<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_kasir extends CI_Model
{
	function getVoucher($statusBayarRekanan)
	{
		$this->db->select('voucher_belanja.*, pengguna.nama, voucher_belanja.tgl_konfirmasi_admin, voucher_belanja.tgl_konfirmasi_kasir,voucher_belanja.status_bayar_rekanan,voucher_belanja.total_belanja_kasir');
		$this->db->where('konfirmasi_kasir', 1);
		$this->db->from('voucher_belanja');
		$this->db->join('pengguna', 'pengguna.id = voucher_belanja.id_pegawai');
		$this->db->order_by('id', 'desc');

		if ($statusBayarRekanan == 'belum') {
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 0);
			$this->db->or_where('voucher_belanja.konfirmasi_pembayaran', 1);
			$this->db->where('voucher_belanja.status_bayar_rekanan', 0);
		} else if ($statusBayarRekanan == 'sudah') {
			$this->db->where('voucher_belanja.status_bayar_rekanan', 1);
		}
		return $this->db->get()->result();
	}

	function detailVoucher($id)
	{
		$this->db->select('voucher_belanja.*,pengguna.id as id_pengguna, pengguna.nama');
		$this->db->from('voucher_belanja');
		$this->db->join('pengguna', 'pengguna.id = voucher_belanja.id_pegawai');
		$this->db->where('voucher_belanja.id', $id);
		return $this->db->get()->row();
	}

	function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('voucher_belanja', $data);
	}

	function getDetailVoucher($id)
	{
		$this->db->select('voucher_belanja.*,pengguna.id as id_pengguna, pengguna.nama');
		$this->db->from('voucher_belanja');
		$this->db->join('pengguna', 'pengguna.id = voucher_belanja.id_pegawai');
		$this->db->where('voucher_belanja.id', $id);
		return $this->db->get()->row();
	}

	function getNama($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('pengguna')->row()->nama;
	}

	function getBelumBayarRekanan()
	{
		$this->db->where('konfirmasi_admin', 1);
		$this->db->where('konfirmasi_kasir', 1);
		$this->db->where('konfirmasi_pembayaran', 0);
		$this->db->or_where('konfirmasi_pembayaran', 1);
		$this->db->where('status_bayar_rekanan', 0);
		return $this->db->get('voucher_belanja');
	}
}
