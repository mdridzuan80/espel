<?php
namespace Espel\Tmycpd;

use Espel\AppMycurl;
use Espel\BaseLibrary;
use PHPHtmlParser\Dom;

class Tmycpd extends BaseLibrary
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(AppMycurl $appMyCurl)
    {
        $data = [];

        $dom = new Dom;
        $html = $appMyCurl->requestGet();

        $dom->load($html['message']);
        $formInput = $dom->find("#contact input[type='hidden']");

        foreach ($formInput as $input)
        {
            if('__EVENTTARGET' == $input->getAttribute('name'))
            {
                $data[$input->getAttribute('name')] = 'btnSignin';
            }
            else
            {
                $data[$input->getAttribute('name')] = $input->getAttribute('value');
            }
        }

        $data['txtUsername'] = $this->CI->config->item('espel_mycpd_username');
        $data['txtPassword'] = $this->CI->config->item('espel_mycpd_password');

        $appMyCurl->setUrl($this->CI->config->item('espel_mycpd_url') . 'default.aspx');
        $appMyCurl->setData($data);

        $resultLog = $appMyCurl->requestPost();
        echo $resultLog();

        exit();
    }
}