<?php
use Espel\BaseModel\MY_Model;

class Hrmis_profil_import_model extends MY_Model
{
    public $table = "hrmis_profil_import";
    public $timestamps = false;

    public function kosongkan()
    {
        $sql = "truncate table " . $this->table;
        $this->db->query($sql);
    }
}