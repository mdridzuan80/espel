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
        $mail_conf = $this->mail_conf->get($id);
        $this->appnotify->test_send($mail_conf,$mail);
    }

    public function test_send_3()
    {

        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Set the hostname of the mail server
        $mail->Host = 'postmaster.1govuc.gov.my';
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 25;
        //Whether to use SMTP authentication
        $mail->SMTPAuth = FALSE;
        //Username to use for SMTP authentication
        $mail->Username = 'yourname@example.com';
        //Password to use for SMTP authentication
        $mail->Password = 'yourpassword';
        //Set who the message is to be sent from
        $mail->setFrom('pentadbirijknm.moh@1govuc.gov.my', 'ijknm');
        //Set an alternative reply-to address
        $mail->addReplyTo('pentadbirijknm.moh@1govuc.gov.my', 'ijknm');
        //Set who the message is to be sent to
        $mail->addAddress('md.ridzuan80@gmail.com', 'John Doe');
        //Set the subject line
        $mail->Subject = 'PHPMailer SMTP test';
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($this->load->view("layout/email/pengujian",'',TRUE));
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent!';
        }
    }
}