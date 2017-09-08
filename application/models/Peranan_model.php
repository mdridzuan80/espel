<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peranan_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDefaultPeranan($username)
    {
        $sql = "SELECT * FROM kumpulan_pengguna a, kumpulan b
            WHERE 1=1
            AND a.kumpulan_id = b.id
            AND a.pengguna_id = ?
            ORDER BY a.kumpulan_id DESC
            LIMIT 1";
        return $this->db->query($sql, [$id]);
    }

    public function getListPerananAvailable($id,$currentPeranan)
    {
        $sql = "SELECT * FROM kumpulan_pengguna a, kumpulan b
            WHERE 1=1
            AND a.kumpulan_id = b.id
            AND a.pengguna_id = ?
            AND a.kumpulan_id <> ?
            ORDER BY a.id DESC";
        return $this->db->query($sql, [$id, $currentPeranan]);
    }

    public function getListPerananJoinAvailable($id)
    {
        $sql = "SELECT a.id, b.nama, b.id as kump_id FROM kumpulan_pengguna a, kumpulan b
            WHERE 1=1
            AND a.kumpulan_id = b.id
            AND a.pengguna_id = ?
            ORDER BY b.id ASC";
        return $this->db->query($sql, [$id]);
    }

    public function getListPerananUnjoinAvailable($pengguna_id)
    {
        $sql = "SELECT * FROM kumpulan
            WHERE 1=1
            AND id not in(SELECT kumpulan_id FROM kumpulan_pengguna
            WHERE 1=1
            AND pengguna_id = ?)";
        return $this->db->query($sql, [$pengguna_id]);
    }

    public function getPerananOwner($id, $peranan_id)
    {
        $sql = "SELECT a.id, b.nama, b.id as kump_id FROM kumpulan_pengguna a, kumpulan b
            WHERE 1=1
            AND a.kumpulan_id = b.id
            AND a.pengguna_id = ?
            AND a.kumpulan_id = ?
            ORDER BY b.id ASC";
        return $this->db->query($sql, [$id, $peranan_id]);
    }

    public function hapus($id)
    {
        $sql = "DELETE FROM kumpulan_pengguna WHERE id = ?";
        return $this->execSql($sql,[$id]);
    }

    public function subscribePeranan($data)
    {
        $sql = "INSERT INTO kumpulan_pengguna (`kumpulan_id`,`pengguna_id`)
            VALUES (?,?)";
        return $this->execSql($sql,$data);
    }

    public function hasPeranan($nokp, $peranan)
    {
        $db = $this->db;
        $db->from("kumpulan_pengguna");
        $db->join("pengguna", "pengguna.id=kumpulan_pengguna.pengguna_id");
        $db->join("kumpulan", "kumpulan.id=kumpulan_pengguna.kumpulan_id");
        $db->where_in("kumpulan.kod",$peranan);
        $db->where("pengguna.nokp",$nokp);
        return $db->get()->num_rows() > 0;
    }
}
