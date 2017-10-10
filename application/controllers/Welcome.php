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

	public function get_event_all($tahun,$bulan,$hari)
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
				$this->kursus->takwim_day_all
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
		$this->load->model("hrmis_carta_model","jabatan");
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(buildTree($this->jabatan->senarai_carta())));
	}

	public function get_laporan_gred($kod)
	{
		$this->load->model("profil_model","profil");

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->profil->sen_gred($kod)));
	}

	public function get_laporan_skim($kod)
	{
		$this->load->model("profil_model","profil");

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->profil->sen_skim($kod)));
	}

	public function get_tree_jabatan_related()
	{
		$this->load->model("hrmis_carta_model","jabatan");
		$this->load->model('kumpulan_profil_model','kumpulan_profil');
		$id = $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id;
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode(buildTreeParentInc($this->jabatan->as_array()->get_all(),$id,$id)));
	}
}
