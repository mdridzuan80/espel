<?php
class Hrmis_profil_model extends MY_Model
{
    protected $_table = "hrmis_data_peribadi";

    public function get_data()
    {
        $sql = "select *
            from hrmis_data_peribadi
            WHERE
            hrmis_data_peribadi.nokp NOT IN (select nokp from espel_profil
            where nokp is not NULL)
            and nokp is not NULL
            ";

        return $this->db->query($sql)->result();
    }
}