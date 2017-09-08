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
}
