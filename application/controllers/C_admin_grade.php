<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_grade extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin_grade');
	}

	function getGrade()
	{
		return $this->m_admin_grade->getGrade();
	}

	function getGrade2()
	{
		$grade =  $this->m_admin_grade->getGrade();
		$output = '<option value=""> - Pilih Grade -</option>';
		foreach ($grade as $g) {
			$output .= '
			<option value="' . $g->id . '">' . $g->grade  . '</option>
			';
		}
		echo $output;
	}
}
