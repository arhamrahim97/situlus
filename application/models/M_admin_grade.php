<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_grade extends CI_Model
{
	function getGrade()
	{
		return $this->db->get('grade')->result();
	}
}
