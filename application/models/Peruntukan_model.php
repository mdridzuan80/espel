<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peruntukan_model extends MY_Model
{
    protected $_table = "espel_peruntukan";

    protected $belongs_to = [
        'jabatan' => [
            'model' => 'jabatan_model',
            'primary_key'=>'jabatan_id',
        ],
        'jns_peruntukan' => [
            'model' => 'jnsperuntukan_model',
            'primary_key'=>'jns_peruntukan_id',
        ],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function peruntukan_semasa($peruntukan)
    {
        $this->db->select("sum(a.jumlah) jumlah ");
        $this->db->from($this->_table . " a");
        $this->db->where("YEAR(a.tarikh)", date( 'Y',strtotime($peruntukan->tarikh) ) );
        $this->db->where("a.jabatan_id", $peruntukan->jabatan_id);
        $this->db->where("a.jns_peruntukan_id", $peruntukan->jns_peruntukan_id);
        return $this->db->get()->row()->jumlah;
    }

    public function sen_transaksi($peruntukan)
    {
        $this->db->from($this->_table . " a");
        $this->db->where("YEAR(a.tarikh)", date( 'Y',strtotime($peruntukan->tarikh) ) );
        $this->db->where("a.jabatan_id", $peruntukan->jabatan_id);
        $this->db->where("a.jns_peruntukan_id", $peruntukan->jns_peruntukan_id);
        $this->db->order_by("a.tarikh");
        return $this->db->get()->result();
    }
}
