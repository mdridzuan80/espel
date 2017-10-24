<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peruntukan_model extends MY_Model
{
    protected $_table = "espel_peruntukan";

    protected $belongs_to = [
        'jabatan' => [
            'model' => 'jabatan_model',
            'primary_key'=>'jabatan_id',
        ],
        'jns_peruntukan' => [
            'model' => 'jnsperuntukan_model',
            'primary_key'=>'jns_peruntukan_id',
        ],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function peruntukan_semasa($peruntukan)
    {
        $this->db->select("sum(a.jumlah) jumlah ");
        $this->db->from($this->_table . " a");
        $this->db->where("YEAR(a.tarikh)", date( 'Y',strtotime($peruntukan->tarikh) ) );
        $this->db->where("a.jabatan_id", $peruntukan->jabatan_id);
        $this->db->where("a.jns_peruntukan_id", $peruntukan->jns_peruntukan_id);
        return $this->db->get()->row()->jumlah;
    }

    public function sen_transaksi($peruntukan)
    {
        $this->db->from($this->_table . " a");
        $this->db->where("YEAR(a.tarikh)", date( 'Y',strtotime($peruntukan->tarikh) ) );
        $this->db->where("a.jabatan_id", $peruntukan->jabatan_id);
        $this->db->where("a.jns_peruntukan_id", $peruntukan->jns_peruntukan_id);
        $this->db->order_by("a.tarikh");
        return $this->db->get()->result();
    }

    public function dropdown_peruntukan($jabatanId, $tahun)
    {
        $this->db->select("b.id, b.nama");
        $this->db->from($this->_table . " a");
        $this->db->join("espel_dict_jns_peruntukan b", "a.jns_peruntukan_id=b.id");
        $this->db->where("YEAR(a.tarikh)", $tahun );
        $this->db->where("a.jabatan_id", $jabatanId);
        $this->db->group_by(["b.id","b.nama"]);
        return $this->db->get()->result();
    }

    public function jabatan_has_peruntukan($tahun)
    {
        $data = [];
        $sql = 'SELECT distinct
            hrmis_carta_organisasi.buid
            FROM
            hrmis_carta_organisasi
            INNER JOIN espel_peruntukan ON espel_peruntukan.jabatan_id = hrmis_carta_organisasi.buid
            WHERE
            year(espel_peruntukan.tarikh) = ?
            ';
        $rst = $this->db->query($sql,[$tahun]);

        if($rst->num_rows())
        {
            foreach($rst->result() as $row)
            {
                $data[] = $row->buid;
            }
        }

        return $data;
    }

    public function prestasi($tahun, $jabatan_id)
    {
        $sql = "SELECT
            espel_dict_jns_peruntukan.id as jns_peruntukan_id,
            espel_dict_jns_peruntukan.nama,
            hrmis_carta_organisasi.title,
            Sum(espel_peruntukan.jumlah) as jumlah
            FROM
            espel_peruntukan
            INNER JOIN hrmis_carta_organisasi ON espel_peruntukan.jabatan_id = hrmis_carta_organisasi.buid
            INNER JOIN espel_dict_jns_peruntukan ON espel_peruntukan.jns_peruntukan_id = espel_dict_jns_peruntukan.id
            WHERE
            year(espel_peruntukan.tarikh) = ?
            AND
            espel_peruntukan.jabatan_id = ?
            GROUP BY
            hrmis_carta_organisasi.title,
            espel_dict_jns_peruntukan.nama";

        return $this->db->query($sql,[$tahun,$jabatan_id])->result();
    }

    public function belanja($jns_peruntukan_id, $jabatan_id, $tahun)
    {
         $sql = "SELECT
            sum(espel_belanja.jumlah) as jumlah,
            espel_kursus.peruntukan_id,
            espel_kursus.ptj_jabatan_id_created,
            espel_kursus.stat_laksana
            FROM
            espel_kursus
            INNER JOIN espel_belanja ON espel_belanja.kursus_id = espel_kursus.id
            WHERE espel_kursus.stat_laksana = 'L'
            AND espel_belanja.stat_byr = 'S'
            AND year(espel_belanja.tkh_lo) = $tahun
            AND espel_kursus.ptj_jabatan_id_created IN ($jabatan_id)
            AND espel_kursus.peruntukan_id = $jns_peruntukan_id
            GROUP BY espel_kursus.peruntukan_id,
            espel_kursus.ptj_jabatan_id_created,
            espel_kursus.stat_laksana";
        
        $rst = $this->db->query($sql);

        if($rst->num_rows())
        {
            return $this->db->query($sql)->row()->jumlah;
        }
        else
        {
            return 0;
        }
    }

    public function tanggungan($jns_peruntukan_id, $jabatan_id, $tahun)
    {
         $sql = "SELECT
            sum(espel_belanja.jumlah) as jumlah,
            espel_kursus.peruntukan_id,
            espel_kursus.ptj_jabatan_id_created,
            espel_kursus.stat_laksana
            FROM
            espel_kursus
            INNER JOIN espel_belanja ON espel_belanja.kursus_id = espel_kursus.id
            WHERE espel_kursus.stat_laksana = 'L'
            AND espel_belanja.stat_byr = 'T'
            AND year(espel_belanja.tkh_lo) = $tahun
            AND espel_kursus.ptj_jabatan_id_created IN ($jabatan_id)
            AND espel_kursus.peruntukan_id = $jns_peruntukan_id
            GROUP BY espel_kursus.peruntukan_id,
            espel_kursus.ptj_jabatan_id_created,
            espel_kursus.stat_laksana";
        
        $rst = $this->db->query($sql);

        if($rst->num_rows())
        {
            return $this->db->query($sql)->row()->jumlah;
        }
        else
        {
            return 0;
        }
    }

    public function dropdown_pengguna_peruntukan($tahun)
    {
        $sql = 'SELECT
            espel_peruntukan.id,
            espel_dict_jns_peruntukan.nama,
            espel_dict_jns_peruntukan.keterangan,
            year(tarikh) AS tahun
            FROM
            espel_peruntukan
            INNER JOIN espel_dict_jns_peruntukan ON espel_peruntukan.jns_peruntukan_id = espel_dict_jns_peruntukan.id
            where 1=1
            and year(tarikh) = ?';
        return $this->db->query($sql,[$tahun])->result();
    }

    public function get_peruntukan_related()
    {
        $sql = 'select distinct a.buid, a.parent_buid, b.id as peruntukan, year(b.tarikh) as tahun from hrmis_carta_organisasi a
            left join espel_peruntukan b on a.buid = b.jabatan_id';
        return $this->db->query($sql)->result_array();
    }
}
