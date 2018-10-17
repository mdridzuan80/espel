<?php
namespace Module;

abstract class Module
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }
}