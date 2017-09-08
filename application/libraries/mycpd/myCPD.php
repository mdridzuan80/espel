<?php
#
# MyCPD 2.0 PHP Integration Class
# RAJA MOHAMMAD HAFIZ
# V1.0
#
# 4 FUNCTIONS AVAILABLE ACCORDING TO WSDL
# 1. getUserInfo ($params)
# 2. getPointByCategory ($params)
# 3. getCumulativePoint ($params)
# 4. getHcpList()
#
# $params = [DateStart,DateEnd,Hcp,IdentityNo] - default to empty value
#

class MyCPD {
    private $wsdl = 'http://www.mycpd2.moh.gov.my/ws/Service1.svc?singleWsdl';
    private $client;

    public function __construct(){
        $this->client = new SoapClient($this->wsdl);
    }

    public function debug(){
        echo "<br>FUNCTIONS : <br>";
        var_dump($this->client->__getFunctions());
        echo "<br>TYPES : <br>";
        var_dump($this->client->__getTypes());
    }

    public function getUserInfo($params){
        try{
            $userDetails = new UserDetails();
            $userDetails->setParam($params);
            $userInfo = new UserInfo($userDetails);
            $response = $this->client->__soapCall('UserInfo',[$userInfo]);

            return $response;
        }catch(Exception $e){

        }
    }

    public function getPointByCategory($params){
        try{
            $userDetails = new UserDetails();
            $userDetails->setParam($params);
            $userInfo = new UserInfo($userDetails);
            $response = $this->client->__soapCall('PointByCategory',[$userInfo]);

            return $response;
        }catch(Exception $e){

        }
    }

    public function getCumulativePoint($params){
        try{
            $userDetails = new UserDetails();
            $userDetails->setParam($params);
            $userInfo = new UserInfo($userDetails);
            $response = $this->client->__soapCall('CumulativePoint',[$userInfo]);

            return $response;
        }catch(Exception $e){

        }
    }

    public function getActualPoint($params){
        try{
            $userDetails = new UserDetails();
            $userDetails->setParam($params);
            $userInfo = new UserInfo($userDetails);
            $response = $this->client->__soapCall('ActualPoint',[$userInfo]);

            return $response;
        }catch(Exception $e){

        }
    }

    public function getHcpList(){
        try{
            $response = $this->client->__soapCall('HcpList',[]);

            return $response;
        }catch(Exception $e){

        }
    }
}

class UserDetails{
    private $DateEnd = "";
    private $DateStart = "";
    private $Hcp = "";
    private $IdentityNo = "";

    public function setParam($params){
        $this->DateEnd = isset($params['DateEnd']) ? $params['DateEnd'] : "";
        $this->DateStart = isset($params['DateStart']) ? $params['DateStart'] : "";
        $this->Hcp = isset($params['Hcp']) ? $params['Hcp'] : "";
        $this->IdentityNo = isset($params['IdentityNo']) ? $params['IdentityNo'] : "";
    }
}

class UserInfo{
    private $userdet;

    public function __construct(UserDetails $ud){
        $this->userdet = $ud;
    }
}

class PointByCategory {
    private $userdet;

    public function __construct(UserDetails $ud){
        $this->userdet = $ud;
    }
}

class CumulativePoint {
    private $userdet;

    public function __construct(UserDetails $ud){
        $this->userdet = $ud;
    }
}

class ActualPoint  {
    private $userdet;

    public function __construct(UserDetails $ud){
        $this->userdet = $ud;
    }
}
