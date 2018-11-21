<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		return $this->load->view('landing/default');
	}

	public function get_tree_jabatan()
	{
		$this->load->model("hrmis_carta_model", "jabatan");
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(buildTreeParentInc($this->jabatan->as_array()->get_all(), 6792, 6792)));
	}
}
