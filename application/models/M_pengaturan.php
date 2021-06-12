<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pengaturan extends CI_Model
{
	function getSettings()
	{
		return $this->db->get('pengaturan');
	}
}
