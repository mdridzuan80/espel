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
            
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Mencapai maklumat konfigursi email']);        
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
                $plugins = [
                    "js" => [
                        'assets/js/konfigurasi.js',
                    ],
                ];

                return $this->renderView('konfigurasi/email/add','',$plugins);
            }
            else
            {
                $this->load->model("mailconf_model","mail_conf");
                $data = [
                    "nama" => $this->input->post("txtNama"),
                    "host" => $this->input->post("txtHost"),
                    "from" => $this->input->post("txtAlamat"),
                    "port" => $this->input->post("txtPort"),
                    "auth" => $this->input->post("comLogin"),
                    "debug" => $this->input->post("txtDebug"),
                    "secure" => $this->input->post("comSecurity"),
                ];

                if($this->input->post("comLogin")=='T')
                {
                    $data['user'] = $this->input->post('txtUsername');
                    $data['pass'] = $this->input->post('txtPassword');
                }

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
                    $sql = $this->db->last_query();
                    $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Menambah konfigursi email', 'sql' => $sql]);        
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
                $plugins = [
                    "js" => [
                        'assets/js/konfigurasi.js',
                    ],
                ];

                $this->load->model("mailconf_model","mail_conf");
                $data["mail_conf"] = $this->mail_conf->get($id);
                return $this->renderView("konfigurasi/email/edit",$data,$plugins);
            }
            else
            {
                $this->load->model("mailconf_model","mail_conf");
                $data = [
                    "nama" => $this->input->post("txtNama"),
                    "host" => $this->input->post("txtHost"),
                    "from" => $this->input->post("txtAlamat"),
                    "port" => $this->input->post("txtPort"),
                    "auth" => $this->input->post("comLogin"),
                    "debug" => $this->input->post("txtDebug"),
                    "secure" => $this->input->post("comSecurity"),
                ];

                if($this->input->post("comLogin")=='T')
                {
                    $data['user'] = $this->input->post('txtUsername');
                    $data['pass'] = $this->input->post('txtPassword');
                }
                else
                {
                    $data['user'] = NULL;
                    $data['pass'] = NULL;
                }

                if($this->input->post('chkAktif'))
                {
                    if($this->activated($id) && $this->mail_conf->update($id,$data))
                    {
                        $sql = $this->db->last_query();
                        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Mengaktifkan konfigursi email', 'sql' => $sql]);        

                        $this->appsess->setFlashSession("success", true);
                    }
                    else
                    {
                        $this->appsess->setFlashSession("success", false);
                    }
                }

                if($this->mail_conf->update($id,$data))
                {
                    $sql = $this->db->last_query();
                    $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Mengemaskini konfigursi email', 'sql' => $sql]);        
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
            if($this->activated($id))
            {
                $sql = $this->db->last_query();
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Mengemaskini konfigursi email', 'sql' => $sql]);
            }

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
                    $sql = $this->db->last_query();
                    $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Menghapus konfigursi email', 'sql' => $sql]);        
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
