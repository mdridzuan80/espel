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

            if($filter['jabatan_id'] && $filter['sub_jabatan'])
            {
                $all_jabatan = flattenArray(relatedJabatan($all_jabatan,$filter['jabatan_id']));
                array_push($all_jabatan,$filter['jabatan_id']);
                $sql .= ' AND espel_profil.jabatan_id in (' . implode(",", $all_jabatan) . ')';
            }
            else
            {
                $sql .= ' AND espel_profil.jabatan_id in (' . trim($filter['jabatan_id']) . ')';
            }

            if($this->appsess->getSessionData("username") != 'admin' && $this->appsess->getSessionData("kumpulan") != '1' && $this->appsess->getSessionData("kumpulan") != '2')
            {
                $status_tree = jabatan_not_in($this->appsess->getSessionData('username'));
                if($status_tree['status_subtree'] == 'F')
                {
                    $sql .= ' AND espel_profil.jabatan_id not in (' . implode(",", $status_tree['not_in']) . ')';
                }
            }

            if($filter['kump_id'])
                $sql .= ' AND espel_profil.kelas = \'' . trim($filter['kump_id']) . '\''  ;

            if($filter['skim_id'])
                $sql .= ' AND espel_profil.skim_id = \'' . trim($filter['skim_id']) . '\'' ;

            if($filter['gred_id'])
                $sql .= ' AND espel_profil.gred_id = \'' . trim($filter['gred_id']) . '\'';
            
            $sql .= ' AND espel_profil.status = \'' . trim($filter['status']) . '\'';

            $sql .= ' ORDER BY espel_profil.nama';

            $info['count'] = $this->db->query($sql)->num_rows();
            
            $sql .= ' LIMIT ' . $start . ', ' . $limit;
        
            $info['data'] = $this->db->query($sql)->result();

        return $info;
    }

    public function all_penyelaras($limit, $start, $filter)
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
            hrmis_carta_organisasi.title AS jabatan,
            a.title AS penyelaras
            FROM
            espel_profil
            INNER JOIN hrmis_carta_organisasi ON espel_profil.jabatan_id = hrmis_carta_organisasi.buid
            INNER JOIN hrmis_kumpulan ON espel_profil.kelas_id = hrmis_kumpulan.kod
            INNER JOIN hrmis_skim ON hrmis_skim.kod = espel_profil.skim_id
            INNER JOIN espel_kumpulan_profil ON espel_kumpulan_profil.profil_nokp = espel_profil.nokp
            INNER JOIN hrmis_carta_organisasi a ON a.buid = espel_kumpulan_profil.jabatan_id
            WHERE espel_profil.nokp <> \'admin\'
            AND espel_kumpulan_profil.kumpulan_id = 3';

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
            
            $sql .= ' LIMIT ' . $start . ', ' . $limit;
        
            $info['data'] = $this->db->query($sql)->result();

        return $info;
    }

    public function all_pengecualian($limit, $start, $filter)
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
            hrmis_carta_organisasi.title AS jabatan,
            a.hari,
            round( (365-a.hari)*7/365 ) as layak
            FROM
            espel_profil
            INNER JOIN hrmis_carta_organisasi ON espel_profil.jabatan_id = hrmis_carta_organisasi.buid
            INNER JOIN hrmis_kumpulan ON espel_profil.kelas_id = hrmis_kumpulan.kod
            INNER JOIN hrmis_skim ON hrmis_skim.kod = espel_profil.skim_id
            INNER JOIN (select nokp, sum(hari) as hari from (select id, nokp, hari1 as hari from espel_sejarah_cuti
                where tahun1 = '. date('Y') .'
                union
                select id, nokp, hari2 as hari from espel_sejarah_cuti
                where tahun2 = '. date('Y') .') as kelayakan
                group by nokp
                ) as a ON a.nokp = espel_profil.nokp
            WHERE espel_profil.nokp <> \'admin\'';

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
            
            $sql .= ' LIMIT ' . $start . ', ' . $limit;
        
            $info['data'] = $this->db->query($sql)->result();

        return $info;
    }

    public function sen_kump()
    {
        $data = [];
        $sql = "select distinct b.id, b.nama
            from view_laporan_statistik_prestasi a, espel_dict_kelas b
            where 1=1
            and a.kelas = b.id";
        $sen_kump= $this->db->query($sql)->result();

        foreach($sen_kump as $kump)
        {
            $data[]=['id' => $kump->id,'kod' => $kump->nama];
        }

        return $data;
    }

    public function sen_gred($kelas, $skim)
    {
        $data = [];
        $param = [];
        $sql = "select distinct gred_id from espel_profil where 1=1";

        if($kelas)
        {
            $sql .= " AND kelas = ?";
            $param[] = $kelas;           
        }

        if($skim)
        {
            $sql .= " AND skim_id = ?";
            $param[] = $skim;
        }

        if(!$kelas && !$skim)
        {
            $sql .= ' AND id = 0';
        }

        $sql .= " order by 1";

        $sen_gred = $this->db->query($sql,$param)->result();

        foreach($sen_gred as $gred)
        {
            $data[]=['id' => $gred->gred_id,'kod' => $gred->gred_id];
        }

        return $data;
    }

    public function sen_gred2($kelas, $skim)
    {
        $data = [];
        $param = [];
        $sql = "select distinct gred_id from espel_profil where 1=1";

        if($kelas)
        {
            $sql .= " AND kelas IN (" . implode(',',$kelas) . ")";
            $param[] = $kelas;           
        }

        if($skim)
        {
            $trimm = [];
            foreach($skim as $x)
            {
                $trimm[]=trim($x);
            }
            $sql .= " AND skim_id IN (" . "'" . trim(implode("', '",$trimm)) . "'" . ")";
            $param[] = $skim;
        }

        if(!$kelas && !$skim)
        {
            $sql .= ' AND id = 0';
        }

        $sql .= " order by 1";

        $sen_gred = $this->db->query($sql,$param)->result();

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
            from view_laporan_statistik_prestasi a, hrmis_skim b
            where 1=1
            and a.skim_id = b.kod
            and a.kelas = ?
            order by b.keterangan";
        $sen_skim = $this->db->query($sql,[$kump])->result();

        foreach($sen_skim as $skim)
        {
            $data[]=['id' => $skim->kod,'kod' => $skim->keterangan];
        }

        return $data;
    }

    public function sen_skim2($kump)
    {
        $data = [];
        $sql = "select distinct b.kod, b.keterangan
            from espel_profil a, hrmis_skim b
            where 1=1
            and a.skim_id = b.kod
            and a.kelas in(" . implode(',',$kump) . ")
            order by b.keterangan";
        
        $sen_skim = $this->db->query($sql)->result();
        
        foreach($sen_skim as $skim)
        {
            $data[]=['id' => $skim->kod,'kod' => $skim->keterangan];
        }

        return $data;
    }

    public function statistik_kelas($filter)
    {
        $sql = "SELECT a.kelas, a.kumpulan,
sum(if(`a`.`kelas`,1,0)) AS `pengisian`,
sum(if(`a`.`jum_hari` = 0,1,0)) AS `kosong`,
sum(if(`a`.`jum_hari` = 1,1,0)) AS `satu`,
sum(if(`a`.`jum_hari` = 2,1,0)) AS `dua`, 
sum(if(`a`.`jum_hari` = 3,1,0)) AS `tiga`,
sum(if(`a`.`jum_hari` = 4,1,0)) AS `empat`,
sum(if(`a`.`jum_hari` = 5,1,0)) AS `lima`,
sum(if(`a`.`jum_hari` = 6,1,0)) AS `enam`,
sum(if(`a`.`jum_hari` = 7,1,0)) AS `tujuh`,
sum(if(`a`.`jum_hari` > 7,1,0)) AS `over_7`,
sum(if(`a`.`jum_hari` >= 7,1,0)) AS `over_77`
FROM (SELECT
            espel_profil.*,
            hrmis_skim.keterangan AS skim,
            espel_dict_kelas.nama AS kumpulan,
            hrmis_carta_organisasi.title AS jabatan,
            IFNULL(hadir.jum_hari,0) as jum_hari,
            IFNULL(pengecualian.jum_kecuali,0) as jum_kecuali,
 			IF(ISNULL(pengecualian.jum_kecuali),7, round( (365-pengecualian.jum_kecuali)*7/365 ) ) as kelayakan
            FROM espel_profil
            INNER JOIN hrmis_carta_organisasi ON espel_profil.jabatan_id = hrmis_carta_organisasi.buid
            INNER JOIN espel_dict_kelas ON espel_profil.kelas = espel_dict_kelas.id
            INNER JOIN hrmis_skim ON hrmis_skim.kod = espel_profil.skim_id
            LEFT JOIN (select nokp, round(sum(hari)) as jum_hari from (
SELECT espel_kursus.nokp, espel_kursus.id, espel_kursus.hari
FROM espel_kursus
LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
WHERE 1=1
AND YEAR(espel_kursus.tkh_mula) = " . $filter->tahun . "
AND espel_kursus.stat_hadir = 'L'
AND espel_kursus.nokp is not null
UNION
SELECT espel_permohonan_kursus.nokp, espel_kursus.id, espel_kursus.hari
FROM espel_kursus
INNER JOIN espel_permohonan_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
INNER JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
WHERE 1=1
AND espel_kursus.stat_laksana = 'L'
AND YEAR(espel_kursus.tkh_mula) = " . $filter->tahun . "
and espel_permohonan_kursus.stat_hadir = 'Y' 
and espel_permohonan_kursus.stat_mohon ='L'
UNION
SELECT mycpd.nokp, 'cpd' as id, round((mycpd.point/40)*7) as hari
FROM mycpd
WHERE mycpd.tahun = " . $filter->tahun . "
						) as xx
group by nokp) as hadir ON espel_profil.nokp = hadir.nokp
			LEFT JOIN (
			select nokp, sum(hari) as jum_kecuali from (select id, nokp, tahun1 as tahun,hari1 as hari from espel_sejarah_cuti
                where tahun1 = " . $filter->tahun . "
                union
                select id, nokp, tahun2,hari2 from espel_sejarah_cuti
                where tahun2 = " . $filter->tahun . ") as pengecualian
group by nokp
			) as pengecualian ON espel_profil.nokp = pengecualian.nokp
            WHERE
            espel_profil.nokp <> 'admin') as a WHERE 1=1";

        if(isset($filter->nama) && $filter->nama)
        {
            $sql .= ' and a.nama like \'%' . trim($filter->nama) . '%\'';
        }

        if(isset($filter->nokp) && $filter->nokp)
        {
            $sql .= ' and a.nokp like \'%' . trim($filter->nokp) . '%\'';
        }

        if(isset($filter->jabatan_id) && $filter->jabatan_id)
        {
            $sql .= ' and a.jabatan_id IN (' . implode(',',$filter->jabatan_id) . ')';
        }

        if(isset($filter->kelas_id) && sizeof($filter->kelas_id))
        {
            $sql .= ' and a.kelas in(' . implode(',', $filter->kelas_id) . ')';
        }

        if(isset($filter->skim_id) && $filter->skim_id[0])
        {
            $trimm = [];
            foreach($filter->skim_id as $x)
            {
                $trimm[]=trim($x);
            }
            $sql .= ' and a.skim_id in (' . "'" . trim(implode("', '",$trimm)) . "'" . ')';
        }

        if(isset($filter->gred_id) && $filter->gred_id[0])
        {
            $trimm = [];
            foreach($filter->gred_id as $x)
            {
                $trimm[]=trim($x);
            }
            $sql .= ' and a.gred_id in (' . "'" . trim(implode("', '",$trimm)) . "'" . ')';
        }

        if(isset($filter->hari) && $filter->hari)
        {
            $i = 0;
            $bil = sizeof($filter->hari);
            $sql .= " and (";
            foreach($filter->hari as $h)
            {
                $i++;
                if($h == 1)
                {
                    $sql .= ' a.jum_hari = 0';
                }
                else if($h > 1 && $h < 9)
                {
                    $sql .= ' a.jum_hari = ' . ($h-1);
                }
                else
                {
                    $sql .= ' a.jum_hari > ' . ($h-2);
                }
                
                if($i == $bil)
                {
                    $sql .= " AND ";
                }
                else
                {
                    $sql .= " OR ";
                }
                    
            }
            $sql .="1=1)";
        }

            $sql .= " group by a.kelas, a.kumpulan";
        //dd($sql);
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

    public function byBuID($buid)
    {
        $sql = "SELECT * FROM espel_profil where jabatan_id = ?";
        
        return $this->db->query($sql, [$buid]);
    }
}
