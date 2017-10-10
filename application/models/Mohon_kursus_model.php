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

    public function get_calon($Kursus_id, $filter)
    {
        $this->db->select('a.id, b.nama, b.gred_id as gred, e.keterangan as kumpulan, c.title as jabatan, a.stat_mohon, a.role');
        $this->db->from($this->_table . ' a');
        $this->db->join('espel_profil b', 'a.nokp = b.nokp');
        $this->db->join('hrmis_carta_organisasi c', 'b.jabatan_id = c.buid');
        $this->db->join('hrmis_kumpulan e', 'b.kelas_id = e.kod');
        $this->db->join('hrmis_skim f', 'b.skim_id = f.kod');
        $this->db->where('a.kursus_id',$Kursus_id);

        if($filter->jabatan_id)
        {
            $this->db->where('b.jabatan_id',$filter->jabatan_id);
        }

        if($filter->kumpulan)
        {
            $this->db->where('e.kelas_id',$filter->kumpulan);
        }

        if($filter->gred)
        {
            $this->db->where('b.gred_id',$filter->gred);
        }

        $rst = $this->db->get();

        return $rst->result();
    }

    public function get_pencalonan($kursus_id, $filter)
    {
        $sql = 'select * from (SELECT a.nokp, a.nama, b.title jabatan, a.jabatan_id, a.gred_id, a.skim_id, 0 as hari
                FROM espel_profil a, hrmis_carta_organisasi b
                WHERE 1=1
                AND a.jabatan_id = b.buid
                AND a.nokp NOT IN (SELECT nokp FROM espel_kursus WHERE YEAR(tkh_mula) = ' . date('Y') . ' AND stat_hadir = \'L\' AND nokp is not null)
                UNION
                SELECT a.nokp, a.nama, c.title jabatan, a.jabatan_id, a.gred_id, a.skim_id, sum(b.hari) as hari
                FROM espel_profil a, espel_kursus b, hrmis_carta_organisasi c
                WHERE 1=1
                AND a.nokp = b.nokp
                AND a.jabatan_id = c.buid
                AND YEAR(b.tkh_mula) = ' . date('Y') . ' AND b.stat_hadir = \'L\'
                GROUP BY a.nokp, a.nama, c.title, a.jabatan_id, a.gred_id, a.skim_id) as a WHERE 1=1
                AND nokp NOT IN(select nokp from espel_permohonan_kursus where kursus_id = ' . $kursus_id .')';

        if($filter->jabatan_id)
        {
            $sql .= ' and a.jabatan_id = ' . $filter->jabatan_id;
        }

        if($filter->kumpulan)
        {
            $sql .= ' and a.skim_id = ' . $filter->kumpulan;
        }

        if($filter->gred)
        {
            $sql .= ' and a.gred_id = ' . $filter->gred;
        }

        if($filter->hari)
        {
            if($filter->hari == 1)
            {
                $sql .= ' and a.hari < ' . $filter->hari;
            }
            else
            {
                $sql .= ' and a.hari >= ' . $filter->hari;
            }

        }

        $rst = $this->db->query($sql);

        return $rst->result();
    }
}
