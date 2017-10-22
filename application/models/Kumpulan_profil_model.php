<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kumpulan_profil_model extends MY_Model
{
    protected $_table = "espel_kumpulan_profil";
    protected $belongs_to = array( 'kumpulan' => array( 'model' => 'kumpulan_model','primary_key'=>'kumpulan_id') );

    public function __construct()
    {
        parent::__construct();
    }

    public function subscribe_peranan($nokp)
    {
        $sql = 'SELECT
            espel_kumpulan_profil.id,
            espel_kumpulan_profil.profil_nokp,
            espel_kumpulan.kod,
            espel_kumpulan.nama,
            hrmis_carta_organisasi.title
            FROM
            espel_kumpulan_profil
            INNER JOIN espel_kumpulan ON espel_kumpulan_profil.kumpulan_id = espel_kumpulan.id
            LEFT JOIN hrmis_carta_organisasi ON espel_kumpulan_profil.jabatan_id = hrmis_carta_organisasi.buid
            WHERE 1=1
            AND espel_kumpulan_profil.profil_nokp = ?';

        return $this->db->query($sql,[$nokp])->result();
    }
    public function getDefaultKumpulan($username)
    {
        $this->_database->select("b.id,b.kod");
        $this->_database->from($this->_table . " a");
        $this->_database->join("espel_kumpulan b","a.kumpulan_id = b.id");
        $this->_database->order_by("b.id", "DESC");
        $this->_database->where("a.profil_nokp",$username);
        $this->_database->limit(1);
        $kump_profil = $this->_database->get();

        if($kump_profil->num_rows())
        {
            return $kump_profil->row()->kod;
        }
        
        return AppAuth::PENGGUNA;
    }

    public function hasKumpulan($nokp,$kumpulan)
    {
        $this->_database->select("count(*) as `numrows`");
        $this->_database->from($this->_table);
        $this->_database->join("espel_kumpulan", $this->_table . ".kumpulan_id=espel_kumpulan.id");
        $this->_database->where($this->_table . ".profil_nokp",$nokp);
        $this->_database->where_in("kod",$kumpulan);
        return $this->_database->get()->row()->numrows;
    }

    public function getJabatanPeranan($nokp, $role)
    {
        $sql = 'select * from espel_kumpulan_profil where profil_nokp = ? and kumpulan_id = ?';
        return $this->db->query($sql,[$nokp,$role])->row();
    }
}
