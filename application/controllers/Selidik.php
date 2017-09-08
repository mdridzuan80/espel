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
			return $this->renderView("selidik/boranga/add");
		}
		else
		{

		}
	}
}
