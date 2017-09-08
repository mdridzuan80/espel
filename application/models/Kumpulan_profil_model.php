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

    public function getDefaultKumpulan($username)
    {
        $this->_database->select("b.id,b.kod");
        $this->_database->from($this->_table . " a");
        $this->_database->join("espel_kumpulan b","a.kumpulan_id = b.id");
        $this->_database->order_by("b.id", "DESC");
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
        $this->db->select("count(*) as `numrows`");
        $this->db->from($this->_table);
        $this->db->join("espel_kumpulan", $this->_table . ".kumpulan_id=espel_kumpulan.id");
        $this->db->where($this->_table . ".profil_nokp",$nokp);
        $this->db->where_in("kod",$kumpulan);
        return $this->db->get()->row()->numrows;
    }
}
