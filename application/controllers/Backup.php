<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->dbutil();
        $this->load->library('zip');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Mencapai maklumat backup']);
        return $this->renderView('backup/show');
    }

    public function create()
    {
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup(['format'=>'zip']);

        // Load the file helper and write the file to your server
        //$this->load->helper('file');
        //write_file('/assets/backup/mybackup.zip', $backup);

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Melakukan backup keseluruhan pangkalan data']);
        force_download('espel_backup_' . time() . '.zip', $backup);
    }
}
