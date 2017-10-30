<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mohon_kursus_model extends MY_Model
{
    protected $_table = "espel_permohonan_kursus";

    public function get_permohonan($nokp)
    {
        $sql = "SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title AS anjuran_dalam, espel_kursus.penganjur AS anjuran_luar,
            espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_permohonan_kursus.stat_mohon, espel_permohonan_kursus.nokp, espel_permohonan_kursus.tkh
            FROM espel_permohonan_kursus
            INNER JOIN espel_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
            LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
            WHERE 1=1
            AND espel_permohonan_kursus.nokp = ?
            AND espel_permohonan_kursus.role = 'PENGGUNA'";

        return $this->db->query($sql,[$nokp])->result();
    }

    public function get_dicalonkan($nokp)
    {
        $sql = "SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title AS anjuran_dalam, espel_kursus.penganjur AS anjuran_luar,
            espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_permohonan_kursus.stat_mohon, espel_permohonan_kursus.nokp, espel_permohonan_kursus.tkh,
            espel_kursus.surat,espel_kursus.stat_laksana,espel_permohonan_kursus.stat_hadir
            FROM espel_permohonan_kursus
            INNER JOIN espel_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
            LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
            WHERE 1=1
            AND espel_permohonan_kursus.nokp = ?
            AND espel_permohonan_kursus.role = 'PTJ'";

        return $this->db->query($sql,[$nokp])->result();
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
        $this->load->model('kumpulan_profil_model','kumpulan_profil');
        $jabatan_id = $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id;

        $this->db->select('a.id, b.nama, b.gred_id as gred, e.keterangan as kumpulan, c.title as jabatan, a.stat_mohon, a.role, a.stat_hadir');
        $this->db->from($this->_table . ' a');
        $this->db->join('espel_profil b', 'a.nokp = b.nokp');
        $this->db->join('hrmis_carta_organisasi c', 'b.jabatan_id = c.buid');
        $this->db->join('hrmis_kumpulan e', 'b.kelas_id = e.kod');
        $this->db->join('hrmis_skim f', 'b.skim_id = f.kod');
        $this->db->where('a.kursus_id',$Kursus_id);


        if(isset($filter->jabatan_id) && $filter->jabatan_id)
        {
            if($filter->jabatan_id != $jabatan_id)
            {
                $this->db->where('b.jabatan_id',$filter->jabatan_id);
            }
        }

        if(isset($filter->kumpulan) && $filter->kumpulan)
        {
            $this->db->where('b.kelas_id',$filter->kumpulan);
        }

        if(isset($filter->gred) && $filter->gred)
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

        if(isset($filter->jabatan_id) && $filter->jabatan_id)
        {
            $sql .= ' and a.jabatan_id = ' . $filter->jabatan_id;
        }

        if(isset($filter->kumpulan) && $filter->kumpulan)
        {
            $sql .= ' and a.skim_id = ' . $filter->kumpulan;
        }

        if(isset($filter->gred) && $filter->gred)
        {
            $sql .= ' and a.gred_id = ' . $filter->gred;
        }

        if(isset($filter->hari) && $filter->hari)
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

    public function sen_prestasi($filter)
    {
        $sql = 'select * from (SELECT a.nokp, a.nama, b.title jabatan, hk.keterangan kumpulan, hs.keterangan skim, a.jabatan_id, a.kelas_id, a.skim_id, a.gred_id, 0 as hari
                FROM espel_profil a, hrmis_carta_organisasi b, hrmis_kumpulan hk, hrmis_skim hs
                WHERE 1=1
                AND a.jabatan_id = b.buid
                AND a.kelas_id = hk.kod
                AND a.skim_id = hs.kod
                AND a.nokp NOT IN (SELECT nokp FROM espel_kursus WHERE YEAR(tkh_mula) = ' . $filter->tahun . ' AND stat_hadir = \'L\' AND nokp is not null)
                UNION
                SELECT a.nokp, a.nama, c.title jabatan, hk.keterangan kumpulan, hs.keterangan skim, a.jabatan_id, a.kelas_id, a.skim_id, a.gred_id, sum(b.hari) as hari
                FROM espel_profil a, espel_kursus b, hrmis_carta_organisasi c, hrmis_kumpulan hk, hrmis_skim hs
                WHERE 1=1
                AND a.nokp = b.nokp
                AND a.jabatan_id = c.buid
                AND a.kelas_id = hk.kod
                AND a.skim_id = hs.kod
                AND YEAR(b.tkh_mula) = ' . $filter->tahun . ' AND b.stat_hadir = \'L\'
                GROUP BY a.nokp, a.nama, c.title, hk.keterangan, hs.keterangan, a.jabatan_id, a.kelas_id, a.skim_id, a.gred_id) as a WHERE 1=1';

        if(isset($filter->jabatan_id) && $filter->jabatan_id)
        {
            $sql .= ' and a.jabatan_id IN (' . implode(',',$filter->jabatan_id) . ')';
        }

        if(isset($filter->kelas_id) && $filter->kelas_id)
        {
            $sql .= ' and a.kelas_id = \'' . $filter->kelas_id . '\'';
        }

        if(isset($filter->skim_id) && $filter->skim_id)
        {
            $sql .= ' and a.skim_id = \'' . $filter->skim_id . '\'';
        }

        if(isset($filter->gred_id) && $filter->gred_id)
        {
            $sql .= ' and a.gred_id = \'' . $filter->gred_id . '\'';
        }

        if(isset($filter->hari) && $filter->hari)
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

        $sql .= " ORDER BY a.nama";

        $rst = $this->db->query($sql);

        return $rst->result();
    }
}
