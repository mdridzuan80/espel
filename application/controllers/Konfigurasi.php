<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends MY_Controller
{
    const EMAIL_ACTIVE = 1;
    const EMAIL_NOT_ACTIVE = 0;

    public function __construct()
	{
		parent::__construct();
		$this->isLogged();
    }

    public function index() {}

    public function email_show()
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN']))
        {
            $this->load->model('mailconf_model','mail_conf');
            $data["mails"] = $this->mail_conf->get_all();
            return $this->renderView("konfigurasi/email/show",$data);
        }
        else
        {
            return $this->renderPermissionDeny();
        }
    }

    public function email_add()
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN']))
        {
            if(!$this->exist("submit"))
            {
                return $this->renderView("konfigurasi/email/add");
            }
            else
            {
                $this->load->model("mailconf_model","mail_conf");
                $data = [
                    "nama" => $this->input->post("txtNama"),
                    "host" => $this->input->post("txtHost"),
                    "from" => $this->input->post("txtAlamat"),
                    "user" => $this->input->post("txtUsername"),
                    "pass" => $this->input->post("txtPassword"),
                    "port" => $this->input->post("txtPort"),
                ];

                if($this->mail_conf->count_all())
                {
                    if($this->input->post('chkAktif'))
                    {
                        $data["status"] = self::EMAIL_ACTIVE;
                        $this->mail_conf->update_all(["status"=>self::EMAIL_NOT_ACTIVE]);
                    }
                    else
                    {
                        $data["status"] = self::EMAIL_NOT_ACTIVE;
                    }
                }
                else
                {
                    $data["status"] = self::EMAIL_ACTIVE;
                }

                if($this->mail_conf->insert($data))
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
        else
        {
            return $this->renderPermissionDeny();
        }
    }

    public function email_edit($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN']))
        {
            if(!$this->exist("submit"))
            {
                $this->load->model("mailconf_model","mail_conf");
                $data["mail_conf"] = $this->mail_conf->get($id);
                return $this->renderView("konfigurasi/email/edit", $data);
            }
            else
            {
                $this->load->model("mailconf_model","mail_conf");
                $data = [
                    "nama" => $this->input->post("txtNama"),
                    "host" => $this->input->post("txtHost"),
                    "from" => $this->input->post("txtAlamat"),
                    "user" => $this->input->post("txtUsername"),
                    "pass" => $this->input->post("txtPassword"),
                    "port" => $this->input->post("txtPort"),
                ];

                if($this->input->post('chkAktif'))
                {
                    if($this->activated($id) && $this->mail_conf->update($id,$data))
                    {
                        $this->appsess->setFlashSession("success", true);
                    }
                    else
                    {
                        $this->appsess->setFlashSession("success", false);
                    }
                }

                if($this->mail_conf->update($id,$data))
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
        else
        {
            return $this->renderPermissionDeny();
        }
    }

    public function email_set_default($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN']))
        {
            $this->activated($id);
            redirect('konfigurasi/email');
        }
        else
        {
            return $this->renderPermissionDeny();
        }
    }

    private function activated($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN']))
        {
            $this->load->model("mailconf_model","mail_conf");

            if($this->mail_conf->update_all(["status" => self::EMAIL_NOT_ACTIVE]))
            {
                if($this->mail_conf->update($id,["status" => self::EMAIL_ACTIVE]))
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return $this->renderPermissionDeny();
        }
    }

    public function email_deleted($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN']))
        {
            $this->load->model("mailconf_model","mail_conf");
            if($this->mail_conf->get_by("status",self::EMAIL_ACTIVE)->id != $id)
            {
                if($this->mail_conf->delete($id))
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
            redirect('konfigurasi/email');
        }
        else
        {
            return $this->renderPermissionDeny();
        }
    }
}
