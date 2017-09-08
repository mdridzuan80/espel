<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Program_model extends MY_Model
{
    protected $_table = "espel_dict_program";

    protected $has_many = [
        'list_aktiviti' => [
            'model' => 'aktiviti_model',
            'primary_key'=>'program_id',
        ],
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
