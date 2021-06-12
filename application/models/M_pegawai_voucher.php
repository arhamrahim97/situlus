<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pegawai_voucher extends CI_Model
{
	function cekVoucherProses($data)
	{
		// status 0 = cek voucher, 1
		$this->db->where('id_pegawai', $data);
		$this->db->where('konfirmasi_admin !=', 1);
		$this->db->where('konfirmasi_kasir !=', 1);
		$this->db->where('konfirmasi_pembayaran !=', 1);
		return $this->db->get('voucher_belanja')->result();
	}

	function cekVoucherTolakAdmin($data)
	{
		$this->db->where('id_pegawai', $data);
		$this->db->where('konfirmasi_admin =', 2);
		$this->db->where('konfirmasi_kasir =', 0);
		$this->db->where('konfirmasi_pembayaran =', 0);
		return $this->db->get('voucher_belanja')->result();
	}

	function cekVoucherTolakKasir($data)
	{
		$this->db->where('id_pegawai', $data);
		$this->db->where('konfirmasi_admin =', 1);
		$this->db->where('konfirmasi_kasir =', 2);
		$this->db->where('konfirmasi_pembayaran =', 0);
		return $this->db->get('voucher_belanja')->result();
	}

	function cekJumlahVoucherBelanja($data)
	{
		$this->db->where('id_pegawai', $data);
		return $this->db->get('voucher_belanja')->result();
	}

	function getLastVoucher($data)
	{
		$this->db->where('id_pegawai', $data);
		$this->db->order_by('id', 'desc');
		return $this->db->get('voucher_belanja')->row();
	}

	function insertVoucher($data)
	{
		return $this->db->insert('voucher_belanja', $data);
	}

	function getVoucher($id)
	{
		$this->db->where('id_pegawai', $id);
		$this->db->where('konfirmasi_admin', 1);
		$this->db->order_by('id', 'desc');
		return $this->db->get('voucher_belanja')->result();
	}

	function menugguKonfirmasi()
	{
		$id_pegawai = $this->session->userdata('id');
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->where('konfirmasi_admin', 0);
		return $this->db->get('voucher_belanja')->row();
	}

	function getVoucherditolak()
	{
		$id_pegawai = $this->session->userdata('id');
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->where('konfirmasi_admin', 2);
		$this->db->where('status', 0);
		return $this->db->get('voucher_belanja');
	}

	function hapusPemberitahuan($id)
	{
		$update = array(
			'status' => '2',
			'updated_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('id', $id);
		return $this->db->update('voucher_belanja', $update);
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

	function getDaftarBarang($id)
	{
		$this->db->where('id_voucher', $id);
		return $this->db->get('daftar_barang')->result();
	}

	function getPengguna($id)
	{
		$this->db->select('pengguna.*,grade.grade,grade.limit_voucher');
		$this->db->from('pengguna');
		$this->db->join('grade', 'grade.id = pengguna.grade');
		$this->db->where('pengguna.id', $id);
		return $this->db->get()->row();
	}
}
