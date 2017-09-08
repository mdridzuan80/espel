<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Log_model extends MY_Model
{
    const TABLE = "log";

    public function __construct()
    {
        parent::__construct();
    }

    public function simpan($data)
    {
        $sql = "INSERT INTO " . self::TABLE . " (`nama`,`keterangan`)
            VALUES (?,?)";
        return $this->execSql($sql,$data);
    }

    public function hapus($id)
    {
        $sql = "DELETE FROM " . self::TABLE . " WHERE id = ?";
        return $this->execSql($sql,[$id]);
    }

    public function updateStatus($data,$id=NULL)
    {
        if(is_null($id))
        {
            $sql = "UPDATE " . self::TABLE . " SET status = ?";
            return $this->execSql($sql,[$data]);
        }
        else
        {
            $sql = "UPDATE " . self::TABLE . " SET status = ? WHERE id = ?";
            return $this->execSql($sql,[$data,$id]);
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . self::TABLE;
        return $this->db->query($sql);
    }

    /*public function getByNokp(nokp)
    {
        $sql = "SELECT * FROM " . self::TABLE;
        return $this->db->query($sql);
    }*/

    public function find($id)
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE id = ?";
        return $this->db->query($sql,[$id]);
    }

    public function getStatus($status)
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE status = ?";
        return $this->db->query($sql,[$status]);
    }
}
