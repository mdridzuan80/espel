<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Boranga_model extends MY_Model
{
    protected $_table = "espel_boranga";

    public function sen_tidak_jawab($filter)
    {
        $sql = "SELECT * FROM (SELECT b.nama, a.nokp, a.tajuk, 'PENGGUNA' AS cipta, a.stat_soal_selidik_a, year(a.tkh_mula) as tahun, b.jabatan_id as jabatan_id, b.gred_id, b.skim_id, b.kelas_id, d.title, f.keterangan AS kumpulan, e.keterangan AS skim
            FROM espel_kursus AS a
            INNER JOIN espel_profil AS b ON b.nokp = a.nokp
            INNER JOIN hrmis_carta_organisasi d on b.jabatan_id = d.buid 
            LEFT JOIN espel_boranga AS c ON a.id = c.kursus_id AND a.nokp = c.nokp
            INNER JOIN hrmis_kumpulan AS f ON b.kelas_id = f.kod
            INNER JOIN hrmis_skim AS e ON b.skim_id = e.kod
            WHERE
            a.stat_soal_selidik_a = 'Y' AND
            c.id IS NULL AND
            a.stat_hadir = 'L'
            UNION
            SELECT espel_profil.nama, espel_permohonan_kursus.nokp, espel_kursus.tajuk, 'PENYELARAS' AS cipta, espel_kursus.stat_soal_selidik_a, year(espel_kursus.tkh_mula) as tahun, espel_kursus.ptj_jabatan_id_created as jabatan_id, espel_profil.gred_id, espel_profil.skim_id, espel_profil.kelas_id, hrmis_carta_organisasi.title, hrmis_kumpulan.keterangan, hrmis_skim.keterangan
            FROM espel_kursus
            INNER JOIN espel_permohonan_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
            INNER JOIN espel_profil ON espel_profil.nokp = espel_permohonan_kursus.nokp
            INNER JOIN hrmis_carta_organisasi on espel_profil.jabatan_id = hrmis_carta_organisasi.buid 
            LEFT JOIN espel_boranga ON espel_permohonan_kursus.kursus_id = espel_boranga.kursus_id AND espel_permohonan_kursus.nokp = espel_boranga.nokp
            INNER JOIN hrmis_kumpulan ON hrmis_kumpulan.kod = espel_profil.kelas_id
            INNER JOIN hrmis_skim ON hrmis_skim.kod = espel_profil.skim_id
            WHERE
            espel_kursus.stat_soal_selidik_a = 'Y' AND
            espel_kursus.stat_laksana = 'L' AND
            espel_permohonan_kursus.stat_mohon = 'L' AND
            espel_permohonan_kursus.stat_hadir = 'Y') as a
            WHERE 1=1";

            if(isset($filter->tahun) && $filter->tahun)
            {
                $sql .= ' and a.tahun = ' . $filter->tahun;
            }

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
            $sql .= " ORDER BY a.nama";

        return $this->db->query($sql)->result();
    }

    public function sen_x_jawab_b($filter)
    {
        $sql = "SELECT c.*, d.title as jabatan_ppp, e.nama as kumpulan_ppp, f.keterangan as skim_ppp, a.nama as peserta, a.id as kursus_id, a.tajuk
            FROM (SELECT a.nokp_ppp, b.nokp, b.nama, b.id, b.tajuk, b.tahun
            FROM view_laporan_statistik_prestasi a
            INNER JOIN (SELECT a.nokp, b.nama, a.id, a.tajuk, year(a.tkh_mula) as tahun
            FROM espel_kursus a
            INNER JOIN espel_profil b ON a.nokp = b.nokp 
            WHERE a.`stat_soal_selidik_b` = 'Y'
            AND a.nokp is not null
            AND a.stat_hadir = 'L'
            UNION
            SELECT b.nokp, c.nama, a.id, a.tajuk, year(a.tkh_mula) as tahun
            FROM espel_kursus a
            INNER JOIN espel_permohonan_kursus b ON b.kursus_id = a.id
            INNER JOIN espel_profil c ON b.nokp = c.nokp
            WHERE a.stat_soal_selidik_b = 'Y'
            AND a.stat_laksana = 'L'
            AND b.stat_mohon = 'L'
            AND b.stat_hadir = 'Y') b ON a.nokp = b.nokp) a
            LEFT JOIN espel_borangb b ON (a.nokp = b.nokp_peserta AND a.id = b.kursus_id AND a.nokp_ppp = b.nokp)
            AND b.id IS NULL
            INNER JOIN view_laporan_statistik_prestasi c ON a.nokp_ppp = c.nokp
            INNER JOIN hrmis_carta_organisasi d ON c.jabatan_id = d.buid
            INNER JOIN espel_dict_kelas e ON e.id = c.kelas
            INNER JOIN hrmis_skim f ON f.kod = c.skim_id
            ";

        if(isset($filter->tahun) && $filter->tahun)
        {
            $sql .= ' and a.tahun = ' . $filter->tahun;
        }

        if(isset($filter->jabatan_id) && $filter->jabatan_id)
        {
            $sql .= ' and c.jabatan_id IN (' . implode(',',$filter->jabatan_id) . ')';
        }

        if(isset($filter->kelas_id) && $filter->kelas_id)
        {
            $sql .= ' and c.kelas = '  . $filter->kelas_id ;
        }

        if(isset($filter->skim_id) && $filter->skim_id)
        {
            $sql .= ' and c.skim_id = \'' . $filter->skim_id . '\'';
        }

        if(isset($filter->gred_id) && $filter->gred_id)
        {
            $sql .= ' and c.gred_id = \'' . $filter->gred_id . '\'';
        }
        $sql .= " ORDER BY c.nama";
        
        return $this->db->query($sql)->result();
    }

    public function analisa_reaksi($kursus_id)
    {
        $sql = "SELECT
            Sum(a.`b1-1`) AS `b1-1`,
            Sum(a.`b2-1`) AS `b2-1`,
            Sum(a.`b3-1`) AS `b3-1`,
            Sum(a.`b4-1`) AS `b4-1`,
            Sum(a.`b5-1`) AS `b5-1`,
            Sum(a.`b6-1`) AS `b6-1`,
            Sum(a.`b7-1`) AS `b7-1`,
            Sum(a.`b8-1`) AS `b8-1`,
            Sum(a.`b1-2`) AS `b1-2`,
            Sum(a.`b2-2`) AS `b2-2`,
            Sum(a.`b3-2`) AS `b3-2`,
            Sum(a.`b4-2`) AS `b4-2`,
            Sum(a.`b5-2`) AS `b5-2`,
            Sum(a.`b6-2`) AS `b6-2`,
            Sum(a.`b7-2`) AS `b7-2`,
            Sum(a.`b8-2`) AS `b8-2`,
            Sum(a.`b1-3`) AS `b1-3`,
            Sum(a.`b2-3`) AS `b2-3`,
            Sum(a.`b3-3`) AS `b3-3`,
            Sum(a.`b4-3`) AS `b4-3`,
            Sum(a.`b5-3`) AS `b5-3`,
            Sum(a.`b6-3`) AS `b6-3`,
            Sum(a.`b7-3`) AS `b7-3`,
            Sum(a.`b8-3`) AS `b8-3`,
            Sum(a.`b1-4`) AS `b1-4`,
            Sum(a.`b2-4`) AS `b2-4`,
            Sum(a.`b3-4`) AS `b3-4`,
            Sum(a.`b4-4`) AS `b4-4`,
            Sum(a.`b5-4`) AS `b5-4`,
            Sum(a.`b6-4`) AS `b6-4`,
            Sum(a.`b7-4`) AS `b7-4`,
            Sum(a.`b8-4`) AS `b8-4`
            FROM
            view_analisa_boranga_reaksi a
            WHERE 1=1
            AND id = ?";

        return $this->db->query($sql,[$kursus_id])->row_array();
    }

    public function analisa_pembelajaran($kursus_id)
    {
        $sql = "SELECT
            Sum(a.`c1-1`) AS `c1-1`,
            Sum(a.`c2-1`) AS `c2-1`,
            Sum(a.`c3-1`) AS `c3-1`,
            Sum(a.`c4-1`) AS `c4-1`,
            Sum(a.`c5-1`) AS `c5-1`,
            Sum(a.`c6-1`) AS `c6-1`,
            Sum(a.`c7-1`) AS `c7-1`,
            Sum(a.`c8-1`) AS `c8-1`,
            Sum(a.`c9-1`) AS `c9-1`,
            Sum(a.`c10-1`) AS `c10-1`,
            Sum(a.`c11-1`) AS `c11-1`,
            Sum(a.`c12-1`) AS `c12-1`,
            Sum(a.`c1-2`) AS `c1-2`,
            Sum(a.`c2-2`) AS `c2-2`,
            Sum(a.`c3-2`) AS `c3-2`,
            Sum(a.`c4-2`) AS `c4-2`,
            Sum(a.`c5-2`) AS `c5-2`,
            Sum(a.`c6-2`) AS `c6-2`,
            Sum(a.`c7-2`) AS `c7-2`,
            Sum(a.`c8-2`) AS `c8-2`,
            Sum(a.`c9-2`) AS `c9-2`,
            Sum(a.`c10-2`) AS `c10-2`,
            Sum(a.`c11-2`) AS `c11-2`,
            Sum(a.`c12-2`) AS `c12-2`,
            Sum(a.`c1-3`) AS `c1-3`,
            Sum(a.`c2-3`) AS `c2-3`,
            Sum(a.`c3-3`) AS `c3-3`,
            Sum(a.`c4-3`) AS `c4-3`,
            Sum(a.`c5-3`) AS `c5-3`,
            Sum(a.`c6-3`) AS `c6-3`,
            Sum(a.`c7-3`) AS `c7-3`,
            Sum(a.`c8-3`) AS `c8-3`,
            Sum(a.`c9-3`) AS `c9-3`,
            Sum(a.`c10-3`) AS `c10-3`,
            Sum(a.`c11-3`) AS `c11-3`,
            Sum(a.`c12-3`) AS `c12-3`,
            Sum(a.`c1-4`) AS `c1-4`,
            Sum(a.`c2-4`) AS `c2-4`,
            Sum(a.`c3-4`) AS `c3-4`,
            Sum(a.`c4-4`) AS `c4-4`,
            Sum(a.`c5-4`) AS `c5-4`,
            Sum(a.`c6-4`) AS `c6-4`,
            Sum(a.`c7-4`) AS `c7-4`,
            Sum(a.`c8-4`) AS `c8-4`,
            Sum(a.`c9-4`) AS `c9-4`,
            Sum(a.`c10-4`) AS `c10-4`,
            Sum(a.`c11-4`) AS `c11-4`,
            Sum(a.`c12-4`) AS `c12-4`
            FROM
            view_analisa_boranga_pembelajaran a
            WHERE 1=1
            AND id = ?";
            
        return $this->db->query($sql,[$kursus_id])->row_array();
    }
}
