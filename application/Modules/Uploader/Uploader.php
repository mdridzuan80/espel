<?php
namespace Module\Uploader;

use Module\Module;

class Uploader extends Module
{
    private $upload_path;
    private $encrypt_name = TRUE;
    private $allowed_types = ['pdf', 'jpeg', 'jpg', 'png'];

    public function __construct()
    {
        parent::__construct();
        $this->upload_path = $this->CI->config->item('espel_upload_folder');
        $this->CI->load->library('upload', ['upload_path' => $this->upload_path, 'encrypt_name' => $this->encrypt_name, 'allowed_types' => $this->allowed_types]);
    }

    public function upload()
    {
        if (! $this->CI->upload->do_upload('userfile')) {
            $error = array('error' => $this->CI->upload->display_errors());
            return false;
        }

        $dataUpload = array('upload_data' => $this->CI->upload->data());
        return $dataUpload['upload_data'];
    }

} 