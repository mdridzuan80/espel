<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mycpd_model extends MY_Model
{
    protected $_table = "mycpd";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_point($nokp, $tahun)
    {
        $sql = "SELECT IFNULL(sum(point),0) as point from mycpd
            where nokp = ?
            and tahun = ?";
        return $this->db->query($sql, [$nokp, $tahun])->row();
    }
}
