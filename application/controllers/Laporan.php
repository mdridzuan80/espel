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

    // laporan senarai hadir oleh pengguna
    public function pengguna_hadir_kursus()
    {
        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses laporan Senarai Latihan yang dihadiri']);
        $plugins = ['embedjs'=>[$this->load->view('laporan/pengguna/kursus_hadir/js','',true)]];
        return $this->renderView("laporan/pengguna/kursus_hadir/param",'',$plugins);
    }

    public function ajax_papar_pengguna_hadir_kursus()
    {
        $this->load->model("kursus_model", "kursus");

        $tahun = $this->input->post('tahun');
        
        $data['tahun'] = $tahun;
        $data["sen_hadir"] = $this->kursus->get_all_kursus_hadir($this->appsess->getSessionData('username'), $tahun);

        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Papar laporan Senarai Latihan yang dihadiri']);
        return $this->load->view('laporan/pengguna/kursus_hadir/result',$data);
    }

    public function ajax_papar_pengguna_hadir_export()
    {
        $tahun = $this->input->post('tahun');
        $jenis = $this->input->post('jenis');

        $this->load->model("kursus_model", "kursus");
        $this->load->model("profil_model", "profil");

        $tahun = $this->input->post('tahun');
        
        $data['tahun'] = $tahun;
        $data['profil'] = $this->profil->get($this->appsess->getSessionData('username'));
        $data["sen_hadir"] = $this->kursus->get_all_kursus_hadir($this->appsess->getSessionData('username'), $tahun);

        switch($jenis)
        {
            case 1 :
                try {
                    $html2pdf = new Html2Pdf('L', 'A4', 'en', false, 'UTF-8', array(5, 5, 5, 5));
                    $html2pdf->pdf->SetDisplayMode('fullpage');

                    ob_start();
                    $content = ob_get_clean();

                    $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Export PDF laporan Senarai Latihan yang dihadiri']);
                    $html2pdf->writeHTML($this->load->view("laporan/pengguna/kursus_hadir/pdf",$data,TRUE));
                    $html2pdf->output('about.pdf');
                } catch (Html2PdfException $e) {
                    $formatter = new ExceptionFormatter($e);
                    echo $formatter->getHtmlMessage();
                }
            break;

            case 2 :
                $this->output->set_header('Content-type: application/vnd.ms-excel');
                $this->output->set_header('Content-Disposition: attachment; filename=senarai_hadir.xls');
                $content = $this->load->view("laporan/pengguna/kursus_hadir/pdf",$data,TRUE);
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Export Excel laporan Senarai Latihan yang dihadiri']);
                echo $content;
            break;

            case 3 :
                $this->output->set_header('Content-type: application/vnd.ms-word');
                $this->output->set_header('Content-Disposition: attachment; filename=senarai_hadir.doc');
                $content = $this->load->view("laporan/pengguna/kursus_hadir/pdf",$data,TRUE);
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Export Word laporan Senarai Latihan yang dihadiri']);
                echo $content;
            break;
        }
    }
    // end: laporan senarai hadir oleh pengguna

    public function bukulog()
    {
        if(!$this->exist("submit"))
        {
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses laporan buku log latihan']);
            $plugins = ['embedjs'=>[$this->load->view('laporan/pengguna/bukulog/js','',true)]];
            return $this->renderView("laporan/pengguna/bukulog/param",'',$plugins);
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
                $this->load->model('hrmis_skim_model', 'skim');
                $this->load->model('hrmis_carta_model', 'jabatan');   

                $data["profil"] = $this->profil->with(["jawatan","jabatan"])->get($this->appsess->getSessionData("username"));
                $data["sen_latihan_dalam_negara"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),1,$tahun);
                $data["sen_latihan_luar_negara"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),2,$tahun);
                $data["sen_latihan_semuka"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),3,$tahun);
                $data["sen_latihan_tidak_semuka"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),4,$tahun);
                $data["sen_latihan_kendiri"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),5,$tahun);

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
                $data['mskim'] = $this->skim;
                $data['mjabatan'] = $this->jabatan;

                $html2pdf->writeHTML($this->load->view("laporan/bukulog/bukulog",$data,TRUE));
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Jana laporan ringkasan']);
                $html2pdf->output('bukulog.pdf', "D");
            } catch (Html2PdfException $e) {
                $formatter = new ExceptionFormatter($e);
                echo $formatter->getHtmlMessage();
            }
        }
    }

    public function ajax_papar_bukulog()
    {
        $this->load->model("profil_model", "profil");
        $this->load->model("kursus_model","kursus");
        $this->load->model("program_model","program");
        $this->load->model('hrmis_skim_model', 'skim');
        $this->load->model('hrmis_carta_model', 'jabatan');   

        $tahun = $this->input->post("tahun");
        $data = [];

        $data["tahun"] = $tahun;
        $data['mskim'] = $this->skim;
        $data['mjabatan'] = $this->jabatan;
        $data["profil"] = $this->profil->with(["jawatan","jabatan"])->get($this->appsess->getSessionData("username"));
        $data["sen_latihan_dalam_negara"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),1,$tahun);
        $data["sen_latihan_luar_negara"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),2,$tahun);
        $data["sen_latihan_semuka"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),3,$tahun);
        $data["sen_latihan_tidak_semuka"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),4,$tahun);
        $data["sen_latihan_kendiri"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),5,$tahun);

        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Papar laporan buku log']);
        return $this->load->view('laporan/pengguna/bukulog/result',$data);
    }

    public function ajax_papar_bukulog_export()
    {
        $this->load->model("profil_model", "profil");
        $this->load->model("kursus_model","kursus");
        $this->load->model("program_model","program");
        $this->load->model('hrmis_skim_model', 'skim');
        $this->load->model('hrmis_carta_model', 'jabatan');   

        $tahun = $this->input->post('tahun');
        $jenis = $this->input->post('jenis');
        
        $data = [];

        $data["tahun"] = $tahun;
        $data['mskim'] = $this->skim;
        $data['mjabatan'] = $this->jabatan;
        $data["profil"] = $this->profil->with(["jawatan","jabatan"])->get($this->appsess->getSessionData("username"));
        $data["sen_latihan_dalam_negara"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),1,$tahun);
        $data["sen_latihan_luar_negara"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),2,$tahun);
        $data["sen_latihan_semuka"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),3,$tahun);
        $data["sen_latihan_tidak_semuka"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),4,$tahun);
        $data["sen_latihan_kendiri"]  = $this->kursus->get_kursus_by_program($this->appsess->getSessionData("username"),5,$tahun);

        switch($jenis)
        {
            case 1 :
                try {
                    $html2pdf = new Html2Pdf('L', 'A4', 'en', false, 'UTF-8', array(5, 5, 5, 5));
                    $html2pdf->pdf->SetDisplayMode('fullpage');
                    $html2pdf->setTestTdInOnePage(false);

                    ob_start();
                    $content = ob_get_clean();

                    $html2pdf->writeHTML($this->load->view("laporan/pengguna/bukulog/pdf",$data,TRUE));
                    
                    $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Export PDF laporan buku log']);
                    $html2pdf->output('ringkasan.pdf');
                } catch (Html2PdfException $e) {
                    $formatter = new ExceptionFormatter($e);
                    echo $formatter->getHtmlMessage();
                }
            break;

            case 2 :
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Export Excel laporan buku log']);
                $this->output->set_header('Content-type: application/vnd.ms-excel');
                $this->output->set_header('Content-Disposition: attachment; filename=senarai_hadir.xls');
                $content = $this->load->view("laporan/pengguna/bukulog/pdf",$data,TRUE);
                echo $content;
            break;

            case 3 :
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Export Word laporan buku log']);
                $this->output->set_header('Content-type: application/vnd.ms-word');
                $this->output->set_header('Content-Disposition: attachment; filename=senarai_hadir.doc');
                $content = $this->load->view("laporan/pengguna/bukulog/pdf",$data,TRUE);
                echo $content;
            break;
        }
    }

    // laporan Ringkasan Pengguna
    public function ringkasan()
    {
        $plugins = ['embedjs'=>[$this->load->view('laporan/pengguna/ringkasan/js','',true)]];
        return $this->renderView("laporan/pengguna/ringkasan/param",'',$plugins);
    }

    public function ajax_papar_ringkasan()
    {
        $this->load->library('appcpd');
        $this->load->model("program_model","program");
        $this->load->model("kursus_model","kursus");
        $this->load->model("profil_model","profil");
        $this->load->model('hrmis_carta_model', 'jabatan');

        $data = [];
        $tahun = $this->input->post("tahun");

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

        return $this->load->view('laporan/pengguna/ringkasan/result',$data);

    }

    public function ajax_papar_ringkasan_export()
    {
        $tahun = $this->input->post('tahun');
        $jenis = $this->input->post('jenis');

        $this->load->library('appcpd');
        $this->load->model("kursus_model", "kursus");
        $this->load->model("profil_model", "profil");
        $this->load->model("program_model","program");
        $this->load->model('hrmis_carta_model', 'jabatan');

        $tahun = $this->input->post('tahun');
        $data = [];        
        $data['tahun'] = $tahun;
        $data['profil'] = $this->profil->get($this->appsess->getSessionData('username'));

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

        switch($jenis)
        {
            case 1 :
                try {
                    $html2pdf = new Html2Pdf('L', 'A4', 'en', false, 'UTF-8', array(5, 5, 5, 5));
                    $html2pdf->pdf->SetDisplayMode('fullpage');
                    $html2pdf->setTestTdInOnePage(false);

                    ob_start();
                    $content = ob_get_clean();

                    $html2pdf->writeHTML($this->load->view("laporan/pengguna/ringkasan/pdf",$data,TRUE));
                    
                    $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Export PDF laporan ringkasan']);
                    $html2pdf->output('ringkasan.pdf');
                } catch (Html2PdfException $e) {
                    $formatter = new ExceptionFormatter($e);
                    echo $formatter->getHtmlMessage();
                }
            break;

            case 2 :
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Export Excel laporan ringkasan']);
                $this->output->set_header('Content-type: application/vnd.ms-excel');
                $this->output->set_header('Content-Disposition: attachment; filename=senarai_hadir.xls');
                $content = $this->load->view("laporan/pengguna/ringkasan/pdf",$data,TRUE);
                echo $content;
            break;

            case 3 :
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Export Word laporan ringkasan']);
                $this->output->set_header('Content-type: application/vnd.ms-word');
                $this->output->set_header('Content-Disposition: attachment; filename=senarai_hadir.doc');
                $content = $this->load->view("laporan/pengguna/ringkasan/pdf",$data,TRUE);
                echo $content;
            break;
        }
    }
    // end laporan Ringkasan Pengguna

    public function jabatan()
    {
        $this->load->model("jabatan_model","jabatan");
        echo json_encode(buildTree($this->jabatan->as_array()->get_all()));
    }

    public function hadir_kursus()
    {
        if(!$this->exist("papar"))
        {
            $this->load->model("kelas_model", "kelas");

            $data["sen_kelas"] = $this->kelas->dropdown("id","nama");
            $plugins["embedjs"][] = $this->load->view("laporan/js.php",NULL,TRUE);
            return $this->renderView("laporan/hadiri_kursus", $data, $plugins);
        }
        else
        {

        }
    }

    public function prestasi_kursus_individu()
    {
        if(!$this->exist("submit"))
        {
            $this->load->model('profil_model', 'profil');

            $data['sen_kumpulan'] = $this->profil->sen_kump();

            return $this->renderView("laporan/prestasi/param/param", $data, ['embedjs'=>[$this->load->view('scripts/carian_js','',true)]]);
        }
        else
        {
            try {
                $html2pdf = new Html2Pdf('L', 'A4', 'en', false, 'UTF-8', array(5, 5, 5, 5));
                $html2pdf->pdf->SetDisplayMode('fullpage');
                $html2pdf->setTestTdInOnePage(false);

                ob_start();
                $content = ob_get_clean();

                $this->load->model('mohon_kursus_model','mohon_kursus');
                $this->load->model("hrmis_carta_model","jabatan");

                $tahun = $this->input->post("txtTahun");
                
                $jab_id = $this->input->post("comJabatan");

                $flatted = flatten_array(
                    relatedJabatan($this->jabatan->as_array()->get_all(),$jab_id)
                );
                
                array_push($flatted,$jab_id);
                
                $filter = new obj([
                    'tahun' => $tahun,
                    'jabatan_id' => $flatted,
                    'kelas_id' => $this->input->post("comKelas"),
                    'skim_id' => $this->input->post("comSkim"),
                    'gred_id' => $this->input->post("comGred"),
                    'hari' => $this->input->post("comHari"),
                ]);

                $data['tahun'] = $tahun;

                $data['sen_anggota'] = $this->mohon_kursus->sen_prestasi($filter);

                $html2pdf->writeHTML($this->load->view("laporan/prestasi/senarai_individu",$data,TRUE));
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Jana laporan ringkasan']);

                $html2pdf->output('senarai_prestasi_anggota.pdf', "D");
            } catch (Html2PdfException $e) {
                $formatter = new ExceptionFormatter($e);
                echo $formatter->getHtmlMessage();
            }
        }
    }

    public function prestasi_kursus_keseluruhan()
    {
        if(!$this->exist("submit"))
        {
            return $this->renderView("laporan/prestasi/param/prestasi_keseluruhan");
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
                $data['tahun'] = $tahun;

                $this->load->model('profil_model','profil');
                $this->load->model('kursus_model','kursus');

                $data['sen_kelas'] = $this->profil->statistik_kelas();
                $data['objKursus'] = $this->kursus;
                
                $html2pdf->writeHTML($this->load->view("laporan/prestasi/prestasi_keseluruhan",$data,TRUE));
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Jana laporan ringkasan']);

                $html2pdf->output('prestasi_keseluruhan.pdf', "D");
            } catch (Html2PdfException $e) {
                $formatter = new ExceptionFormatter($e);
                echo $formatter->getHtmlMessage();
            }
        }
    }

    public function prestasi_kewangan()
    {
        if(!$this->exist("submit"))
        {
            return $this->renderView("laporan/prestasi/param/kewangan");
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
                $data['tahun'] = $tahun;

                $this->load->model('profil_model','profil');
                $this->load->model('kursus_model','kursus');

                $data['sen_kelas'] = $this->profil->statistik_kelas();
                $data['objKursus'] = $this->kursus;

                $html2pdf->writeHTML($this->load->view("laporan/prestasi/prestasi_kewangan",$data,TRUE));
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Jana laporan ringkasan']);
                
                //dd($this->load->view("laporan/prestasi/prestasi_kewangan",$data,TRUE));

                $html2pdf->output('prestasi_kewangan.pdf', "D");
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
