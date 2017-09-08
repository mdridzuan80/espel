<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Laporan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ringkasan()
    {
        if(!$this->exist("submit"))
        {
            return $this->renderView("laporan/ringkasan/param");
        }
        else
        {
            $this->load->library('appcpd');
            $this->load->model("program_model","program");
            $this->load->model("kursus_model","kursus");
            $this->load->model("profil_model","profil");

            $data = [];
            $tahun = $this->input->post("txtTahun");

            foreach($this->program->getAll()->result_array() as $program)
            {
                $data['program'][$program["id"]]=$program;
                if($program["id"]==1)
                    $data['program'][$program["id"]]["hari"]=$this->kursus->getBilhari($this->appsess->getSessionData('username'), $program["id"], $tahun);
                if($program["id"]==3 || $program["id"]==4)
                    $data['program'][$program["id"]]["hari"]=$this->kursus->getBilhariPemb($this->appsess->getSessionData('username'), $program["id"], $tahun);
                if($program["id"]==5)
                    $data['program'][$program["id"]]["hari"]=$this->kursus->getBilhariKendiri($this->appsess->getSessionData('username'), $program["id"], $tahun);
            }
            $data['program']['cpd']["nama"] = "Lain-Lain (myCPD) - Jumlah mata kumulatif";
            $data['program']['cpd']["hari"] = $this->appcpd->setNokp($this->appsess->getSessionData("username"))
                ->setHcp($this->profil->getProfile($this->appsess->getSessionData("username"))->row()->hcp)
                ->setTkhTamat($tahun . "-12-31")
                ->setTkhMula($tahun . "-01-01")
                ->cumulativePoint();
            $data["tahun"] = $tahun;

            return $this->renderView("laporan/ringkasan/show",$data);
        }
    }

    public function jabatan()
    {
        $this->load->model("jabatan_model","jabatan");
        echo json_encode(buildTree($this->jabatan->as_array()->get_all()));
    }

    public function bukulog()
    {
        if(!$this->exist("submit"))
        {
            return $this->renderView("laporan/bukulog/param");
        }
        else
        {
            try {
                $html2pdf = new Html2Pdf('P', 'A4', 'en', false, 'UTF-8', array(5, 5, 5, 5));
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->setTestTdInOnePage(false);

                ob_start();
                $content = ob_get_clean();

                $html2pdf->writeHTML($this->load->view("laporan/bukulog/bukulog",'',TRUE));
                //$html2pdf->createIndex('Sommaire', 30, 12, false, true, 3);
                $html2pdf->output('bukulog.pdf');
            } catch (Html2PdfException $e) {
                $formatter = new ExceptionFormatter($e);
                echo $formatter->getHtmlMessage();
            }
        }
    }

    public function pdf()
    {
        try {
            $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));
            $html2pdf->pdf->SetDisplayMode('fullpage');

            ob_start();
            $content = ob_get_clean();

            $html2pdf->writeHTML($this->load->view("laporan/bukulog/pdf",["html2pdf"=>$html2pdf],TRUE));
            $html2pdf->createIndex('Sommaire', 30, 12, false, true, 2);
            $html2pdf->output('about.pdf');
        } catch (Html2PdfException $e) {
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }
}
