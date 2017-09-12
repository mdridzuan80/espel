<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    const SUPER_DEFAULT = "super_admin/dashboard/show";
    const SUPER_SIDEMENU = "super_admin/sidemenu";

    const ADMIN_DEFAULT = "admin/dashboard/dashboard";
    const ADMIN_SIDEMENU = "admin/sidemenu";

    const PTJ_DEFAULT = "ptj/dashboard/dashboard";
    const PTJ_SIDEMENU = "ptj/sidemenu";

    const MEMBER_DEFAULT = "anggota/dashboard/show";
    const MEMBER_SIDEMENU = "anggota/sidemenu";

    public function __construct()
    {
        parent::__construct();
    }

    protected function renderLoginView($pageContent, $data=[])
    {
        return $this->load->view($pageContent, $data);
    }

    protected function renderTukarPerananView($pageContent)
    {
        $data = [
            'currentPeranan' => $this->currentPeranan(),
            'availPeranan' => $this->availPeranan(),
        ];
        //dd($data['currentPeranan']->result());
        return $this->load->view($pageContent, $data);
    }

    protected function renderView($pageContent, $data=[], $plugins=[])
    {
        $layout = [];

        $this->load->model("profil_model");
        $this->load->model("pengguna_model");

        switch($this->appsess->getSessionData("kumpulan"))
        {
            case AppAuth::SUPER:
                $sidemenu = SELF::SUPER_SIDEMENU;
            break;
            case AppAuth::ADMIN:
                $sidemenu = SELF::ADMIN_SIDEMENU;
            break;
            case AppAuth::PENYELARAS:
                $sidemenu = SELF::PTJ_SIDEMENU;
            break;
            case AppAuth::PENGGUNA:
                $this->load->model("kursus_model", "kursus");
                $this->load->model("mohon_kursus_model", "mohon_kursus");

                $layout["sen_permohonan"] = $this->mohon_kursus->get_permohonan($this->appsess->getSessionData('username'));
                $layout["sen_hadir"] = $this->kursus->get_all_kursus_hadir($this->appsess->getSessionData('username'),date('Y'));
                $layout["bil_boranga"] = count($this->kursus->get_all_kursus_boranga($this->appsess->getSessionData('username')));
                $sidemenu = SELF::MEMBER_SIDEMENU;
            break;
        }

        $layout["login_profil"] = $this->profil_model->getProfil($this->appsess->getSessionData("username"));
        $layout["availPeranan"] = $this->availPeranan();
        $layout["sidemenu"] = $sidemenu;
        $layout["pageContent"] = $pageContent;

        if(is_array($data))
            $layout = array_merge($data, $layout);

        if(count($plugins))
        {
            if(is_array($plugins))
                $layout = array_merge($layout, [
                    "plugins" => $plugins
                ]);
        }

        return $this->load->view("layout/master", $layout);
    }

    protected function isLogged()
    {
        if(!$this->appauth->isLogged())
		{
			return redirect('login');
		}
    }

    protected function exist($name)
    {
        return (!is_null($this->input->post($name)) && empty($this->input->post($name)));
    }

    protected function renderDefaultLayoutView($data=[], $plugin=[])
    {
        switch($this->appsess->getSessionData("kumpulan"))
        {
            case AppAuth::SUPER:
                return $this->renderView(SELF::SUPER_DEFAULT, SELF::SUPER_SIDEMENU, $data, $plugin);
            break;
            case AppAuth::ADMIN:
                return $this->renderView(SELF::ADMIN_DEFAULT, SELF::ADMIN_SIDEMENU, $data, $plugin);
            break;
            case AppAuth::PENYELARAS:
                return $this->renderView(SELF::PTJ_DEFAULT, SELF::PTJ_SIDEMENU, $data, $plugin);
            break;
            case AppAuth::PENGGUNA:
                return $this->renderView(SELF::MEMBER_DEFAULT, SELF::MEMBER_SIDEMENU, $data, $plugin);
            break;
        }
    }

    protected function availPeranan()
    {
        $this->load->model("kumpulan_profil_model","kumpulan_profil");
        $this->load->model("kumpulan_model","kumpulan");

        return $this->kumpulan_profil->with("kumpulan")
        ->get_many_by(
            [
                "kumpulan_id<>"=>$this->kumpulan->get_by("kod",$this->appsess->getSessionData("kumpulan"))->id,
                "profil_nokp"=>$this->appsess->getSessionData("username"),
            ]
        );
    }

    protected function currentPeranan()
    {
        $this->load->model("pengguna_model");
        $this->load->model("peranan_model");

        return $this->peranan_model->getPerananOwner(
            $this->pengguna_model->getPengguna(
                $this->appsess->getSessionData("username"))->row()->id,
                $this->appsess->getSessionData("peranan")
        );
    }

    protected function renderPermissionDeny()
    {
        $this->output->set_status_header(401);
        return $this->renderView("errors/html/error_401");
    }
}
