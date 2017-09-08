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
    ];

    public function __construct()
    {
        parent::__construct();
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

    public function getBilhari($nokp, $programID, $tahun)
    {
        $sql = "SELECT a.program_id, a.nokp, sum(hari) jumlah
            FROM (SELECT kursus_luar.program_id, kursus_luar.nokp, DATEDIFF(kursus_luar.tkh_tamat, kursus_luar.tkh_mula)+1 AS hari
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
}
