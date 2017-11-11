<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Borangb_model extends MY_Model
{
    protected $_table = "espel_borangb";

    public function senarai_boranga_related($nokp)
    {
        $sql = "select * from (SELECT espel_kursus.nokp, espel_kursus.id as kursus_id, espel_kursus.tajuk, espel_kursus.anjuran, espel_dict_program.nama as program, hrmis_carta_organisasi.title as anjuran_dalam,
            espel_kursus.penganjur as anjuran_luar, espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_kursus.hari
            FROM espel_kursus
            INNER JOIN espel_dict_program ON espel_kursus.program_id = espel_dict_program.id
            LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
            WHERE 1=1
            AND YEAR(espel_kursus.tkh_mula) = ?
            AND espel_kursus.stat_hadir = 'L'
            UNION
            SELECT espel_permohonan_kursus.nokp, espel_kursus.id as kursus_id, espel_kursus.tajuk, espel_kursus.anjuran, espel_dict_program.nama as program, hrmis_carta_organisasi.title as anjuran_dalam, espel_kursus.penganjur as anjuran_luar,
            espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_kursus.hari
            FROM espel_kursus
            INNER JOIN espel_dict_program ON espel_kursus.program_id = espel_dict_program.id
            INNER JOIN espel_permohonan_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
            LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
            WHERE 1=1
            AND YEAR(espel_kursus.tkh_mula) = ?
            and espel_permohonan_kursus.stat_hadir = 'Y' and espel_permohonan_kursus.stat_mohon ='L') a 
            INNER JOIN espel_profil b ON a.nokp = b.nokp
            LEFT JOIN espel_borangb c ON (a.nokp = c.nokp_peserta AND a.kursus_id = c.kursus_id)
            WHERE 1=1
            and c.id is null
            AND b.nokp_ppp = ?
            ORDER BY tkh_mula";

        return $this->db->query($sql,[date('Y'),date('Y'),$nokp])->result();
    }

    public function analisa_reaksi($sen_jabatan, $tahun)
    {
        $sql = "SELECT
            Sum(a.`b1-1`) AS `b1-1`,
            Sum(a.`b2-1`) AS `b2-1`,
            Sum(a.`b3-1`) AS `b3-1`,
            Sum(a.`b4-1`) AS `b4-1`,
            Sum(a.`b5-1`) AS `b5-1`,
            Sum(a.`b6-1`) AS `b6-1`,
            Sum(a.`b1-2`) AS `b1-2`,
            Sum(a.`b2-2`) AS `b2-2`,
            Sum(a.`b3-2`) AS `b3-2`,
            Sum(a.`b4-2`) AS `b4-2`,
            Sum(a.`b5-2`) AS `b5-2`,
            Sum(a.`b6-2`) AS `b6-2`,
            Sum(a.`b1-3`) AS `b1-3`,
            Sum(a.`b2-3`) AS `b2-3`,
            Sum(a.`b3-3`) AS `b3-3`,
            Sum(a.`b4-3`) AS `b4-3`,
            Sum(a.`b5-3`) AS `b5-3`,
            Sum(a.`b6-3`) AS `b6-3`,
            Sum(a.`b1-4`) AS `b1-4`,
            Sum(a.`b2-4`) AS `b2-4`,
            Sum(a.`b3-4`) AS `b3-4`,
            Sum(a.`b4-4`) AS `b4-4`,
            Sum(a.`b5-4`) AS `b5-4`,
            Sum(a.`b6-4`) AS `b6-4`
            FROM
            view_analisa_borangb_reaksi a
            WHERE 1=1
            AND a.ptj_jabatan_id_created in ?
            AND a.tahun = ?";

        return $this->db->query($sql,[$sen_jabatan,$tahun])->row_array();
    }

    public function analisa_pembelajaran($sen_jabatan, $tahun)
    {
        $sql = "SELECT
            Sum(a.`c1-1`) AS `c1-1`,
            Sum(a.`c2-1`) AS `c2-1`,
            Sum(a.`c3-1`) AS `c3-1`,
            Sum(a.`c4-1`) AS `c4-1`,
            Sum(a.`c5-1`) AS `c5-1`,
            Sum(a.`c6-1`) AS `c6-1`,
            Sum(a.`c7-1`) AS `c7-1`,
            Sum(a.`c1-2`) AS `c1-2`,
            Sum(a.`c2-2`) AS `c2-2`,
            Sum(a.`c3-2`) AS `c3-2`,
            Sum(a.`c4-2`) AS `c4-2`,
            Sum(a.`c5-2`) AS `c5-2`,
            Sum(a.`c6-2`) AS `c6-2`,
            Sum(a.`c7-2`) AS `c7-2`,
            Sum(a.`c1-3`) AS `c1-3`,
            Sum(a.`c2-3`) AS `c2-3`,
            Sum(a.`c3-3`) AS `c3-3`,
            Sum(a.`c4-3`) AS `c4-3`,
            Sum(a.`c5-3`) AS `c5-3`,
            Sum(a.`c6-3`) AS `c6-3`,
            Sum(a.`c7-3`) AS `c7-3`,
            Sum(a.`c1-4`) AS `c1-4`,
            Sum(a.`c2-4`) AS `c2-4`,
            Sum(a.`c3-4`) AS `c3-4`,
            Sum(a.`c4-4`) AS `c4-4`,
            Sum(a.`c5-4`) AS `c5-4`,
            Sum(a.`c6-4`) AS `c6-4`,
            Sum(a.`c7-4`) AS `c7-4`
            FROM
            view_analisa_borangb_pembelajaran a
            WHERE 1=1
            AND a.ptj_jabatan_id_created in ?
            AND a.tahun = ?";
            
        return $this->db->query($sql,[$sen_jabatan,$tahun])->row_array();
    }
}
