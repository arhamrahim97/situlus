<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_wilayah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_wilayah');
	}

	function getProvinsi()
	{
		return $this->m_wilayah->getProvinsi();
	}

	function getProvinsi2()
	{
		$provinsi =  $this->m_wilayah->getProvinsi();
		$output = '<option value=""> - Pilih Provinsi -</option>';
		foreach ($provinsi as $p) {
			$output .= '
			<option value="' . $p->id . '">' . $p->nama  . '</option>
			';
		}
		echo $output;
	}


	function getKabupaten()
	{
		$id_provinsi = $this->input->post('id');
		return $this->m_wilayah->getKabupaten($id_provinsi);
	}

	function getKecamatan()
	{
		$id_kabupaten = $this->input->post('id');
		return $this->m_wilayah->getKecamatan($id_kabupaten);
	}

	function getKelurahan()
	{
		$id_kecamatan = $this->input->post('id');
		return $this->m_wilayah->getKelurahan($id_kecamatan);
	}
}
