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
			$this->load->model('kursus_model','kursus');
			$this->load->model('hrmis_skim_model','hrmis_skim');
			$this->load->model('hrmis_carta_model','hrmis_carta');

			$data['profil'] = $this->profil->get($this->appsess->getSessionData('username'));
			$data['kursus'] = $this->kursus->get($kursus_id);
			$data['objSkim'] = $this->hrmis_skim;
			$data['objCarta'] = $this->hrmis_carta;
			
			return $this->renderView("selidik/boranga/add",$data);
		}
		else
		{
			$this->load->model('boranga_model','boranga');

			$data = [
				'kursus_id' => $kursus_id,
				'nokp' => $this->appsess->getSessionData('username'),
				'kat_kursus' => $this->input->post('comKategoriKursus'),
				'tarikh' => date('Y-m-d H:i:s'),
				'b1' => $this->input->post('b1'),
				'b2' => $this->input->post('b2'),
				'b3' => $this->input->post('b3'),
				'b4' => $this->input->post('b4'),
				'b5' => $this->input->post('b5'),
				'b6' => $this->input->post('b6'),
				'b7' => $this->input->post('b7'),
				'b8' => $this->input->post('b8'),
				'c1' => $this->input->post('c1'),
				'c2' =>$this->input->post('c2'),
				'c3' => $this->input->post('c3'),
				'c4' => $this->input->post('c4'),
				'c5' => $this->input->post('c5'),
				'c6' => $this->input->post('c6'),
				'c7' => $this->input->post('c7'),
				'c8' => $this->input->post('c8'),
				'c9' => $this->input->post('c9'),
				'c10' => $this->input->post('c10'),
				'c11' => $this->input->post('c11'),
				'c12' => $this->input->post('c12'),
				'd1' => $this->input->post('txtKekuatan'),
				'd2' => $this->input->post('txtKelemahan'),
				'd3' => $this->input->post('txtCadangan'),
			];

			$this->boranga->insert($data);
			return $this->renderView('selidik/boranga/terimakasih');
		}
	}
}
