<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Boranga_model extends MY_Model
{
    protected $_table = "espel_boranga";

    public function sen_tidak_jawab($filter)
    {
        $sql = "SELECT * FROM (SELECT b.nama, a.nokp, a.tajuk, 'PENGGUNA' AS cipta, a.stat_soal_selidik_a, year(a.tkh_mula) as tahun, b.jabatan_id as jabatan_id, b.gred_id, b.skim_id, b.kelas_id, d.title
            FROM espel_kursus AS a
            INNER JOIN espel_profil AS b ON b.nokp = a.nokp
            INNER JOIN hrmis_carta_organisasi d on b.jabatan_id = d.buid 
            LEFT JOIN espel_boranga AS c ON a.id = c.kursus_id AND a.nokp = c.nokp
            WHERE
            a.stat_soal_selidik_a = 'Y' AND
            c.id IS NULL AND
            a.stat_hadir = 'L'
            UNION
            SELECT espel_profil.nama, espel_permohonan_kursus.nokp, espel_kursus.tajuk, 'PENYELARAS' AS cipta, espel_kursus.stat_soal_selidik_a, year(espel_kursus.tkh_mula) as tahun, espel_kursus.ptj_jabatan_id_created as jabatan_id, espel_profil.gred_id, espel_profil.skim_id, espel_profil.kelas_id, hrmis_carta_organisasi.title
            FROM espel_kursus
            INNER JOIN espel_permohonan_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
            INNER JOIN espel_profil ON espel_profil.nokp = espel_permohonan_kursus.nokp
            INNER JOIN hrmis_carta_organisasi on espel_profil.jabatan_id = hrmis_carta_organisasi.buid 
            LEFT JOIN espel_boranga ON espel_permohonan_kursus.kursus_id = espel_boranga.kursus_id AND espel_permohonan_kursus.nokp = espel_boranga.nokp
            WHERE
            espel_kursus.stat_soal_selidik_a = 'Y' AND
            espel_kursus.stat_laksana = 'L' AND
            espel_permohonan_kursus.stat_mohon = 'L' AND
            espel_permohonan_kursus.stat_hadir = 'Y') as a
            WHERE 1=1";

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
}
