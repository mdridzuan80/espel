<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        if($this->exist("login"))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->appauth->login($username, $password);
            return redirect('');
        }
        $this->renderLoginView("login");
    }

    public function logout()
    {
        $this->appauth->logout();
        return redirect();
    }

    public function hash($password)
    {
        echo password_hash($password,PASSWORD_BCRYPT);
    }
}
