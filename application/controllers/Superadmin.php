<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends MY_Controller
{
    const EMAIL_ACTIVE = 1;
    const EMAIL_NOT_ACTIVE = 0;

    public function __construct()
	{
		parent::__construct();
		$this->isLogged();
    }

    public function index() {
    }

    public function pengguna_show()
    {
        $this->load->model('pengguna_model','pengguna');
        $data["profiles"] = $this->pengguna->getAll();
        return $this->renderView("super/pengguna/show",$data);
    }

    public function pengguna_profil($id)
    {
        $this->load->model('pengguna_model','pengguna');
        $this->load->model('peranan_model','peranan');
        $data["profile"] = $this->pengguna->find($id);
        $data["senPeranan"] = $this->peranan->getListPerananJoinAvailable($id);
        return $this->renderView("super/pengguna/profile",$data);
    }

    public function pengguna_profil_peranan_hapus($penggunaId,$kumpulanId)
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

    public function pengguna_profil_peranan_add($penggunaId)
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

    public function email_show()
    {
        $this->load->model('mailconf_model','mail_conf');
        $data["mails"] = $this->mail_conf->getAll();
        return $this->renderView("super/konfigurasi/email/show",$data);
    }

    public function email_add()
    {
        if(!$this->exist("submit"))
        {
            return $this->renderView("super/konfigurasi/email/add");
        }
        else
        {
            $data = [
                $this->input->post("txtNama"),
                $this->input->post("txtHost"),
                $this->input->post("txtAlamat"),
                $this->input->post("txtUsername"),
                $this->input->post("txtPassword"),
                $this->input->post("txtPort"),
            ];

            $this->load->model("mailconf_model","mail_conf");
            if($this->mail_conf->getAll()->num_rows())
            {
                if($this->input->post('chkAktif'))
                {
                    $data[] = self::EMAIL_ACTIVE;
                    $this->mail_conf->updateStatus(self::EMAIL_NOT_ACTIVE);
                }
                else
                {
                    $data[] = self::EMAIL_NOT_ACTIVE;
                }
            }
            else
            {
                $data[] = self::EMAIL_ACTIVE;
            }
            if($this->mail_conf->simpan($data))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
            redirect('super/konfigurasi/email');
        }
    }

    public function email_edit($id)
    {
        if(!$this->exist("submit"))
        {
            $this->load->model("mailconf_model","mail_conf");
            $data["mail_conf"] = $this->mail_conf->find($id);
            return $this->renderView("super/konfigurasi/email/edit", $data);
        }
        else
        {
            $data = [
                $this->input->post("txtNama"),
                $this->input->post("txtHost"),
                $this->input->post("txtAlamat"),
                $this->input->post("txtUsername"),
                $this->input->post("txtPassword"),
                $this->input->post("txtPort"),
                $id,
            ];

            $this->load->model("mailconf_model","mail_conf");

            if($this->mail_conf->getAll()->num_rows())
            {
                if($this->input->post('chkAktif'))
                {
                    $this->activated($id);
                }
            }

            if($this->mail_conf->kemaskini($data))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
            redirect('konfigurasi/email');
        }
    }

    public function email_actived($id)
    {
        $this->activated($id);
        redirect('super/konfigurasi/email');
    }

    private function activated($id)
    {
        $this->load->model("mailconf_model","mail_conf");
        $this->mail_conf->updateStatus(self::EMAIL_NOT_ACTIVE);
        $this->mail_conf->updateStatus(self::EMAIL_ACTIVE,$id);
    }

    public function email_deleted($id)
    {
        $this->load->model("mailconf_model","mail_conf");
        if($this->mail_conf->getStatus(self::EMAIL_ACTIVE)->row()->id != $id)
        {
            if($this->mail_conf->hapus($id))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
        }
        else
        {
            $this->appsess->setFlashSession("success", false);
        }
        redirect('super/konfigurasi/email');
    }
}
