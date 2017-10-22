<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kumpulan_model extends MY_Model
{
    protected $belongs_to = [
        'kumpulan' => [
            'model' => 'kumpulan_model',
            'primary_key'=>'kumpulan_id',
        ],
    ];

    protected $_table = "espel_kumpulan";

    public function __construct()
    {
        parent::__construct();
    }

    public function sen_kumpulan_patut($kump)
    {
        $sql = "select * from espel_kumpulan where id >= ?";
        return $this->db->query($sql,[$kump])->result();
    }
}
