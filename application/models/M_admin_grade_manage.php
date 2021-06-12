<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_grade_manage extends CI_Model
{
	function cekGrade($grade)
	{
		$this->db->where('grade', $grade);
		return $this->db->get('grade')->row();
	}

	function insert($grade)
	{
		return $this->db->insert('grade', $grade);
	}

	function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('grade', $data);
	}

	function getGrade()
	{
		$data = $this->db->order_by('grade')->get('grade')->result();
		return $data;
	}
}
