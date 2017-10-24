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
            SELECT espel_profil.nama, espel_permohonan_kursus.nokp, espel_kursus.tajuk, 'PENYELARAS' AS cipta, espel_kursus.stat_soal_selidik_a, year(espel_kursus.tkh_mula) as tahun, espel_kursus.ptj_jabatan_id_created as jabatan_id, espel_profil.gred_id, espel_profil.skim_id, espel_profil.kelas_id, hrmis_carta_organisasi.title, espel_profil.kelas_id, espel_profil.skim_id
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
        $sql = "select * from (SELECT
            b.nama,
            a.nokp,
            a.tajuk,
            'PENGGUNA' AS cipta,
            a.stat_soal_selidik_b,
            year(a.tkh_mula) AS tahun,
            h.jabatan_id AS jabatan_id,
            h.gred_id,
            h.skim_id,
            h.kelas_id,
            h.nama AS nama_ppp,
            d.title AS jabatan_ppp,
            e.keterangan AS kumpulan_ppp,
            f.keterangan AS skim_ppp
            FROM
            espel_kursus AS a
            INNER JOIN espel_profil AS b ON b.nokp = a.nokp
            LEFT JOIN espel_boranga AS c ON a.id = c.kursus_id AND a.nokp = c.nokp
            LEFT JOIN espel_borangb AS g ON c.id = g.boranga_id
            INNER JOIN espel_profil AS h ON b.nokp_ppp = h.nokp
            INNER JOIN hrmis_carta_organisasi AS d ON h.jabatan_id = d.buid
            INNER JOIN hrmis_kumpulan AS e ON h.kelas_id = e.kod
            INNER JOIN hrmis_skim AS f ON h.skim_id = f.kod
            WHERE
            a.stat_soal_selidik_b = 'Y' AND
            g.id IS NULL AND
            a.stat_hadir = 'L'
            UNION
            SELECT
            c.nama,
            b.nokp,
            a.tajuk,
            'PENYELARAS' AS cipta,
            a.stat_soal_selidik_b,
            year(a.tkh_mula) AS tahun,
            a.ptj_jabatan_id_created AS jabatan_id,
            f.gred_id,
            f.skim_id,
            f.kelas_id,
            f.nama AS nama_ppp,
            hrmis_carta_organisasi.title AS jabatan_ppp,
            hrmis_kumpulan.keterangan AS kumpulan_ppp,
            hrmis_skim.keterangan AS skim_ppp
            FROM
            espel_kursus AS a
            INNER JOIN espel_permohonan_kursus AS b ON a.id = b.kursus_id
            INNER JOIN espel_profil AS c ON c.nokp = b.nokp
            LEFT JOIN espel_boranga AS d ON b.kursus_id = d.kursus_id AND b.nokp = d.nokp
            INNER JOIN espel_borangb AS e ON d.id = e.boranga_id
            INNER JOIN espel_profil AS f ON f.nokp_ppp = e.nokp
            INNER JOIN hrmis_carta_organisasi ON f.jabatan_id = hrmis_carta_organisasi.buid
            INNER JOIN hrmis_kumpulan ON f.kelas_id = hrmis_kumpulan.kod
            INNER JOIN hrmis_skim ON f.skim_id = hrmis_skim.kod
            WHERE
            a.stat_soal_selidik_b = 'Y' AND
            a.stat_laksana = 'L' AND
            b.stat_mohon = 'L' AND
            b.stat_hadir = 'Y') as a
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
        $sql .= " ORDER BY a.nama_ppp";
        
        return $this->db->query($sql)->result();
    }

    public function analisa_reaksi($sen_jabatan, $tahun)
    {
        $sql = "SELECT
            Sum(view_analisa_boranga_reaksi.`b1-1`) AS `b1-1`,
            Sum(view_analisa_boranga_reaksi.`b2-1`) AS `b2-1`,
            Sum(view_analisa_boranga_reaksi.`b3-1`) AS `b3-1`,
            Sum(view_analisa_boranga_reaksi.`b4-1`) AS `b4-1`,
            Sum(view_analisa_boranga_reaksi.`b5-1`) AS `b5-1`,
            Sum(view_analisa_boranga_reaksi.`b6-1`) AS `b6-1`,
            Sum(view_analisa_boranga_reaksi.`b7-1`) AS `b7-1`,
            Sum(view_analisa_boranga_reaksi.`b8-1`) AS `b8-1`,
            Sum(view_analisa_boranga_reaksi.`b1-2`) AS `b1-2`,
            Sum(view_analisa_boranga_reaksi.`b2-2`) AS `b2-2`,
            Sum(view_analisa_boranga_reaksi.`b3-2`) AS `b3-2`,
            Sum(view_analisa_boranga_reaksi.`b4-2`) AS `b4-2`,
            Sum(view_analisa_boranga_reaksi.`b5-2`) AS `b5-2`,
            Sum(view_analisa_boranga_reaksi.`b6-2`) AS `b6-2`,
            Sum(view_analisa_boranga_reaksi.`b7-2`) AS `b7-2`,
            Sum(view_analisa_boranga_reaksi.`b8-2`) AS `b8-2`,
            Sum(view_analisa_boranga_reaksi.`b1-3`) AS `b1-3`,
            Sum(view_analisa_boranga_reaksi.`b2-3`) AS `b2-3`,
            Sum(view_analisa_boranga_reaksi.`b3-3`) AS `b3-3`,
            Sum(view_analisa_boranga_reaksi.`b4-3`) AS `b4-3`,
            Sum(view_analisa_boranga_reaksi.`b5-3`) AS `b5-3`,
            Sum(view_analisa_boranga_reaksi.`b6-3`) AS `b6-3`,
            Sum(view_analisa_boranga_reaksi.`b7-3`) AS `b7-3`,
            Sum(view_analisa_boranga_reaksi.`b8-3`) AS `b8-3`,
            Sum(view_analisa_boranga_reaksi.`b1-4`) AS `b1-4`,
            Sum(view_analisa_boranga_reaksi.`b2-4`) AS `b2-4`,
            Sum(view_analisa_boranga_reaksi.`b3-4`) AS `b3-4`,
            Sum(view_analisa_boranga_reaksi.`b4-4`) AS `b4-4`,
            Sum(view_analisa_boranga_reaksi.`b5-4`) AS `b5-4`,
            Sum(view_analisa_boranga_reaksi.`b6-4`) AS `b6-4`,
            Sum(view_analisa_boranga_reaksi.`b7-4`) AS `b7-4`,
            Sum(view_analisa_boranga_reaksi.`b8-4`) AS `b8-4`,
            view_analisa_boranga_reaksi.tahun,
            view_analisa_boranga_reaksi.ptj_jabatan_id_created
            FROM
            view_analisa_boranga_reaksi
            WHERE 1=1
            AND view_analisa_boranga_reaksi.ptj_jabatan_id_created in (?)
            AND view_analisa_boranga_reaksi.tahun = ?
            GROUP BY
            view_analisa_boranga_reaksi.ptj_jabatan_id_created,
            view_analisa_boranga_reaksi.tahun";
        return $this->query($sql,[$sen_jabatan,$tahun]);
    }
}
