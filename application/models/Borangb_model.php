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
}
