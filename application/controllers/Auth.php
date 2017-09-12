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

    public function lupa_katalaluan()
    {
        $this->load->model("profil_model","profil");

        $username = $this->input->post("txtUsername");
        $profil = $this->profil->get_by("nokp", $username);
        if($profil)
        {
            $this->load->library("appnotify");
            $slug = md5($username . $profil->email . date('Ymd'));

            $mail = [
                "to" => $profil->email,
                "subject" => "[espel] Reset Katalaluan",
                "body" => $this->load->view("layout/email/reset_katalaluan",["profil"=>$profil,"slug"=>$slug],TRUE),
            ];

            //echo $mail["body"];
            //die();
            //
            if($this->appnotify->send($mail))
            {
                $this->appsess->setFlashSession("success", TRUE);
                redirect("login#signup");
            }
            else
            {
                $this->appsess->setFlashSession("success", FALSE);
                redirect("login#signup");
            }
        }
        else
        {
            $this->appsess->setFlashSession("success", FALSE);
            redirect("login#signup");
        }
    }

    public function reset()
    {
        $this->load->model("profil_model","profil");

        $user_id = $this->uri->segment(2);
		if(!$user_id) show_error('Invalid reset code.');
		$hash = $this->uri->segment(3);
		if(!$hash) show_error('Invalid reset code.');

        $user = $this->profil->get_by("nokp",$user_id);
        if(!$user) show_error('Invalid reset code.');
		$slug = md5($user->nokp . $user->email . date('Ymd'));
		if($hash != $slug) show_error('Invalid reset code.');

        if(!$this->exist("reset"))
        {
            $this->load->view('reset');
        }
        else
        {
            $pass = $this->input->post("katalaluan");
            $rePass = $this->input->post("reKatalaluan");

            if($pass == $rePass)
            {
                $this->load->library("appauth");
                if($this->appauth->reset_password($user->nokp,$pass))
                {
                    $this->appsess->setFlashSession("success", TRUE);
                    redirect("login");
                }
                else
                {
                    $this->appsess->setFlashSession("success", FALSE);
                    redirect("login");
                }
            }
            else
            {
                $this->appsess->setFlashSession("success", FALSE);
                redirect("login");
            }
        }
    }
}
