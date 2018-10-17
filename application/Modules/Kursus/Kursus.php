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

    const STATUS_KURSUS_LAKSANA_YA = 'Y';

    const ANJURAN_LUAR = 'L';
    const ANJURAN_DALAM = 'D';

    const LATIHAN_DALAM_NEGARA = 1;
    const LATIHAN_LUAR_NEGARA = 2;
    const PEMBELAJARAN_SESI_BERSEMUKA = 3;
    const PEMBELAJARAN_SESI_TIDAK_BERSEMUKA = 4;
    const KENDIRI = 5;

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

    public function __contruct()
    {
        parent::__construct();
        $this->CI->load->model("kursus_model", "kursus");
        $this->CI->load->model("kumpulan_profil_model", "kumpulan_profil");
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
        if ($this->program_id === SELF::LATIHAN_DALAM_NEGARA || $this->program_id === SELF::LATIHAN_LUAR_NEGARA)
            return $this->hari = kiraanHari(date('Y-m-d H:i', strtotime($this->tkh_mula)), date('Y-m-d H:i', strtotime($this->tkh_tamat)));

        return $this->hari = datediff("y", date("Y-m-d", strtotime($this->tkh_mula)), date("Y-m-d", strtotime($this->tkh_tamat))) + 1;
    }

    public function bertindih()
    {
        $takwim = initObj([
            "tahun" => $this->tkh_mula->year,
            "bulan" => $this->tkh_tamat->month
        ]);

        $rst = $this->CI->kursus->takwim_day_pengguna_2(0, $takwim);

        if (count($rst) != 0)
            return Arrays::matchesAny($rst, function ($value) use ($data) {
                $tkhMulaR = constructDate($value['tkh_mula']);
                $tkhTamatR = constructDate($value['tkh_tamat']);
                $tkhMula = constructDate($data['tkh_mula']);
                $tkhTamat = constructDate($data['tkh_tamat']);

                return $tkhMula->between($tkhMulaR, $tkhTamatR) || $tkhTamat->between($tkhMulaR, $tkhTamatR);
            });

        return false;
    }
}