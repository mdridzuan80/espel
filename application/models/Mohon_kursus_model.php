<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mohon_kursus_model extends MY_Model
{
    protected $_table = "espel_permohonan_kursus";

    public function get_permohonan($nokp)
    {
        $this->db->select("b.tajuk, c.nama, b.tkh_mula, b.tkh_tamat, a.tkh, a.stat_mohon");
        $this->db->from($this->_table . " a");
        $this->db->join("espel_kursus b", "a.kursus_id = b.id");
        $this->db->join("espel_dict_jabatan c","b.penganjur_id = c.id" );
        $this->db->where("a.nokp", $nokp);

        return $this->db->get()->result();
    }

    public function get_permohonan_jabatan($jabatan_id)
    {
        $this->db->select("b.id, b.tajuk, c.nama, b.tkh_mula, b.tkh_tamat, a.tkh, c.nama jabatan, count(a.id) total");
        $this->db->from($this->_table . " a");
        $this->db->join("espel_kursus b", "a.kursus_id = b.id");
        $this->db->join("espel_dict_jabatan c","b.penganjur_id = c.id" );
        $this->db->where("b.ptj_jabatan_id_created", $jabatan_id);
        $this->db->where("b.stat_laksana", 'R');

        return $this->db->get()->result();
    }
}
