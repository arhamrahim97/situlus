<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_peminjaman extends CI_Model
{
	function getData($namaPeminjam, $konfirmasiAdmin, $statusPeminjam)
	{
		$this->db->select('*, peminjaman.id, peminjaman.updated_at');
		$this->db->from('peminjaman');
		$this->db->join('pengguna', 'pengguna.id = peminjaman.id_pegawai');
		$this->db->where('konfirmasi_admin >', 0);
		$status = $statusPeminjam;
		if ($statusPeminjam == 3) {
			$status = 0;
		}
		if ($namaPeminjam) {
			$this->db->where('nama', $namaPeminjam);
		}
		if ($konfirmasiAdmin) {
			$this->db->where('konfirmasi_admin', $konfirmasiAdmin);
		}
		if ($statusPeminjam) {
			$this->db->where('status_pinjaman', $status);
		}
		$this->db->order_by('peminjaman.updated_at', 'DESC');
		return $this->db->get()->result();
	}

	function getPemberitahuanDetail($id)
	{
		$this->db->select('peminjaman.id, nama, tgl_pengusulan, total_pinjaman, pembayaran_perbulan, tenor_pinjaman, surat_pernyataan');
		$this->db->from('peminjaman');
		$this->db->join('pengguna', 'pengguna.id = peminjaman.id_pegawai');
		$this->db->where('peminjaman.id', $id);
		return $this->db->get()->result();
	}

	function getCountConfirm()
	{
		$this->db->where('konfirmasi_admin', 0);
		return $this->db->get('peminjaman')->num_rows();
	}

	function getConfirm()
	{
		$this->db->select('peminjaman.id, peminjaman.total_pinjaman, pengguna.nama');
		$this->db->from('peminjaman');
		$this->db->join('pengguna', 'pengguna.id = peminjaman.id_pegawai');
		$this->db->where('konfirmasi_admin', 0);
		$this->db->order_by('peminjaman.created_at', 'DESC');
		return $this->db->get()->result();
	}

	function setujuPeminjaman($id)
	{
		$update = array(
			'konfirmasi_admin' => '1',
			'id_admin' => $this->session->userdata('id'),
			'tgl_konfirmasi_admin' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('id', $id);
		return $this->db->update('peminjaman', $update);
	}

	function tenorPeminjaman($id)
	{
		$this->db->where('id', $id);
		$dataPinjaman = $this->db->get('peminjaman')->row();
		$tenor = $dataPinjaman->tenor_pinjaman;
		$pembayaran_perbulan = $dataPinjaman->pembayaran_perbulan;
		$tgl_konfirmasi_admin = $dataPinjaman->tgl_konfirmasi_admin;
		for ($i = 0; $i < $tenor; $i++) {
			$k = $i + 1;
			$periode = date('Y-m-d H:i:s', strtotime($tgl_konfirmasi_admin . ' + ' . $k . ' month'));
			$data2 = array(
				'id_pinjaman' => $id,
				'pembayaran_perbulan' => $pembayaran_perbulan,
				'periode_pembayaran' => $periode,
				'created_at' => date("Y-m-d H:i:s")
			);
			$this->db->insert('tenor_pinjaman', $data2);
		}
	}

	function tolakPeminjaman($id, $catatan)
	{
		$update = array(
			'konfirmasi_admin' => '2',
			'catatan' => $catatan,
			'id_admin' => $this->session->userdata('id'),
			'tgl_konfirmasi_admin' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('id', $id);
		return $this->db->update('peminjaman', $update);
	}

	function getDetail($id)
	{
		$this->db->select('*, peminjaman.id, tgl_pengusulan, total_pinjaman, tenor_pinjaman, pembayaran_perbulan, tgl_konfirmasi_admin, peminjaman.updated_at, nama');
		$this->db->from('peminjaman');
		$this->db->join('pengguna', 'pengguna.id = peminjaman.id_admin');
		$this->db->where('peminjaman.id', $id);
		return $this->db->get()->row();
	}

	function getTenor($id)
	{
		$this->db->select('*, tenor_pinjaman.id, tenor_pinjaman.periode_pembayaran, tenor_pinjaman.konfirmasi_admin, tenor_pinjaman.tgl_konfirmasi_admin, tenor_pinjaman.id_admin, pengguna.nama as nama');
		$this->db->from('tenor_pinjaman');
		$this->db->join('peminjaman', 'peminjaman.id = tenor_pinjaman.id_pinjaman', 'left');
		$this->db->join('pengguna', 'pengguna.id = tenor_pinjaman.id_admin', 'left');
		$this->db->where('tenor_pinjaman.id_pinjaman', $id);
		$this->db->order_by('tenor_pinjaman.id', 'ASC');
		return $this->db->get()->result();
	}

	function pembayaranTenor($id)
	{
		$update = array(
			'konfirmasi_admin' => '1',
			'id_admin' => $this->session->userdata('id'),
			'tgl_konfirmasi_admin' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('id', $id);
		return $this->db->update('tenor_pinjaman', $update);
	}

	function getIdPinjaman($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('tenor_pinjaman')->row();
	}

	function statusPeminjaman($id)
	{
		$this->db->where('id_pinjaman', $id);
		$jumlahTenor = $this->db->get('tenor_pinjaman')->num_rows();

		$this->db->where('id_pinjaman', $id);
		$this->db->where('konfirmasi_admin', 1);
		$jumlahDibayar = $this->db->get('tenor_pinjaman')->num_rows();

		if ($jumlahTenor == $jumlahDibayar) {
			$this->db->set('status_pinjaman', 1);
			$this->db->set('updated_at', date("Y-m-d H:i:s"));
			$this->db->where('id', $id);
			$this->db->update('peminjaman');
		}
	}
}

/* End of file mainModel.php */
/* Location: ./application/models/mainModel.php */
