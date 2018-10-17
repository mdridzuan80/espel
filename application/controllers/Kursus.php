<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Underscore\Types\Arrays;
use Module\Kursus\Kursus as KursusModul;
use Module\Uploader\Uploader;
     
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
        $this->set_filterMenu(TRUE);

        return $this->renderView("kursus/takwim", $data, $plugins);
    }

    public function separa_takwim()
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
        $plugins["embedjs"][] = $this->load->view("kursus/separa/js",NULL,TRUE);

        return $this->renderView("kursus/separa/takwim", $data, $plugins);
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
        $this->set_filterMenu(TRUE);
        return $this->renderView("kursus/takwim_pengguna", $data, $plugins);
    }
    
    public function takwim_pengguna_senarai()
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
        $plugins = $this->plugins();
        $plugins["embedjs"][] = $this->load->view("kursus/takwim_pengguna_js",NULL,TRUE);
        
        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses senarai kursus  (Pengguna)']);
        $this->set_filterMenu(TRUE);
        return $this->renderView("kursus/takwim_pengguna_senarai", $data, $plugins);
    }

    function separa_takwim_senarai()
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
        return $this->renderView("kursus/separa/takwim_senarai", $data, ['embedjs'=>[$this->load->view('kursus/separa/js','',TRUE)]]);
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
        $plugins = $this->plugins();
        $plugins["embedjs"][] = $this->load->view("kursus/takwim_senarai_js",NULL,TRUE);
        $this->set_filterMenu(TRUE);

        return $this->renderView("kursus/takwim_senarai", $data, $plugins);
    }

    public function separa_pengurusan($kursus_id)
    {
        $plugins["embedjs"][] = $this->load->view("kursus/separa/pengurusan/js",NULL,TRUE);
        return $this->renderView('kursus/separa/pengurusan/show','',$plugins);
    }

    public function ajax_separa_info($kursus_id)
    {
        $this->load->model('kursus_model','kursus');
        
        $data['kursus'] = $this->kursus->with(['program'])->get($kursus_id);
        $data['objJabatan'] = $this->jabatan;

        return $this->renderView('kursus/separa/pengurusan/info', $data, $plugins);
    }

    public function luar()
    {
        $plugins=$this->plugins();
        $plugins['embedjs'][] = $this->load->view('kursus/luar/js','',TRUE);
        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses menu Daftar kursus luar']);
        return $this->renderView("kursus/luar/show",'', $plugins);
    }

    public function ajax_senarai_luar()
    {
        $this->load->model("kursus_model","kursus");
        $data["sen_kursus"] = $this->kursus->with(["program"])->get_many_by(
            [
                "nokp" => $this->appsess->getSessionData('username'),
                "year(tkh_mula)" => date("Y"),
                "stat_jabatan" => "T",
            ]
        );
        return $this->load->view("kursus/luar/senarai",$data);
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
                $peruntukan = get_peruntukan_parent($elements, $this->config->item('espel_default_jabatan_id'), date('Y'));

                $data['sen_peruntukan'] = $this->peruntukan->dropdown_peruntukan2(implode(',',$peruntukan));
                $plugins = $this->plugins();

                return $this->renderView("kursus/jabatan/daftar", $data, $plugins);
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
                        'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                        'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                        'tempat' => $this->input->post("txtTempat"),
                        'anjuran' => $this->input->post('comAnjuran'),
                        'stat_jabatan' => 'Y',
                        'penganjur_id' => $this->input->post("comPenganjur"),
                        'stat_terbuka'=>$this->input->post("comTerbuka"),
                        'peruntukan_id'=>$this->input->post("comPeruntukan"),
                        'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
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
                        'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                        'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                        'tempat' => $this->input->post("txtTempat"),
                        'anjuran' => $this->input->post('comAnjuran'),
                        'stat_jabatan' => "Y",
                        'penganjur_id' => $this->input->post("comPenganjur"),
                        'stat_terbuka'=>$this->input->post("comTerbuka"),
                        'peruntukan_id'=>$this->input->post("comPeruntukan"),
                        'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                        'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
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
                        'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                        'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                        'tempat' => $this->input->post("txtTempat"),
                        'sumber'=>$this->input->post("txtSumber"),
                        'penyelia_nokp'=>$this->input->post("comPenyelia"),
                        'anjuran' => $this->input->post('comAnjuran'),
                        'stat_jabatan' => "Y",
                        'penganjur_id' => $this->input->post("comPenganjur"),
                        'stat_terbuka'=>$this->input->post("comTerbuka"),
                        'peruntukan_id'=>$this->input->post("comPeruntukan"),
                        'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                        'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
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
                if($this->exists($data) && $this->kursus->insert($data))
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

    public function rancang_daftar_jabatan()
    {
        if ($this->appauth->hasPeranan($this->appsess->getSessionData("username"), ['PTJ'])) {
            $this->load->model('program_model', 'program');
            $this->load->model('aktiviti_model', 'aktiviti');
            $this->load->model('profil_model', 'profil');
            $this->load->model("peruntukan_model", "peruntukan");
            $this->load->model('kumpulan_profil_model', 'kumpulan_profil');

            //$jabatan_id = $this->profil->get($this->appsess->getSessionData("username"))->jabatan_id;
            $jabatan_id = $this->kumpulan_profil->get_by(["profil_nokp" => $this->appsess->getSessionData("username"), "kumpulan_id" => 3])->jabatan_id;
            $data['sen_program'] = $this->program->get_all();
            $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id", 1)->dropdown("id", "nama");
            $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id", 3)->dropdown("id", "nama");
            $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id", 4)->dropdown("id", "nama");
            $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id", 5)->dropdown("id", "nama");
            $data['sen_penyelia'] = $this->profil->where(["jabatan_id" => $jabatan_id])->dropdown('nokp', 'nama');

            $elements = $this->peruntukan->get_peruntukan_related();
            $peruntukan = get_peruntukan_parent($elements, 10531, date('Y'));
            $data['sen_peruntukan'] = $this->peruntukan->dropdown_peruntukan2(implode(',', $peruntukan));
            $plugins['embedjs'][] = $this->load->view('kursus/rancang/jabatan/js', '', true);

            //dd($data['sen_program']);
            return $this->load->view("kursus/rancang/jabatan/daftar", $data);
        } else {
            return $this->renderPermissionDeny();
        }
    }

    public function separa_daftar_jabatan()
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            $this->load->model('program_model','program');
            $this->load->model('aktiviti_model','aktiviti');
            $this->load->model('profil_model','profil');
            $this->load->model("peruntukan_model", "peruntukan");
            $this->load->model('kumpulan_profil_model','kumpulan_profil');

            //$jabatan_id = $this->profil->get($this->appsess->getSessionData("username"))->jabatan_id;
            $jabatan_id = $this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id;
            $data['sen_program'] = $this->program->get_all();
            $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id",1)->dropdown("id","nama");
            $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id",3)->dropdown("id","nama");
            $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id",4)->dropdown("id","nama");
            $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id",5)->dropdown("id","nama");
            $data['sen_penyelia'] = $this->profil->where(["jabatan_id" => $jabatan_id])->dropdown('nokp','nama');

            $elements = $this->peruntukan->get_peruntukan_related();
            $peruntukan = get_peruntukan_parent($elements, 10531, date('Y'));
            $data['sen_peruntukan'] = $this->peruntukan->dropdown_peruntukan2(implode(',',$peruntukan));
            $plugins['embedjs'][] = $this->load->view('kursus/separa/jabatan/js','',TRUE);

            //dd($data['sen_program']);
            return $this->load->view("kursus/separa/jabatan/daftar",$data);
        }
        else
        {
            return $this->renderPermissionDeny();
        }
    }

    public function ajax_separa_daftar_jabatan_simpan()
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            $this->load->model('kumpulan_profil_model','kumpulan_profil');

            if($this->input->post("hddProgram")==1 || $this->input->post("hddProgram")==2)
            {
                $data = [
                    'tajuk'=>$this->input->post("txtTajuk"),
                    'program_id'=>$this->input->post("hddProgram"),
                    'aktiviti_id'=>$this->input->post("comAktiviti"),
                    'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                    'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                    'tempat' => $this->input->post("txtTempat"),
                    'anjuran' => $this->input->post('comAnjuran'),
                    'stat_jabatan' => 'Y',
                    'penganjur_id' => $this->input->post("comPenganjur"),
                    'stat_terbuka'=>$this->input->post("comTerbuka"),
                    'peruntukan_id'=>$this->input->post("comPeruntukan"),
                    'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                    'hari' => datediff("y", date("Y-m-d",strtotime($this->input->inputToDate("txtTkhMula"))), date("Y-m-d",strtotime($this->input->inputToDate("txtTkhTamat"))))+1,
                    'telefon' => $this->input->post("txtTelefon"),
                    'email' => $this->input->post("txtEmail"),
                    'jenis' => $this->input->post("jenis"),
                    'stat_laksana' => $this->input->post("laksana"),
                ];

                if($this->input->post("comAnjuran")=="L")
                {
                    $data["penganjur"] = $this->input->post("txtPenganjur");
                    $data["penganjur_id"] = NULL;
                }

                if($this->input->post("comAnjuran")=="D")
                {
                    $data["penganjur"] = NULL;
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
                    'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                    'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                    'tempat' => $this->input->post("txtTempat"),
                    'anjuran' => $this->input->post('comAnjuran'),
                    'stat_jabatan' => "Y",
                    'penganjur_id' => $this->input->post("comPenganjur"),
                    'stat_terbuka'=>$this->input->post("comTerbuka"),
                    'peruntukan_id'=>$this->input->post("comPeruntukan"),
                    'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                    'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
                    'telefon' => $this->input->post("txtTelefon"),
                    'email' => $this->input->post("txtEmail"),
                    'jenis' => $this->input->post("jenis"),
                    'stat_laksana' => $this->input->post("laksana"),
                ];

                if($this->input->post("comAnjuran")=="L")
                {
                    $data["penganjur"] = $this->input->post("txtPenganjur");
                    $data["penganjur_id"] = NULL;
                }

                if($this->input->post("comAnjuran")=="D")
                {
                    $data["penganjur"] = NULL;
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
                    'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                    'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                    'tempat' => $this->input->post("txtTempat"),
                    'sumber'=>$this->input->post("txtSumber"),
                    'penyelia_nokp'=>$this->input->post("comPenyelia"),
                    'anjuran' => $this->input->post('comAnjuran'),
                    'stat_jabatan' => "Y",
                    'penganjur_id' => $this->input->post("comPenganjur"),
                    'stat_terbuka'=>$this->input->post("comTerbuka"),
                    'peruntukan_id'=>$this->input->post("comPeruntukan"),
                    'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                    'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
                    'telefon' => $this->input->post("txtTelefon"),
                    'email' => $this->input->post("txtEmail"),
                    'jenis' => $this->input->post("jenis"),
                    'stat_laksana' => $this->input->post("laksana"),
                ];

                if($this->input->post("comAnjuran")=="R")
                {
                    $data["penganjur"] = $this->input->post("txtPenganjur");
                    $data["penganjur_id"] = NULL;
                }

                if($this->input->post("comAnjuran")=="D")
                {
                    $data["penganjur"] = NULL;
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
                $kursus_id = $this->db->insert_id();

                $sql = $this->db->last_query();
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Daftar kursus Separa siap','sql'=>$sql]);
                return $this->output->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode(['kursus_id'=>$kursus_id]));
            }
            else
            {
                return $this->output->set_status_header(400,'Pastikan semua medan diisi');
            }
        }
        else
        {
            return $this->output->set_status_header(404,'Anda tiada hak capaian');
        }
    }

    public function info_jabatan($id)
    {
        if($this->appsess->getSessionData("kumpulan") == appauth::PENYELARAS)
        {
            $this->load->model('kursus_model');

            if($this->kursus_model->get($id)->jenis == 'R')
            {
                return redirect("kursus/edit_jabatan/" . $id);
            }
            else
            {
                return redirect("kursus/edit_separa_jabatan/" . $id);
            }

        }

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

                if(filter_var($penyelia->email_ppp, FILTER_VALIDATE_EMAIL))
                {
                    $mail = [
                        "to" => $penyelia->email_ppp,
                        "subject" => "[espel] Permohonan Kursus",
                        "body" => $this->load->view("layout/email/permohonan_kursus",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus],TRUE),
                    ];

                    $this->appnotify->send($mail);
                }
                
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

                if(filter_var($penyelia->email_ppp, FILTER_VALIDATE_EMAIL))
                {
                    $mail = [
                        "to" => $penyelia->email_ppp,
                        "subject" => "[espel] Permohonan Kursus",
                        "body" => $this->load->view("layout/email/permohonan_kursus",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus],TRUE),
                    ];

                    $this->appnotify->send($mail);
                }

                $this->appsess->setFlashSession("success", true);
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
            }
            redirect('');
        }
    }

    public function info_kursus_jabatan($id)
    {
        if(!$this->exist("mohon"))
        {
            $this->load->model('kursus_model','kursus');
            $data['kursus'] = $this->kursus->info_kursus_jabatan($id);
            return $this->load->view("kursus/jabatan/info",$data);
        }
    }

    public function info_kursus_pengguna_2($id)
    {
        if(!$this->exist("mohon"))
        {
            $this->load->model('kursus_model','kursus');
            $data['kursus'] = $this->kursus->info_kursus($id);
            
            return $this->load->view("kursus/pengguna/info",$data);
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
            $plugins=$this->plugins();
            $plugins['embedjs'][] = $this->load->view('kursus/pengguna/js','',TRUE);
            
            return $this->renderView("kursus/pengguna/info",$data,$plugins);
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

                if($pemohon->email_ppp && filter_var($pemohon->email_ppp, FILTER_VALIDATE_EMAIL))
                {
                    $mail = [
                        "to" => $pemohon->email_ppp,
                        "subject" => "[eSPeL] Permohonan Kursus",
                        "body" => $this->load->view("layout/email/permohonan_kursus",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan],TRUE),
                    ];
                }

                $this->appnotify->send($mail);

                return $this->output->set_status_header(200);
            }
            else
            {
                return $this->output->set_status_header(400,'Proses permohonan gagal.');
            }
        }
    }

    public function edit_jabatan($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            if(! $this->exist("submit"))
            {
                $this->load->model('program_model','program');
                $this->load->model('aktiviti_model','aktiviti');
                $this->load->model('profil_model','profil');
                $this->load->model("peruntukan_model", "peruntukan");
                $this->load->model('kursus_model','kursus');
                $this->load->model('kumpulan_profil_model','kumpulan_profil');

                $data['kursus'] = $this->kursus->get($id);
                $data['level'] = 1;

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
                $data['vlevel']=$this->load->view('kursus/pengurusan/show',['level'=>$data['level'], 'kursus_id'=>$id],TRUE);

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
                            'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                            'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                            'tempat' => $this->input->post("txtTempat"),
                            'anjuran' => $this->input->post('comAnjuran'),
                            'stat_jabatan' => 'Y',
                            'penganjur_id' => $this->input->post("comPenganjur"),
                            'stat_terbuka'=>$this->input->post("comTerbuka"),
                            'peruntukan_id'=>$this->input->post("comPeruntukan"),
                            'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                            'hari' => datediff("y", date("Y-m-d", strtotime($this->input->inputToDate("txtTkhMula"))), date("Y-m-d", strtotime($this->input->inputToDate("txtTkhTamat")))) + 1,
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
                            'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                            'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                            'tempat' => $this->input->post("txtTempat"),
                            'anjuran' => $this->input->post('comAnjuran'),
                            'stat_jabatan' => "Y",
                            'penganjur_id' => $this->input->post("comPenganjur"),
                            'stat_terbuka'=>$this->input->post("comTerbuka"),
                            'peruntukan_id'=>$this->input->post("comPeruntukan"),
                            'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                            'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
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
                            'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                            'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                            'tempat' => $this->input->post("txtTempat"),
                            'sumber'=>$this->input->post("txtSumber"),
                            'penyelia_nokp'=>$this->input->post("comPenyelia"),
                            'anjuran' => $this->input->post('comAnjuran'),
                            'stat_jabatan' => "Y",
                            'penganjur_id' => $this->input->post("comPenganjur"),
                            'stat_terbuka'=>$this->input->post("comTerbuka"),
                            'peruntukan_id'=>$this->input->post("comPeruntukan"),
                            'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                            'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
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

    public function edit_separa_jabatan($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            $this->load->model('program_model','program');
            $this->load->model('aktiviti_model','aktiviti');
            $this->load->model('profil_model','profil');
            $this->load->model("peruntukan_model", "peruntukan");
            $this->load->model('kursus_model','kursus');
            $this->load->model('kumpulan_profil_model','kumpulan_profil');

            $data['kursus'] = $this->kursus->get($id);

            //$jabatan_id = $this->profil->get($this->appsess->getSessionData("username"))->jabatan_id;
            $data['level'] = 1;
            $data['vlevel']=$this->load->view('kursus/pengurusan/separa',['level'=>$data['level'],'kursus_id'=>$id],TRUE);
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

            $plugins = $this->plugins();
            $plugins['embedjs'][] = $this->load->view('kursus/separa/jabatan/edit_js','',TRUE);

            return $this->renderView("kursus/separa/jabatan/edit", $data, $plugins);
        }
    }

    public function ajax_edit_separa_jabatan($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            $this->load->model('kumpulan_profil_model','kumpulan_profil');

            if($this->input->post("hddProgram")==1 || $this->input->post("hddProgram")==2)
            {
                $data = [
                        'tajuk'=>$this->input->post("txtTajuk"),
                        'program_id'=>$this->input->post("hddProgram"),
                        'aktiviti_id'=>$this->input->post("comAktiviti"),
                        'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                        'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                        'tempat' => $this->input->post("txtTempat"),
                        'anjuran' => $this->input->post('comAnjuran'),
                        'stat_jabatan' => 'Y',
                        'penganjur_id' => $this->input->post("comPenganjur"),
                        'stat_terbuka'=>$this->input->post("comTerbuka"),
                        'peruntukan_id'=>$this->input->post("comPeruntukan"),
                        'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                        'hari' => datediff("y", date("Y-m-d",strtotime($this->input->inputToDate("txtTkhMula"))), date("Y-m-d",strtotime($this->input->inputToDate("txtTkhTamat"))))+1,
                        'telefon' => $this->input->post("txtTelefon"),
                        'email' => $this->input->post("txtEmail"),
                    ];

                    if($this->input->post("comAnjuran")=="L")
                    {
                        $data["penganjur"] = $this->input->post("txtPenganjur");
                        $data["penganjur_id"] = NULL;
                    }

                    if($this->input->post("comAnjuran")=="D")
                    {
                        $data["penganjur"] = NULL;
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
                        'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                        'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                        'tempat' => $this->input->post("txtTempat"),
                        'anjuran' => $this->input->post('comAnjuran'),
                        'stat_jabatan' => "Y",
                        'penganjur_id' => $this->input->post("comPenganjur"),
                        'stat_terbuka'=>$this->input->post("comTerbuka"),
                        'peruntukan_id'=>$this->input->post("comPeruntukan"),
                        'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                        'hari' => kiraanHari(date('Y-m-d H:i',strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))),date('Y-m-d H:i',strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
                        'telefon' => $this->input->post("txtTelefon"),
                        'email' => $this->input->post("txtEmail"),
                    ];

                    if($this->input->post("comAnjuran")=="L")
                    {
                        $data["penganjur"] = $this->input->post("txtPenganjur");
                        $data["penganjur_id"] = NULL;
                    }

                    if($this->input->post("comAnjuran")=="D")
                    {
                        $data["penganjur"] = NULL;
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
                        'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                        'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                        'tempat' => $this->input->post("txtTempat"),
                        'sumber'=>$this->input->post("txtSumber"),
                        'penyelia_nokp'=>$this->input->post("comPenyelia"),
                        'anjuran' => $this->input->post('comAnjuran'),
                        'stat_jabatan' => "Y",
                        'penganjur_id' => $this->input->post("comPenganjur"),
                        'stat_terbuka'=>$this->input->post("comTerbuka"),
                        'peruntukan_id'=>$this->input->post("comPeruntukan"),
                        'ptj_jabatan_id_created'=>$this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id,
                        'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
                        'telefon' => $this->input->post("txtTelefon"),
                        'email' => $this->input->post("txtEmail"),
                    ];

                    if($this->input->post("comAnjuran")=="L")
                    {
                        $data["penganjur"] = $this->input->post("txtPenganjur");
                        $data["penganjur_id"] = NULL;
                    }

                    if($this->input->post("comAnjuran")=="D")
                    {
                        $data["penganjur"] = NULL;
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
                $sql = $this->db->last_query();
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Edit Daftar kursus Separa siap','sql'=>$sql]);
                
                return $this->output->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode(['kursus_id'=>$id]));
            }
            else
            {
                return $this->output->set_status_header(400,'Pastikan semua medan diisi!');
            }
        }
        else
        {
            return $this->output->set_status_header(404,'Anda tiada hak capaian');
        }
    }

    public function ajax_delete_separa_jabatan($id)
    {
        if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            $this->load->model("kursus_model","kursus");

            if($this->kursus->delete($id))
            {
                $sql = $this->db->last_query();
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Edit Daftar kursus Separa siap','sql'=>$sql]);
                
                return $this->output->set_status_header(200);
            }
            else
            {
                return $this->output->set_status_header(400,'Operasi tidak berjaya!');
            }
        }
        else
        {
            return $this->output->set_status_header(404,'Anda tiada hak capaian');
        }

        return $this->output->set_status_header(400,'Sila berhubung dengan Sistem admin');
    }    

    public function daftar_luar()
    {
        $this->load->model('program_model','program');
        $this->load->model('aktiviti_model','aktiviti');
        $this->load->model('profil_model','profil');

        $data['sen_program'] = $this->program->dropdown("id","nama");
        $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id",1)->dropdown("id","nama");
        $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id",3)->dropdown("id","nama");
        $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id",4)->dropdown("id","nama");
        $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id",5)->dropdown("id","nama");
        $data['sen_penyelia'] = $this->profil->where(["nokp" => $this->profil->get($this->appsess->getSessionData("username"))->nokp_ppp
            ])->dropdown('nokp','nama');

        $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses daftar kursus']);

        return $this->load->view("kursus/luar/daftar",$data);
    }

    public function ajax_do_daftar_luar()
    {
        $this->load->model("kursus_model", "kursus");

        $kursus = new KursusModul;

        $kursus->tajuk = strtoupper($this->input->post("txtTajuk"));
        $kursus->nokp = $this->appsess->getSessionData('username');
        $kursus->program_id = $this->input->post("hddProgram");
        $kursus->aktiviti_id = $this->input->post("comAktiviti");
        $kursus->tkh_mula = constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula"));
        $kursus->tkh_tamat = constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"));
        $kursus->tempat = $this->input->post("txtTempat");
        $kursus->stat_jabatan = KursusModul::STATUS_KURSUS_DALAM_TIDAK;
        $kursus->stat_hadir = KursusModul::STATUS_HADIR_MOHON;
        $kursus->stat_laksana = KursusModul::STATUS_KURSUS_LAKSANA_YA;
        $kursus->anjuran = $this->input->post("comAnjuran");
        $kursus->jenis = KursusModul::JENIS_KURSUS_LUAR;

        if($this->input->post("comAnjuran")== KursusModul::JENIS_KURSUS_LUAR)
            $kursus->penganjur = $this->input->post("txtPenganjur");

        if($this->input->post("comAnjuran")=="D")
            $kursus->penganjur_id = $this->input->post("comPenganjur");

        if($this->input->post("hddProgram")==KursusModul::KENDIRI)
        {
            $kursus->sumber = $this->input->post("txtSumber");
            $kursus->penyelia_nokp = $this->input->post("comPenyelia");
        }

        if (!empty($_FILES['userfile']['name']))
        {
            $uploader = new Uploader;

            if(! $docName = $uploader->upload())
            {
                $error = array('error' => $this->upload->display_errors());
                return $this->output->set_status_header(400, 'Dokumen yang dilampirkan bermasalah');
            }

            $kursus->dokumen_path = $docName['file_name'];
            $kursus->surat = $docName['orig_name'] ;
        }

        if($kursus->bertindih())
        {
            return $this->output->set_status_header(400,'Pastikan semua medan diisi atau kursus ini tidak bertindih dengan kursus lain!');
        }

        $this->kursus->daftar($kursus);

        $sql = $this->db->last_query();
        $this->applog->write(['nokp' => $this->appsess->getSessionData('username'), 'event' => 'Daftar kursus luar', 'sql' => $sql]);

        return $this->output->set_status_header(200);

    }

    private function pengguna_exists($data)
    {
        $this->load->model("kursus_model", "kursus");
        $this->load->model("kumpulan_profil_model", "kumpulan_profil");

        $takwim = initObj([
            "tahun" => date('Y', strtotime($data['tkh_mula'])),
            "bulan" => date('m', strtotime($data['tkh_tamat']))
        ]);

        $rst = $this->kursus->takwim_day_pengguna_2(0, $takwim);
        
        if(count($rst) != 0)
            return Arrays::matchesAny($rst, function ($value) use ($data) {
                $tkhMulaR = constructDate($value['tkh_mula']);
                $tkhTamatR = constructDate($value['tkh_tamat']);
                $tkhMula = constructDate($data['tkh_mula']);
                $tkhTamat = constructDate($data['tkh_tamat']);

                return $tkhMula->between($tkhMulaR, $tkhTamatR) || $tkhTamat->between($tkhMulaR, $tkhTamatR);
            });

        return false;
    }

    public function edit_luar($id)
    {
        $this->load->model('kursus_model','kursus');

        $data['kursus'] = $this->kursus->get($id);

        $this->load->model('program_model','program');
        $this->load->model('aktiviti_model','aktiviti');
        $this->load->model('profil_model','profil');
        $data['sen_program'] = $this->program->dropdown("id","nama");
        $data['sen_xtvt_lat'] = $this->aktiviti->where("program_id",1)->dropdown("id","nama");
        $data['sen_xtvt_pemb1'] = $this->aktiviti->where("program_id",3)->dropdown("id","nama");
        $data['sen_xtvt_pemb2'] = $this->aktiviti->where("program_id",4)->dropdown("id","nama");
        $data['sen_xtvt_kendiri'] = $this->aktiviti->where("program_id",5)->dropdown("id","nama");
        $data['sen_penyelia'] = $this->profil->where(["nokp" => $this->profil->get($this->appsess->getSessionData("username"))->nokp_ppp])->dropdown('nokp','nama');
        return $this->load->view("kursus/luar/edit",$data);
    }

    public function ajax_do_edit_luar()
    {
        if($this->input->post("hddProgram")==1 || $this->input->post("hddProgram")==2)
        {
            $data = [
                'tajuk' => $this->input->post("txtTajuk"),
                'program_id' => $this->input->post("hddProgram"),
                'aktiviti_id' => $this->input->post("comAktiviti"),
                'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                'tempat' => $this->input->post("txtTempat"),
                'hari' => datediff("y", date("Y-m-d", strtotime($this->input->inputToDate("txtTkhMula"))), date("Y-m-d", strtotime($this->input->inputToDate("txtTkhTamat")))) + 1,
                'anjuran' => $this->input->post("comAnjuran"),
                'stat_hadir' => 'M',
            ];
            if($this->input->post("comAnjuran")=="L")
            {
                $data["penganjur"] = $this->input->post("txtPenganjur");
                $data["penganjur_id"] = NULL;
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
                'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                'tempat' => $this->input->post("txtTempat"),
                'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
                'anjuran' => $this->input->post("comAnjuran"),
                'stat_hadir' => 'M',
            ];
            if($this->input->post("comAnjuran")=="L")
            {
                $data["penganjur"] = $this->input->post("txtPenganjur");
                $data["penganjur_id"] = NULL;
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
                'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                'tempat' => $this->input->post("txtTempat"),
                'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
                'anjuran' => $this->input->post("comAnjuran"),
                'sumber'=>$this->input->post("txtSumber"),
                'penyelia_nokp'=>$this->input->post("comPenyelia"),
                'stat_hadir' => 'M',
            ];
            if($this->input->post("comAnjuran")=="L")
            {
                $data["penganjur"] = $this->input->post("txtPenganjur");
                $data["penganjur_id"] = NULL;
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
            $config['allowed_types'] = ['pdf', 'jpeg', 'jpg', 'jpe'];

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    return $this->output->set_status_header(400,'Dokumen yang dilampirkan bermasalah');
            }
            else
            {
                
                $dataUpload = array('upload_data' => $this->upload->data());
                $data['dokumen_path'] = $dataUpload['upload_data']['file_name'];
            }
        }

        $this->load->model("kursus_model","kursus");

        $kursus_id = $this->input->post('hddKursusId');

        if($this->kursus->update($kursus_id, $data))
        {
            $sql = $this->db->last_query();
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Kemaskini kursus luar','sql'=>$sql]);
            return $this->output->set_status_header(200);
        }
        else
        {
            return $this->output->set_status_header(400,'Pastikan semua medan diisi!');
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
        $this->load->model('kursus_model','kursus');

        $kursus = $this->kursus->get($id);

        if($this->kursus->delete($id))
        {
            $sql = $this->db->last_query();
            $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Hapus kursus luar','sql'=>$sql]);
            return $this->output->set_status_header(200);
        }
        else
        {
            return $this->output->set_status_header(400,'Operasi hapus tidak berjaya!');
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
                $data['jab_ptj'] = $this->appsess->getSessionData('ptj_jabatan_id');

                $plugins = $this->plugins();
                $plugins['embedjs'][] = $this->load->view('kursus/pengesahan_kehadiran/js', $data, true);
                
                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses kursus luar']);
                return $this->renderView("kursus/pengesahan_kehadiran/view", $data, $plugins);
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
            $this->load->model('program_model', 'mprogram');

            if($this->kursus->update($id, $data))
            {
                /* if($data['stat_hadir'] == 'L')
                {
                    $pemohon = $this->profil->get_by("nokp",$this->kursus->get($id)->nokp);
                    $penyelia = $this->profil->get_by("nokp",$pemohon->nokp_ppp);
                    $kursus = $this->kursus->with(["program","aktiviti","penganjur"])->get($id);
                    $mJawatan = $this->mjawatan;
                    $mJabatan = $this->mjabatan;
                    $mProgram = $this->mprogram;

                    if($pemohon->email_ppp)
                    {
                        $mail = [
                            "to" => $pemohon->email_ppp,
                            "subject" => "[espel][Makluman] Pengesahan Kehadiran Kursus",
                            "body" => $this->load->view("layout/email/sah_hadir_kursus",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan, 'mprogram'=> $mProgram],TRUE),
                        ];
                        
                        //jabatan profil
                        $this->load->model('hrmis_carta_model','jabatan');
                        $this->load->model('kumpulan_profil_model','kumpulan_profil');
        
                        $elements = $this->jabatan->senarai_penyelaras();
                        $jabatan_penyelaras = get_parent_penyelaras($elements, $pemohon->jabatan_id);

                        $sen_penyelaras = $this->kumpulan_profil->get_many_by('jabatan_id', $jabatan_penyelaras);
                        
                        $kursus = $this->kursus->get($id);
                        $mesej = $this->load->view('layout/email/makluman_penyelaras_sah_hadir_kursus',["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus, 'mjawatan'=>$mJawatan, 'mjabatan'=>$mJabatan, 'mprogram'=> $mProgram],TRUE);

                        foreach($sen_penyelaras as $penyelaras)
                        {
                            $profil_penyelaras = $this->profil->get($penyelaras->profil_nokp);
                            if($profil_penyelaras->email)
                            {
                                if (filter_var($profil_penyelaras->email, FILTER_VALIDATE_EMAIL)) {
                                    $this->load->library('appnotify');

                                    $mail = [
                                        "to" => $profil_penyelaras->email,
                                        "subject" => "[eSPeL][Makluman] Pengesahan hadir berkursus",
                                        "body" => $mesej,
                                    ];
                                    $this->appnotify->send($mail);
                                }
                            }
                        }
                    }
                    else
                    {
                        $this->appsess->setFlashSession("success", false);
                        return redirect('kursus/pengesahan_kehadiran');
                    }
                } */

                $this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Mengesahkan kursus luar','sql'=>$sql]);
                $this->appsess->setFlashSession("success", true);
                return false;
            }
            else
            {
                $this->appsess->setFlashSession("success", false);
                return false;
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
                'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                'tempat' => $this->input->post("txtTempat"),
                'stat_jabatan' => "T",
                'hari' => datediff("y", date("Y-m-d", strtotime($this->input->inputToDate("txtTkhMula"))), date("Y-m-d", strtotime($this->input->inputToDate("txtTkhTamat")))) + 1,
                'anjuran' => $this->input->post("comAnjuran"),
                "stat_soal_selidik_a" => "T",
                "stat_soal_selidik_b" => "T",
            ];

            if ($this->input->post("chkBorangA"))
                $data["stat_soal_selidik_a"] = $this->input->post("chkBorangA");
            if ($this->input->post("chkBorangB"))
                $data["stat_soal_selidik_b"] = $this->input->post("chkBorangB");

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
                'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                'tempat' => $this->input->post("txtTempat"),
                'stat_jabatan' => "T",
                'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
                'anjuran' => $this->input->post("comAnjuran"),
                "stat_soal_selidik_a" => "T",
                "stat_soal_selidik_b" => "T",
            ];

            if ($this->input->post("chkBorangA"))
                $data["stat_soal_selidik_a"] = $this->input->post("chkBorangA");
            if ($this->input->post("chkBorangB"))
                $data["stat_soal_selidik_b"] = $this->input->post("chkBorangB");

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
                'tkh_mula' => constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")),
                'tkh_tamat' => constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat")),
                'tempat' => $this->input->post("txtTempat"),
                'stat_jabatan' => "T",
                'hari' => kiraanHari(date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhMula") . " " . $this->input->post("txtMasaMula")))), date('Y-m-d H:i', strtotime(constructDate($this->input->post("txtTkhTamat") . " " . $this->input->post("txtMasaTamat"))))),
                'anjuran' => $this->input->post("comAnjuran"),
                'sumber'=>$this->input->post("txtSumber"),
                'penyelia_nokp'=>$this->input->post("comPenyelia"),
                "stat_soal_selidik_a" => "T",
                "stat_soal_selidik_b" => "T",
            ];

            if ($this->input->post("chkBorangA"))
                $data["stat_soal_selidik_a"] = $this->input->post("chkBorangA");
            if ($this->input->post("chkBorangB"))
                $data["stat_soal_selidik_b"] = $this->input->post("chkBorangB");

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
            $config['allowed_types'] = ['pdf', 'jpeg', 'jpg', 'png'];
            
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
        return false;
    }

    public function pengesahan_kehadiran()
    {
        if ($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['PTJ']))
        {
            $this->load->model("kursus_model","kursus");
            $this->load->model('profil_model', 'profil');

            $data['sen_kumpulan'] = $this->profil->sen_kump();

            if ($this->appsess->getSessionData('kumpulan') == AppAuth::SUPER || $this->appsess->getSessionData('kumpulan') == AppAuth::ADMIN)
            {
                $data['jab_ptj'] = initObj(['jabatan_id' => $this->config->item('espel_default_jabatan_id')])->jabatan_id;
            }
            else
            {
                $data['jab_ptj'] = $this->appsess->getSessionData('ptj_jabatan_id');
            }

            $data["sen_kursus"] = $this->kursus->get_all_kursus_luar_pengesahan(
                get_penyelaras_related_jabatan($this->appsess->getSessionData("username")),
                []
            );

            $data["sen_kursus_luar"] = $this->kursus->get_all_kursus_luar(
                get_penyelaras_related_jabatan($this->appsess->getSessionData("username"))
            );
            
            $plugins = $this->plugins();
            $plugins['embedjs'][] = $this->load->view('kursus/pengesahan_kehadiran/js', $data, true);

            return $this->renderView("kursus/pengesahan_kehadiran/show", $data, $plugins);
        }
		else
		{
			return $this->renderPermissionDeny();
		}
    }

    public function data_grid_pengesahan()
    {
        if ($this->appauth->hasPeranan($this->appsess->getSessionData("username"), ['PTJ']))
        {
            $this->load->model("kursus_model", "kursus");
            
            $data["sen_kursus"] = $this->kursus->get_all_kursus_luar_pengesahan(
                get_penyelaras_related_jabatan($this->appsess->getSessionData("username")),
                $this->input->post()
            );

            return $this->load->view('kursus/pengesahan_kehadiran/grid', $data);
        }
        else return $this->renderPermissionDeny();    
    }

    public function kedudukan_pelaksanaan()
    {
        $this->load->model('kursus_model','kursus');

        $data['level'] = 3;
        $data['vlevel']=$this->load->view('kursus/pengurusan/show',['level'=>$data['level']],TRUE);
        $data['sen_tahun'] = $this->kursus->sen_tahun();
        $plugins = $this->plugins();
        $plugins['embedjs'][] = $this->load->view('kursus/laksana/js','',TRUE);

        return $this->renderView("kursus/laksana/show", $data,  $plugins);
    }

    public function separa_kedudukan_pelaksanaan()
    {
        $this->load->model('kursus_model','kursus');

        $data['level'] = 3;
        $data['vlevel']=$this->load->view('kursus/pengurusan/separa',['level'=>$data['level']],TRUE);
        $data['sen_tahun'] = $this->kursus->sen_tahun();
        $plugins = $this->plugins();
        $plugins['embedjs'][] = $this->load->view('kursus/separa/laksana/js','',TRUE);

        return $this->renderView("kursus/separa/laksana/show", $data,  $plugins);
    }

    public function kedudukan_pengesahan()
    {
        $this->load->model('kursus_model','kursus');

        $data['level'] = 4;
        $data['vlevel']=$this->load->view('kursus/pengurusan/show',['level'=>$data['level']],TRUE);
        $data['sen_tahun'] = $this->kursus->sen_tahun();
        $plugins = $this->plugins();
        $plugins['embedjs'][] = $this->load->view('kursus/pengesahan/js','',TRUE);

        return $this->renderView("kursus/pengesahan/show", $data,  $plugins);
    }

    public function ajax_senarai_pengesahan()
    {
        $this->load->model('kursus_model','kursus');
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('kumpulan_profil_model','kumpulan_profil');

        $takwim = initObj([
            "tajuk" => $this->input->post('tajuk'),
			"tahun" => $this->input->post('tahun'),
            "bulan" => $this->input->post('bulan'),
            "status" => $this->input->post('status'),
        ]);

        $data['objMohonKursus'] = $this->mohon_kursus;
        $data['sen_permohonan'] = $this->kursus->sen_takwim_mohon($this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id, $takwim);
        return $this->load->view('kursus/pengesahan/senarai',$data);
    }

    public function ajax_senarai_pelaksanaan()
    {
        $this->load->model('kursus_model','kursus');
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('kumpulan_profil_model','kumpulan_profil');

        $takwim = initObj([
            "tajuk" => $this->input->post('tajuk'),
			"tahun" => $this->input->post('tahun'),
            "bulan" => $this->input->post('bulan'),
            "status" => $this->input->post('status'),
        ]);

        $data['objMohonKursus'] = $this->mohon_kursus;
        $data['sen_permohonan'] = $this->kursus->sen_takwim_mohon($this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id, $takwim);
        
        return $this->load->view('kursus/laksana/senarai',$data);
    }

    public function permohonan_kursus()
    {
        $this->load->model('kursus_model','kursus');

        $data['level'] = 2;
        $data['vlevel']=$this->load->view('kursus/pengurusan/show',['level'=>$data['level']],TRUE);
        $data['sen_tahun'] = $this->kursus->sen_tahun();
        $plugins = $this->plugins();
        $plugins['embedjs'][] = $this->load->view('kursus/permohonan/js','',TRUE);

        return $this->renderView("kursus/permohonan/show", $data,  $plugins);
    }

        public function separa_permohonan_kursus()
    {
        $this->load->model('kursus_model','kursus');

        $data['level'] = 2;
        $data['vlevel']=$this->load->view('kursus/pengurusan/separa',['level'=>$data['level']],TRUE);
        $data['sen_tahun'] = $this->kursus->sen_tahun();
        $plugins = $this->plugins();
        $plugins['embedjs'][] = $this->load->view('kursus/separa/permohonan/js','',TRUE);

        return $this->renderView("kursus/separa/permohonan/show", $data,  $plugins);
    }

    public function pencalonan($kursus_id)
    {
        $this->load->model('profil_model','profil');
        $this->load->model('kursus_model','kursus');
        $this->load->model('kelas_model','kelas');
        $this->load->model('hrmis_carta_model','jabatan');
        $this->load->model('kumpulan_profil_model','kumpulan_profil');


        $data['sen_kumpulan'] = $this->profil->sen_kump();
        $data['jab_ptj'] = $this->appsess->getSessionData('ptj_jabatan_id');
        $data['level'] = 2;
        $data['vlevel'] = $this->load->view('kursus/pengurusan/separa', ['level' => $data['level'], 'kursus_id' => $kursus_id], true);
        $data['kursus'] = $this->kursus->with(['program'])->get($kursus_id);
        $data['sen_kelas'] = $this->kelas->dropdown('id', 'nama');
        $data['jabatan_id'] = $this->appsess->getSessionData('ptj_jabatan_id');
        $data['sen_kelas'] = $this->kelas->dropdown('id','nama');
        $data['objJabatan'] = $this->jabatan;
        $data['vlevel']=$this->load->view('kursus/pengurusan/show',['level'=>$data['level'], 'kursus_id'=>$kursus_id],TRUE);
        $js['jabatan_id'] = $this->appsess->getSessionData('ptj_jabatan_id');
        $js['kursus_id'] = $kursus_id;

        $plugins = ['embedjs' => [
            $this->load->view('scripts/carian_js', $data, true),
            $this->load->view('kursus/separa/calon/calon_js', $js, true)
        ]];

        //return $this->renderView('calon/show', $data, $plugins);
        return $this->renderView('kursus/separa/calon/show', $data, $plugins);
    }

    public function separa_pencalonan($kursus_id)
    {
        $this->load->model('profil_model','profil');
        $this->load->model('kursus_model','kursus');
        $this->load->model('kelas_model','kelas');
        $this->load->model('hrmis_carta_model','jabatan');
        $this->load->model('kumpulan_profil_model','kumpulan_profil');
        
        $data['sen_kumpulan'] = $this->profil->sen_kump();
        $data['jab_ptj'] = $this->appsess->getSessionData('ptj_jabatan_id');
        $data['level'] = 2;
        $data['vlevel']=$this->load->view('kursus/pengurusan/separa',['level'=>$data['level'],'kursus_id'=>$kursus_id],TRUE);
        $data['kursus'] = $this->kursus->with(['program'])->get($kursus_id);
        $data['sen_kelas'] = $this->kelas->dropdown('id','nama');
        $data['jabatan_id'] = $this->appsess->getSessionData('ptj_jabatan_id');
        $data['objJabatan'] = $this->jabatan;
        $js['jabatan_id'] = $this->appsess->getSessionData('ptj_jabatan_id');
        $js['kursus_id'] = $kursus_id;

        $plugins = ['embedjs'=>[
            $this->load->view('scripts/carian_js',$data,true),
            $this->load->view('kursus/separa/calon/calon_js',$js,TRUE)
        ]];

        return $this->renderView('kursus/separa/calon/show', $data, $plugins);
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
                if (filter_var($pemohon->email, FILTER_VALIDATE_EMAIL)) {
                    $this->load->library('appnotify');

                    $mail = [
                        "to" => $pemohon->email ,
                        "subject" => "[espel][Makluman] Terpilih untuk mengikuti kursus",
                        "body" => $this->load->view("layout/email/permohonan_kursus_berjaya_pilih",["pemohon"=>$pemohon, "kursus"=>$kursus],TRUE),
                    ];
                    $this->appnotify->send($mail);
                }
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
        $this->load->model('hrmis_carta_model','mjabatan');
        $this->load->model('program_model', 'mprogram');

        $permohonan = $this->mohon_kursus->get($id);
        $kursus = $this->kursus->get($permohonan->kursus_id);
        $pemohon = $this->profil->get_by('nokp',$permohonan->nokp);
        $mprogram = $this->mprogram;
        $mjabatan = $this->mjabatan;


        if($this->mohon_kursus->update($id,['stat_mohon'=>'T']))
        {
            if($pemohon->email)
            {
                if (filter_var($pemohon->email, FILTER_VALIDATE_EMAIL)) {
                    $this->load->library('appnotify');

                    $mail = [
                        "to" => $pemohon->email,
                        "subject" => "[espel][Makluman] Permohonan kursus anda ditolak",
                        "body" => $this->load->view("layout/email/permohonan_kursus_berjaya_tolak",["pemohon"=>$pemohon, "kursus"=>$kursus, 'mprogram'=> $mProgram, 'mjabatan'=>$mJabatan],TRUE),
                    ];
                    $this->appnotify->send($mail);
                }
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
            return $this->output->set_status_header(200);
        }

        return $this->output->set_status_header(400, 'Proses hapus tidak berjaya!');
    }

    public function hapus_separa_pencalonan($id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');

        $permohonan = $this->mohon_kursus->get($id);

        if($this->mohon_kursus->delete($id))
        {
            $this->appsess->setFlashSession("success", true);
        }

        return redirect('kursus/separa_pencalonan/' . $permohonan->kursus_id);

    }

    public function ajax_get_calon_terpilih($kursus_id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');

        $filter = initObj([
            'nama' => $this->input->post('nama'),
            'nokp' => $this->input->post('nokp'),
			'jabatan_id' => $this->input->post('jabatanID'),
            'kumpulan' => $this->input->post('kumpulan'),
            'skim' => $this->input->post('skim'),
            'gred' => $this->input->post('gred'),
            'hari' => $this->input->post('hari'),
            'sub_jabatan' => $this->input->post('sub_jabatan'),        
        ]);

        $data['sen_calon'] = $this->mohon_kursus->get_calon($kursus_id, $filter);

        return $this->load->view('calon/senarai', $data);

    }

    public function ajax_get_calon_separa_terpilih($kursus_id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');

        $filter = initObj([
            'nama' => $this->input->post('nama'),
            'nokp' => $this->input->post('nokp'),
			'jabatan_id' => $this->input->post('jabatanID'),
            'kumpulan' => $this->input->post('kumpulan'),
            'gred' => $this->input->post('gred'),
            'hari' => $this->input->post('hari'),
            'sub_jabatan' => $this->input->post('sub_jabatan'),
        ]);

        $data['sen_calon'] = $this->mohon_kursus->get_calon($kursus_id, $filter);

        return $this->load->view('kursus/separa/calon/senarai', $data);

    }
    public function ajax_get_pencalonan($kursus_id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');

        $filter = initObj([
            'nama' => $this->input->post('nama'),
            'nokp' => $this->input->post('nokp'),
            'jabatan_id' => $this->input->post('jabatan_id'),
            'sub_jabatan' => $this->input->post('sub_jabatan'),
            'kumpulan' => $this->input->post('kelas_id'),
            'gred' => $this->input->post('gred_id'),
            'hari' => $this->input->post('hari'),
            'sub_jabatan' => $this->input->post('sub_jabatan'),
        ]);

        $data['sen_calon'] = $this->mohon_kursus->get_pencalonan($kursus_id, $filter);

        return $this->load->view('calon/senarai_calon', $data);

    }

    public function ajax_set_pencalonan($kursus_id)
    {
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('kursus_model', 'kursus');

        $kursus = $this->kursus->get($kursus_id);

        foreach($this->input->post('chkKehadiran') as $kehadiran)
        {
            if($kehadiran)
            {
                $data['nokp'] = $kehadiran;
                $data['kursus_id'] = $kursus_id;
                $data['tkh'] = date('Y-m-d h:i');
                
                if($kursus->jenis == 'S')
                {
                    $data['stat_mohon'] = 'L';
                    $data['stat_hadir'] = 'Y';
                }

                $data['role'] = $this->appsess->getSessionData('kumpulan');

                if(!$this->mohon_kursus->insert($data))
                {
                    return show_error('Data tidak berjaya disimpan');
                }

            }
        }

        return $this->output->set_status_header(200, 'Proses selesai');

    }

    public function ajax_set_separa_pencalonan($kursus_id)
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
                $data['stat_hadir'] = 'Y';
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
            "tajuk" => $this->input->post('tajuk'),
			"tahun" => $this->input->post('tahun'),
            "bulan" => $this->input->post('bulan'),
            "status" => $this->input->post('status'),
        ]);

        $data['objMohonKursus'] = $this->mohon_kursus;
        $data['sen_permohonan'] = $this->kursus->sen_takwim_mohon($this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id, $takwim);
        return $this->load->view('kursus/permohonan/senarai',$data);
    }

    public function ajax_senarai_separa_permohonan()
    {
        $this->load->model('kursus_model','kursus');
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('kumpulan_profil_model','kumpulan_profil');

        $takwim = initObj([
            "tajuk" => $this->input->post('tajuk'),
			"tahun" => $this->input->post('tahun'),
            "bulan" => $this->input->post('bulan'),
            "status" => $this->input->post('status'),
        ]);

        $data['objMohonKursus'] = $this->mohon_kursus;
        $data['sen_permohonan'] = $this->kursus->sen_takwim_mohon($this->kumpulan_profil->get_by(["profil_nokp"=>$this->appsess->getSessionData("username"),"kumpulan_id"=>3])->jabatan_id, $takwim);
        return $this->load->view('kursus/separa/permohonan/senarai',$data);
    }

    public function ajax_senarai_anjuran_sah()
    {
        $this->load->model('kursus_model','kursus');
        $this->load->model('mohon_kursus_model','mohon_kursus');
        $this->load->model('kumpulan_profil_model','kumpulan_profil');

        $takwim = initObj([
            "tajuk" => $this->input->post('tajuk'),
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

        if(! $this->exist("submit"))
        {
            $this->load->model('kursus_model','kursus');

            $data['kursus'] = $profil_kursus;
            $data['objJabatan'] = $this->jabatan;

            if($has_belanja)
            {
                $data['belanja'] = $this->belanja->get_by('kursus_id',$kursus_id);
            }
            
            $data['level'] = 3;
            $data['vlevel']=$this->load->view('kursus/pengurusan/show',['level'=>$data['level'], 'kursus_id'=>$kursus_id],TRUE);

            return $this->renderView('kursus/pelaksanaan/show', $data, $this->plugins());
        }
        else
        {
            if(!$profil_kursus->peruntukan_id) // tiada bajet
            {
                $config['upload_path'] = './assets/uploads/';
                $config['encrypt_name'] = TRUE;
                $config['allowed_types'] = ['pdf', 'jpeg', 'jpg', 'png'];

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $dataUpload = array('upload_data' => $this->upload->data());

                    $dokumen_path = $dataUpload['upload_data']['file_name'];
                    $dokumen_name = $_FILES['userfile']['name'];

                    if( $this->kursus->update($kursus_id,['stat_laksana'=>'L', 'surat'=> $dokumen_path, 'dokumen_path' => $dokumen_name]))
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

                                if($penyelia && $penyelia->email && filter_var($penyelia->email, FILTER_VALIDATE_EMAIL))
                                {
                                    $mail = [
                                        "to" => $penyelia->email,
                                        "subject" => "[espel][Makluman] Anggota di bawah seliaan anda terpilih untuk mengikuti kursus",
                                        "body" => $this->load->view("layout/email/permohonan_kursus_berjaya",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus,'mjawatan'=>$mjawatan,'mprogram'=>$mprogram, 'mjabatan'=>$mjabatan],TRUE),
                                    ];

                                    $this->appnotify->send($mail);
                                }

                                if($pemohon->email && filter_var($pemohon->email, FILTER_VALIDATE_EMAIL))
                                {
                                    $mail = [
                                        "to" => $pemohon->email,
                                        "subject" => "[espel][Makluman] Anda Terpilih untuk mengikuti kursus",
                                        "body" => $this->load->view("layout/email/permohonan_pemohon_kursus_berjaya", ["pemohon"=>$pemohon, "kursus"=>$kursus, 'mjawatan'=>$mjawatan, 'mprogram'=>$mprogram, 'mjabatan' => $mjabatan],TRUE),
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
                            $config['allowed_types'] = ['pdf', 'jpeg', 'jpg', 'png'];

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

                                            if($penyelia->email && filter_var($penyelia->email, FILTER_VALIDATE_EMAIL))
                                            {
                                                $mail = [
                                                    "to" => $penyelia->email,
                                                    "subject" => "[espel][Makluman] Anggota di bawah seliaan anda terpilih untuk mengikuti kursus",
                                                    "body" => $this->load->view("layout/email/permohonan_kursus_berjaya",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus,'mjawatan'=>$mjawatan,'mprogram'=>$mprogram,'mjabatan'=>$mjabatan],TRUE),
                                                ];
                                                $this->appnotify->send($mail);
                                            }

                                            if($pemohon->email && filter_var($pemohon->email, FILTER_VALIDATE_EMAIL))
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
                            $config['allowed_types'] = ['pdf', 'jpeg', 'jpg', 'png'];

                            $this->load->library('upload', $config);

                            if ( ! $this->upload->do_upload('userfile'))
                            {
                                    $error = array('error' => $this->upload->display_errors());
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

    public function separa_pelaksanaan($kursus_id)
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

            $data['level'] = 3;
            $data['vlevel']=$this->load->view('kursus/pengurusan/separa',['level'=>$data['level'],'kursus_id'=>$kursus_id],TRUE);
            $data['kursus'] = $profil_kursus;
            $data['objJabatan'] = $this->jabatan;

            if($has_belanja)
            {
                $data['belanja'] = $this->belanja->get_by('kursus_id',$kursus_id);
            }
            return $this->renderView('kursus/separa/pelaksanaan/show', $data, $this->plugins());
        }
        else
        {
            if(!$profil_kursus->peruntukan_id) // tiada bajet
            {
                $config['upload_path'] = './assets/uploads/';
                $config['encrypt_name'] = TRUE;
                $config['allowed_types'] = ['pdf', 'jpeg', 'jpg', 'png'];

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

                                if($penyelia->email && filter_var($penyelia->email, FILTER_VALIDATE_EMAIL))
                                {
                                    $mail = [
                                        "to" => $penyelia->email,
                                        "subject" => "[espel][Makluman] Anggota di bawah seliaan anda terpilih untuk mengikuti kursus",
                                        "body" => $this->load->view("layout/email/permohonan_kursus_berjaya",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus,'mjawatan'=>$mjawatan,'mprogram'=>$mprogram, 'mjabatan'=>$mjabatan],TRUE),
                                    ];
                                }
                                //$this->appnotify->send($mail);

                                if($pemohon->email && filter_var($pemohon->email, FILTER_VALIDATE_EMAIL))
                                {
                                    $mail = [
                                        "to" => $pemohon->email,
                                        "subject" => "[espel][Makluman] Anda Terpilih untuk mengikuti kursus",
                                        "body" => $this->load->view("layout/email/permohonan_pemohon_kursus_berjaya",["pemohon"=>$pemohon,"kursus"=>$kursus,'mjawatan'=>$mjawatan,'mprogram'=>$mprogram],TRUE),
                                    ];
                                }
                                //$this->appnotify->send($mail);
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
                            $config['allowed_types'] = ['pdf', 'jpeg', 'jpg', 'png'];

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

                                            if($penyelia->email && filter_var($penyelia->email, FILTER_VALIDATE_EMAIL))
                                            {
                                                $mail = [
                                                    "to" => $penyelia->email,
                                                    "subject" => "[espel][Makluman] Anggota di bawah seliaan anda terpilih untuk mengikuti kursus",
                                                    "body" => $this->load->view("layout/email/permohonan_kursus_berjaya",["pemohon"=>$pemohon,"penyelia"=>$penyelia, "kursus"=>$kursus,'mjawatan'=>$mjawatan,'mprogram'=>$mprogram,'mjabatan'=>$mjabatan],TRUE),
                                                ];
                                                //$this->appnotify->send($mail);
                                            }

                                            if($pemohon->email && filter_var($pemohon->email, FILTER_VALIDATE_EMAIL))
                                            {
                                                $mail = [
                                                    "to" => $pemohon->email,
                                                    "subject" => "[espel][Makluman] Anda Terpilih untuk mengikuti kursus",
                                                    "body" => $this->load->view("layout/email/permohonan_pemohon_kursus_berjaya",["pemohon"=>$pemohon,"kursus"=>$kursus,'mjawatan'=>$mjawatan,'mprogram'=>$mprogram,'mjabatan'=>$mjabatan],TRUE),
                                                ];
                                                //$this->appnotify->send($mail);
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
                            $config['allowed_types'] = ['pdf', 'jpeg', 'jpg', 'png'];

                            $this->load->library('upload', $config);

                            if ( ! $this->upload->do_upload('userfile'))
                            {
                                    $error = array('error' => $this->upload->display_errors());
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
        return redirect('kursus/separa_pelaksanaan/'. $kursus_id);
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

        $filter = initObj([
        ]);

        $data['sen_calon'] = $this->mohon_kursus->get_calon($kursus_id,$filter);
        $data['level'] = 4;
        $data['vlevel']=$this->load->view('kursus/pengurusan/show',['level'=>$data['level'], 'kursus_id'=>$kursus_id],TRUE);

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

                if($pemohon->email_ppp && filter_var($pemohon->email_ppp, FILTER_VALIDATE_EMAIL))
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
                        if($email_penyelaras && filter_var($email_penyelaras, FILTER_VALIDATE_EMAIL))
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

    public function ajax_jawab_pencalonan($kursus_id, $jawapan)
    {
        $this->load->model('mohon_kursus_model', 'mohon_kursus');

        if(! $this->mohon_kursus->jawapanByPengguna($kursus_id, $jawapan, $this->appsess->getSessionData('username')))
            return $this->output->set_status_header(400);

        return $this->output->set_status_header(200, 'Proses selesai');
    }
}
