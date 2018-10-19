<?php

namespace Module\Kursus;

use Module\Module;
use Underscore\Types\Arrays;

class Kursus extends Module
{
    const JENIS_KURSUS_RANCANG = 'R';
    const JENIS_KURSUS_SIAP = 'S';
    const JENIS_KURSUS_LUAR = 'L';

    const STATUS_KURSUS_DALAM_TIDAK = 'T';
    const STATUS_KURSUS_DALAM_YA = 'Y';

    const STATUS_HADIR_MOHON = 'M';
    const STATUS_HADIR_YA = 'Y';
    const STATUS_HADIR_TIDAK = 'T';

    const STATUS_KURSUS_LAKSANA_LULUS = 'L';

    const ANJURAN_LUAR = 'L';
    const ANJURAN_DALAM = 'D';

    const LATIHAN_DALAM_NEGARA = 1;
    const LATIHAN_LUAR_NEGARA = 2;
    const PEMBELAJARAN_SESI_BERSEMUKA = 3;
    const PEMBELAJARAN_SESI_TIDAK_BERSEMUKA = 4;
    const KENDIRI = 5;

    protected $kursus_id = null;
    protected $tajuk = null;
    protected $program_id = null;
    protected $aktiviti_id = null;
    protected $tkh_mula = null;
    protected $tkh_tamat = null;
    protected $nokp = null;
    protected $stat_jabatan = null;
    protected $stat_hadir = null;
    protected $stat_laksana = null;
    protected $anjuran = null;
    protected $penganjur = null;
    protected $penganjur_id = null;
    protected $penyelia = null;
    protected $hari = null;
    protected $dokumen_path = null;
    protected $surat = null;
    protected $sumber = null;
    protected $penyelia_nokp = null;
    protected $telefon = null;
    protected $email = null;
    protected $jenis = null; // L => Luar, S => Siap, R => Rancang
    protected $stat_soal_selidik_a = 'T';
    protected $stat_soal_selidik_b = 'T';


    public function __contruct()
    {
        parent::__construct();
    }

    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    public function __get($name)
    {
        return $this->{$name};
    }

    public function calcHari()
    {
        if ($this->program_id == SELF::LATIHAN_DALAM_NEGARA || $this->program_id == SELF::LATIHAN_LUAR_NEGARA)
            return $this->hari = datediff("y", date("Y-m-d", strtotime($this->tkh_mula)), date("Y-m-d", strtotime($this->tkh_tamat))) + 1;

        return $this->hari = kiraanHari(date('Y-m-d H:i', strtotime($this->tkh_mula)), date('Y-m-d H:i', strtotime($this->tkh_tamat)));
    }

    public function bertindih()
    {
        $this->CI->load->model("mohon_kursus_model", "mohon_kursus");

        $takwim = initObj([
            "tahun" => $this->tkh_mula->year,
            "bulan" => $this->tkh_tamat->month
        ]);

        $rst = $this->CI->mohon_kursus->SenaraiKursusBerdaftar($this->nokp, $takwim, $this->kursus_id);

        if (count($rst) != 0)
            return Arrays::matchesAny($rst, function ($value) {
                $tkhMulaR = constructDate($value['tkh_mula']);
                $tkhTamatR = constructDate($value['tkh_tamat']);
                $tkhMula = constructDate($this->tkh_mula);
                $tkhTamat = constructDate($this->tkh_tamat);

                return $tkhMula->between($tkhMulaR, $tkhTamatR) || $tkhTamat->between($tkhMulaR, $tkhTamatR) || $tkhMulaR->between($tkhMula, $tkhTamat) || $tkhTamatR->between($tkhMula, $tkhTamat);
            });

        return false;
    }

    public function get($kursus_id)
    {
        $this->CI->load->model('kursus_model', 'kursus');
        $kursus = $this->CI->kursus->get($kursus_id);

        $this->kursus_id = $kursus_id;
        $this->tajuk = strtoupper($kursus->tajuk);
        $this->nokp = $kursus->nokp;
        $this->program_id = $kursus->program_id;
        $this->aktiviti_id = $kursus->aktiviti_id;
        $this->tkh_mula = constructDate($kursus->tkh_mula);
        $this->tkh_tamat = constructDate($kursus->tkh_tamat);
        $this->tempat = $kursus->tempat;
        $this->stat_jabatan = $kursus->stat_jabatan;
        $this->stat_hadir = $kursus->stat_hadir;
        $this->stat_laksana = $kursus->stat_laksana;
        $this->anjuran = $kursus->anjuran;
        $this->penganjur = $kursus->penganjur;
        $this->penganjur_id = $kursus->penganjur_id;
        $this->sumber = $kursus->sumber;
        $this->penyelia_nokp = $kursus->penyelia_nokp;
        $this->dokumen_path = $kursus->dokumen_path;
        $this->surat = $kursus->surat;
        $this->hari = $kursus->hari;
        $this->jenis = $kursus->jenis;
        $this->stat_soal_selidik_a = $kursus->stat_soal_selidik_a;
        $this->stat_soal_selidik_b = $kursus->stat_soal_selidik_b;
        
        return $this;
    }
}