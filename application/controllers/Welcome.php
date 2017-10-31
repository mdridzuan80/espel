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

		$this->output->set_content_type('application/json')
        ->set_output
		(
			json_encode
			(
				$this->kursus->takwim_day
				(
					0,
					$takwim
				)
			)
		);
	}

	public function get_event_pengguna($tahun,$bulan,$hari)
	{
		$this->load->model("kursus_model","kursus");
		$this->load->model("kumpulan_profil_model","kumpulan_profil");
		$takwim = initObj([
			"tahun" => $tahun,
			"bulan" => $bulan,
			"hari" => $hari,
		]);

		$this->output->set_content_type('application/json')
        ->set_output(
			json_encode(
				$this->kursus->takwim_day_pengguna(0,$takwim)
			)
		);
	}

	public function get_event_pengguna_2($tahun,$bulan)
	{
		$this->load->model("kursus_model","kursus");
		$this->load->model("kumpulan_profil_model","kumpulan_profil");
		$takwim = initObj([
			"tahun" => $tahun,
			"bulan" => $bulan
		]);

		$this->output->set_content_type('application/json')
        ->set_output(
			json_encode(
				$this->kursus->takwim_day_pengguna_2(0,$takwim)
			)
		);
	}

	public function get_event_all($tahun,$bulan)
	{
		$this->load->model("kursus_model","kursus");
		$this->load->model("kumpulan_profil_model","kumpulan_profil");
		$takwim = initObj([
			"tahun" => $tahun,
			"bulan" => $bulan,
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
        ->set_output(json_encode(buildTreeParentInc($this->jabatan->as_array()->get_all(),6792,6792)));
	}

	public function get_laporan_gred($kelas, $skim)
	{
		$this->load->model("profil_model","profil");

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->profil->sen_gred($kelas, $skim)));
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

		if( $this->appsess->getSessionData("kumpulan")== $this->appauth::SUPER || $this->appsess->getSessionData("kumpulan")== $this->appauth::ADMIN  )
		{
			$id = $this->config->item('espel_default_jabatan_id');
		}
		else
		{
			$id = $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id;
		}
		
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode(buildTreeParentInc($this->jabatan->as_array()->get_all(),$id,$id)));
	}
	public function analisa_reaksi()
	{
		$this->load->model('boranga_model','boranga');
		$this->load->model("hrmis_carta_model","jabatan");
		$this->load->model('kumpulan_profil_model','kumpulan_profil');
        
        $jab_id = $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id;

        $flatted = flatten_array(
            relatedJabatan($this->jabatan->as_array()->get_all(),$jab_id)
        );
		array_push($flatted,$jab_id);

		// buildTreeParentInc($this->jabatan->as_array()->get_all(),$id,$id)
		
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($this->boranga->analisa_reaksi($flatted,date('Y'))));
	}
}
