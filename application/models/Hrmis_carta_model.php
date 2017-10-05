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
}