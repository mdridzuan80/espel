<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mohon_kursus_model extends MY_Model
{
    protected $_table = "espel_permohonan_kursus";

    public function get_permohonan($nokp)
    {
        $sql = "SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title AS anjuran_dalam, espel_kursus.penganjur AS anjuran_luar, espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_permohonan_kursus.stat_mohon
            FROM espel_permohonan_kursus
            INNER JOIN espel_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
            LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
            WHERE 1=1
            AND YEAR(espel_kursus.tkh_mula) = ?
            AND espel_permohonan_kursus.nokp = ?
            AND espel_permohonan_kursus.role = 'PENGGUNA'
            UNION
            SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title as anjuran_dalam,
            espel_kursus.penganjur as anjuran_luar, espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_kursus.stat_hadir
            FROM espel_kursus
            LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
            WHERE 1=1
            AND YEAR(espel_kursus.tkh_mula) = ?
            AND espel_kursus.nokp = ?";

        return $this->db->query($sql, [date('Y'), $nokp, date('Y'), $nokp])->result();
    }

    public function get_dicalonkan($nokp)
    {
        $sql = "SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title AS anjuran_dalam, espel_kursus.penganjur AS anjuran_luar,
            espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_permohonan_kursus.stat_mohon, espel_permohonan_kursus.nokp, espel_permohonan_kursus.tkh,
            espel_kursus.surat,espel_kursus.stat_laksana,espel_permohonan_kursus.stat_hadir
            FROM espel_permohonan_kursus
            INNER JOIN espel_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
            LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
            WHERE 1=1
            AND espel_permohonan_kursus.nokp = ?
            AND espel_permohonan_kursus.role = 'PTJ'";

        return $this->db->query($sql, [$nokp])->result();
    }

    public function get_permohonan_jabatan($jabatan_id)
    {
        $this->db->select("b.id, b.tajuk, c.nama, b.tkh_mula, b.tkh_tamat, a.tkh, c.nama jabatan, count(a.id) total");
        $this->db->from($this->_table . " a");
        $this->db->join("espel_kursus b", "a.kursus_id = b.id");
        $this->db->join("espel_dict_jabatan c", "b.penganjur_id = c.id");
        $this->db->where("b.ptj_jabatan_id_created", $jabatan_id);
        $this->db->where("b.stat_laksana", 'R');
        return $this->db->get()->result();
    }

    public function get_count_sah($kursus_id)
    {
        $sql = "select * from espel_permohonan_kursus where 1=1 and kursus_id = ? and stat_hadir is null ";
        return $this->db->query($sql, [$kursus_id])->num_rows();
    }

    public function get_calon($Kursus_id, $filter)
    {
        $this->load->model('hrmis_carta_model', 'hrmis_carta');
        $this->load->model('kumpulan_profil_model', 'kumpulan_profil');

        $all_jabatan = $this->hrmis_carta->as_array()->get_all();
        $jabatan_id = $this->kumpulan_profil->get_by(["profil_nokp" => $this->appsess->getSessionData("username"), "kumpulan_id" => 3])->jabatan_id;

        $this->db->select('a.id, b.nama, b.gred_id as gred, e.nama as kumpulan, c.title as jabatan, d.tkh_mula, d.stat_jabatan, d.stat_laksana, a.stat_mohon, a.role, a.stat_hadir');
        $this->db->from($this->_table . ' a');
        $this->db->join('espel_kursus d', 'a.kursus_id = d.id');
        $this->db->join('view_laporan_statistik_prestasi b', 'a.nokp = b.nokp', 'left');
        $this->db->join('hrmis_carta_organisasi c', 'b.jabatan_id = c.buid');
        $this->db->join('espel_dict_kelas e', 'b.kelas = e.id');
        $this->db->join('hrmis_skim f', 'b.skim_id = f.kod', 'left');
        $this->db->where('a.kursus_id', $Kursus_id);
        
        /* if($filter->nama)
        {
            $this->db->like('b.nama', $filter->nama);
        }

        if($filter->nokp)
        {
            $this->db->like('b.nokp', $filter->nokp);
        }

        if($filter->jabatan_id && $filter->sub_jabatan)
        {
            $all_jabatan = flattenArray(relatedJabatan($all_jabatan,$filter->jabatan_id));
            array_push($all_jabatan,$filter->jabatan_id);
            $this->db->where_in('b.jabatan_id',$all_jabatan);
        }
        else
        {
            if($filter->jabatan_id)
            {
                $this->db->where('b.jabatan_id',$filter->jabatan_id);
            }
        }

        if(isset($filter->kumpulan) && $filter->kumpulan)
        {
            $this->db->where('b.kelas',$filter->kumpulan);
        }

        if(isset($filter->skim) && $filter->skim)
        {
            $this->db->where('b.skim_id',$filter->skim);
        }

        if(isset($filter->gred) && $filter->gred)
        {
            $this->db->where('b.gred_id',$filter->gred);
        } */
        $rst = $this->db->get();
        //dd($this->db->last_query());
        return $rst->result();
    }

    public function get_pencalonan($kursus_id, $filter)
    {
        $this->load->model('hrmis_carta_model', 'hrmis_carta');
        $all_jabatan = $this->hrmis_carta->as_array()->get_all();

        $sql = "select * from (
                SELECT
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
AND YEAR(espel_kursus.tkh_mula) = " . date('Y') . "
AND espel_kursus.stat_hadir = 'L'
AND espel_kursus.nokp is not null
UNION
SELECT espel_permohonan_kursus.nokp, espel_kursus.id, espel_kursus.hari
FROM espel_kursus
INNER JOIN espel_permohonan_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
INNER JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
WHERE 1=1
AND espel_kursus.stat_laksana = 'L'
AND YEAR(espel_kursus.tkh_mula) = " . date('Y') . "
and espel_permohonan_kursus.stat_hadir = 'Y' 
and espel_permohonan_kursus.stat_mohon ='L'
UNION
SELECT mycpd.nokp, 'cpd' as id, round((sum(mycpd.point)/40)*7) as hari
FROM mycpd
WHERE mycpd.tahun = " . date('Y') . " group by mycpd.nokp, id
						) as xx
group by nokp) as hadir ON espel_profil.nokp = hadir.nokp
			LEFT JOIN (
			select nokp, sum(hari) as jum_kecuali from (select id, nokp, tahun1 as tahun,hari1 as hari from espel_sejarah_cuti
                where tahun1 = " . date('Y') . "
                union
                select id, nokp, tahun2,hari2 from espel_sejarah_cuti
                where tahun2 = " . date('Y') . ") as pengecualian
group by nokp
			) as pengecualian ON espel_profil.nokp = pengecualian.nokp
            WHERE
            espel_profil.nokp <> 'admin') as a WHERE 1=1
                AND nokp NOT IN(select nokp from espel_permohonan_kursus where kursus_id = " . $kursus_id . ")";

        if ($filter->nama) {
            $sql .= ' and a.nama like \'%' . $filter->nama . '%\'';
        }

        if ($filter->nokp) {
            $sql .= ' and a.nokp like \'%' . $filter->nokp . '%\'';
        }

        if ($filter->jabatan_id && $filter->sub_jabatan) {
            $all_jabatan = flattenArray(relatedJabatan($all_jabatan, $filter->jabatan_id));
            array_push($all_jabatan, $filter->jabatan_id);
            $sql .= ' and a.jabatan_id in(' . implode(',', $all_jabatan) . ')';
        } else {
            $sql .= ' and a.jabatan_id in(' . $filter->jabatan_id . ')';
        }

        if (isset($filter->kumpulan) && $filter->kumpulan) {
            $sql .= ' and a.kelas = ' . $filter->kumpulan;
        }

        if (isset($filter->gred) && $filter->gred) {
            $sql .= ' and a.gred_id = ' . $filter->gred;
        }

        if (isset($filter->hari) && $filter->hari) {
            if ($filter->hari == 1) {
                $sql .= ' and a.jum_hari = 0 ';
            } else if ($filter->hari > 1 && $filter->hari < 9) {
                $sql .= ' and a.jum_hari = ' . ($filter->hari - 1);
            } else {
                $sql .= ' and a.jum_hari > ' . ($filter->hari - 2);
            }

        }

        $this->db->cache_on();
        $rst = $this->db->query($sql);
        $this->db->cache_off();

        return $rst->result();
    }

    public function sen_prestasi($filter)
    {
        $sql = 'select * from (SELECT a.nokp, a.nama, b.title jabatan, hk.keterangan kumpulan, hs.keterangan skim, a.jabatan_id, a.kelas_id, a.skim_id, a.gred_id, 0 as hari
                FROM espel_profil a, hrmis_carta_organisasi b, hrmis_kumpulan hk, hrmis_skim hs
                WHERE 1=1
                AND a.jabatan_id = b.buid
                AND a.kelas_id = hk.kod
                AND a.skim_id = hs.kod
                AND a.nokp NOT IN (SELECT nokp FROM espel_kursus WHERE YEAR(tkh_mula) = ' . $filter->tahun . ' AND stat_hadir = \'L\' AND nokp is not null)
                UNION
                SELECT a.nokp, a.nama, c.title jabatan, hk.keterangan kumpulan, hs.keterangan skim, a.jabatan_id, a.kelas_id, a.skim_id, a.gred_id, sum(b.hari) as hari
                FROM espel_profil a, espel_kursus b, hrmis_carta_organisasi c, hrmis_kumpulan hk, hrmis_skim hs
                WHERE 1=1
                AND a.nokp = b.nokp
                AND a.jabatan_id = c.buid
                AND a.kelas_id = hk.kod
                AND a.skim_id = hs.kod
                AND YEAR(b.tkh_mula) = ' . $filter->tahun . ' AND b.stat_hadir = \'L\'
                GROUP BY a.nokp, a.nama, c.title, hk.keterangan, hs.keterangan, a.jabatan_id, a.kelas_id, a.skim_id, a.gred_id) as a WHERE 1=1';

        if (isset($filter->jabatan_id) && $filter->jabatan_id) {
            $sql .= ' and a.jabatan_id IN (' . implode(',', $filter->jabatan_id) . ')';
        }

        if (isset($filter->kelas_id) && $filter->kelas_id) {
            $sql .= ' and a.kelas_id = \'' . $filter->kelas_id . '\'';
        }

        if (isset($filter->skim_id) && $filter->skim_id) {
            $sql .= ' and a.skim_id = \'' . $filter->skim_id . '\'';
        }

        if (isset($filter->gred_id) && $filter->gred_id) {
            $sql .= ' and a.gred_id = \'' . $filter->gred_id . '\'';
        }

        if (isset($filter->hari) && $filter->hari) {
            if ($filter->hari == 1) {
                $sql .= ' and a.hari < ' . $filter->hari;
            } else {
                $sql .= ' and a.hari >= ' . $filter->hari;
            }
        }

        $sql .= " ORDER BY a.nama";

        $rst = $this->db->query($sql);

        return $rst->result();
    }

    public function sen_prestasi_individu($filter)
    {
        $sql = "SELECT
            espel_profil.nokp,
            espel_profil.nama,
            espel_profil.gred_id,
            espel_profil.`status`,
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
LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
WHERE 1=1
AND espel_kursus.stat_laksana = 'L'
AND YEAR(espel_kursus.tkh_mula) = " . $filter->tahun . "
and espel_permohonan_kursus.stat_hadir = 'Y' 
and espel_permohonan_kursus.stat_mohon ='L'
UNION
SELECT mycpd.nokp, 'cpd' as id, round((sum(mycpd.point)/40)*7) as hari
FROM mycpd
WHERE mycpd.tahun = " . $filter->tahun . " group by mycpd.nokp, id
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
            espel_profil.nokp <> 'admin' and espel_profil.status = 'Y'";
        if (isset($filter->nama) && $filter->nama) {
            $sql .= ' and espel_profil.nama like \'%' . trim($filter->nama) . '%\'';
        }

        if (isset($filter->nokp) && $filter->nokp) {
            $sql .= ' and espel_profil.nokp like \'%' . trim($filter->nokp) . '%\'';
        }

        if (isset($filter->jabatan_id) && $filter->jabatan_id) {
            $sql .= ' and espel_profil.jabatan_id IN (' . implode(',', $filter->jabatan_id) . ')';
        }

        if (isset($filter->kelas_id) && $filter->kelas_id) {
            $sql .= ' and espel_profil.kelas = \'' . $filter->kelas_id . '\'';
        }

        if (isset($filter->skim_id) && $filter->skim_id) {
            $sql .= ' and espel_profil.skim_id = \'' . $filter->skim_id . '\'';
        }

        if (isset($filter->gred_id) && $filter->gred_id) {
            $sql .= ' and espel_profil.gred_id = \'' . $filter->gred_id . '\'';
        }

        if (isset($filter->hari) && $filter->hari) {
            if ($filter->hari == 1) {
                $sql .= ' and (hadir.jum_hari is null or hadir.jum_hari = \'\')';
            } else if ($filter->hari > 1 && $filter->hari < 9) {
                $sql .= ' and hadir.jum_hari = ' . ($filter->hari - 1);
            } else {
                $sql .= ' and hadir.jum_hari > ' . ($filter->hari - 2);
            }
        }

        $sql .= " ORDER BY espel_profil.nama";

        $rst = $this->db->query($sql);

        return $rst->result();
    }

    public function jawapanByPengguna($kursus_id, $jawapan, $nokp)
    {
        $this->db->set('stat_mohon', $jawapan);
        $this->where('kursus_id', $kursus_id);
        $this->where('nokp', $nokp);

        return $this->db->update('espel_permohonan_kursus');
    }

    public function SenaraiKursusBerdaftar($nokp, $takwim, $kursus_id)
    {
        if ($kursus_id) {
            $sql = "SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title AS anjuran_dalam, espel_kursus.penganjur AS anjuran_luar,
						espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_permohonan_kursus.stat_mohon
            FROM espel_permohonan_kursus
            INNER JOIN espel_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
            LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
            WHERE 1=1
            AND YEAR(espel_kursus.tkh_mula) = ?
            AND espel_permohonan_kursus.nokp = ?
            AND espel_kursus.id <> ?
            AND espel_permohonan_kursus.role = 'PENGGUNA'
            UNION
            SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title as anjuran_dalam,
            espel_kursus.penganjur as anjuran_luar, espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_kursus.stat_hadir
            FROM espel_kursus
            LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
            WHERE 1=1
            AND YEAR(espel_kursus.tkh_mula) = ?
            AND espel_kursus.nokp = ?
            AND espel_kursus.id <> ?
            UNION
            SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title AS anjuran_dalam, espel_kursus.penganjur AS anjuran_luar,
                        espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_permohonan_kursus.stat_mohon
                        FROM espel_permohonan_kursus
                        INNER JOIN espel_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
                        LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
                        WHERE 1=1
                        AND YEAR(espel_kursus.tkh_mula) =?
                        AND espel_permohonan_kursus.nokp = ?
                        AND espel_kursus.id <> ?
                        AND espel_permohonan_kursus.role = 'PTJ'";

            $rst = $this->db->query($sql, [
                $takwim->tahun, $nokp, $kursus_id,
                $takwim->tahun, $nokp, $kursus_id,
                $takwim->tahun, $nokp, $kursus_id,
            ]);
        } else {
            $sql = "SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title AS anjuran_dalam, espel_kursus.penganjur AS anjuran_luar,
                            espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_permohonan_kursus.stat_mohon
                FROM espel_permohonan_kursus
                INNER JOIN espel_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
                LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
                WHERE 1=1
                AND YEAR(espel_kursus.tkh_mula) = ?
                AND espel_permohonan_kursus.nokp = ?
                AND espel_permohonan_kursus.role = 'PENGGUNA'
                UNION
                SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title as anjuran_dalam,
                espel_kursus.penganjur as anjuran_luar, espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_kursus.stat_hadir
                FROM espel_kursus
                LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
                WHERE 1=1
                AND YEAR(espel_kursus.tkh_mula) = ?
                AND espel_kursus.nokp = ?
                UNION
                SELECT espel_kursus.id, espel_kursus.tajuk, espel_kursus.anjuran, hrmis_carta_organisasi.title AS anjuran_dalam, espel_kursus.penganjur AS anjuran_luar,
                            espel_kursus.tkh_mula, espel_kursus.tkh_tamat, espel_permohonan_kursus.stat_mohon
                            FROM espel_permohonan_kursus
                            INNER JOIN espel_kursus ON espel_kursus.id = espel_permohonan_kursus.kursus_id
                            LEFT JOIN hrmis_carta_organisasi ON espel_kursus.penganjur_id = hrmis_carta_organisasi.buid
                            WHERE 1=1
                            AND YEAR(espel_kursus.tkh_mula) =?
                            AND espel_permohonan_kursus.nokp = ?
                            AND espel_permohonan_kursus.role = 'PTJ'";

            $rst = $this->db->query($sql, [
                $takwim->tahun, $nokp,
                $takwim->tahun, $nokp,
                $takwim->tahun, $nokp,
            ]);
        }

        if (!$rst->num_rows())
            return [];

        return $rst->result_array();

    }
}
