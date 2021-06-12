<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_konfigurasi extends CI_Model
{
	function getKonfigurasi()
	{
		return $this->db->get('pengaturan')->first_row();
	}

	function perbaruiLayanan($id, $bunga_voucher, $bunga_pinjaman, $simpanan_pokok)
	{
		$update = array(
			'bunga_voucher' => $bunga_voucher,
			'bunga_pinjaman' => $bunga_pinjaman,
			'simpanan_pokok' => $simpanan_pokok,
			'updated_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('id', $id);
		return $this->db->update('pengaturan', $update);
	}

	function perbaruiWeb($id, $title_header, $title_footer, $title_carousel, $jam_buka, $telepon, $email, $facebook, $twitter, $instagram)
	{
		$update = array(
			'title_header' => $title_header,
			'title_footer' => $title_footer,
			'title_carousel' => $title_carousel,
			'jam_buka' => $jam_buka,
			'telepon' => $telepon,
			'email' => $email,
			'facebook' => $facebook,
			'twitter' => $twitter,
			'facebook' => $facebook,
			'instagram' => $instagram,
			'updated_at' => date("Y-m-d H:i:s")
		);
		$this->db->where('id', $id);
		return $this->db->update('pengaturan', $update);
	}
}
