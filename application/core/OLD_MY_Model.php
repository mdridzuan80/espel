<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function execSql($sql, $var = false,$log = TRUE)
    {
        $sql;
        $log;
        if($var)
        {
            $sql=$this->db->query($sql,$var);
        }
        else
        {
            $sql=$this->db->query($sql);
        }

        $log = $this->db->last_query();

        /*if($log)
        {
            $data = ["nokp" => $this->appsess->getSessionData("username"),
                    $
                ];
            $this->db->
        }*/

        return $sql;
    }
}
