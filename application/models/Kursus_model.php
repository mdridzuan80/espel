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
        $sql = "SELECT a.id, a.tajuk, b.nama jabatan, a.tkh_mula, a.tkh_tamat, a.hari
        FROM espel_kursus a, espel_dict_jabatan b
        WHERE 1=1
        AND a.penganjur_id = b.id
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
        SELECT a.id, a.tajuk, b.nama jabatan, a.tkh_mula, a.tkh_tamat, a.hari
        FROM espel_kursus a, espel_dict_jabatan b, espel_permohonan_kursus c
        WHERE 1=1
        AND a.penganjur_id = b.id
        AND a.id = c.kursus_id
        AND YEAR(a.tkh_mula) = ?
        AND a.nokp = ?
        and c.stat_hadir = 'L'
        ";
        return $this->db->query($sql,[$tahun,$nokp,$tahun,$nokp,$tahun,$nokp])->result();
    }
    public function get_all_kursus_luar_pengesahan(array $jabatanID)
    {
        $this->db->select("a.id, b.nama,d.nama jabatan, a.tajuk, c.nama as program, a.stat_hadir, a.tkh_mula, a.tkh_tamat, a.stat_soal_selidik_a, a.stat_soal_selidik_b");
        $this->db->from("espel_kursus a");
        $this->db->join("espel_profil b","a.nokp = b.nokp");
        $this->db->join("espel_dict_program c","a.program_id = c.id");
        $this->db->join("espel_dict_jabatan d","b.jabatan_id = d.id");
        $this->db->where("a.stat_hadir", "M");
        $this->db->where_in("b.jabatan_id", $jabatanID);
        $rst = $this->db->get();

        return $rst->result();
    }

    public function get_all_kursus_boranga($nokp)
    {
        $this->db->select("a.id, b.nama,d.nama jabatan, a.tajuk, c.nama as program, a.stat_hadir, a.tkh_mula, a.tkh_tamat, a.stat_soal_selidik_a, a.stat_soal_selidik_b");
        $this->db->from("espel_kursus a");
        $this->db->join("espel_profil b","a.nokp = b.nokp");
        $this->db->join("espel_dict_program c","a.program_id = c.id");
        $this->db->join("espel_dict_jabatan d","b.jabatan_id = d.id");
        $this->db->where("year(a.tkh_mula)",date("Y"));
        $this->db->where("a.stat_soal_selidik_a", "Y");
        $this->db->where("a.stat_hadir", "L");
        $this->db->where_in("b.nokp", $nokp);
        $rst = $this->db->get();

        return $rst->result();
    }

    public function get_kursus_by_program($nokp, $programID, $tahun)
    {
        $sql = "SELECT a.id, a.tajuk, b.nama jabatan, a.tkh_mula, a.tkh_tamat, a.hari, a.tempat
        FROM espel_kursus a, espel_dict_jabatan b
        WHERE 1=1
        AND a.penganjur_id = b.id
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
        SELECT a.id, a.tajuk, b.nama jabatan, a.tkh_mula, a.tkh_tamat, a.hari, a.tempat
        FROM espel_kursus a, espel_dict_jabatan b, espel_permohonan_kursus c
        WHERE 1=1
        AND a.penganjur_id = b.id
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
        $sql = "SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat FROM espel_kursus a, espel_dict_program b
            WHERE 1=1
            AND a.program_id = b.id
            AND a.ptj_jabatan_id_created = ?
            AND YEAR(a.tkh_mula) = ?
            AND MONTH(a.tkh_mula) = ?
            UNION
            SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat FROM espel_kursus a, espel_dict_program b
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

    public function takwim_day($ptj_jabatan_id, $takwim)
    {
        $tkh = date("Y-m-d",strtotime($takwim->tahun . "-" . $takwim->bulan . "-" . $takwim->hari));
        $sql = "SELECT * FROM (SELECT a.id, a.tajuk, b.nama, a.tkh_mula, a.tkh_tamat FROM espel_kursus a, espel_dict_program b
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


}
