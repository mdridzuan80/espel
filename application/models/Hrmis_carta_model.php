<?php
class Hrmis_carta_model extends MY_Model
{
    protected $_table = "hrmis_carta_organisasi";

    public function senarai_carta()
    {
        $sql = 'select * from hrmis_carta_organisasi
            where 1=1';
        return $this->db->query($sql)->result_array();
    }

    public function senarai_penyelaras()
    {
        $sql = "select distinct a.buid, a.parent_buid, b.jabatan_id as penyelaras from hrmis_carta_organisasi a
            left join espel_kumpulan_profil b on a.buid = b.jabatan_id  ";
        return $this->db->query($sql)->result_array();
    }
}