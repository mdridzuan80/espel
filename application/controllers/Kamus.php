<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamus extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->isLogged();
	}

    public function program()
    {
        $this->load->model('program_model','program');
        $data["sen_program"] = $this->program->get_All();
        return $this->renderView("kamus/program/show", $data);
    }

    public function program_add()
    {
        if(!$this->exist("submit"))
        {
            return $this->renderView("kamus/program/add");
        }
        else
        {
			$data = [
                "nama" => $this->input->post("txtProgram"),
                "keterangan" => $this->input->post("txtKeterangan"),
            ];
			$this->load->model("program_model","program");
			if($this->program->insert($data))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
			redirect('kamus/program');
        }
    }

	public function program_edit($id)
	{
		if(!$this->exist("submit"))
        {
            $this->load->model("program_model","program");
			$this->load->model("aktiviti_model","aktiviti");
            $data["program"] = $this->program->with("list_aktiviti")->get($id);
            return $this->renderView("kamus/program/edit", $data);
        }
        else
        {
			$this->load->model("program_model","program");
			$data = [
                "nama" => $this->input->post("txtProgram"),
                "keterangan" => $this->input->post("txtKeterangan"),
            ];
			if($this->program->update($id, $data))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
			redirect('kamus/program');
		}
	}

	public function program_delete($id)
    {
        $this->load->model("program_model","program");
        if($this->program->delete($id))
        {
            $this->appsess->setFlashSession("success", true);
        }
        else
        {
            $this->appsess->setFlashSession("success", false);
        }
        redirect('kamus/program');
    }

	public function aktiviti_add($id)
    {
        if(!$this->exist("submit"))
        {
			$data['programId'] = $id;
            return $this->renderView("kamus/aktiviti/add", $data);
        }
        else
        {
			$this->load->model("aktiviti_model","aktiviti");
			$data = [
                "nama" => $this->input->post("txtAktiviti"),
                "program_id" => $id,
            ];
			if($this->aktiviti->insert($data))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
			redirect('kamus/program_edit/' . $id);
        }
    }

	public function aktiviti_edit($id)
	{
		if(!$this->exist("submit"))
		{
			$this->load->model("aktiviti_model","aktiviti");
			$data["activity"] = $this->aktiviti->get($id);
			return $this->renderView("kamus/aktiviti/edit", $data);
		}
		else
		{
			$this->load->model("aktiviti_model","aktiviti");
			$data = [
				"nama" => $this->input->post("txtAktiviti"),
			];
			if($this->aktiviti->update($id,$data))
			{
				$this->appsess->setFlashSession("success", true);
			}
			else
			{
				$this->appsess->setFlashSession("success", false);
			}
			redirect('kamus/program_edit/' . $this->aktiviti->get($id)->program_id);
		}
	}

	public function aktiviti_delete($id)
    {
        $this->load->model("aktiviti_model","aktiviti");
		$program_id = $this->aktiviti->get($id)->program_id;
        if($this->aktiviti->delete($id))
        {
            $this->appsess->setFlashSession("success", true);
        }
        else
        {
            $this->appsess->setFlashSession("success", false);
        }
        redirect('kamus/program_edit/' . $program_id);
    }
}
