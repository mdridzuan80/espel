<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kursus extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->isLogged();
    }

    public function index()
    {
        $this->load->model("kursus_model","kursus");
        $data["kursuss"] = $this->kursus->getAll();
        return $this->renderView("kursus/show", $data);
    }

    public function pengurusan()
    {
         return $this->renderView("kursus/pengurusan/show");
    }

    private function plugins()
    {
        return [
            "css" => [
                'assets/js/vendors/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css',
                'assets/css/calendar.css',
            ],
            "js" => [
                "assets/js/vendors/moment/moment.js",
                'assets/js/vendors/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js',
                'assets/js/kursus.js',
            ],
        ];
    }

    public function takwim()
    {
        $prefs['show_next_prev'] = TRUE;
        $prefs['start_day'] = 'monday';
        $prefs['month_type'] = 'long';
        $prefs['day_type'] = 'long';
        $prefs['template'] = '
        {table_open}<div id="calendar-wrap">{/table_open}

        {heading_row_start}<table><tr>{/heading_row_start}
        {heading_previous_cell}<td><a href="{previous_url}" class="btn btn-default pull-right btn-sm" title="Daftar kursus yang dianjurkan">&lt;&lt;</a></td>{/heading_previous_cell}
        {heading_title_cell}<td width="99%" align="center"><h1>{heading}</h1></td>{/heading_title_cell}
        {heading_next_cell}<td><a href="{next_url}" class="btn btn-default pull-right btn-sm" role="button" title="Daftar kursus yang dianjurkan">&gt;&gt;</a></td>{/heading_next_cell}
        {heading_row_end}</tr></table><div id="calendar">{/heading_row_end}

        {week_row_start}<ul class="weekdays">{/week_row_start}
        {week_day_cell}<li>{week_day}</li>{/week_day_cell}
        {week_row_end}</ul>{/week_row_end}

        {cal_row_start}<ul class="days">{/cal_row_start}
        {cal_cell_start}<li class="day">{/cal_cell_start}
        {cal_cell_start_today}<li class="day highlight">{/cal_cell_start_today}
        {cal_cell_start_other}<li class="day other-month">{/cal_cell_start_other}

        {cal_cell_content}<div class="date"><a href="{content}">{day}</a></div>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}<div id="cell-{day}" class="date">{day}</div>{/cal_cell_no_content}
        {cal_cell_no_content_today}<div id="cell-{day}" class="date">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</li>{/cal_cell_end}
        {cal_cell_end_today}</li>{/cal_cell_end_today}
        {cal_cell_end_other}</li>{/cal_cell_end_other}
        {cal_row_end}</ul>{/cal_row_end}

        {table_close}</div></div>{/table_close}
        ';

        $this->load->library('calendar', $prefs);

        $data["objCal"] = $this->calendar;
        $data["tahun"] = $this->uri->segment(3, date('Y'));
        $data["bulan"] = $this->uri->segment(4, date('m'));
        $plugins = $this->plugins();
        $plugins["embedjs"][] = $this->load->view("kursus/js",NULL,TRUE);

        return $this->renderView("kursus/takwim", $data, $plugins);
    }

    public function takwim_pengguna()
    {
        $prefs['show_next_prev'] = TRUE;
        $prefs['start_day'] = 'monday';
        $prefs['month_type'] = 'long';
        $prefs['day_type'] = 'long';
        $prefs['template'] = '

        {table_open}<div id="calendar-wrap">{/table_open}

        {heading_row_start}<table><tr>{/heading_row_start}
        {heading_previous_cell}<td><a href="{previous_url}" class="btn btn-default pull-right btn-sm" title="Daftar kursus yang dianjurkan">&lt;&lt;</a></td>{/heading_previous_cell}
        {heading_title_cell}<td width="99%" align="center"><h1>{heading}</h1></td>{/heading_title_cell}
        {heading_next_cell}<td><a href="{next_url}" class="btn btn-default pull-right btn-sm" role="button" title="Daftar kursus yang dianjurkan">&gt;&gt;</a></td>{/heading_next_cell}
        {heading_row_end}</tr></table><div id="calendar">{/heading_row_end}

        {week_row_start}<ul class="weekdays">{/week_row_start}
        {week_day_cell}<li>{week_day}</li>{/week_day_cell}
        {week_row_end}</ul>{/week_row_end}

        {cal_row_start}<ul class="days">{/cal_row_start}
        {cal_cell_start}<li class="day">{/cal_cell_start}
        {cal_cell_start_today}<li class="day highlight">{/cal_cell_start_today}
        {cal_cell_start_other}<li class="day other-month">{/cal_cell_start_other}

        {cal_cell_content}<div class="date"><a href="{content}">{day}</a></div>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}<div id="cell-{day}" class="date">{day}</div>{/cal_cell_no_content}
        {cal_cell_no_content_today}<div id="cell-{day}" class="date">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</li>{/cal_cell_end}
        {cal_cell_end_today}</li>{/cal_cell_end_today}
        {cal_cell_end_other}</li>{/cal_cell_end_other}
        {cal_row_end}</ul>{/cal_row_end}

        {table_close}</div></div>{/table_close}
        ';

        $this->load->library('calendar', $prefs);

        $data["objCal"] = $this->calendar;
        $data["tahun"] = $this->uri->segment(3, date('Y'));
        $data["bulan"] = $this->uri->segment(4, date('m'));
        $plugins = $this->plugins();
        $plugins["embedjs"][] = $this->load->view("kursus/pengguna_js",NULL,TRUE);

        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses takwim kursus (Pengguna)']);
        return $this->renderView("kursus/takwim_pengguna", $data, $plugins);
    }

    public function takwim_pengguna_2()
    {
        $prefs['show_next_prev'] = TRUE;
        $prefs['start_day'] = 'monday';
        $prefs['month_type'] = 'long';
        $prefs['day_type'] = 'long';
        $prefs['template'] = '

        {table_open}<div id="calendar-wrap">{/table_open}

        {heading_row_start}<table><tr>{/heading_row_start}
        {heading_previous_cell}<td><a href="{previous_url}" class="btn btn-default pull-right btn-sm" title="Daftar kursus yang dianjurkan">&lt;&lt;</a></td>{/heading_previous_cell}
        {heading_title_cell}<td width="99%" align="center"><h1>{heading}</h1></td>{/heading_title_cell}
        {heading_next_cell}<td><a href="{next_url}" class="btn btn-default pull-right btn-sm" role="button" title="Daftar kursus yang dianjurkan">&gt;&gt;</a></td>{/heading_next_cell}
        {heading_row_end}</tr></table><div id="calendar">{/heading_row_end}

        {week_row_start}<ul class="weekdays">{/week_row_start}
        {week_day_cell}<li>{week_day}</li>{/week_day_cell}
        {week_row_end}</ul>{/week_row_end}

        {cal_row_start}<ul class="days">{/cal_row_start}
        {cal_cell_start}<li class="day">{/cal_cell_start}
        {cal_cell_start_today}<li class="day highlight">{/cal_cell_start_today}
        {cal_cell_start_other}<li class="day other-month">{/cal_cell_start_other}

        {cal_cell_content}<div class="date"><a href="{content}">{day}</a></div>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}<div id="cell-{day}" class="date">{day}</div>{/cal_cell_no_content}
        {cal_cell_no_content_today}<div id="cell-{day}" class="date">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</li>{/cal_cell_end}
        {cal_cell_end_today}</li>{/cal_cell_end_today}
        {cal_cell_end_other}</li>{/cal_cell_end_other}
        {cal_row_end}</ul>{/cal_row_end}

        {table_close}</div></div>{/table_close}
        ';

        $this->load->library('calendar', $prefs);

        $data["objCal"] = $this->calendar;
        $data["tahun"] = $this->uri->segment(3, date('Y'));
        $data["bulan"] = $this->uri->segment(4, date('m'));
        $plugins = $this->plugins();
        $plugins["embedjs"][] = $this->load->view("kursus/pengguna_2_js",NULL,TRUE);

        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses takwim kursus (Pengguna)']);
        return $this->renderView("kursus/takwim_pengguna", $data, $plugins);
    }
    
    function takwim_pengguna_senarai()
    {
        $prefs['show_next_prev'] = TRUE;
        $prefs['template'] = '
        {heading_row_start}<table><tr>{/heading_row_start}
        {heading_previous_cell}<td><a href="{previous_url}" class="btn btn-default pull-right btn-sm" title="Daftar kursus yang dianjurkan">&lt;&lt;</a></td>{/heading_previous_cell}
        {heading_title_cell}<td width="99%" align="center"><h1>{heading}</h1></td>{/heading_title_cell}
        {heading_next_cell}<td><a href="{next_url}" class="btn btn-default pull-right btn-sm" role="button" title="Daftar kursus yang dianjurkan">&gt;&gt;</a></td>{/heading_next_cell}
        {heading_row_end}</tr></table><div style="display:none">{/heading_row_end}
        {table_close}</div>{/table_close}';

        $this->load->library('calendar', $prefs);

        $this->load->model("kumpulan_profil_model","kumpulan_profil");
        $this->load->model("kursus_model","kursus");

        $data["objCal"] = $this->calendar;
        $data["takwim"] = initObj([
            "tahun" => $this->uri->segment(3, date('Y')),
            "bulan" => $this->uri->segment(4, date('m'))
        ]);
        $data["sen_kursus"]=$this->kursus->takwim_day_pengguna_2(0,$data["takwim"]);
        
        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses senarai kursus  (Pengguna)']);
        return $this->renderView("kursus/takwim_pengguna_senarai", $data);
    }

    function takwim_senarai()
    {
        $prefs['show_next_prev'] = TRUE;
        $prefs['template'] = '
        {heading_row_start}<table><tr>{/heading_row_start}
        {heading_previous_cell}<td><a href="{previous_url}" class="btn btn-default pull-right btn-sm" title="Daftar kursus yang dianjurkan">&lt;&lt;</a></td>{/heading_previous_cell}
        {heading_title_cell}<td width="99%" align="center"><h1>{heading}</h1></td>{/heading_title_cell}
        {heading_next_cell}<td><a href="{next_url}" class="btn btn-default pull-right btn-sm" role="button" title="Daftar kursus yang dianjurkan">&gt;&gt;</a></td>{/heading_next_cell}
        {heading_row_end}</tr></table><div style="display:none">{/heading_row_end}
        {table_close}</div>{/table_close}';

        $this->load->library('calendar', $prefs);

        $this->load->model("kumpulan_profil_model","kumpulan_profil");
        $this->load->model("kursus_model","kursus");

        $data["objCal"] = $this->calendar;
        $data["takwim"] = initObj([
            "tahun" => $this->uri->segment(3, date('Y')),
            "bulan" => $this->uri->segment(4, date('m'))
        ]);
        $data["sen_kursus"]=$this->kursus->takwim($this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id, $data["takwim"]);
        return $this->renderView("kursus/takwim_senarai", $data);
    }

/*    public function delete($id)
    {
        $this->load->model("kursus_model","kursus");

        if($this->kursus->hapus($id))
        {
            $this->appsess->setFlashSession("success", true);
        }
        else
        {
            $this->appsess->setFlashSession("success", false);
        }
        redirect('kursus');
    }
*/
/*    public function edit($id)
    {
        if(!$this->exist("submit"))
        {
            $this->load->model('kursus_model','kursus');
            $this->load->model('program_model','program');
            $this->load->model('aktiviti_model','aktiviti');
            $this->load->model('jabatan_model','jabatan');

            $data['kursus'] = $this->kursus->find($id)->row();
            $data['programs'] = $this->program->getAll();
            $data['aktivitis'] = $this->aktiviti->findByProgram($data['kursus']->program_id);
            $data['jabatans'] = $this->jabatan->getAll();
            return $this->renderView("kursus/edit",$data,$this->plugins());
        }
        else
        {
            $data = [
                'tajuk'=>$this->input->post("txtTajuk"),
                'negara'=>$this->input->post("comNegara"),
                'program_id'=>$this->input->post("hddProgram"),
                'aktiviti_id'=>$this->input->post("comAktiviti"),
                'tkh_mula'=>$this->input->inputToDate("txtTkhMula"),
                'tkh_tamat'=>$this->input->inputToDate("txtTkhTamat"),
                'anjuran_jabatan_id'=>$this->input->post("comAnjuran"),
                'terbuka'=>$this->input->post("comTerbuka"),
            ];
            $this->load->model("kursus_model","kursus");
            if($this->kursus->kemaskini($data,$id))
            {
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
            redirect('kursus');
        }
    }
*/
    public function luar()
    {
            $this->load->model("kursus_model","kursus");
            $data["sen_kursus"] = $this->kursus->with(["program"])->get_many_by(
                [
                    "nokp" => $this->appsess->getSessionData('username'),
                    "year(tkh_mula)" => date("Y"),
                    "stat_jabatan" => "T",
                ]
            );
            
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses menu Daftar kursus luar']);
            return $this->renderView("kursus/luar/show", $data);
    }

    public function daftar_jabatan()
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            if(!$this->exist("submit"))
            {
                $this->load->model('program_model','program');
                $this->load->model('aktiviti_model','aktiviti');
                $this->load->model('profil_model','profil');
                $this->load->model("peruntukan_model", "peruntukan");
                $this->load->model('kumpulan_profil_model','kumpulan_profil');

                //$jabatan_id = $this->profil->get($this->appsess->getSessionData("username"))->jabatan_id;
		        $jabatan_id = $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id;
                $data['sen_program'] = $this->program->dropdown("id","nama");
                $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id",1)->dropdown("id","nama");
                $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id",3)->dropdown("id","nama");
                $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id",4)->dropdown("id","nama");
                $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id",5)->dropdown("id","nama");
                $data['sen_penyelia'] = $this->profil->where(
                    ["jabatan_id" => $jabatan_id]
                )->dropdown('nokp','nama');

                $elements = $this->peruntukan->get_peruntukan_related();
                $peruntukan = get_peruntukan_parent($elements, 10531, date('Y'));

                $data['sen_peruntukan'] = $this->peruntukan->dropdown_peruntukan2(implode(',',$peruntukan));
                return $this->renderView("kursus/jabatan/daftar",$data,$this->plugins());
            }
            else
            {
                $this->load->model('kumpulan_profil_model','kumpulan_profil');

                if($this->input->post("hddProgram")==1 || $this->input->post("hddProgram")==2)
                {
                    $data = [
                        'tajuk'=>$this->input->post("txtTajuk"),
                        'program_id'=>$this->input->post("hddProgram"),
                        'aktiviti_id'=>$this->input->post("comAktiviti"),
                        'tkh_mula'=>$this->input->inputToDate("txtTkhMula"),
                        'tkh_tamat'=>$this->input->inputToDate("txtTkhTamat"),
                        'tempat' => $this->input->post("txtTempat"),
                        'anjuran' => $this->input->post('comAnjuran'),
                        'stat_jabatan' => 'Y',
                        'penganjur_id' => $this->input->post("comPenganjur"),
                        'stat_terbuka'=>$this->input->post("comTerbuka"),
                        'peruntukan_id'=>$this->input->post("comPeruntukan"),
                        'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                        //'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                        'hari' => datediff("y", date("Y-m-d",strtotime($this->input->inputToDate("txtTkhMula"))), date("Y-m-d",strtotime($this->input->inputToDate("txtTkhTamat"))))+1,
                        'telefon' => $this->input->post("txtTelefon"),
                        'email' => $this->input->post("txtEmail"),
                    ];
                    if($this->input->post("comAnjuran")=="L")
                    {
                        $data["penganjur"] = $this->input->post("txtPenganjur");
                    }
                    if($this->input->post("comAnjuran")=="D")
                    {
                        $data["penganjur_id"] = $this->input->post("comPenganjur");
                    }

                    if($this->input->post("chkBorangA"))
                        $data["stat_soal_selidik_a"] = 'Y';
                    if($this->input->post("chkBorangB"))
                        $data["stat_soal_selidik_b"] = 'Y';
                }

                if($this->input->post("hddProgram")==3 || $this->input->post("hddProgram")==4)
                {
                    $data = [
                        'tajuk' => $this->input->post("txtTajuk"),
                        'program_id' => $this->input->post("hddProgram"),
                        'aktiviti_id' => $this->input->post("comAktiviti"),
                        'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                        'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                        'tempat' => $this->input->post("txtTempat"),
                        'anjuran' => $this->input->post('comAnjuran'),
                        'stat_jabatan' => "Y",
                        'penganjur_id' => $this->input->post("comPenganjur"),
                        'stat_terbuka'=>$this->input->post("comTerbuka"),
                        'peruntukan_id'=>$this->input->post("comPeruntukan"),
                        'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                        'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                        'telefon' => $this->input->post("txtTelefon"),
                        'email' => $this->input->post("txtEmail"),
                    ];
                    if($this->input->post("comAnjuran")=="L")
                    {
                        $data["penganjur"] = $this->input->post("txtPenganjur");
                    }
                    if($this->input->post("comAnjuran")=="D")
                    {
                        $data["penganjur_id"] = $this->input->post("comPenganjur");
                    }

                    if($this->input->post("chkBorangA"))
                        $data["stat_soal_selidik_a"] = 'Y';
                    if($this->input->post("chkBorangB"))
                        $data["stat_soal_selidik_b"] = 'Y';
                }

                if($this->input->post("hddProgram")==5)
                {
                    $data = [
                        'tajuk' => $this->input->post("txtTajuk"),
                        'program_id' => $this->input->post("hddProgram"),
                        'aktiviti_id' => $this->input->post("comAktiviti"),
                        'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                        'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                        'tempat' => $this->input->post("txtTempat"),
                        'sumber'=>$this->input->post("txtSumber"),
                        'penyelia_nokp'=>$this->input->post("comPenyelia"),
                        'anjuran' => $this->input->post('comAnjuran'),
                        'stat_jabatan' => "Y",
                        'penganjur_id' => $this->input->post("comPenganjur"),
                        'stat_terbuka'=>$this->input->post("comTerbuka"),
                        'peruntukan_id'=>$this->input->post("comPeruntukan"),
                        'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                        'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                        'telefon' => $this->input->post("txtTelefon"),
                        'email' => $this->input->post("txtEmail"),
                    ];
                    if($this->input->post("comAnjuran")=="L")
                    {
                        $data["penganjur"] = $this->input->post("txtPenganjur");
                    }
                    if($this->input->post("comAnjuran")=="D")
                    {
                        $data["penganjur_id"] = $this->input->post("comPenganjur");
                    }

                    if($this->input->post("chkBorangA"))
                        $data["stat_soal_selidik_a"] = 'Y';
                    if($this->input->post("chkBorangB"))
                        $data["stat_soal_selidik_b"] = 'Y';
                }

                $this->load->model("kursus_model","kursus");
                if($this->kursus->insert($data))
                {
                    $this->appsess->setFlashSession("success", true);
                }
                else
                {
                    $this->appsess->setFlashSession("success", false);
                }
                redirect('kursus/takwim');
            }
        }
        else
        {
            return $this->renderPermissionDeny();
        }
    }

    public function info_jabatan($id)
    {
        if($this->appsess->getSessionData("kumpulan") == appauth::PENYELARAS)
            redirect("kursus/edit_jabatan/" . $id);

        if(!$this->exist("mohon"))
        {
            $this->load->model('program_model','program');
            $this->load->model('aktiviti_model','aktiviti');
            $this->load->model('profil_model','profil');
            $this->load->model("peruntukan_model", "peruntukan");
            $this->load->model('kursus_model','kursus');
            $this->load->model('kumpulan_profil_model','kumpulan_profil');
            $this->load->model('mohon_kursus_model','mohon_kursus');

            $data['kursus'] = $this->kursus->get($id);

            $jabatan_id = $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id;
            $data['sen_program'] = $this->program->dropdown("id","nama");
            $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id",1)->dropdown("id","nama");
            $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id",3)->dropdown("id","nama");
            $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id",4)->dropdown("id","nama");
            $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id",5)->dropdown("id","nama");
            $data['sen_penyelia'] = $this->profil->where(
                ["jabatan_id" => $jabatan_id]
            )->dropdown('nokp','nama');
            $data['sen_peruntukan'] = $this->peruntukan->dropdown_peruntukan($jabatan_id,date('Y'));
            $data['has_mohon'] = $this->mohon_kursus->count_by('nokp',$this->appsess->getSessionData('username'));

            return $this->renderView("kursus/jabatan/info",$data,$this->plugins());
        }
        else
        {
            $this->load->model("mohon_kursus_model", "mohon_kursus");

            $data = [
                "kursus_id" => $id,
                "nokp" => $this->appsess->getSessionData("username"),
                "tkh" => date("Y-m-d h:i"),
                'role' => $this->appsess->getSessionData('kumpulan')
            ];

            if($this->mohon_kursus->insert($data))
            {
                $this->load->model("kursus_model", "kursus");
                $this->load->model("profil_model", "profil");
                $this->load->library("appnotify");

                $pemohon = $this->profil->get_by("nokp",$this->appsess->getSessionData("username"));
                $penyelia = $this->profil->get_by("nokp",$pemohon->nokp_ppp);
                $kursus = $this->kursus->with(["program","aktiviti","penganjur"])->get($id);

                $mail = [
                    "to" => $penyelia->email_ppp,
                    "subject" => "[espel] Permohonan Kursus",
                    "body" => $this->load->view("layout/email/permohonan_kursus",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus],TRUE),
                ];

                $this->appnotify->send($mail);

                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
            redirect('');
        }
    }

    public function info_kursus($id)
    {
        if($this->appsess->getSessionData("kumpulan") == appauth::PENYELARAS)
            redirect("kursus/edit_jabatan/" . $id);

        if(!$this->exist("mohon"))
        {
            $this->load->model('program_model','program');
            $this->load->model('aktiviti_model','aktiviti');
            $this->load->model('profil_model','profil');
            $this->load->model("peruntukan_model", "peruntukan");
            $this->load->model('kursus_model','kursus');
            $this->load->model('kumpulan_profil_model','kumpulan_profil');
            $this->load->model('mohon_kursus_model','mohon_kursus');

            $data['kursus'] = $this->kursus->get($id);

            //$jabatan_id = $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id;
            $data['sen_program'] = $this->program->dropdown("id","nama");
            $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id",1)->dropdown("id","nama");
            $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id",3)->dropdown("id","nama");
            $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id",4)->dropdown("id","nama");
            $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id",5)->dropdown("id","nama");
            /* $data['sen_penyelia'] = $this->profil->where(
                ["jabatan_id" => $jabatan_id]
            )->dropdown('nokp','nama'); */
            $data['sen_peruntukan'] = $this->peruntukan->dropdown_peruntukan($jabatan_id,date('Y'));
            $data['has_mohon'] = $this->mohon_kursus->count_by(['nokp' => $this->appsess->getSessionData('username'), 'id' => $id]);

            return $this->renderView("kursus/jabatan/info",$data,$this->plugins());
        }
        else
        {
            $this->load->model("mohon_kursus_model", "mohon_kursus");

            $data = [
                "kursus_id" => $id,
                "nokp" => $this->appsess->getSessionData("username"),
                "tkh" => date("Y-m-d h:i"),
                'role' => $this->appsess->getSessionData('kumpulan')
            ];

            if($this->mohon_kursus->insert($data))
            {
                $this->load->model("kursus_model", "kursus");
                $this->load->model("profil_model", "profil");
                $this->load->library("appnotify");

                $pemohon = $this->profil->get_by("nokp",$this->appsess->getSessionData("username"));
                $penyelia = $this->profil->get_by("nokp",$pemohon->nokp_ppp);
                $kursus = $this->kursus->with(["program","aktiviti","penganjur"])->get($id);

                $mail = [
                    "to" => $penyelia->email_ppp,
                    "subject" => "[espel] Permohonan Kursus",
                    "body" => $this->load->view("layout/email/permohonan_kursus",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus],TRUE),
                ];

                $this->appnotify->send($mail);

                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
            redirect('');
        }
    }

    public function info_kursus_pengguna($id)
    {
        if($this->appsess->getSessionData("kumpulan") == appauth::PENYELARAS)
            redirect("kursus/edit_jabatan/" . $id);

        if(!$this->exist("mohon"))
        {
            $this->load->model('kursus_model','kursus');

            $data['kursus'] = $this->kursus->info_kursus($id);
            
            return $this->renderView("kursus/pengguna/info",$data,$this->plugins());
        }
        else
        {
            $this->load->model("mohon_kursus_model", "mohon_kursus");

            $data = [
                "kursus_id" => $id,
                "nokp" => $this->appsess->getSessionData("username"),
                "tkh" => date("Y-m-d h:i"),
                'role' => $this->appsess->getSessionData('kumpulan')
            ];

            if($this->mohon_kursus->insert($data))
            {
                $this->load->model("kursus_model", "kursus");
                $this->load->model("profil_model", "profil");
                $this->load->library("appnotify");
                $this->load->model('hrmis_skim_model', 'mjawatan');
                $this->load->model('hrmis_carta_model', 'mjabatan');

                $pemohon = $this->profil->get_by("nokp",$this->appsess->getSessionData("username"));
                $penyelia = $this->profil->get_by("nokp",$pemohon->nokp_ppp);
                $kursus = $this->kursus->with(["program","aktiviti","penganjur"])->get($id);
                $mJawatan = $this->mjawatan;
                $mJabatan = $this->mjabatan;

                if($pemohon->email_ppp)
                {
                    $mail = [
                        "to" => $pemohon->email_ppp,
                        "subject" => "[eSPeL] Permohonan Kursus",
                        "body" => $this->load->view("layout/email/permohonan_kursus",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan],TRUE),
                    ];
                }

                $this->appnotify->send($mail);

                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
            redirect('');
        }
    }

    public function edit_jabatan($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            if(!$this->exist("submit"))
            {
                $this->load->model('program_model','program');
                $this->load->model('aktiviti_model','aktiviti');
                $this->load->model('profil_model','profil');
                $this->load->model("peruntukan_model", "peruntukan");
                $this->load->model('kursus_model','kursus');
                $this->load->model('kumpulan_profil_model','kumpulan_profil');

                $data['kursus'] = $this->kursus->get($id);


                //$jabatan_id = $this->profil->get($this->appsess->getSessionData("username"))->jabatan_id;
		        $jabatan_id = $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id;
                $data['sen_program'] = $this->program->dropdown("id","nama");
                $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id",1)->dropdown("id","nama");
                $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id",3)->dropdown("id","nama");
                $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id",4)->dropdown("id","nama");
                $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id",5)->dropdown("id","nama");
                $data['sen_penyelia'] = $this->profil->where(
                    ["jabatan_id" => $jabatan_id]
                )->dropdown('nokp','nama');
                $data['sen_peruntukan'] = $this->peruntukan->dropdown_peruntukan($jabatan_id,date('Y'));

                return $this->renderView("kursus/jabatan/edit",$data,$this->plugins());
            }
            else
            {
                
                $this->load->model('kumpulan_profil_model','kumpulan_profil');

                if($this->input->post("hddProgram")==1 || $this->input->post("hddProgram")==2)
                {
                    $data = [
                            'tajuk'=>$this->input->post("txtTajuk"),
                            'program_id'=>$this->input->post("hddProgram"),
                            'aktiviti_id'=>$this->input->post("comAktiviti"),
                            'tkh_mula'=>$this->input->inputToDate("txtTkhMula"),
                            'tkh_tamat'=>$this->input->inputToDate("txtTkhTamat"),
                            'tempat' => $this->input->post("txtTempat"),
                            'anjuran' => $this->input->post('comAnjuran'),
                            'stat_jabatan' => 'Y',
                            'penganjur_id' => $this->input->post("comPenganjur"),
                            'stat_terbuka'=>$this->input->post("comTerbuka"),
                            'peruntukan_id'=>$this->input->post("comPeruntukan"),
                            'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                            'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                            'telefon' => $this->input->post("txtTelefon"),
                            'email' => $this->input->post("txtEmail"),
                        ];
                        if($this->input->post("comAnjuran")=="L")
                        {
                            $data["penganjur"] = $this->input->post("txtPenganjur");
                        }
                        if($this->input->post("comAnjuran")=="D")
                        {
                            $data["penganjur_id"] = $this->input->post("comPenganjur");
                        }

                        if($this->input->post("chkBorangA"))
                            $data["stat_soal_selidik_a"] = 'Y';
                        if($this->input->post("chkBorangB"))
                            $data["stat_soal_selidik_b"] = 'Y';
                }

                if($this->input->post("hddProgram")==3 || $this->input->post("hddProgram")==4)
                {
                    $data = [
                            'tajuk' => $this->input->post("txtTajuk"),
                            'program_id' => $this->input->post("hddProgram"),
                            'aktiviti_id' => $this->input->post("comAktiviti"),
                            'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                            'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                            'tempat' => $this->input->post("txtTempat"),
                            'anjuran' => $this->input->post('comAnjuran'),
                            'stat_jabatan' => "Y",
                            'penganjur_id' => $this->input->post("comPenganjur"),
                            'stat_terbuka'=>$this->input->post("comTerbuka"),
                            'peruntukan_id'=>$this->input->post("comPeruntukan"),
                            'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                            'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                            'telefon' => $this->input->post("txtTelefon"),
                            'email' => $this->input->post("txtEmail"),
                        ];
                        if($this->input->post("comAnjuran")=="L")
                        {
                            $data["penganjur"] = $this->input->post("txtPenganjur");
                        }
                        if($this->input->post("comAnjuran")=="D")
                        {
                            $data["penganjur_id"] = $this->input->post("comPenganjur");
                        }

                        if($this->input->post("chkBorangA"))
                            $data["stat_soal_selidik_a"] = 'Y';
                        if($this->input->post("chkBorangB"))
                            $data["stat_soal_selidik_b"] = 'Y';
                }

                if($this->input->post("hddProgram")==5)
                {
                    $data = [
                            'tajuk' => $this->input->post("txtTajuk"),
                            'program_id' => $this->input->post("hddProgram"),
                            'aktiviti_id' => $this->input->post("comAktiviti"),
                            'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                            'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                            'tempat' => $this->input->post("txtTempat"),
                            'sumber'=>$this->input->post("txtSumber"),
                            'penyelia_nokp'=>$this->input->post("comPenyelia"),
                            'anjuran' => $this->input->post('comAnjuran'),
                            'stat_jabatan' => "Y",
                            'penganjur_id' => $this->input->post("comPenganjur"),
                            'stat_terbuka'=>$this->input->post("comTerbuka"),
                            'peruntukan_id'=>$this->input->post("comPeruntukan"),
                            'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                            'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                            'telefon' => $this->input->post("txtTelefon"),
                            'email' => $this->input->post("txtEmail"),
                        ];
                        if($this->input->post("comAnjuran")=="L")
                        {
                            $data["penganjur"] = $this->input->post("txtPenganjur");
                        }
                        if($this->input->post("comAnjuran")=="D")
                        {
                            $data["penganjur_id"] = $this->input->post("comPenganjur");
                        }

                        if($this->input->post("chkBorangA"))
                            $data["stat_soal_selidik_a"] = 'Y';
                        if($this->input->post("chkBorangB"))
                            $data["stat_soal_selidik_b"] = 'Y';
                }

                $this->load->model("kursus_model","kursus");

                if($this->kursus->update($id, $data))
                {
                    $this->appsess->setFlashSession("success", true);
                }
                else
                {
                    $this->appsess->setFlashSession("success", false);
                }

                return redirect('kursus/edit_jabatan/' . $id);
            }
        }
    }

    public function daftar_luar()
    {
        if(!$this->exist("submit"))
        {
            $this->load->model('program_model','program');
            $this->load->model('aktiviti_model','aktiviti');
            $this->load->model('profil_model','profil');
            $data['sen_program'] = $this->program->dropdown("id","nama");
            $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id",1)->dropdown("id","nama");
            $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id",3)->dropdown("id","nama");
            $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id",4)->dropdown("id","nama");
            $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id",5)->dropdown("id","nama");
            $data['sen_penyelia'] = $this->profil->where(
                [
                    "jabatan_id" => $this->profil->get($this->appsess->getSessionData("username"))->jabatan_id,
                    "nokp<>" => $this->appsess->getSessionData("username"),
                ]
            )->dropdown('nokp','nama');
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses daftar kursus']);
            return $this->renderView("kursus/luar/daftar",$data,$this->plugins());
        }
        else
        {
            if($this->input->post("hddProgram")==1 || $this->input->post("hddProgram")==2)
            {
                $data = [
                    'tajuk' => $this->input->post("txtTajuk"),
                    'program_id' => $this->input->post("hddProgram"),
                    'aktiviti_id' => $this->input->post("comAktiviti"),
                    'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                    'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                    'tempat' => $this->input->post("txtTempat"),
                    'nokp' => $this->appsess->getSessionData('username'),
                    'stat_jabatan' => "T",
                    'stat_hadir' => "M",
                    'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                    'anjuran' => $this->input->post("comAnjuran"),
                ];
                if($this->input->post("comAnjuran")=="L")
                {
                    $data["penganjur"] = $this->input->post("txtPenganjur");
                }
                if($this->input->post("comAnjuran")=="D")
                {
                    $data["penganjur_id"] = $this->input->post("comPenganjur");
                }
            }

            if($this->input->post("hddProgram")==3 || $this->input->post("hddProgram")==4)
            {
                $data = [
                    'tajuk' => $this->input->post("txtTajuk"),
                    'program_id' => $this->input->post("hddProgram"),
                    'aktiviti_id' => $this->input->post("comAktiviti"),
                    'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                    'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                    'tempat' => $this->input->post("txtTempat"),
                    'nokp' => $this->appsess->getSessionData('username'),
                    'stat_jabatan' => "T",
                    'stat_hadir' => "M",
                    'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                    'anjuran' => $this->input->post("comAnjuran"),
                ];
                if($this->input->post("comAnjuran")=="L")
                {
                    $data["penganjur"] = $this->input->post("txtPenganjur");
                }
                if($this->input->post("comAnjuran")=="D")
                {
                    $data["penganjur_id"] = $this->input->post("comPenganjur");
                }
            }

            if($this->input->post("hddProgram")==5)
            {
                $data = [
                    'tajuk' => $this->input->post("txtTajuk"),
                    'program_id' => $this->input->post("hddProgram"),
                    'aktiviti_id' => $this->input->post("comAktiviti"),
                    'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                    'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                    'tempat' => $this->input->post("txtTempat"),
                    'nokp' => $this->appsess->getSessionData('username'),
                    'stat_jabatan' => "T",
                    'stat_hadir' => "M",
                    'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                    'anjuran' => $this->input->post("comAnjuran"),
                    'sumber'=>$this->input->post("txtSumber"),
                    'penyelia_nokp'=>$this->input->post("comPenyelia"),
                    'nokp'=>$this->appsess->getSessionData('username'),
                ];
                if($this->input->post("comAnjuran")=="L")
                {
                    $data["penganjur"] = $this->input->post("txtPenganjur");
                }
                if($this->input->post("comAnjuran")=="D")
                {
                    $data["penganjur_id"] = $this->input->post("comPenganjur");
                }
            }

            $this->load->model("kursus_model","kursus");

            if (!empty($_FILES['userfile']['name']))
            {
                $config['upload_path'] = './assets/uploads/';
                $config['encrypt_name'] = TRUE;
                $config['allowed_types'] = ['pdf'];

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $dataUpload = array('upload_data' => $this->upload->data());

                    $data['dokumen_path'] = $dataUpload['upload_data']['file_name'];
                }
            }
            
            if($this->kursus->insert($data))
            {
                $sql = $this->db->last_query();
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Daftar kursus luar','sql'=>$sql]);
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }

            redirect('kursus/luar');
        }
    }

    public function edit_luar($id)
    {
        if($this->appsess->getSessionData("kumpulan")==Appauth::PENGGUNA)
        {
            $this->load->model('kursus_model','kursus');

            $data['kursus'] = $this->kursus->get($id);

            if($data['kursus']->stat_hadir=='M')
            {
                if(!$this->exist("submit"))
                {
                    $this->load->model('program_model','program');
                    $this->load->model('aktiviti_model','aktiviti');
                    $this->load->model('profil_model','profil');
                    $data['sen_program'] = $this->program->dropdown("id","nama");
                    $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id",1)->dropdown("id","nama");
                    $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id",3)->dropdown("id","nama");
                    $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id",4)->dropdown("id","nama");
                    $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id",5)->dropdown("id","nama");
                    $data['sen_penyelia'] = $this->profil->where(
                        [
                            "jabatan_id" => $this->profil->get($this->appsess->getSessionData("username"))->jabatan_id,
                            "nokp<>" => $this->appsess->getSessionData("username"),
                        ]
                    )->dropdown('nokp','nama');
                    return $this->renderView("kursus/luar/edit",$data,$this->plugins());
                }
                else
                {
                    if($this->input->post("hddProgram")==1 || $this->input->post("hddProgram")==2)
                    {
                        $data = [
                            'tajuk' => $this->input->post("txtTajuk"),
                            'program_id' => $this->input->post("hddProgram"),
                            'aktiviti_id' => $this->input->post("comAktiviti"),
                            'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                            'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                            'tempat' => $this->input->post("txtTempat"),
                            'nokp' => $this->appsess->getSessionData('username'),
                            'stat_jabatan' => "T",
                            'stat_hadir' => "M",
                            'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                            'anjuran' => $this->input->post("comAnjuran"),
                        ];
                        if($this->input->post("comAnjuran")=="L")
                        {
                            $data["penganjur_id"] = 0;
                            $data["penganjur"] = $this->input->post("txtPenganjur");
                        }
                        if($this->input->post("comAnjuran")=="D")
                        {
                            $data["penganjur"] = NULL;
                            $data["penganjur_id"] = $this->input->post("comPenganjur");
                        }
                    }

                    if($this->input->post("hddProgram")==3 || $this->input->post("hddProgram")==4)
                    {
                        $data = [
                            'tajuk' => $this->input->post("txtTajuk"),
                            'program_id' => $this->input->post("hddProgram"),
                            'aktiviti_id' => $this->input->post("comAktiviti"),
                            'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                            'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                            'tempat' => $this->input->post("txtTempat"),
                            'nokp' => $this->appsess->getSessionData('username'),
                            'stat_jabatan' => "T",
                            'stat_hadir' => "M",
                            'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                            'anjuran' => $this->input->post("comAnjuran"),
                        ];
                        if($this->input->post("comAnjuran")=="L")
                        {
                            $data["penganjur_id"] = 0;
                            $data["penganjur"] = $this->input->post("txtPenganjur");
                        }
                        if($this->input->post("comAnjuran")=="D")
                        {
                            $data["penganjur"] = NULL;
                            $data["penganjur_id"] = $this->input->post("comPenganjur");
                        }
                    }

                    if($this->input->post("hddProgram")==5)
                    {
                        $data = [
                            'tajuk' => $this->input->post("txtTajuk"),
                            'program_id' => $this->input->post("hddProgram"),
                            'aktiviti_id' => $this->input->post("comAktiviti"),
                            'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                            'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                            'tempat' => $this->input->post("txtTempat"),
                            'nokp' => $this->appsess->getSessionData('username'),
                            'stat_jabatan' => "T",
                            'stat_hadir' => "M",
                            'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                            'anjuran' => $this->input->post("comAnjuran"),
                            'sumber'=>$this->input->post("txtSumber"),
                            'penyelia_nokp'=>$this->input->post("comPenyelia"),
                            'nokp'=>$this->appsess->getSessionData('username'),
                        ];
                        if($this->input->post("comAnjuran")=="L")
                        {
                            $data["penganjur_id"] = 0;
                            $data["penganjur"] = $this->input->post("txtPenganjur");
                        }
                        if($this->input->post("comAnjuran")=="D")
                        {
                            $data["penganjur"] = NULL;
                            $data["penganjur_id"] = $this->input->post("comPenganjur");
                        }
                    }

                    if (!empty($_FILES['userfile']['name']))
                    {
                        $config['upload_path'] = './assets/uploads/';
                        $config['encrypt_name'] = TRUE;
                        $config['allowed_types'] = ['pdf'];

                        $this->load->library('upload', $config);

                        if ( ! $this->upload->do_upload('userfile'))
                        {
                                $error = array('error' => $this->upload->display_errors());
                        }
                        else
                        {
                            
                            $dataUpload = array('upload_data' => $this->upload->data());
                            $data['dokumen_path'] = $dataUpload['upload_data']['file_name'];
                        }
                    }

                    $this->load->model("kursus_model","kursus");
                    if($this->kursus->update($id, $data))
                    {
                        $sql = $this->db->last_query();
                        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Kemaskini kursus luar','sql'=>$sql]);
                        $this->appsess->setFlashSession("success", true);
                    }
                    else
                    {
                        $this->appsess->setFlashSession("success", false);
                    }
                    redirect('kursus/luar');
                }
            }
            $this->output->set_status_header(401);
        }
		else
		{
			return $this->renderPermissionDeny();
		}
    }

    public function delete_jabatan($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            $this->load->model('kursus_model','kursus');

            $kursus = $this->kursus->get($id);

            if($kursus->stat_laksana=='R')
            {
                if($this->kursus->delete($id))
                {
                    $sql = $this->db->last_query();
                    $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Hapus kursus luar','sql'=>$sql]);
                    $this->appsess->setFlashSession("success", true);
                }
                else
                {
                    $this->appsess->setFlashSession("success", false);
                }
                redirect('kursus/takwim');
            }
            $this->output->set_status_header(401);
        }
		else
		{
			return $this->renderPermissionDeny();
		}
    }

    public function delete_luar($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            $this->load->model('kursus_model','kursus');

            $kursus = $this->kursus->get($id);

            if($kursus->stat_hadir=='M')
            {
                if($this->kursus->delete($id))
                {
                    $sql = $this->db->last_query();
                    $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Hapus kursus luar','sql'=>$sql]);
                    $this->appsess->setFlashSession("success", true);
                }
                else
                {
                    $this->appsess->setFlashSession("success", false);
                }
                redirect('kursus/luar');
            }
            $this->output->set_status_header(401);
        }
		else
		{
			return $this->renderPermissionDeny();
		}
    }

    public function view_luar($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            if(!$this->exist("submit"))
            {
                $this->load->model('kursus_model','kursus');
                $this->load->model('program_model','program');
                $this->load->model('aktiviti_model','aktiviti');
                $this->load->model('profil_model','profil');

                $data['kursus'] = $this->kursus->get($id);
                $data['sen_program'] = $this->program->dropdown("id","nama");
                $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id",1)->dropdown("id","nama");
                $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id",3)->dropdown("id","nama");
                $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id",4)->dropdown("id","nama");
                $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id",5)->dropdown("id","nama");
                $data['sen_penyelia'] = $this->profil->where(
                    [
                        "jabatan_id" => $this->profil->get($this->appsess->getSessionData("username"))->jabatan_id,
                        "nokp<>" => $this->appsess->getSessionData("username"),
                    ]
                )->dropdown('nokp','nama');

                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses kursus luar']);
                return $this->renderView("kursus/pengesahan_kehadiran/view",$data,$this->plugins());
            }
        }
		else
		{
            return $this->renderPermissionDeny();
		}
    }

    public function do_sah($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            $this->load->model('kursus_model','kursus');
            $this->load->model('profil_model','profil');
            $this->load->library('appnotify');
            
            $data = [
                "stat_soal_selidik_a" => "T",
                "stat_soal_selidik_b" => "T",
                "stat_hadir" => $this->input->post("comKehadiran")
            ];

            if($this->input->post("chkBorangA"))
                $data["stat_soal_selidik_a"] = $this->input->post("chkBorangA");
            if($this->input->post("chkBorangB"))
                $data["stat_soal_selidik_b"] = $this->input->post("chkBorangB");

            $this->load->model("kursus_model","kursus");
            $this->load->model('hrmis_skim_model', 'mjawatan');
            $this->load->model('hrmis_carta_model', 'mjabatan');

            if($this->kursus->update($id, $data))
            {
                if($data['stat_hadir'] == 'L')
                {
                    $pemohon = $this->profil->get_by("nokp",$this->kursus->get($id)->nokp);
                    $penyelia = $this->profil->get_by("nokp",$pemohon->nokp_ppp);
                    $kursus = $this->kursus->with(["program","aktiviti","penganjur"])->get($id);
                    $mJawatan = $this->mjawatan;
                    $mJabatan = $this->mjabatan;

                    if($pemohon->email_ppp)
                    {
                        $mail = [
                            "to" => $pemohon->email_ppp,
                            "subject" => "[espel][Makluman] Pengesahan Kehadiran Kursus",
                            "body" => $this->load->view("layout/email/sah_hadir_kursus",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan],TRUE),
                        ];
                        
                        //jabatan profil
                        $this->load->model('hrmis_carta_model','jabatan');
                        $this->load->model('kumpulan_profil_model','kumpulan_profil');
        
                        $elements = $this->jabatan->senarai_penyelaras();
                        $jabatan_penyelaras = get_parent_penyelaras($elements, $pemohon->jabatan_id);

                        $sen_penyelaras = $this->kumpulan_profil->get_by('jabatan_id', $jabatan_penyelaras);

                        $kursus = $this->kursus->get($row);
                        $mesej = $this->load->view('layout/email/makluman_penyelaras_sah_hadir_kursus',["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan],TRUE);

                        foreach($sen_penyelaras as $penyelaras)
                        {
                            if($this->profil->get($penyelaras->nokp)->email)
                            {
                                $this->load->library('appnotify');

                                $mail = [
                                    "to" => $penyelaras->email ,
                                    "subject" => "[eSPeL][Makluman] Pengesahan hadir berkursus",
                                    "body" => $mesej,
                                ];
                                $this->appnotify->send($mail);
                            }
                        }
                    }
                    else
                    {
                        $this->appsess->setFlashSession("success", false);
                        return redirect('kursus/view_luar/' . $id);
                    }
                }

                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Mengesahkan kursus luar','sql'=>$sql]);
                $this->appsess->setFlashSession("success", true);
                return redirect('kursus/view_luar/' . $id);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
                return redirect('kursus/view_luar/' . $id);
            }
        }
		else
		{
			return $this->renderPermissionDeny();
		}
    }

    public function do_sah_kemaskini($id)
    {
        if($this->input->post("hddProgram")==1 || $this->input->post("hddProgram")==2)
        {
            $data = [
                'tajuk' => $this->input->post("txtTajuk"),
                'program_id' => $this->input->post("hddProgram"),
                'aktiviti_id' => $this->input->post("comAktiviti"),
                'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                'tempat' => $this->input->post("txtTempat"),
                'nokp' => $this->appsess->getSessionData('username'),
                'stat_jabatan' => "T",
                'stat_hadir' => "M",
                'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                'anjuran' => $this->input->post("comAnjuran"),
            ];
            if($this->input->post("comAnjuran")=="L")
            {
                $data["penganjur_id"] = 0;
                $data["penganjur"] = $this->input->post("txtPenganjur");
            }
            if($this->input->post("comAnjuran")=="D")
            {
                $data["penganjur"] = NULL;
                $data["penganjur_id"] = $this->input->post("comPenganjur");
            }
        }

        if($this->input->post("hddProgram")==3 || $this->input->post("hddProgram")==4)
        {
            $data = [
                'tajuk' => $this->input->post("txtTajuk"),
                'program_id' => $this->input->post("hddProgram"),
                'aktiviti_id' => $this->input->post("comAktiviti"),
                'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                'tempat' => $this->input->post("txtTempat"),
                'nokp' => $this->appsess->getSessionData('username'),
                'stat_jabatan' => "T",
                'stat_hadir' => "M",
                'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                'anjuran' => $this->input->post("comAnjuran"),
            ];
            if($this->input->post("comAnjuran")=="L")
            {
                $data["penganjur_id"] = 0;
                $data["penganjur"] = $this->input->post("txtPenganjur");
            }
            if($this->input->post("comAnjuran")=="D")
            {
                $data["penganjur"] = NULL;
                $data["penganjur_id"] = $this->input->post("comPenganjur");
            }
        }

        if($this->input->post("hddProgram")==5)
        {
            $data = [
                'tajuk' => $this->input->post("txtTajuk"),
                'program_id' => $this->input->post("hddProgram"),
                'aktiviti_id' => $this->input->post("comAktiviti"),
                'tkh_mula' => $this->input->inputToDate("txtTkhMula"),
                'tkh_tamat' => $this->input->inputToDate("txtTkhTamat"),
                'tempat' => $this->input->post("txtTempat"),
                'nokp' => $this->appsess->getSessionData('username'),
                'stat_jabatan' => "T",
                'stat_hadir' => "M",
                'hari' => kiraanHari($this->input->inputToDate("txtTkhMula"),$this->input->inputToDate("txtTkhTamat")),
                'anjuran' => $this->input->post("comAnjuran"),
                'sumber'=>$this->input->post("txtSumber"),
                'penyelia_nokp'=>$this->input->post("comPenyelia"),
                'nokp'=>$this->appsess->getSessionData('username'),
            ];
            if($this->input->post("comAnjuran")=="L")
            {
                $data["penganjur_id"] = 0;
                $data["penganjur"] = $this->input->post("txtPenganjur");
            }
            if($this->input->post("comAnjuran")=="D")
            {
                $data["penganjur"] = NULL;
                $data["penganjur_id"] = $this->input->post("comPenganjur");
            }
        }

        if (!empty($_FILES['userfile']['name']))
        {
            $config['upload_path'] = './assets/uploads/';
            $config['encrypt_name'] = TRUE;
            $config['allowed_types'] = ['pdf'];

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                
                $dataUpload = array('upload_data' => $this->upload->data());
                $data['dokumen_path'] = $dataUpload['upload_data']['file_name'];
            }
        }

        $this->load->model("kursus_model","kursus");
        if($this->kursus->update($id, $data))
        {
            $sql = $this->db->last_query();
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Mengemaskini daftar kursus (Penyelaras Kursus)','sql'=>$sql]);
            $this->appsess->setFlashSession("success", true);
        }
        else
        {
            $this->appsess->setFlashSession("success", false);
        }
        return redirect('kursus/view_luar/' . $id);
    }

    public function pengesahan_kehadiran()
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            $this->load->model("kursus_model","kursus");

            if( ! $this->exist("submit") )
            {
                $data["sen_kursus"] = $this->kursus->get_all_kursus_luar_pengesahan(
                    get_penyelaras_related_jabatan($this->appsess->getSessionData("username"))
                );
                
                $data['sen_anjuran'] = '';
                return $this->renderView("kursus/pengesahan_kehadiran/show", $data, $this->plugins());
            }
            else
            {
                foreach($this->input->post('chkKehadiran') as $kehadiran)
                {
                    $data[] = $kehadiran;
                }
                
                foreach($data as $row)
                {
                    if($this->kursus->update($row,['stat_hadir'=>$this->input->post('hadir')]))
                    {
                        //$this->output->set_status_header(401);
                        //dd($this->db->last_query());
                        //jabatan profil
                        $this->load->model('profil_model','profil');
                        $this->load->model('hrmis_carta_model','jabatan');
                        $this->load->model('kumpulan_profil_model','kumpulan_profil');
                        $this->load->model('hrmis_skim_model', 'mjawatan');
                        $this->load->model('hrmis_carta_model', 'mjabatan');
                        
                        $elements = $this->jabatan->senarai_penyelaras();
                        $jabatan = $this->profil->get($this->kursus->get($row)->nokp)->jabatan_id;
                        $jabatan_penyelaras = get_parent_penyelaras($elements, $jabatan);

                        $sen_penyelaras = $this->kumpulan_profil->get_by('jabatan_id', $jabatan_penyelaras);

                        $mJawatan = $this->mjawatan;
                        $mJabatan = $this->mjabatan;

                        $kursus = $this->kursus->get($row);
                        $pemohon = $this->profil->get_by('nokp',$kursus->nokp);
                        $mesej = $this->load->view('layout/email/makluman_penyelaras_sah_hadir_kursus',["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan],TRUE);

                        foreach($sen_penyelaras as $penyelaras)
                        {
                            if($this->profil->get($penyelaras->nokp)->email)
                            {
                                $this->load->library('appnotify');

                                $mail = [
                                    "to" => $pemohon->email ,
                                    "subject" => "[eSPeL][Makluman] Pengesahan hadir berkursus",
                                    "body" => $mesej,
                                ];
                                $this->appnotify->send($mail);
                            }

                        }

                        $this->appsess->setFlashSession("success", true);
                    }
                    else
                    {
                        $this->appsess->setFlashSession("success", false);
                    }
                }
            }
        }
		else
		{
			return $this->renderPermissionDeny();
		}
    }

    public function permohonan_kursus()
    {
        return $this->renderView("permohonan/show",'',$this->plugins());
    }

    public function pencalonan($kursus_id)
    {
        $this->load->model('profil_model','profil');
        $this->load->model('kursus_model','kursus');
        $this->load->model('kelas_model','kelas');
        $this->load->model('hrmis_carta_model','jabatan');
        $this->load->model('kumpulan_profil_model','kumpulan_profil');
        
        $js['jabatan_id'] = $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id;
        $plugins['embedjs'][] = $this->load->view('calon/calon_js',$js,TRUE);

        $data['kursus'] = $this->kursus->with(['program'])->get($kursus_id);
        $data['sen_kelas'] = $this->kelas->dropdown('id','nama');
        $data['jabatan_id'] = $js['jabatan_id'];
        $data['objJabatan'] = $this->jabatan;


        return $this->renderView('calon/show', $data, $plugins);
    }

    public function terima_pencalonan($id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('kursus_model','kursus');
        $this->load->model('profil_model','profil');

        $permohonan = $this->mohon_kursus->get($id);
        $kursus = $this->kursus->get($permohonan->kursus_id);
        $pemohon = $this->profil->get_by('nokp',$permohonan->nokp);


        if($this->mohon_kursus->update($id,['stat_mohon'=>'L']))
        {
            if($pemohon->email)
            {
                $this->load->library('appnotify');

                $mail = [
                    "to" => $pemohon->email ,
                    "subject" => "[espel][Makluman] Terpilih untuk mengikuti kursus",
                    "body" => $this->load->view("layout/email/permohonan_kursus_berjaya_pilih",["pemohon"=>$pemohon, "kursus"=>$kursus],TRUE),
                ];
                $this->appnotify->send($mail);
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
        }

        return redirect('kursus/pencalonan/' . $permohonan->kursus_id);
    }

    public function tolak_pencalonan($id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('kursus_model','kursus');
        $this->load->model('profil_model','profil');

        $permohonan = $this->mohon_kursus->get($id);
        $kursus = $this->kursus->get($permohonan->kursus_id);
        $pemohon = $this->profil->get_by('nokp',$permohonan->nokp);


        if($this->mohon_kursus->update($id,['stat_mohon'=>'T']))
        {
            if($pemohon->email)
            {
                $this->load->library('appnotify');

                $mail = [
                    "to" => $pemohon->email,
                    "subject" => "[espel][Makluman] Permohonan kursus anda ditolak",
                    "body" => $this->load->view("layout/email/permohonan_kursus_berjaya_tolak",["pemohon"=>$pemohon, "kursus"=>$kursus],TRUE),
                ];
                $this->appnotify->send($mail);
                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                 $this->appsess->setFlashSession("success", false);
            }
        }

        return redirect('kursus/pencalonan/' . $permohonan->kursus_id);

    }

    public function hapus_pencalonan($id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');

        $permohonan = $this->mohon_kursus->get($id);

        if($this->mohon_kursus->delete($id))
        {
            $this->appsess->setFlashSession("success", true);
        }

        return redirect('kursus/pencalonan/' . $permohonan->kursus_id);

    }
    public function ajax_get_calon_terpilih($kursus_id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');

        $filter = initObj([
			'jabatan_id' => $this->input->post('jabatanID'),
            'kumpulan' => $this->input->post('kumpulan'),
            'gred' => $this->input->post('gred'),
            'hari' => $this->input->post('hari'),
        ]);

        $data['sen_calon'] = $this->mohon_kursus->get_calon($kursus_id, $filter);

        return $this->load->view('calon/senarai', $data);

    }

    public function ajax_get_pencalonan($kursus_id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');

        $filter = initObj([
			'jabatan_id' => $this->input->post('jabatanID'),
            'kumpulan' => $this->input->post('kumpulan'),
            'gred' => $this->input->post('gred'),
            'hari' => $this->input->post('hari'),
        ]);

        $data['sen_calon'] = $this->mohon_kursus->get_pencalonan($kursus_id, $filter);

        return $this->load->view('calon/senarai_calon', $data);

    }

    public function ajax_set_pencalonan($kursus_id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');
        foreach($this->input->post('chkKehadiran') as $kehadiran)
        {
            if($kehadiran)
            {
                $data['nokp'] = $kehadiran;
                $data['kursus_id'] = $kursus_id;
                $data['tkh'] = date('Y-m-d h:i');
                $data['stat_mohon'] = 'L';
                $data['role'] = $this->appsess->getSessionData('kumpulan');

                if(!$this->mohon_kursus->insert($data))
                {
                    return show_error('Data tidak berjaya disimpan');
                }

            }
        }

        return $this->output->set_status_header(200, 'Proses selesai');

    }

    public function test_send_email()
    {
        $this->load->library('appnotify');
        $this->appnotify->send(['to'=>'mdridzuan@melaka.gov.my','subject'=>'espel - notification test', 'body'=>'Anda telah berjaya menghantar email ini']);
    }

    public function ajax_senarai_permohonan()
    {
        $this->load->model('kursus_model','kursus');
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('kumpulan_profil_model','kumpulan_profil');

        $takwim = initObj([
			"tahun" => $this->input->post('tahun'),
			"bulan" => $this->input->post('bulan'),
        ]);

        $data['objMohonKursus'] = $this->mohon_kursus;
        $data['sen_permohonan'] = $this->kursus->sen_takwim_mohon($this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id, $takwim);
        return $this->load->view('permohonan/senarai',$data);
    }

    public function ajax_senarai_anjuran_sah()
    {
        $this->load->model('kursus_model','kursus');
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('kumpulan_profil_model','kumpulan_profil');

        $takwim = initObj([
			"tahun" => $this->input->post('tahun'),
			"bulan" => $this->input->post('bulan'),
        ]);

        $data['objMohonKursus'] = $this->mohon_kursus;
        $data['sen_permohonan'] = $this->kursus->sen_pengesahan_anjuaran($this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id, $takwim);
        return $this->load->view('kursus/pengesahan_kehadiran/kursus_anjuran/senarai',$data);
    }

    public function pelaksanaan($kursus_id)
    {
        $this->load->model('belanja_model','belanja');
        $this->load->model('kursus_model','kursus');
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('profil_model','profil');
        $this->load->model('hrmis_carta_model','jabatan');
        $this->load->model('hrmis_carta_model','mjabatan');
        $this->load->model('hrmis_skim_model', 'mjawatan');
        $this->load->model('program_model', 'mprogram');

        $profil_kursus = $this->kursus->with(['program'])->get($kursus_id);

        $has_belanja = $this->belanja->count_by('kursus_id',$kursus_id);

        if(!$this->exist("submit"))
        {
            $this->load->model('kursus_model','kursus');

            $data['kursus'] = $profil_kursus;
            $data['objJabatan'] = $this->jabatan;

            if($has_belanja)
            {
                $data['belanja'] = $this->belanja->get_by('kursus_id',$kursus_id);
            }
            return $this->renderView('kursus/pelaksanaan/show', $data, $this->plugins());
        }
        else
        {
            if(!$profil_kursus->peruntukan_id) // tiada bajet
            {
                $config['upload_path'] = './assets/uploads/';
                $config['encrypt_name'] = TRUE;
                $config['allowed_types'] = ['pdf'];

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $dataUpload = array('upload_data' => $this->upload->data());

                    $dokumen_path = $dataUpload['upload_data']['file_name'];

                    if( $this->kursus->update($kursus_id,['stat_laksana'=>'L', 'surat'=>$dokumen_path]))
                    {
                        // hantar email
                        $sen_peserta = $this->mohon_kursus->get_many_by(['kursus_id'=>$kursus_id]);

                        if(count($sen_peserta))
                        {
                            $this->load->library('appnotify');
                            foreach($sen_peserta as $peserta)
                            {
                                $pemohon = $this->profil->get_by("nokp",$peserta->nokp);
                                $penyelia = $this->profil->get_by("nokp",$pemohon->nokp_ppp);
                                $kursus = $this->kursus->with(["program","aktiviti"])->get($kursus_id);
                                $mjawatan = $this->mjawatan;
                                $mprogram = $this->mprogram;
                                $mjabatan = $this->mjabatan;

                                if($penyelia->email)
                                {
                                    $mail = [
                                        "to" => $penyelia->email,
                                        "subject" => "[espel][Makluman] Anggota di bawah seliaan anda terpilih untuk mengikuti kursus",
                                        "body" => $this->load->view("layout/email/permohonan_kursus_berjaya",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus,'mjawatan'=>$mjawatan,'mprogram'=>$mprogram, 'mjabatan'=>$mjabatan],TRUE),
                                    ];
                                }
                                $this->appnotify->send($mail);

                                if($pemohon->email)
                                {
                                    $mail = [
                                        "to" => $pemohon->email,
                                        "subject" => "[espel][Makluman] Anda Terpilih untuk mengikuti kursus",
                                        "body" => $this->load->view("layout/email/permohonan_pemohon_kursus_berjaya",["pemohon"=>$pemohon,"kursus"=>$kursus,'mjawatan'=>$mjawatan,'mprogram'=>$mprogram],TRUE),
                                    ];
                                }
                                $this->appnotify->send($mail);
                            }
                        }
                        $this->appsess->setFlashSession("success", true);
                    }
                    else
                    {
                        $this->appsess->setFlashSession("success", false);
                    }
                }
            }
            else // ada bajet
            {
                $kursus = $this->kursus->with(['program'])->get($kursus_id);

                if($kursus->stat_laksana == 'R')
                {
                    $data = [
                        'kursus_id' => $kursus_id,
                        'stat_byr' => $this->input->post("comStat"),
                        'no_lo' => $this->input->post('txtNoLO'),
                        'tkh_lo' => $this->input->inputToDate("txtTkhLO"),
                        'no_resit' => $this->input->post('txtNoResit'),
                        'jumlah' => $this->input->post("txtJumlah"),
                    ];

                    if($this->input->post('txtTkhResit'))
                    {
                        $data['tkh_resit'] = $this->input->inputToDate("txtTkhResit");
                    }

                    if($this->belanja->insert($data))
                    {
                        if($kursus->stat_laksana == 'R')
                        {
                            $config['upload_path'] = './assets/uploads/';
                            $config['encrypt_name'] = TRUE;
                            $config['allowed_types'] = ['pdf'];

                            $this->load->library('upload', $config);

                            if ( ! $this->upload->do_upload('userfile'))
                            {
                                    $error = array('error' => $this->upload->display_errors());
                                    dd($this->upload->display_errors());
                            }
                            else
                            {
                                $dataUpload = array('upload_data' => $this->upload->data());

                                $dokumen_path = $dataUpload['upload_data']['file_name'];

                                if( $this->kursus->update($kursus_id,['stat_laksana'=>'L', 'surat'=>$dokumen_path]))
                                {
                                    // hantar email
                                    $sen_peserta = $this->mohon_kursus->get_many_by(['kursus_id'=>$kursus_id]);

                                    if(count($sen_peserta))
                                    {
                                        $this->load->library('appnotify');
                                        foreach($sen_peserta as $peserta)
                                        {
                                            $pemohon = $this->profil->get_by("nokp",$peserta->nokp);
                                            $penyelia = $this->profil->get_by("nokp",$pemohon->nokp_ppp);
                                            $kursus = $this->kursus->with(["program","aktiviti"])->get($kursus_id);
                                            $mjawatan = $this->mjawatan;
                                            $mprogram = $this->mprogram;
                                            $mjabatan = $this->mjabatan;

                                            if($penyelia->email)
                                            {
                                                $mail = [
                                                    "to" => $penyelia->email,
                                                    "subject" => "[espel][Makluman] Anggota di bawah seliaan anda terpilih untuk mengikuti kursus",
                                                    "body" => $this->load->view("layout/email/permohonan_kursus_berjaya",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus,'mjawatan'=>$mjawatan,'mprogram'=>$mprogram,'mjabatan'=>$mjabatan],TRUE),
                                                ];
                                                $this->appnotify->send($mail);
                                            }

                                            if($pemohon->email)
                                            {
                                                $mail = [
                                                    "to" => $pemohon->email,
                                                    "subject" => "[espel][Makluman] Anda Terpilih untuk mengikuti kursus",
                                                    "body" => $this->load->view("layout/email/permohonan_pemohon_kursus_berjaya",["pemohon"=>$pemohon,"kursus"=>$kursus,'mjawatan'=>$mjawatan,'mprogram'=>$mprogram,'mjabatan'=>$mjabatan],TRUE),
                                                ];
                                                $this->appnotify->send($mail);
                                            }
                                        }
                                    }
                                    $this->appsess->setFlashSession("success", true);
                                }
                                else
                                {
                                    $this->appsess->setFlashSession("success", false);
                                }
                            }
                        }
                        $this->appsess->setFlashSession("success", true);
                    }
                    else
                    {
                        $this->appsess->setFlashSession("success", false);
                    }
                }
                else
                {
                    $belanja = $this->belanja->get_by('kursus_id',$kursus_id);
                    $data = [
                        'kursus_id' => $kursus_id,
                        'stat_byr' => $this->input->post("comStat"),
                        'no_lo' => $this->input->post('txtNoLO'),
                        'tkh_lo' => $this->input->inputToDate("txtTkhLO"),
                        'no_resit' => $this->input->post('txtNoResit'),
                        'jumlah' => $this->input->post("txtJumlah"),
                    ];

                    if($this->input->post('txtTkhResit'))
                    {
                        $data['tkh_resit'] = $this->input->inputToDate("txtTkhResit");
                    }

                    if($this->belanja->update($belanja->id,$data))
                    {
                        if (!empty($_FILES['userfile']['name']))
                        {
                            $config['upload_path'] = './assets/uploads/';
                            $config['encrypt_name'] = TRUE;
                            $config['allowed_types'] = ['pdf'];

                            $this->load->library('upload', $config);

                            if ( ! $this->upload->do_upload('userfile'))
                            {
                                    $error = array('error' => $this->upload->display_errors());
                                    dd($this->upload->display_errors());
                            }
                            else
                            {
                                $dataUpload = array('upload_data' => $this->upload->data());

                                $dokumen_path = $dataUpload['upload_data']['file_name'];

                                if( $this->kursus->update($kursus_id,['surat'=>$dokumen_path]))
                                {
                                    $this->appsess->setFlashSession("success", true);
                                }
                                else
                                {
                                    $this->appsess->setFlashSession("success", false);
                                }
                            }
                        }
                        $this->appsess->setFlashSession("success", true);
                    }
                    else
                    {
                        $this->appsess->setFlashSession("success", false);
                    }
                }
            }
        }
        return redirect('kursus/pelaksanaan/'. $kursus_id);
    }

    public function sah_calon($kursus_id)
    {
        $this->load->model('profil_model','profil');
        $this->load->model('kursus_model','kursus');
        $this->load->model('kelas_model','kelas');
        $this->load->model('hrmis_carta_model','jabatan');
        $this->load->model('mohon_kursus_model','mohon_kursus');

        $data['kursus'] = $this->kursus->with(['program'])->get($kursus_id);
        $data['sen_kelas'] = $this->kelas->dropdown('id','nama');
        $data['jabatan_id'] = $this->profil->get($this->appsess->getSessionData('username'))->jabatan_id;
        $data['objJabatan'] = $this->jabatan;
        $data['sen_calon'] = $this->mohon_kursus->get_calon($kursus_id,[]);

        return $this->renderView('calon/show_sah', $data,['embedjs'=>[$this->load->view('calon/calon_sah_js','',TRUE)]]);
    }

    public function kehadiran_peserta()
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('kursus_model','kursus');
        $this->load->model('profil_model','profil');
        $this->load->model('hrmis_carta_model','mjabatan');
        $this->load->model('hrmis_skim_model','mjawatan');
        $this->load->model('program_model','mprogram');
        $this->load->library('appnotify');

        foreach($this->input->post('chkKehadiran') as $kehadiran)
        {
            $data[] = $kehadiran;
        }

        if($this->mohon_kursus->update_many($data,['stat_hadir'=>$this->input->post('stat_hadir')]))
        {
            $mJawatan = $this->mjawatan;
            $mJabatan = $this->mjabatan;
            $mProgram = $this->mprogram;

            foreach($data as $mohon_id)
            {
                $kursus = $this->kursus->with(["program","aktiviti","penganjur"])->get($this->mohon_kursus->get($mohon_id)->kursus_id);
                $nokp_pyd = $this->mohon_kursus->get($mohon_id)->nokp;
                $pemohon = $this->profil->get_by("nokp",$nokp_pyd);
                $penyelia = $this->profil->get_by("nokp",$pemohon->nokp_ppp);

                ///
                if($pemohon->email_ppp)
                {
                    if($this->input->post('stat_hadir')=='Y')
                    {
                        $mail = [
                            "to" => $pemohon->email_ppp,
                            "subject" => "[espel][Makluman] Pengesahan Kehadiran Kursus",
                            "body" => $this->load->view("layout/email/sah_hadir_kursus",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan],TRUE),
                        ];
                    }
                    else
                    {
                        $mail = [
                            "to" => $pemohon->email_ppp,
                            "subject" => "[espel][Makluman] Pengesahan Kehadiran Kursus",
                            "body" => $this->load->view("layout/email/sah_x_hadir_kursus",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan],TRUE),
                        ];
                    }
                    $this->appnotify->send($mail);

                    //jabatan profil
                    $this->load->model('hrmis_carta_model','jabatan');
                    $this->load->model('kumpulan_profil_model','kumpulan_profil');
    
                    $elements = $this->jabatan->senarai_penyelaras();
                    $jabatan_penyelaras = get_parent_penyelaras($elements, $pemohon->jabatan_id);

                    $sen_penyelaras = $this->kumpulan_profil->get_many_by('jabatan_id', $jabatan_penyelaras);

                    if($this->input->post('stat_hadir')=='Y')
                    {
                        $mesej = $this->load->view('layout/email/makluman_penyelaras_sah_hadir_kursus',["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan,'mprogram'=>$mProgram],TRUE);
                    }
                    else
                    {
                        $mesej = $this->load->view('layout/email/makluman_penyelaras_sah_x_hadir_kursus',["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan,'mprogram'=>$mProgram],TRUE);
                    }
                   
                    foreach($sen_penyelaras as $penyelaras)
                    {
                        $email_penyelaras = $this->profil->get($penyelaras->profil_nokp)->email;
                        if($email_penyelaras)
                        {
                            $mail = [
                                "to" => $email_penyelaras ,
                                "subject" => "[eSPeL][Makluman] Pengesahan hadir berkursus",
                                "body" => $mesej,
                            ];
                            $this->appnotify->send($mail);
                        }
                    }
                }
                //

            }
            $this->appsess->setFlashSession("success", true);
        }
        else
        {
            $this->appsess->setFlashSession("success", false);
        }
    }
}
