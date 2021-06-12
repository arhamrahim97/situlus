<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_wilayah extends CI_Model
{
	function getProvinsi()
	{
		return $this->db->get('wilayah_provinsi')->result();
	}

	function getKabupaten($id_provinsi)
	{
		$this->db->where('provinsi_id', $id_provinsi);
		$kabupaten = $this->db->get('wilayah_kabupaten')->result();
		$output = '';
		$output = '<option value=""> - Pilih Kabupaten -</option>';
		foreach ($kabupaten as $kab) {
			$output .= '
				<option value="' . $kab->id . '">' . $kab->nama . '</option>
			';
		}
		echo $output;
	}

	function getKecamatan($id_kabupaten)
	{
		$this->db->where('kabupaten_id', $id_kabupaten);
		$kecamatan = $this->db->get('wilayah_kecamatan')->result();
		$output = '';
		$output = '<option value=""> - Pilih Kecamatan -</option>';
		foreach ($kecamatan as $kec) {
			$output .= '
				<option value="' . $kec->id . '">' . $kec->nama . '</option>
			';
		}
		echo $output;
	}

	function getKelurahan($id_kecamatan)
	{
		$this->db->where('kecamatan_id', $id_kecamatan);
		$kelurahan = $this->db->get('wilayah_desa')->result();
		$output = '';
		$output = '<option value=""> - Pilih Kelurahan -</option>';
		foreach ($kelurahan as $kel) {
			$output .= '
				<option value="' . $kel->id . '">' . $kel->nama . '</option>
			';
		}
		echo $output;
	}
}
