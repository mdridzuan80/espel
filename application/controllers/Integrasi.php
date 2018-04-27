<?php
    class Integrasi extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->isLogged();
        }

        public function index()
        {
            //$this->load->library('apphrmis');

            //$data['hrmis'] = $this->apphrmis->syncData();

            $this->load->model('log_model');

            $data['hrmis'] = $this->log_model->latest_log('hrmis');

            return $this->renderView("integrasi/default.php", $data);
        }
    }