<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengguna_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPengguna($username)
    {
        $sql = "SELECT * FROM pengguna
            WHERE 1=1
            AND nokp = ?
            LIMIT 1";
        return $this->db->query($sql,[$username]);
    }

    public function getAll()
    {
        $sql = "SELECT f.id, a.nama, a.nokp, b.kod as gred, c.nama as jabatan, d.perihal as jawatan, e.perihal as status
            FROM profil a, gred b, jabatan c, jawatan d, stat_jawatan e, pengguna f
            WHERE 1=1
            AND a.gred_id = b.id
            AND a.jabatan_id = c.id
            AND a.jawatan_id = d.id
            AND a.stat_jawatan_id = e.id
            AND a.nokp = f.nokp";
        return $this->db->query($sql);
    }

    public function find($id)
    {
        $sql = "SELECT f.id, a.nama, a.nokp, b.kod as gred, c.nama as jabatan, d.perihal as jawatan, e.perihal as status, a.email
            FROM profil a, gred b, jabatan c, jawatan d, stat_jawatan e, pengguna f
            WHERE 1=1
            AND a.gred_id = b.id
            AND a.jabatan_id = c.id
            AND a.jawatan_id = d.id
            AND a.stat_jawatan_id = e.id
            AND a.nokp = f.nokp
            AND f.id = ?";
        return $this->db->query($sql,[$id]);
    }

}
