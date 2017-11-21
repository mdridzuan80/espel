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
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN','PTJ']) || $this->appsess->getSessionData("username")=='admin' )
        {
            $this->load->model('kumpulan_profil_model','kumpulan_profil');
            $this->load->model('kumpulan_model','kumpulan');
            $this->load->model('profil_model', 'profil');

            $data['sen_kumpulan'] = $this->profil->sen_kump();
            if($this->appsess->getSessionData('kumpulan') == AppAuth::SUPER || $this->appsess->getSessionData('kumpulan') == AppAuth::ADMIN)
            {
                $data['jab_ptj'] = initObj(['jabatan_id'=>$this->config->item('espel_default_jabatan_id')]);
            }
            else
            {
                $data['jab_ptj'] = $this->kumpulan_profil->getJabatanPeranan($this->appsess->getSessionData('username'), $this->kumpulan->get_by('kod',$this->appsess->getSessionData('kumpulan'))->id);
            }
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses menu senarai pengguna']);
            return $this->renderView("pengguna/show",$data,['embedjs'=>[$this->load->view('scripts/carian_js',$data,true)]]);
        }
        else
        {
            $this->renderPermissionDeny();
        }
    }

    public function data_grid()
    {
        $this->load->helper("url");
        $this->load->library("pagination");
        $this->load->model('profil_model','profil');
        $this->load->model('hrmis_kumpulan_model','hrmis_kumpulan');
        $this->load->model('kelas_model','kelas');

        $config = array();
        $config["base_url"] = base_url() . "pengguna/data_grid/";
        $config["per_page"] = 10;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $profile = $this->profil->all_profil($config["per_page"],$page, $this->input->post());
        
        $config["total_rows"] = $profile['count'];
        $config["uri_segment"] = 3;

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination" style="margin:0">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data["profiles"] = $profile['data'];
        $data["sen_kumpulan"] = $this->kelas->get_all();
        $data["links"] = $this->pagination->create_links();
        $data['total'] = $profile['count'];
        $data['mula'] = $this->uri->segment(3, 0) + 1;
        $data['hingga'] = ($config["per_page"]>$profile['count']) ? $profile['count'] : $config["per_page"] + $this->uri->segment(3, 0) ;

        return $this->load->view("pengguna/datagrid",$data);
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

    public function status($nokp)
    {
        $this->load->model('profil_model', 'profil');
        
        $profil = $this->profil->get_by('nokp',$nokp);

        $data['status'] = ($profil->status == 'Y') ? 'T' : 'Y';

        if($this->profil->update_by(['nokp'=>$nokp],$data))
        {
            $sql = $this->db->last_query();
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Nyah aktif profil', 'sql' => $sql]);
            $this->output->set_status_header(200);
        }
        else
        {
            $this->output->set_status_header(400,'Operasi gagal!');
        }
    }

    public function penyelaras()
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN']) || $this->appsess->getSessionData("username")=='admin' )
        {
            $this->load->model('kumpulan_profil_model','kumpulan_profil');
            $this->load->model('kumpulan_model','kumpulan');
            $this->load->model('profil_model', 'profil');

            $data['sen_kumpulan'] = $this->profil->sen_kump();
            if($this->appsess->getSessionData('kumpulan') == AppAuth::SUPER || $this->appsess->getSessionData('kumpulan') == AppAuth::ADMIN)
            {
                $data['jab_ptj'] = initObj(['jabatan_id'=>$this->config->item('espel_default_jabatan_id')]);
            }
            else
            {
                $data['jab_ptj'] = $this->kumpulan_profil->getJabatanPeranan($this->appsess->getSessionData('username'), $this->kumpulan->get_by('kod',$this->appsess->getSessionData('kumpulan'))->id);
            }
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses menu senarai penyelaras']);
            return $this->renderView("penyelaras/show",$data,['embedjs'=>[$this->load->view('penyelaras/carian_js',$data,true)]]);
        }
        else
        {
            $this->renderPermissionDeny();
        }
    }

    public function penyelaras_data_grid()
    {
        $this->load->helper("url");
        $this->load->library("pagination");
        $this->load->model('profil_model','profil');
        $this->load->model('hrmis_kumpulan_model','hrmis_kumpulan');

        $config = array();
        $config["base_url"] = base_url() . "pengguna/penyelaras_data_grid/";
        $config["per_page"] = 10;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $profile = $this->profil->all_penyelaras($config["per_page"],$page, $this->input->post());
        
        $config["total_rows"] = $profile['count'];
        $config["uri_segment"] = 3;

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination" style="margin:0">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data["profiles"] = $profile['data'];
        $data["sen_kumpulan"] = $this->hrmis_kumpulan->get_all();
        $data["links"] = $this->pagination->create_links();
        $data['total'] = $profile['count'];
        $data['mula'] = $this->uri->segment(3, 0) + 1;
        $data['hingga'] = ($config["per_page"]>$profile['count']) ? $profile['count'] : $config["per_page"] + $this->uri->segment(3, 0) ;

        return $this->load->view("penyelaras/datagrid",$data);
    }

    public function pengecualian()
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN','PTJ']) || $this->appsess->getSessionData("username")=='admin' )
        {
            $this->load->model('kumpulan_profil_model','kumpulan_profil');
            $this->load->model('kumpulan_model','kumpulan');
            $this->load->model('profil_model', 'profil');

            $data['sen_kumpulan'] = $this->profil->sen_kump();
            if($this->appsess->getSessionData('kumpulan') == AppAuth::SUPER || $this->appsess->getSessionData('kumpulan') == AppAuth::ADMIN)
            {
                $data['jab_ptj'] = initObj(['jabatan_id'=>$this->config->item('espel_default_jabatan_id')]);
            }
            else
            {
                $data['jab_ptj'] = $this->kumpulan_profil->getJabatanPeranan($this->appsess->getSessionData('username'), $this->kumpulan->get_by('kod',$this->appsess->getSessionData('kumpulan'))->id);
            }
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses menu senarai pengecualian']);
            return $this->renderView("pengecualian/show",$data,['embedjs'=>[$this->load->view('pengecualian/carian_js',$data,true)]]);
        }
        else
        {
            $this->renderPermissionDeny();
        }
    }

    public function pengecualian_data_grid()
    {
        $this->load->helper("url");
        $this->load->library("pagination");
        $this->load->model('profil_model','profil');
        $this->load->model('hrmis_kumpulan_model','hrmis_kumpulan');

        $config = array();
        $config["base_url"] = base_url() . "pengguna/pengecualian_data_grid/";
        $config["per_page"] = 10;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $profile = $this->profil->all_pengecualian($config["per_page"],$page, $this->input->post());
        
        $config["total_rows"] = $profile['count'];
        $config["uri_segment"] = 3;

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination" style="margin:0">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data["profiles"] = $profile['data'];
        $data["sen_kumpulan"] = $this->hrmis_kumpulan->get_all();
        $data["links"] = $this->pagination->create_links();
        $data['total'] = $profile['count'];
        $data['mula'] = $this->uri->segment(3, 0) + 1;
        $data['hingga'] = ($config["per_page"]>$profile['count']) ? $profile['count'] : $config["per_page"] + $this->uri->segment(3, 0) ;

        return $this->load->view("pengecualian/datagrid",$data);
    }
}
