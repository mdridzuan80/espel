<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AppSess
{
    private $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function setSessionData($name, $data)
    {
        $this->CI->session->set_userdata($name, $data);
    }

    public function getSessionData($name)
    {
        return $this->CI->session->userdata($name);
    }

    public function sessionDestroy()
    {
        $this->CI->session->sess_destroy();
    }

    public function validateSession($name)
    {
        return $this->getSessionData($name);
    }

    public function setFlashSession($name, $value)
    {
        return $this->CI->session->set_flashdata($name, $value);
    }

    public function getFlashSession($name = false)
    {
        if($name)
            return $this->CI->session->flashdata($name);
        return $this->CI->session->flashdata();
    }
}
