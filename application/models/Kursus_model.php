<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kursus_model extends MY_Model
{
    protected $_table = "espel_kursus";
    protected $belongs_to = [
        'program' => [
            'model' => 'program_model',
            'primary_key'=>'program_id',
        ],
        'aktiviti' => [
            'model' => 'aktiviti_model',
            'primary_key'=>'aktiviti_id',
        ],
        'penganjur' => [
            'model' => 'jabatan_model',
            'primary_key'=>'penganjur_id',
        ],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_kursus_hadir($nokp, $tahun)
    {
        $sql = "select * from (SELECT a.id, a.tajuk, b.title jabatan, a.tkh_mula, a.tkh_tamat, a.hari
        FROM espel_kursus a, hrmis_carta_organisasi b
        WHERE 1=1
        AND a.penganjur_id = b.buid
        AND YEAR(a.tkh_mula) = ?
        AND a.nokp = ?
        and a.stat_hadir = 'L'
        UNION
        SELECT id, tajuk, penganjur, tkh_mula, tkh_tamat, hari
        FROM espel_kursus
        WHERE 1=1
        AND penganjur_id = 0
        AND YEAR(tkh_mula) = ?
        AND nokp = ?
        AND stat_hadir = 'L'
        UNION
        SELECT a.id, a.tajuk, b.title jabatan, a.tkh_mula, a.tkh_tamat, a.hari
        FROM espel_kursus a, hrmis_carta_organisasi b, espel_permohonan_kursus c
        WHERE 1=1
        AND a.penganjur_id = b.buid
        AND a.id = c.kursus_id
        AND YEAR(a.tkh_mula) = ?
        AND a.nokp = ?
        and c.stat_hadir = 'L') a where 1=1 order by tkh_mula
        ";
        return $this->db->query($sql,[$tahun,$nokp,$tahun,$nokp,$tahun,$nokp])->result();
    }

    public function get_all_kursus_patut_hadir($nokp, $tahun)
    {
        $sql = "select * from (SELECT a.id, a.tajuk, b.title jabatan, a.tkh_mula, a.tkh_tamat, a.hari
        FROM espel_kursus a, hrmis_carta_organisasi b
        WHERE 1=1
        AND a.penganjur_id = b.buid
        AND YEAR(a.tkh_mula) = ?
        AND a.nokp = ?
        and a.stat_hadir = 'L'
        UNION
        SELECT id, tajuk, penganjur, tkh_mula, tkh_tamat, hari
        FROM espel_kursus
        WHERE 1=1
        AND penganjur_id = 0
        AND YEAR(tkh_mula) = ?
        AND nokp = ?
        AND stat_hadir = 'L'
        UNION
        SELECT a.id, a.tajuk, b.title jabatan, a.tkh_mula, a.tkh_tamat, a.hari
        FROM espel_kursus a, hrmis_carta_organisasi b, espel_permohonan_kursus c
        WHERE 1=1
        AND a.penganjur_id = b.buid
        AND a.id = c.kursus_id
        AND YEAR(a.tkh_mula) = ?
        AND a.nokp = ?
        and c.stat_hadir = 'L') a where 1=1 order by tkh_mula
        ";
        return $this->db->query($sql,[$tahun,$nokp,$tahun,$nokp,$tahun,$nokp])->result();
    }

    public function get_all_kursus_luar_pengesahan(array $jabatanID)
    {
        $this->db->select("a.id, b.nama,d.title jabatan, a.tajuk, c.nama as program, a.stat_hadir, a.tkh_mula, a.tkh_tamat, a.stat_soal_selidik_a, a.stat_soal_selidik_b, a.dokumen_path");
        $this->db->from("espel_kursus a");
        $this->db->join("espel_profil b","a.nokp = b.nokp");
        $this->db->join("espel_dict_program c","a.program_id = c.id");
        $this->db->join("hrmis_carta_organisasi d","b.jabatan_id = d.buid");
        $this->db->where("a.stat_hadir", "M");
        $this->db->where_in("b.jabatan_id", $jabatanID);
        $rst = $this->db->get();

        return $rst->result();
    }

    public function get_all_kursus_boranga($nokp)
    {
        $this->db->select("a.id, b.nama,d.title jabatan, a.tajuk, c.nama as program, a.stat_hadir, a.tkh_mula, a.tkh_tamat, a.stat_soal_selidik_a, a.stat_soal_selidik_b");
        $this->db->from("espel_kursus a");
        $this->db->join("espel_profil b","a.nokp = b.nokp");
        $this->db->join("espel_dict_program c","a.program_id = c.id");
        $this->db->join("hrmis_carta_organisasi d","b.jabatan_id = d.buid");
        $this->db->join('espel_boranga e', 'e.kursus_id = a.id', 'left');
        $this->db->where("year(a.tkh_mula)",date("Y"));
        $this->db->where("a.stat_soal_selidik_a", "Y");
        $this->db->where("a.stat_hadir", "L");
        $this->db->where_in("b.nokp", $nokp);
        $this->db->where('e.id =', NULL);
        $rst = $this->db->get();

        return $rst->result();
    }

    public function get_kursus_by_program($nokp, $programID, $tahun)
    {
        $sql = "SELECT a.id, a.tajuk, b.title jabatan, a.tkh_mula, a.tkh_tamat, a.hari, a.tempat
        FROM espel_kursus a, hrmis_carta_organisasi b
        WHERE 1=1
        AND a.penganjur_id = b.buid
        AND YEAR(a.tkh_mula) = ?
        AND a.nokp = ?
        AND a.program_id = ?
        and a.stat_hadir = 'L'
        UNION
        SELECT id, tajuk, penganjur, tkh_mula, tkh_tamat, hari, tempat
        FROM espel_kursus
        WHERE 1=1
        AND penganjur_id = 0
        AND YEAR(tkh_mula) = ?
        AND nokp = ?
        AND program_id = ?
        AND stat_hadir = 'L'
        UNION
        SELECT a.id, a.tajuk, b.title jabatan, a.tkh_mula, a.tkh_tamat, a.hari, a.tempat
        FROM espel_kursus a, hrmis_carta_organisasi b, espel_permohonan_kursus c
        WHERE 1=1
        AND a.penganjur_id = b.buid
        AND a.id = c.kursus_id
        AND YEAR(a.tkh_mula) = ?
        AND a.nokp = ?
        AND a.program_id = ?
        and c.stat_hadir = 'L'
        ";
        return $this->db->query($sql,[$tahun,$nokp,$programID,$tahun,$nokp,$programID,$tahun,$nokp,$programID])->result();
    }

    public function getBilhari($nokp, $programID, $tahun)
    {
        $sql = "SELECT a.program_id, sum(hari) jumlah
            FROM (SELECT program_id, nokp, hari
            FROM espel_kursus
            WHERE 1=1
            AND YEAR(tkh_mula) = ?
            AND stat_hadir = 'L'
            AND program_id = ?
            AND nokp = ?
            UNION
            SELECT a.program_id, a.nokp, a.hari
            FROM espel_kursus a, espel_permohonan_kursus c
            WHERE 1=1
            AND a.id = c.kursus_id
            AND YEAR(a.tkh_mula) = ?
            AND a.program_id = ?
            AND a.nokp = ?
            AND c.stat_hadir = 'L'
            ) a
            group by a.program_id";
        $rst = $this->db->query($sql, [$tahun,$programID,$nokp,$tahun,$programID,$nokp]);

        if($rst->num_rows())
            return $rst->row()->jumlah;
        return 0;
    }

    public function getBilhariPemb($nokp, $programID, $tahun)
    {
        $sql = "SELECT a.program_id, a.nokp, sum(hari) jumlah
            FROM (SELECT kursus_luar.program_id, kursus_luar.nokp, jum_jam/6 AS hari
            FROM kursus_luar
            WHERE 1=1
            AND YEAR(kursus_luar.tkh_mula) = ?
            AND kehadiran = 'L'
            AND kursus_luar.program_id = ?
            AND kursus_luar.nokp = ?) a
            group by a.program_id, a.nokp";
        $rst = $this->db->query($sql, [$tahun,$programID,$nokp]);

        if($rst->num_rows())
            return $rst->row()->jumlah;
        return 0;
    }
    public function getBilhariKendiri($nokp, $programID, $tahun)
    {
        $sql = "SELECT a.program_id, a.nokp, sum(hari) jumlah
            FROM (SELECT kursus_luar.program_id, kursus_luar.nokp, 1 AS hari
            FROM kursus_luar
            WHERE 1=1
            AND YEAR(kursus_luar.tkh_mula) = ?
            AND kehadiran = 'L'
            AND kursus_luar.program_id = ?
            AND kursus_luar.nokp = ?) a
            group by a.program_id, a.nokp";
        $rst = $this->db->query($sql, [$tahun,$programID,$nokp]);

        if($rst->num_rows())
            return $rst->row()->jumlah;
        return 0;
    }

    public function takwim($ptj_jabatan_id, $takwim)
    {
        $sql = "SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, a.stat_laksana FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            AND a.program_id = b.id
            AND a.ptj_jabatan_id_created = ?
            AND YEAR(a.tkh_mula) = ?
            AND MONTH(a.tkh_mula) = ?
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, a.stat_laksana FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            AND a.program_id = b.id
            AND a.ptj_jabatan_id_created = ?
            AND YEAR(a.tkh_tamat) = ?
            AND MONTH(a.tkh_tamat) = ?
            AND a.id NOT IN(SELECT id FROM espel_kursus
                WHERE 1=1
                AND ptj_jabatan_id_created = ?
                AND YEAR(tkh_mula) = ?
                AND MONTH(tkh_mula) = ?)";

        $rst = $this->db->query($sql,[
            $ptj_jabatan_id,$takwim->tahun,$takwim->bulan,
            $ptj_jabatan_id,$takwim->tahun,$takwim->bulan,
            $ptj_jabatan_id,$takwim->tahun,$takwim->bulan]
        );

        if($rst->num_rows())
        {
            return $rst->result();
        }
        else
        {
            return NULL;
        }
    }

    public function senarai_kursus_boranga($ptj_jabatan_id)
    {
        $sql = "SELECT espel_dict_program.nama AS program, hrmis_carta_organisasi.title, a.penganjur,
            a.tajuk, year(a.tkh_mula) AS tahun, a.tkh_mula, a.tkh_tamat, a.ptj_jabatan_id_created, a.anjuran
            FROM espel_kursus AS a
            LEFT OUTER JOIN hrmis_carta_organisasi ON a.penganjur_id = hrmis_carta_organisasi.buid
            INNER JOIN espel_dict_program ON a.program_id = espel_dict_program.id
            WHERE
            1 = 1 AND
            a.stat_laksana = 'L'
            AND a.ptj_jabatan_id_created in (?)
            ORDER BY
            a.tkh_mula ASC";
        return $this->db->query($sql,[$ptj_jabatan_id]);
    }

    public function takwim_senarai_pengguna($takwim)
    {
        $sql = "select * from (SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, NULL as stat_mohon FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            AND a.program_id = b.id
            and a.stat_terbuka = 'Y'
            AND YEAR(a.tkh_mula) = ?
            AND MONTH(a.tkh_mula) = ?
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, NULL as stat_mohon FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            AND a.program_id = b.id
            and a.stat_terbuka = 'Y'
            AND YEAR(a.tkh_tamat) = ?
            AND MONTH(a.tkh_tamat) = ?
            AND a.id NOT IN(SELECT id FROM espel_kursus
                WHERE 1=1
                and stat_terbuka = 'Y'
                AND YEAR(tkh_mula) = ?
                AND MONTH(tkh_mula) = ?)
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, c.stat_mohon
            FROM espel_kursus a, espel_dict_program b, espel_permohonan_kursus c
            WHERE 1=1
            AND c.nokp = '" . $this->appsess->getSessionData('username') . "'
            and a.stat_terbuka = 'T'
            AND a.program_id = b.id
            AND c.kursus_id = a.id
            AND YEAR(a.tkh_mula) = ?
            AND MONTH(a.tkh_mula) = ?
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, c.stat_mohon
            FROM espel_kursus a, espel_dict_program b, espel_permohonan_kursus c
            WHERE 1=1
            AND c.nokp = '" . $this->appsess->getSessionData('username') . "'
            and a.stat_terbuka = 'T'
            AND a.program_id = b.id
            AND c.kursus_id = a.id
            AND YEAR(a.tkh_tamat) = ?
            AND MONTH(a.tkh_tamat) = ?
            AND a.id NOT IN(SELECT a.id FROM espel_kursus a, espel_permohonan_kursus b
                WHERE 1=1
                AND b.nokp = '" . $this->appsess->getSessionData('username') . "'
                AND b.kursus_id = a.id
                and a.stat_terbuka = 'T'
                AND YEAR(a.tkh_mula) = ?
                AND MONTH(a.tkh_mula) = ?)) a where 1=1 ORDER BY tkh_mula ASC";

        $rst = $this->db->query($sql,[
            $takwim->tahun,$takwim->bulan,
            $takwim->tahun,$takwim->bulan,
            $takwim->tahun,$takwim->bulan,
            $takwim->tahun,$takwim->bulan,
            $takwim->tahun,$takwim->bulan,
            $takwim->tahun,$takwim->bulan]
        );

        if($rst->num_rows())
        {
            return $rst->result();
        }
        else
        {
            return NULL;
        }
    }

    public function takwim_day($ptj_jabatan_id, $takwim)
    {
        $tkh = date("Y-m-d",strtotime($takwim->tahun . "-" . $takwim->bulan . "-" . $takwim->hari));
        $sql = "SELECT * FROM (
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat
            FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            and a.stat_terbuka = 'Y'
            AND a.program_id = b.id
            AND YEAR(a.tkh_mula) = ?
            AND MONTH(a.tkh_mula) = ?
            AND DAY(a.tkh_mula) = ?
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat
            FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            and a.stat_terbuka = 'Y'
            AND a.program_id = b.id
            AND YEAR(a.tkh_tamat) = ?
            AND MONTH(a.tkh_tamat) = ?
            AND DAY(a.tkh_tamat) = ?
            AND a.id NOT IN(SELECT id FROM espel_kursus
                WHERE 1=1
                and stat_terbuka = 'Y'
                AND YEAR(tkh_mula) = ?
                AND MONTH(tkh_mula) = ?
                AND DAY(tkh_mula) = ?)
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            and a.stat_terbuka = 'Y'
            AND a.program_id = b.id
            AND a.tkh_mula < '$tkh'
            AND a.tkh_tamat > '$tkh'

            union
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat
            FROM espel_kursus a, espel_dict_program b, espel_permohonan_kursus c
            WHERE 1=1
            AND c.nokp = '" . $this->appsess->getSessionData('username') . "'
            and a.stat_terbuka = 'T'
            AND a.program_id = b.id
            AND c.kursus_id = a.id
            AND YEAR(a.tkh_mula) = ?
            AND MONTH(a.tkh_mula) = ?
            AND DAY(a.tkh_mula) = ?
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat
            FROM espel_kursus a, espel_dict_program b, espel_permohonan_kursus c
            WHERE 1=1
            AND c.nokp = '" . $this->appsess->getSessionData('username') . "'
            and a.stat_terbuka = 'T'
            AND a.program_id = b.id
            AND c.kursus_id = a.id
            AND YEAR(a.tkh_tamat) = ?
            AND MONTH(a.tkh_tamat) = ?
            AND DAY(a.tkh_tamat) = ?
            AND a.id NOT IN(SELECT a.id FROM espel_kursus a, espel_permohonan_kursus b
                WHERE 1=1
                AND b.nokp = '" . $this->appsess->getSessionData('username') . "'
                AND b.kursus_id = a.id
                and a.stat_terbuka = 'T'
                AND YEAR(a.tkh_mula) = ?
                AND MONTH(a.tkh_mula) = ?
                AND DAY(a.tkh_mula) = ?)
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat
            FROM espel_kursus a, espel_dict_program b, espel_permohonan_kursus c
            WHERE 1=1
            AND c.nokp = '" . $this->appsess->getSessionData('username') . "'
            and a.stat_terbuka = 'T'
            AND a.program_id = b.id
            AND c.kursus_id = a.id
            AND a.tkh_mula < '$tkh'
            AND a.tkh_tamat > '$tkh'
            ) a
            ORDER BY a.tkh_mula";

        $rst = $this->db->query($sql,[
            $takwim->tahun,$takwim->bulan,$takwim->hari,
            $takwim->tahun,$takwim->bulan,$takwim->hari,
            $takwim->tahun,$takwim->bulan,$takwim->hari,
            $takwim->tahun,$takwim->bulan,$takwim->hari,
            $takwim->tahun,$takwim->bulan,$takwim->hari,
            $takwim->tahun,$takwim->bulan,$takwim->hari
        ]
        );

        if($rst->num_rows())
        {
            return $rst->result_array();
        }
        else
        {
            return NULL;
        }
    }

    public function takwim_day_pengguna($ptj_jabatan_id, $takwim)
    {
        $tkh = date("Y-m-d",strtotime($takwim->tahun . "-" . $takwim->bulan . "-" . $takwim->hari));
        $sql = "SELECT * FROM (
                SELECT espel_kursus.id, espel_kursus.tajuk, espel_dict_program.nama, espel_kursus.tkh_mula, espel_kursus.tkh_tamat, a.nokp, a.stat_mohon
                FROM espel_kursus
                INNER JOIN espel_dict_program ON espel_kursus.program_id = espel_dict_program.id
                LEFT JOIN (select * from espel_permohonan_kursus where nokp = '" . $this->appsess->getSessionData('username') . "') a ON espel_kursus.id = a.kursus_id
                WHERE 1=1
                AND espel_kursus.stat_terbuka = 'Y'
                AND YEAR(espel_kursus.tkh_mula) = ?
                AND MONTH(espel_kursus.tkh_mula) = ?
                AND DAY(espel_kursus.tkh_mula) = ?
            UNION
                SELECT espel_kursus.id, espel_kursus.tajuk, espel_dict_program.nama, espel_kursus.tkh_mula, espel_kursus.tkh_tamat, a.nokp, a.stat_mohon
                FROM espel_kursus
                INNER JOIN espel_dict_program ON espel_kursus.program_id = espel_dict_program.id
                LEFT JOIN (select * from espel_permohonan_kursus where nokp = '" . $this->appsess->getSessionData('username') . "') a ON espel_kursus.id = a.kursus_id
                WHERE 1=1
                AND espel_kursus.stat_terbuka = 'Y'
                AND YEAR(espel_kursus.tkh_mula) = ?
                AND MONTH(espel_kursus.tkh_mula) = ?
                AND DAY(espel_kursus.tkh_mula) = ?
                AND espel_kursus.id NOT IN(SELECT espel_kursus.id FROM espel_kursus
                    INNER JOIN espel_dict_program ON espel_kursus.program_id = espel_dict_program.id
                    LEFT JOIN (select * from espel_permohonan_kursus where nokp = '" . $this->appsess->getSessionData('username') . "') a ON espel_kursus.id = a.kursus_id
                    WHERE 1=1
                    AND espel_kursus.stat_terbuka = 'Y'
                    AND YEAR(espel_kursus.tkh_mula) = ?
                    AND MONTH(espel_kursus.tkh_mula) = ?
                    AND DAY(espel_kursus.tkh_mula) = ?)
            UNION
                SELECT espel_kursus.id, espel_kursus.tajuk, espel_dict_program.nama, espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_permohonan_kursus.nokp, espel_permohonan_kursus.stat_mohon
                FROM espel_kursus
                INNER JOIN espel_dict_program ON espel_kursus.program_id = espel_dict_program.id
                LEFT JOIN espel_permohonan_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
                WHERE 1=1
                AND espel_kursus.stat_terbuka = 'Y'
                AND espel_kursus.tkh_mula < '$tkh'
                AND espel_kursus.tkh_tamat > '$tkh'
                AND (espel_permohonan_kursus.nokp = '" . $this->appsess->getSessionData('username') . "' or espel_permohonan_kursus.nokp is null)

            union
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, c.nokp, c.stat_mohon
            FROM espel_kursus a, espel_dict_program b, espel_permohonan_kursus c
            WHERE 1=1
            AND c.nokp = '" . $this->appsess->getSessionData('username') . "'
            and a.stat_terbuka = 'T'
            AND a.program_id = b.id
            AND c.kursus_id = a.id
            AND YEAR(a.tkh_mula) = ?
            AND MONTH(a.tkh_mula) = ?
            AND DAY(a.tkh_mula) = ?
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, c.nokp, c.stat_mohon
            FROM espel_kursus a, espel_dict_program b, espel_permohonan_kursus c
            WHERE 1=1
            AND c.nokp = '" . $this->appsess->getSessionData('username') . "'
            and a.stat_terbuka = 'T'
            AND a.program_id = b.id
            AND c.kursus_id = a.id
            AND YEAR(a.tkh_tamat) = ?
            AND MONTH(a.tkh_tamat) = ?
            AND DAY(a.tkh_tamat) = ?
            AND a.id NOT IN(SELECT a.id FROM espel_kursus a, espel_permohonan_kursus b
                WHERE 1=1
                AND b.nokp = '" . $this->appsess->getSessionData('username') . "'
                AND b.kursus_id = a.id
                and a.stat_terbuka = 'T'
                AND YEAR(a.tkh_mula) = ?
                AND MONTH(a.tkh_mula) = ?
                AND DAY(a.tkh_mula) = ?)
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, c.nokp, c.stat_mohon
            FROM espel_kursus a, espel_dict_program b, espel_permohonan_kursus c
            WHERE 1=1
            AND c.nokp = '" . $this->appsess->getSessionData('username') . "'
            and a.stat_terbuka = 'T'
            AND a.program_id = b.id
            AND c.kursus_id = a.id
            AND a.tkh_mula < '$tkh'
            AND a.tkh_tamat > '$tkh'
            ) a
            ORDER BY a.tkh_mula";

        $rst = $this->db->query($sql,[
            $takwim->tahun,$takwim->bulan,$takwim->hari,
            $takwim->tahun,$takwim->bulan,$takwim->hari,
            $takwim->tahun,$takwim->bulan,$takwim->hari,
            $takwim->tahun,$takwim->bulan,$takwim->hari,
            $takwim->tahun,$takwim->bulan,$takwim->hari,
            $takwim->tahun,$takwim->bulan,$takwim->hari
        ]
        );

        if($rst->num_rows())
        {
            return $rst->result_array();
        }
        else
        {
            return NULL;
        }
    }

    public function takwim_day_all($ptj_jabatan_id, $takwim)
    {
        $tkh = date("Y-m-d",strtotime($takwim->tahun . "-" . $takwim->bulan . "-" . $takwim->hari));
        $sql = "SELECT * FROM (SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat
            FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            AND a.program_id = b.id
            AND a.ptj_jabatan_id_created = ?
            AND YEAR(a.tkh_mula) = ?
            AND MONTH(a.tkh_mula) = ?
            AND DAY(a.tkh_mula) = ?
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            AND a.program_id = b.id
            AND a.ptj_jabatan_id_created = ?
            AND YEAR(a.tkh_tamat) = ?
            AND MONTH(a.tkh_tamat) = ?
            AND DAY(a.tkh_tamat) = ?
            AND a.id NOT IN(SELECT id FROM espel_kursus
                WHERE 1=1
                AND ptj_jabatan_id_created = ?
                AND YEAR(tkh_mula) = ?
                AND MONTH(tkh_mula) = ?
                AND DAY(tkh_mula) = ?)
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            AND a.program_id = b.id
            AND a.ptj_jabatan_id_created = $ptj_jabatan_id
            AND a.tkh_mula < '$tkh'
            AND a.tkh_tamat > '$tkh') a
            ORDER BY a.tkh_mula";

        $rst = $this->db->query($sql,[
            $ptj_jabatan_id,$takwim->tahun,$takwim->bulan,$takwim->hari,
            $ptj_jabatan_id,$takwim->tahun,$takwim->bulan,$takwim->hari,
            $ptj_jabatan_id,$takwim->tahun,$takwim->bulan,$takwim->hari]
        );

        if($rst->num_rows())
        {
            return $rst->result_array();
        }
        else
        {
            return NULL;
        }
    }

    public function sen_takwim_mohon($ptj_jabatan_id, $takwim)
    {
        $sql = "SELECT * FROM (SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, c.title as penganjur, a.stat_laksana
            FROM espel_kursus a, espel_dict_program b, hrmis_carta_organisasi c
            WHERE 1=1
            AND a.program_id = b.id
            AND a.penganjur_id = c.buid
            AND a.ptj_jabatan_id_created = ?
            AND YEAR(a.tkh_mula) = ?
            AND MONTH(a.tkh_mula) = ?
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, a.penganjur, a.stat_laksana
            FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            AND a.program_id = b.id
            AND a.ptj_jabatan_id_created = ?
            AND YEAR(a.tkh_tamat) = ?
            AND MONTH(a.tkh_tamat) = ?
            AND a.id NOT IN(SELECT a.id FROM espel_kursus a, hrmis_carta_organisasi b
                WHERE 1=1
                AND a.penganjur_id = b.buid
                AND a.ptj_jabatan_id_created = ?
                AND YEAR(a.tkh_mula) = ?
                AND MONTH(a.tkh_mula) = ?)) as a ORDER BY a.tkh_mula";

        $rst = $this->db->query($sql,[
            $ptj_jabatan_id,$takwim->tahun,$takwim->bulan,
            $ptj_jabatan_id,$takwim->tahun,$takwim->bulan,
            $ptj_jabatan_id,$takwim->tahun,$takwim->bulan]
        );

        if($rst->num_rows())
        {
            return $rst->result();
        }
        else
        {
            return NULL;
        }
    }

    public function sen_pengesahan_anjuaran($ptj_jabatan_id, $takwim)
    {
        $sql = "SELECT * FROM (SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, c.title as penganjur, a.stat_laksana
            FROM espel_kursus a, espel_dict_program b, hrmis_carta_organisasi c
            WHERE 1=1
            AND a.program_id = b.id
            AND a.penganjur_id = c.buid
            AND a.stat_laksana = 'L'
            AND a.ptj_jabatan_id_created = ?
            AND YEAR(a.tkh_mula) = ?
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat, a.penganjur, a.stat_laksana
            FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            AND a.program_id = b.id
            AND a.stat_laksana = 'L'
            AND a.ptj_jabatan_id_created = ?
            AND YEAR(a.tkh_tamat) = ?
            AND a.id NOT IN(SELECT a.id FROM espel_kursus a, hrmis_carta_organisasi b
                WHERE 1=1
                AND a.penganjur_id = b.buid
                AND a.stat_laksana = 'L'
                AND a.ptj_jabatan_id_created = ?
                AND YEAR(a.tkh_mula) = ?)) as a ORDER BY a.tkh_mula";

        $rst = $this->db->query($sql,[
            $ptj_jabatan_id,$takwim->tahun,
            $ptj_jabatan_id,$takwim->tahun,
            $ptj_jabatan_id,$takwim->tahun]
        );

        if($rst->num_rows())
        {
            return $rst->result();
        }
        else
        {
            return NULL;
        }
    }

    public function bil_prestasi_kelas($tahun, $bil_hari, $kelas_id)
    {
        $sql = "select a.nokp, a.kelas_id, sum(a.hari) as bil_hari from (SELECT a.nokp, c.kelas_id, a.tajuk, b.title jabatan, a.tkh_mula, a.tkh_tamat, a.hari
        FROM espel_kursus a, hrmis_carta_organisasi b, espel_profil c
        WHERE 1=1
        AND a.penganjur_id = b.buid
				AND a.nokp = c.nokp
        AND YEAR(a.tkh_mula) = $tahun
        and a.stat_hadir = 'L'
        UNION
        SELECT a.nokp, c.kelas_id, a.tajuk, a.penganjur, a.tkh_mula, a.tkh_tamat, a.hari
        FROM espel_kursus a, espel_profil c
        WHERE 1=1
				AND a.nokp = c.nokp
        AND penganjur_id = 0
        AND YEAR(tkh_mula) = $tahun
        AND stat_hadir = 'L'
        UNION
        SELECT d.nokp, d.kelas_id, a.tajuk, b.title jabatan, a.tkh_mula, a.tkh_tamat, a.hari
        FROM espel_kursus a, hrmis_carta_organisasi b, espel_permohonan_kursus c, espel_profil d
        WHERE 1=1
        AND a.penganjur_id = b.buid
        AND a.id = c.kursus_id
				AND c.nokp = d.nokp
        AND YEAR(a.tkh_mula) = $tahun
        and c.stat_hadir = 'L') as a
        where a.kelas_id = '$kelas_id'
        group by a.nokp, a.kelas_id";

        if($bil_hari == 0)
        {
            $sql .= " HAVING sum(a.hari) = 0";
        }
        elseif($bil_hari <= 7)
        {
            $mula = $bil_hari;
            $tamat = $bil_hari + 1;

            $sql .= " HAVING sum(a.hari) >= $mula AND sum(a.hari) < $tamat";
        }
        else
        {
            $sql .= " HAVING sum(a.hari) >= 8";
        }

        $rst = $this->db->query($sql);

        return $rst->num_rows();
    }

    public function sen_kursus_dicalonkan($nokp)
    {
        $sql = 'SELECT a.id, a.tajuk, a.tkh_mula, a.tkh_tamat, a.hari, a.penganjur as penganjur_luar, b.title as penganjur_dalam, a.anjuran, a.surat
            FROM espel_kursus a
            INNER JOIN espel_permohonan_kursus c on a.id = c.kursus_id
            LEFT JOIN hrmis_carta_organisasi b on a.penganjur_id = b.buid
            WHERE 1=1
            AND YEAR(a.tkh_mula) = 2017
            AND c.nokp = ?
            AND c.stat_mohon = \'L\'
            AND a.stat_laksana = \'L\'
            AND c.stat_hadir is null';
        
        return $this->db->query($sql,[$nokp])->result();
    }

    public function rancang($related_jabatan_id, $tahun, $peruntukan_id)
    {
        $sql= "SELECT
                *
                FROM
                espel_kursus
                WHERE espel_kursus.stat_laksana = 'R'
                AND peruntukan_id = $peruntukan_id
                AND ptj_jabatan_id_created in($related_jabatan_id)";
        return $this->db->query($sql);
    }

    public function laksana($related_jabatan_id, $tahun, $peruntukan_id)
    {
        $sql= "SELECT
                *
                FROM
                espel_kursus
                WHERE espel_kursus.stat_laksana = 'L'
                AND peruntukan_id = $peruntukan_id
                AND ptj_jabatan_id_created in($related_jabatan_id)";
        return $this->db->query($sql);
    }

    public function sen_peruntukan_kelas_profil($related_jabatan_id, $tahun, $peruntukan_id, $kelas_id)
    {
        $sql = "select a.id, year(b.tkh_mula) as tahun, c.nokp from espel_peruntukan a
            join espel_kursus b on b.peruntukan_id = a.id
            join espel_permohonan_kursus c on b.id = c.kursus_id
            join espel_profil d on c.nokp = d.nokp
            where b.stat_laksana = 'L'
            and c.stat_hadir = 'Y'
            and b.peruntukan_id = $peruntukan_id
            and d.kelas_id = '$kelas_id'
            and year(b.tkh_mula) = $tahun
            AND ptj_jabatan_id_created in($related_jabatan_id)";
        return $this->db->query($sql);
    }
}
