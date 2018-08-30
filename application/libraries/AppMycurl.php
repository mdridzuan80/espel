<?php
namespace Espel;

class AppMycurl extends BaseLibrary
{
    private $data = [];
    private $url = '';
    private $cookiefile = '';
    private $agent = 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)';
    private $post = '';

    public function __construct(){
        parent::__construct();
        $this->cookiefile = tempnam($this->CI->config->item('espel_mycpd_temp_folder'), "cookies");
        $this->post = curl_init();
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function close_session()
    {
        curl_close($this->post);
    }

    public function requestGet()
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_USERAGENT, $this->agent);
        curl_setopt($curl, CURLOPT_POST, 0); // set POST method  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) return ['status' => false, "message" => $err];

        return ['status' => true, "message" => $response];
    }

    public function requestPost()
    {
        $fields = '';

        foreach ($this->data as $key => $value) {
            $fields .= $key . '=' . $value . '&';
        }

        rtrim($fields, '&');

        curl_setopt($this->post, CURLOPT_URL, $this->url);
        curl_setopt($this->post, CURLOPT_USERAGENT, $this->agent);  
        curl_setopt($this->post, CURLOPT_POST, count($this->data));
        curl_setopt($this->post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($this->post, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->post, CURLOPT_FOLLOWLOCATION, 1);
        ##cookies
        curl_setopt($this->post, CURLOPT_COOKIEFILE, $this->cookiefile);
        curl_setopt($this->post, CURLOPT_COOKIEJAR, $this->cookiefile);
        curl_setopt($this->post, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->post, CURLOPT_SSL_VERIFYHOST, 0);    

        $result = curl_exec($this->post);

        return $result;
    }
}