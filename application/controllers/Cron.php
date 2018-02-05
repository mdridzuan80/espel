<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Cron extends CI_Controller
{
    public function createTree()
    {
        $this->load->model('hrmis_carta_model', 'jabatan');

        $data = $this->jabatan->get_all();
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($this->build_tree($data,6650,0,2)));
    }

    function build_tree($arrs, $parent_id=0, $level=0, $until=FALSE) {
        $a = [];
        foreach ($arrs as $arr) {
            if ($arr->parent_buid == $parent_id) {
                $b['text'] = $arr->title;
                
                if($until !== FALSE)
                {
                    if($level < $until)
                    {
                        $c = $this->build_tree($arrs, $arr->buid, $level+1,$until);
                        if($c)
                            $b['children'] = $c;
                    }
                }
                else
                {
                    $c = $this->build_tree($arrs, $arr->buid, $level+1,$until);
                    if($c)
                        $b['children'] = $c;
                }

                $a[]=$b;
            }
        }
        return $a;
    }

    public function parent_jabatan()
    {
        $this->load->model('hrmis_carta_model','jabatan');
        
        $elements = $this->jabatan->senarai_penyelaras();
        
        return get_parent_penyelaras($elements, 10531);
    }

    public function parent_jabatan_peruntukan()
    {
        $this->load->model('peruntukan_model','peruntukan');

        $elements = $this->peruntukan->get_peruntukan_related();

        $peruntukan = get_peruntukan_parent($elements, 10531, date('Y'));
        
        print_r($peruntukan);
    }

    public function update_inc_jabatan()
    {
        $this->load->model('kumpulan_profil_model', 'kumpulan_profil');
        $this->load->model('hrmis_carta_model', 'hrmis_carta');
        
        $all_jabatan = $this->hrmis_carta->as_array()->get_all();   
        $sen_penyelaras = $this->kumpulan_profil->get_many_by(['kumpulan_id'=>3]);

        foreach($sen_penyelaras as $penyelaras)
        {
            $selected = flattenArray(relatedJabatan($all_jabatan,$penyelaras->jabatan_id));
            
            array_push($selected,$penyelaras->jabatan_id);
            $this->kumpulan_profil->update($penyelaras->id,['inc_jab'=>serialize($selected)]);
        }
    }

    public function huhu()
    {
        $this->load->model('hrmis_carta_model','hrmis_carta');
        $all = $this->hrmis_carta->as_array()->get_all();

        print_r(flattenarray(relatedJabatan($all,6792)));
    }

    public function import_hrmis()
    {
        $this->load->model('profil_2_model', 'profil');
        $this->load->model('hrmis_profil_model', 'hrmis_profil');

        $sen_hrmis = $this->hrmis_profil->get_all();

        $x=0;
        foreach($sen_hrmis as $hrmis)
        {
            $x++;

            $data['nama'] = trim($hrmis->nama);
            $data['nokp'] = trim($hrmis->nokp);
            $data['password'] = pass_encode($hrmis->nokp);
            $data['gred_id'] = trim($hrmis->gred_id);
            preg_match_all('!\d+!', $data['gred_id'], $matches);
            $data['gred'] = $matches[0][0];
            $data['skim_id'] = trim($hrmis->skim_id);
            $data['kelas_id'] = trim($hrmis->kelas_id);
            $data['jabatan_id'] = trim($hrmis->jabatan_id);            
            //$data['jabatan_desc'] = trim($hrmis->jabatan_desc);
            $data['email'] = trim($hrmis->email);
            $data['nokp_ppp'] = trim($hrmis->nokp_ppp);
            $data['email_ppp'] = trim($hrmis->email_ppp);
            $data['nokp_ppk'] = trim($hrmis->nokp_ppk);
            $data['email_ppk'] = trim($hrmis->email_ppk);

            try{
                $this->profil->insert($data);
                echo $data['nokp'] . " done " . $x . "\n";
            }
            catch(CiError $e) {
                $myfile = fopen("log.txt", "a");
                $msg = 'Message: ' . $e->getMessage() . "\n";
                fwrite($myfile, $msg);
            }
        }
    }

    public function test_send()
    {
        $this->load->library('appnotify');

        $mail = [
            "to" => 'md.ridzuan80@gmail.com',
            "subject" => "[eSPeL][Ujian] Ujian Penghantaran",
            "body" => $this->load->view("layout/email/pengujian",'',TRUE),
        ];

        $this->appnotify->send($mail);
    }

    public function test_send_2($id)
    {
        $this->load->model("mailconf_model","mail_conf");
        $this->load->library('appnotify');

        $mail = [
            "to" => 'md.ridzuan80@gmail.com',
            "subject" => "[eSPeL][Ujian] Ujian Penghantaran",
            "body" => $this->load->view("layout/email/pengujian",'',TRUE),
        ];
        //$mail_conf = $this->mail_conf->get($id);
        $this->appnotify->send($mail);
    }

    public function get_sub()
    {
        dd(jabatan_not_in('820921045240'));
    }

    public function clear_jab()
    {
        $this->load->model('hrmis_carta_model','hrmis_carta');

        for($i=0; $i<=20; $i++)
        {
            $all = $this->hrmis_carta->senarai_carta();
            buildTreeJab($all);
        }

    }

}