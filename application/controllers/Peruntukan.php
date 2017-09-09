<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peruntukan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->isLogged();
    }

    public function index()
    {
        $this->load->model('peruntukan_model', 'peruntukan');
        $data['list_peruntukan'] = $this->peruntukan->with(["jabatan","jns_peruntukan"])->get_many_by(["stat_initial"=>'Y',"YEAR(tarikh)"=>date('Y')]);
        $data["objPeruntukan"] = $this->peruntukan;
        return $this->renderView("peruntukan/show", $data);
    }

    private function plugins()
    {
        return [
            "css" => [
                'assets/js/vendors/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css',
                'assets/css/calendar.css',

            ],
            "js" => [
                "assets/js/vendors/moment/moment.js",
                'assets/js/vendors/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js',
                'assets/js/peruntukan.js',
            ],
        ];
    }

    public function initial()
    {
        if(!$this->exist("submit"))
        {
            $this->load->model('jnsperuntukan_model', 'jnsperuntukan');

            $data['jnsperuntukans'] = $this->jnsperuntukan->get_all();

            return $this->renderView("peruntukan/add_init", $data, $this->plugins());
        }
        else
        {
            $this->load->model("peruntukan_model","peruntukan");
            $data = [
                "jns_peruntukan_id" => $this->input->post("comJnsPeruntukan"),
                "jabatan_id" => $this->input->post("comJabatan"),
                "tarikh" => $this->input->inputToDate("txtTkhWaran"),
                "no_waran" => $this->input->post("txtWaran"),
                "stat_agih" => 'Y',
                "stat_initial" => 'Y',
                "jumlah" => $this->input->post("txtJumlah"),
                "keterangan" => $this->input->post("txtKeterangan"),
            ];
			if($this->peruntukan->insert($data))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
			redirect('peruntukan');
        }
    }

    public function info($id)
    {
        $this->load->model('peruntukan_model', 'peruntukan');

        $data["objPeruntukan"] = $this->peruntukan;
        $data["info_peruntukan"] = $this->peruntukan->with(["jabatan","jns_peruntukan"])->get($id);
        $data["sen_transaksi"] = $this->peruntukan->sen_transaksi($data["info_peruntukan"]);
        return $this->renderView("peruntukan/info_peruntukan", $data, $this->plugins());
    }

    public function tambah($id)
    {
        if(!$this->exist("submit"))
        {
            $this->load->model('peruntukan_model', 'peruntukan');

            $data["objPeruntukan"] = $this->peruntukan;
            $data["info_peruntukan"] = $this->peruntukan->with(["jabatan","jns_peruntukan"])->get($id);
            $data['jnsperuntukans'] = $this->jnsperuntukan->get_all();
            return $this->renderView("peruntukan/add_peruntukan", $data, $this->plugins());
        }
        else
        {
            $this->load->model("peruntukan_model","peruntukan");
            $info_peruntukan = $this->peruntukan->get($id);
            $data = [
                "jns_peruntukan_id" => $info_peruntukan->jns_peruntukan_id,
                "jabatan_id" => $info_peruntukan->jabatan_id,
                "tarikh" => $this->input->inputToDate("txtTkhWaran"),
                "no_waran" => $this->input->post("txtWaran"),
                "stat_agih" => 'Y',
                "stat_initial" => 'T',
                "jumlah" => $this->input->post("txtJumlah"),
                "keterangan" => $this->input->post("txtKeterangan"),
            ];
			if($this->peruntukan->insert($data))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
			redirect('peruntukan');
        }
    }

    public function tolak($id)
    {
        if(!$this->exist("submit"))
        {
            $this->load->model('peruntukan_model', 'peruntukan');
            $this->load->model('jnsperuntukan_model', 'jnsperuntukan');

            $data["objPeruntukan"] = $this->peruntukan;
            $data["info_peruntukan"] = $this->peruntukan->with(["jabatan","jns_peruntukan"])->get($id);
            $data['jnsperuntukans'] = $this->jnsperuntukan->get_all();
            return $this->renderView("peruntukan/minus_peruntukan", $data, $this->plugins());
        }
        else
        {
            $this->load->model("peruntukan_model","peruntukan");
            $info_peruntukan = $this->peruntukan->get($id);
            $data = [
                "jns_peruntukan_id" => $info_peruntukan->jns_peruntukan_id,
                "jabatan_id" => $info_peruntukan->jabatan_id,
                "tarikh" => $this->input->inputToDate("txtTkhWaran"),
                "no_waran" => $this->input->post("txtWaran"),
                "stat_agih" => 'Y',
                "stat_initial" => 'T',
                "jumlah" => -$this->input->post("txtJumlah"),
                "keterangan" => $this->input->post("txtKeterangan"),
            ];
			if($this->peruntukan->insert($data))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
			redirect('peruntukan');
        }
    }

    public function prestasi()
    {
        $this->load->model("profil_model", "profil");
        $this->load->model("peruntukan_model", "peruntukan");


        return $this->renderView("peruntukan/prestasi/show");
    }
}
