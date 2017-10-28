<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil_model extends MY_Model
{
    protected $_table = "espel_profil";
    protected $primary_key = "nokp";

    protected $belongs_to = [
        'carta_l' => [
            'model' => 'hrmis_carta_model',
            'primary_key'=>'buid',
        ],
    ];

    protected $has_many = [
        'peranan_l' => [
            'model' => 'kumpulan_profil_model',
            'primary_key'=>'profil_nokp',
        ],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getProfil($username)
    {
        $this->load->model("kumpulan_model", "kumpulan");

        $profil = $this->get_by(["nokp"=>$username,"status"=>'Y']);

        return $profil;
    }

    public function all_profil($limit, $start, $filter)
    {
        $this->load->model('hrmis_carta_model', 'hrmis_carta');
        $info = [];
        $all_jabatan = $this->hrmis_carta->as_array()->get_all();

        $sql = 'SELECT
            espel_profil.nokp,
            espel_profil.nama,
            espel_profil.gred_id,
            espel_profil.`status`,
            hrmis_skim.keterangan AS skim,
            hrmis_kumpulan.keterangan AS kumpulan,
            hrmis_carta_organisasi.title AS jabatan
            FROM
            espel_profil
            INNER JOIN hrmis_carta_organisasi ON espel_profil.jabatan_id = hrmis_carta_organisasi.buid
            INNER JOIN hrmis_kumpulan ON espel_profil.kelas_id = hrmis_kumpulan.kod
            INNER JOIN hrmis_skim ON hrmis_skim.kod = espel_profil.skim_id
            WHERE
            espel_profil.nokp <> \'admin\'';

            if($filter['nama'])
                $sql .= ' AND espel_profil.nama like \'%' . trim($filter['nama']) . '%\'';
            
            if($filter['nokp'])
                $sql .= ' AND espel_profil.nokp like \'%' . trim($filter['nokp']) . '%\'';

            if($filter['jabatan_id'] and $filter['sub_jabatan'])
            {
                $all_jabatan = flattenArray(relatedJabatan($all_jabatan,$filter['jabatan_id']));
                array_push($all_jabatan,$filter['jabatan_id']);
                $sql .= ' AND espel_profil.jabatan_id in (' . implode(",", $all_jabatan) . ')';
            }
            else
            {
                $sql .= ' AND espel_profil.jabatan_id in (' . trim($filter['jabatan_id']) . ')';
            }

            if($filter['kump_id'])
                $sql .= ' AND espel_profil.kelas_id = \'' . trim($filter['kump_id']) . '\''  ;

            if($filter['skim_id'])
                $sql .= ' AND espel_profil.skim_id = \'' . trim($filter['skim_id']) . '\'' ;

            if($filter['gred_id'])
                $sql .= ' AND espel_profil.gred_id = \'' . trim($filter['gred_id']) . '\'';
            
            $sql .= ' AND espel_profil.status = \'' . trim($filter['status']) . '\'';

            $sql .= ' ORDER BY espel_profil.nama';

            $info['count'] = $this->db->query($sql)->num_rows();
            //dd($this->db->last_query());
            $sql .= ' LIMIT ' . $start . ', ' . $limit;
        
            $info['data'] = $this->db->query($sql)->result();

        return $info;
    }

    public function sen_kump()
    {
        $data = [];
        $sql = "select distinct b.kod, b.keterangan
            from espel_profil a, hrmis_kumpulan b
            where 1=1
            and a.kelas_id = b.kod";
        $sen_kump= $this->db->query($sql)->result();

        foreach($sen_kump as $kump)
        {
            $data[]=['id' => $kump->kod,'kod' => $kump->keterangan];
        }

        return $data;
    }

    public function sen_gred($kump)
    {
        $data = [];
        $sql = "select distinct gred_id from espel_profil where skim_id = ?";
        $sen_gred = $this->db->query($sql,[$kump])->result();

        foreach($sen_gred as $gred)
        {
            $data[]=['id' => $gred->gred_id,'kod' => $gred->gred_id];
        }

        return $data;
    }

    public function sen_skim($kump)
    {
        $data = [];
        $sql = "select distinct b.kod, b.keterangan
            from espel_profil a, hrmis_skim b
            where 1=1
            and a.skim_id = b.kod
            and a.kelas_id = ?";
        $sen_skim = $this->db->query($sql,[$kump])->result();

        foreach($sen_skim as $skim)
        {
            $data[]=['id' => $skim->kod,'kod' => $skim->keterangan];
        }

        return $data;
    }

    public function statistik_kelas()
    {
        $sql = "SELECT
        Count(espel_profil.id) as bil,
        hrmis_kumpulan.keterangan,
        hrmis_kumpulan.kod
        FROM
        espel_profil
        INNER JOIN hrmis_kumpulan ON espel_profil.kelas_id = hrmis_kumpulan.kod
        GROUP BY
        hrmis_kumpulan.keterangan,
        hrmis_kumpulan.kod
        order by 1";

        return $this->db->query($sql)->result();
    }

    public function sen_pyd($username)
    {
        $data=[];
        $sql = "select nokp from espel_profil where 1=1 and nokp_ppp = ?";
        $rst = $this->db->query($sql,[$username])->result();

        foreach($rst as $row)
        {
            $data[] = $row->nokp;
        }
        return $data;
    }
}
