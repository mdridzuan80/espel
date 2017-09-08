<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MY_Controller
{
    const EMAIL_ACTIVE = 1;
    const EMAIL_NOT_ACTIVE = 0;

    public function __construct()
	{
		parent::__construct();
		$this->isLogged();
    }

    public function index(){
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN']))
        {
            $this->load->model('profil_model','profil');
            $data["profiles"] = $this->profil
                ->with("jawatan")
                ->with("gred")
                ->with("jabatan")
                ->get_many_by(["status"=>"Y","nokp<>"=>"admin"]);
            return $this->renderView("pengguna/show",$data);
        }
        else
        {
            $this->renderPermissionDeny();
        }
    }

    public function show()
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['super_admin','admin']))
        {
            $this->load->model('pengguna_model','pengguna');
            $data["profiles"] = $this->pengguna->getAll();
            return $this->renderView("pengguna/show",$data);
        }
        else
        {
            $this->renderPermissionDeny();
        }
    }

    public function profil($id)
    {
        $this->load->model('pengguna_model','pengguna');
        $this->load->model('peranan_model','peranan');
        $data["profile"] = $this->pengguna->find($id);
        $data["senPeranan"] = $this->peranan->getListPerananJoinAvailable($id);
        return $this->renderView("super/pengguna/profile",$data);
    }

    public function peranan_hapus($penggunaId,$kumpulanId)
    {
        $this->load->model("peranan_model","peranan");
        if($this->peranan->hapus($kumpulanId))
        {
            $this->appsess->setFlashSession("success", true);
        }
        else
        {
            $this->appsess->setFlashSession("success", false);
        }
        return redirect('super/pengguna/profil/' . $penggunaId);
    }

    public function peranan_add($penggunaId)
    {
        $this->load->model("peranan_model","peranan");

        if(!$this->exist("submit"))
        {
            $data["senPeranan"] = $this->peranan->getListPerananUnjoinAvailable($penggunaId);
            return $this->renderView("super/pengguna/peranan_add", $data);
        }
        else
        {
            $data =[
                $this->input->post('comPeranan'),
                $penggunaId,
            ];

            if($this->peranan->subscribePeranan($data))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
        }

        return redirect('super/pengguna/profil/' . $penggunaId);
    }
}
