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
            try {
                $html2pdf = new Html2Pdf('L', 'A4', 'en', false, 'UTF-8', array(5, 5, 5, 5));
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->setTestTdInOnePage(false);

                ob_start();
                $content = ob_get_clean();

                $this->load->library('appcpd');
                $this->load->model("program_model","program");
                $this->load->model("kursus_model","kursus");
                $this->load->model("profil_model","profil");

                $data = [];
                $tahun = $this->input->post("txtTahun");

                foreach($this->program->get_all() as $program)
                {
                    $data['program'][$program->id]["nama"]=$program->nama;
                    $data['program'][$program->id]["hari"]=$this->kursus->getBilhari($this->appsess->getSessionData('username'), $program->id, $tahun);
                }
                $data['program']['cpd']["nama"] = "Lain-Lain (myCPD) - Jumlah mata kumulatif";
                $data['program']['cpd']["hari"] = $this->appcpd->setNokp($this->appsess->getSessionData("username"))
                    ->setHcp($this->profil->get($this->appsess->getSessionData("username"))->hcp)
                    ->setTkhTamat($tahun . "-12-31")
                    ->setTkhMula($tahun . "-01-01")
                    ->cumulativePoint();
                $data["tahun"] = $tahun;

                $html2pdf->writeHTML($this->load->view("laporan/ringkasan/pdf_ringkasan",$data,TRUE));
                $html2pdf->output('ringkasan.pdf',"D");
            } catch (Html2PdfException $e) {
                $formatter = new ExceptionFormatter($e);
                echo $formatter->getHtmlMessage();
            }
        }
    }

    public function prestasi_kursus()
    {
        if(!$this->exist("submit"))
        {
            return $this->renderView("laporan/prestasi/param");
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
                $html2pdf = new Html2Pdf('L', 'A4', 'en', false, 'UTF-8', array(5, 5, 5, 5));
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->setTestTdInOnePage(false);

                ob_start();
                $content = ob_get_clean();

                $tahun = $this->input->post("txtTahun");
                $data = [];

                $this->load->model("profil_model", "profil");
                $this->load->model("kursus_model","kursus");
                $this->load->library('appcpd');
                $this->load->model("program_model","program");


                $data["profil"] = $this->profil->with(["jawatan","jabatan"])->get($this->appsess->getSessionData("username"));
                $data["sen_latihan_dalam_negara"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),1,$tahun);
                $data["sen_latihan_luar_negara"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),2,$tahun);
                $data["sen_latihan_semuka"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),3,$tahun);
                $data["sen_latihan_tidak_semuka"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),4,$tahun);
                $data["sen_latihan_kendiri"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),5,$tahun);

                //echo $this->load->view("laporan/bukulog/bukulog",$data,TRUE);
                //die();
                $html2pdf->writeHTML($this->load->view("laporan/bukulog/bukulog",$data,TRUE));
                //$html2pdf->createIndex('Sommaire', 30, 12, false, true, 3);
                $html2pdf->output('bukulog.pdf', "D");
            } catch (Html2PdfException $e) {
                $formatter = new ExceptionFormatter($e);
                echo $formatter->getHtmlMessage();
            }
        }
    }

    public function hadir_kursus()
    {
        if(!$this->exist("submit"))
        {
            $this->load->model("kelas_model", "kelas");

            $data["sen_kelas"] = $this->kelas->dropdown("id","nama");
            $plugins["embedjs"][] = $this->load->view("laporan/js.php",NULL,TRUE);
            return $this->renderView("laporan/hadiri_kursus", $data, $plugins);
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
