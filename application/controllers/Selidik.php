<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selidik extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->isLogged();
	}

	public function index()
	{
		return $this->renderDefaultLayoutView();
	}

	public function boranga()
	{
		$this->load->model("kursus_model","kursus");
		$data["sen_kursus"] = $this->kursus->get_all_kursus_boranga($this->appsess->getSessionData('username'));
		return $this->renderView("selidik/boranga/show", $data);
	}

	public function boranga_jawab($kursus_id)
	{
		if(!$this->exist("submit"))
		{
			$this->load->model('profil_model','profil');
			$this->load->model('hrmis_skim_model','hrmis_skim');
			$this->load->model('hrmis_carta_model','hrmis_carta');

			$data['profil'] = $this->profil->get($this->appsess->getSessionData('username'));
			$data['objSkim'] = $this->hrmis_skim;
			$data['objCarta'] = $this->hrmis_carta;
			
			return $this->renderView("selidik/boranga/add",$data);
		}
		else
		{

		}
	}
}
