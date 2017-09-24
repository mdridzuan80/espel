<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AppAuth
{
    private $CI;

    const SUPER = "SUPER";
    const ADMIN = "ADMIN";
    const PENYELARAS = "PTJ";
    const PENGGUNA = "PENGGUNA";


    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function hash_katalaluan($password)
    {
        return password_hash($password,PASSWORD_BCRYPT);
    }

    public function isExist($username) {
        $this->CI->load->model("profil_model","profil");
        $profil = $this->CI->profil->getProfil($username);

        if(count($profil))
        {
            return $profil;
        }

        return false;
    }

    public function login($username, $password) {
        $this->CI->load->model("profil_model","profil");
        $profil = $this->CI->profil->getProfil($username);

        if(password_verify($password,$profil->password))
        {
            $this->CI->load->model("kumpulan_profil_model","kumpulan_profil");
            $this->CI->appsess->setSessionData('isLogged', TRUE);
            $this->CI->appsess->setSessionData('username', $username);
            $this->CI->appsess->setSessionData('kumpulan', $this->CI->kumpulan_profil->getDefaultKumpulan($username));
            return $this->isLogged();
        }

        return FALSE;
    }

    public function logout()
    {
        $this->CI->appsess->sessionDestroy();
    }

    public function reset_password($username, $password)
    {
        $this->CI->load->model("profil_model","profil");
        $data["password"] = $this->hash_katalaluan($password);
        $data["first_login"] = ($this->CI->profil->get($username)->first_login == 'T')? 'F':'T';

        if($this->CI->profil->update($username,$data))
        {
            return TRUE;
        }
        
        return FALSE;
    }

    public function isLogged()
    {
        return $this->CI->appsess->validateSession("isLogged");
    }

    private function setLogged($bool)
    {
        $this->CI->appsess->setSessionData('isLogged', $bool);
    }

    public function hasPeranan($nokp, $kumpulan)
    {
        $this->CI->load->model("kumpulan_profil_model","kumpulan_profil");
        return $this->CI->kumpulan_profil->hasKumpulan($nokp,$kumpulan);
    }

    public function peranan_desc($kod)
    {
        $this->CI->load->model("kumpulan_model","kumpulan");
        return $this->CI->kumpulan->get_by("kod",$kod)->nama;
    }
}
