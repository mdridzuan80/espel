<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil_model extends MY_Model
{
    protected $_table = "espel_profil";
    protected $primary_key = "nokp";

    protected $belongs_to = [
        'carta_l' => [
            'model' => 'hrmis_carta_model',
            'primary_key'=>'buid',
        ],
    ];

    protected $has_many = [
        'peranan_l' => [
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
        $this->load->model("kumpulan_model", "kumpulan");

        $profil = $this->get_by(["nokp"=>$username,"status"=>'Y']);

        return $profil;
    }

    public function all_profil($limit, $start)
    {
        $sql = 'SELECT
            espel_profil.nokp,
            espel_profil.nama,
            espel_profil.gred_id,
            espel_profil.`status`,
            hrmis_skim.keterangan AS skim,
            hrmis_kumpulan.keterangan AS kumpulan,
            hrmis_carta_organisasi.title AS jabatan
            FROM
            espel_profil
            INNER JOIN hrmis_carta_organisasi ON espel_profil.jabatan_id = hrmis_carta_organisasi.buid
            INNER JOIN hrmis_kumpulan ON espel_profil.kelas_id = hrmis_kumpulan.kod
            INNER JOIN hrmis_skim ON hrmis_skim.kod = espel_profil.skim_id
            WHERE
            espel_profil.`status` = \'Y\' AND
            espel_profil.nokp <> \'admin\'
            LIMIT ' . $start . ', ' . $limit;
        
        return $this->db->query($sql)->result();
    }
}
