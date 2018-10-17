<?php
namespace Module\Abstrak;

abstract class Latihan extends Kursus
{
    public function __contruct()
    {
        parent::__construct();
    }
    
    protected function calculatedHari()
    {
        return datediff("y", date("Y-m-d", strtotime($this->tkhMula)), date("Y-m-d", strtotime($this->tkhMula))) + 1;
    }
}

