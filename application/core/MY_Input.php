<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Input extends CI_Input
{
    public function post($index = NULL, $xss_clean = NULL)
	{
		return $this->_fetch_from_array($_POST, $index, $xss_clean);
	}

    public function inputToDate($index = NULL, $xss_clean = NULL)
    {
        return date('Y-m-d H:i',strtotime($this->_fetch_from_array($_POST, $index, $xss_clean)));
    }
}
