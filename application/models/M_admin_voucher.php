<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_voucher extends CI_Model
{
	public function countPengajuan()
	{
		$this->db->where('konfirmasi_admin', 0);
		$this->db->where('konfirmasi_kasir', 0);
		$this->db->where('konfirmasi_pembayaran', 0);
		return $this->db->get('voucher_belanja')->num_rows();
	}

	public function getPengajuan()
	{
		$this->db->select('voucher_belanja.*,pengguna.id as id_pengguna,pengguna.nama');
		$this->db->from('voucher_belanja');
		$this->db->join('pengguna', 'pengguna.id = voucher_belanja.id_pegawai');
		$this->db->where('voucher_belanja.konfirmasi_admin', 0);
		$this->db->where('voucher_belanja.konfirmasi_kasir', 0);
		$this->db->where('voucher_belanja.konfirmasi_pembayaran', 0);
		return $this->db->get()->result();
	}

	public function getVoucher($namaPegawai, $statusDigunakan, $statusBayarAnggota, $statusProsesVoucher)
	{
		$this->db->select('voucher_belanja.*,pengguna.id as id_pengguna,pengguna.nama');
		// $this->db->where('konfirmasi_admin >', 0);
		$this->db->from('voucher_belanja');
		$this->db->join('pengguna', 'pengguna.id = voucher_belanja.id_pegawai');

		if ($namaPegawai) {
			$this->db->where('pengguna.nama', $namaPegawai);
		}

		if ($statusDigunakan == 1) {
			$this->db->where('voucher_belanja.konfirmasi_kasir', 0);
		} else if ($statusDigunakan == 2) {
			$this->db->where('voucher_belanja.konfirmasi_kasir', 1);
		} else if ($statusDigunakan == 3) {
			$this->db->where('voucher_belanja.konfirmasi_kasir', 2);
		}

		if ($statusBayarAnggota == 1) {
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 0);
		} else if ($statusBayarAnggota == 2) {
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 1);
		} else if ($statusBayarAnggota == 3) {
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 2);
		}

		if ($statusProsesVoucher == 1) {
			$this->db->where('voucher_belanja.konfirmasi_admin', 1);
			$this->db->where('voucher_belanja.konfirmasi_kasir', 0);
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 0);
			$this->db->where('voucher_belanja.kadaluarsa <', date("Y-m-d H:i:s"));
		} else if ($statusProsesVoucher == 2) {
			$this->db->where('voucher_belanja.konfirmasi_admin', 2);
			$this->db->where('voucher_belanja.konfirmasi_kasir', 2);
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 2);
		} else if ($statusProsesVoucher == 3) {
			$this->db->where('voucher_belanja.konfirmasi_admin', 0);
			$this->db->where('voucher_belanja.konfirmasi_kasir', 0);
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 0);
		} else if ($statusProsesVoucher == 4) {
			$this->db->where('voucher_belanja.konfirmasi_admin', 1);
			$this->db->where('voucher_belanja.konfirmasi_kasir', 0);
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 0);
		} else if ($statusProsesVoucher == 5) {
			$this->db->where('voucher_belanja.konfirmasi_admin', 1);
			$this->db->where('voucher_belanja.konfirmasi_kasir', 1);
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 0);
		} else if ($statusProsesVoucher == 6) {
			$this->db->where('voucher_belanja.konfirmasi_admin', 1);
			$this->db->where('voucher_belanja.konfirmasi_kasir', 1);
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 0);
			$this->db->or_where('voucher_belanja.konfirmasi_pembayaran', 1);
			$this->db->where('voucher_belanja.status_bayar_rekanan', 0);
		} else if ($statusProsesVoucher == 7) {
			$this->db->where('voucher_belanja.konfirmasi_admin', 1);
			$this->db->where('voucher_belanja.konfirmasi_kasir', 1);
			$this->db->where('voucher_belanja.konfirmasi_pembayaran', 1);
			$this->db->where('voucher_belanja.status_bayar_rekanan', 1);
		}
		return $this->db->get()->result();
	}

	public function getDetailVoucher($id)
	{
		$this->db->select('voucher_belanja.*,pengguna.id as id_pengguna, pengguna.nama');
		$this->db->from('voucher_belanja');
		$this->db->join('pengguna', 'pengguna.id = voucher_belanja.id_pegawai');
		// $this->db->join('pengguna', 'pengguna.id = voucher_belanja.id_admin');
		$this->db->where('voucher_belanja.id', $id);
		return $this->db->get()->row();
	}

	public function getDetailVoucher2($id)
	{
		$this->db->select('pengguna.nama');
		$this->db->from('voucher_belanja');
		// $this->db->join('pengguna', 'pengguna.id = voucher_belanja.id_pegawai');
		$this->db->join('pengguna', 'pengguna.id = voucher_belanja.id_admin');
		$this->db->where('voucher_belanja.id', $id);
		return $this->db->get()->row();
	}

	function getPegawai()
	{
		$this->db->where('role', 'pegawai');
		$this->db->order_by('nama', 'asc');
		return $this->db->get('pengguna')->result();
	}

	function getNama($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('pengguna')->row()->nama;
	}


	function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('voucher_belanja', $data);
	}

	function getListBarang()
	{
		return $this->db->order_by('nama_barang')->get('master_barang')->result();
	}

	function getBarang($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('master_barang')->row();
	}

	function getDaftarBarang($id)
	{
		$this->db->where('id_voucher', $id);
		return $this->db->get('daftar_barang')->result();
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
