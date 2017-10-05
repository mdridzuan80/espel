<?php
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

    public function import_hrmis()
    {
        $this->load->model('profil_2_model', 'profil');
        $this->load->model('hrmis_profil_model', 'hrmis_profil');
        $this->load->model('hrmis_carta_model', 'hrmis_carta');

        $sen_hrmis = $this->hrmis_profil->get_all();

        $x=1;
        foreach($sen_hrmis as $hrmis)
        {
            $x++;
            $data['nama'] = trim($hrmis->nama);
            $data['nokp'] = trim($hrmis->nokp);
            $data['password'] = pass_encode($hrmis->nokp);
            $data['gred_id'] = trim($hrmis->gred);
            $data['skim_id'] = trim($hrmis->skim_id);
            $data['kelas_id'] = trim($hrmis->kelas_id);
            $data['jabatan_id'] = $this->hrmis_carta->get_by('title', (explode(',',$hrmis->unit))[0])->buid;
            $data['nokp_ppp'] = trim($hrmis->nokp_ppp);
            $data['email_ppp'] = trim($hrmis->email_ppp);
            $data['nokp_ppk'] = trim($hrmis->nokp_ppk);
            $data['email_ppk'] = trim($hrmis->email_ppk);

            try{
                $this->profil->insert($data);
                echo $data['nokp'] . " done " . $x . "\n";
            }
            catch(Exception $e) {
                $myfile = fopen("log.txt", "a");
                $msg = 'Message: ' . $e->getMessage() . "\n";
                fwrite($myfile, $msg);
                echo $data['nokp'] . " error exception " . $x . " \n";
            }
        }
    }
}