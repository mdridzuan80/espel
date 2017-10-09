<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends MY_Model
{
    protected $_table = "log";

    public function latest_log($nokp)
    {
        $sql ='select * from log where nokp = ? order by date DESC limit 10';
        return $this->db->query($sql,[$nokp])->result();
    }
}
