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

	public function get_tree_jabatan_related()
	{
		$this->load->model("hrmis_carta_model", "jabatan");
		$this->load->model('kumpulan_profil_model', 'kumpulan_profil');

		if ($this->appsess->getSessionData("kumpulan") == Appauth::SUPER || $this->appsess->getSessionData("kumpulan") == Appauth::ADMIN) {
			$id = $this->config->item('espel_default_jabatan_id');
		} else {
			$id = $this->appsess->getSessionData('ptj_jabatan_id');;
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(buildTreeParentInc($this->jabatan->as_array()->get_all(), $id, $id)));
	}
}
