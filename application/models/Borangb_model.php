<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Borangb_model extends MY_Model
{
    protected $_table = "espel_borangb";

    public function senarai_boranga_related($pyd)
    {
        $sql = "select *, espel_dict_program.nama as program, espel_boranga.id as borangaid from espel_kursus
            join espel_boranga on espel_kursus.id = espel_boranga.kursus_id
            join espel_profil on espel_boranga.nokp = espel_profil.nokp
            join espel_dict_program on espel_kursus.program_id = espel_dict_program.id 
            left join espel_borangb on espel_boranga.id = espel_borangb.boranga_id
            where espel_kursus.stat_soal_selidik_b = 'Y'
            and espel_borangb.id is null
            and espel_boranga.nokp in (?)";

        return $this->db->query($sql,[$pyd])->result();
    }
}
