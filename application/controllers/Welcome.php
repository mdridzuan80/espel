<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->isLogged();
	}

	public function index()
	{
		return $this->renderDefaultLayoutView();
	}

	public function get_event($tahun,$bulan,$hari)
	{
		$this->load->model("kursus_model","kursus");
		$this->load->model("kumpulan_profil_model","kumpulan_profil");
		$takwim = initObj([
			"tahun" => $tahun,
			"bulan" => $bulan,
			"hari" => $hari,
		]);

		$this->output
        ->set_content_type('application/json')
        ->set_output
		(
			json_encode
			(
				$this->kursus->takwim_day
				(
					$this->kumpulan_profil->get_by
					(
						[
							"profil_nokp"=>$this->appsess->getSessionData("username"),
							"kumpulan_id"=>3
						]
					)->jabatan_id,
					$takwim
				)
			)
		);
	}

	public function get_tree_jabatan()
	{
		$this->load->model("jabatan_model","jabatan");
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(buildTree($this->jabatan->as_array()->get_all())));
	}

	public function get_tree_jabatan_related()
	{
		$this->load->model("jabatan_model","jabatan");
		$this->load->model('kumpulan_profil_model','kumpulan_profil');

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode(buildTree($this->jabatan->as_array()->get_all(), $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id
		)));
	}
}
