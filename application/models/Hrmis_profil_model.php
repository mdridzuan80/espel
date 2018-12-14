<?php
class Hrmis_profil_model extends MY_Model
{
    protected $_table = "hrmis_profil";

    public function get_data()
    {
        $sql = "select *
            from hrmis_profil
            WHERE
            hrmis_profil.nokp NOT IN (select nokp from espel_profil
            where nokp is not NULL)
            and nokp is not NULL
            ";

        return $this->db->query($sql)->result();
    }
}