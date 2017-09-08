<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil_model extends MY_Model
{
    protected $_table = "espel_profil";
    protected $primary_key = "nokp";

    protected $belongs_to = [
        'jawatan' => [
            'model' => 'jawatan_model',
            'primary_key'=>'jawatan_id',
        ],
        'gred' => [
            'model' => 'gred_model',
            'primary_key'=>'gred_id',
        ],
        'jabatan' => [
            'model' => 'jabatan_model',
            'primary_key'=>'jabatan_id',
        ],
    ];

    protected $has_many = [
        'kumpulan_profil' => [
            'model' => 'kumpulan_profil_model',
            'primary_key'=>'profil_nokp',
        ],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getProfil($username)
    {
        $rst = $this->with("jawatan")
            ->with("gred")
            ->with("jabatan")
            ->with("kumpulan_profil")
            ->get_by(["nokp"=>$username,"status"=>'Y']);

        $this->load->model("kumpulan_model", "kumpulan");

        foreach($rst->kumpulan_profil as $key => $val)
        {
            $rst->kumpulan_profil[$key]->kumpulan = $this->kumpulan->get($val->kumpulan_id);
        }
        return $rst;
    }
}
