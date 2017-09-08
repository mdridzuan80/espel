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
        $data['list_peruntukan'] = $this->peruntukan->with(["jabatan","jns_peruntukan"])->get_All();
        return $this->renderView("peruntukan/show", $data);
    }

    public function initial()
    {
        if(!$this->exist("submit"))
        {
            $this->load->model('jabatan_model', 'jabatan');
            $this->load->model('jnsperuntukan_model', 'jnsperuntukan');

            $plugins=[
    			"css" => [
    				"assets/js/vendors/bootstrap-daterangepicker/daterangepicker.css",
    				'assets/js/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
    			],
    			"js" => [
    				"assets/js/vendors/moment/moment.js",
    				'assets/js/vendors/bootstrap-daterangepicker/daterangepicker.js',
    				'assets/js/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
                    'assets/js/peruntukan.js',

    			],
    		];

            $data['jabatans'] = $this->jabatan->getAll();
            $data['jnsperuntukans'] = $this->jnsperuntukan->getAll();

            return $this->renderView("peruntukan/add_init", $data, $plugins);
        }
        else
        {
            $this->load->model("peruntukan_model","peruntukan");
            $data = [
                $this->input->post("comJnsPeruntukan"),
                $this->input->post("comJabatan"),
                date('Y-m-d',strtotime($this->input->post("txtTkhWaran"))),
                $this->input->post("txtWaran"),
                'Y',
                $this->input->post("txtJumlah"),
                $this->input->post("txtKeterangan"),
            ];
			if($this->peruntukan->simpan($data))
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
