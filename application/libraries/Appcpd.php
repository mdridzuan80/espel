<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("mycpd/myCPD.php");

use LSS\XML2Array;

class AppCPD extends MyCPD
{
    private $params;
    public function __construct()
    {
        parent::__construct();
        $this->params['DateStart'] = date('Y') . "-01-01";
        $this->params['DateEnd'] = date('Y') . "-12-31";
    }

    public function setNoKp($nokp)
    {
        $this->params['IdentityNo'] = $nokp;
        return $this;
    }

    public function setHcp($hcp)
    {
        $this->params['Hcp'] = $hcp;
        return $this;
    }

    public function setTkhMula($tkh)
    {
        $this->params['DateStart'] = $tkh;
        return $this;
    }

    public function setTkhTamat($tkh)
    {
        $this->params['DateEnd'] = $tkh;
        return $this;
    }

    public function userInfo()
    {
        return $this->getUserInfo($this->params);
    }

    public function pointByCategory()
    {
            return $this->getPointByCategory($this->params);
    }

    public function cumulativePoint()
    {
        return $this->getCumulativePoint($this->params)->CumulativePointResult;
    }

    public function actualPoint()
    {
        return $this->getActualPoint($this->params);
    }

    public function hcpList()
    {
        return $this->getHcpList();
    }
}
