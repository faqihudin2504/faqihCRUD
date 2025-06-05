<?php
namespace App\Models;

use CodeIgniter\Model;

class M_Peminjaman extends Model
{
    protected $table = 'tbl_peminjaman';
    protected $tableTmp = 'tbl_temp_peminjaman';
    protected $tableDetail = 'tbl_detail_peminjaman';

    public function getDataPeminjaman($where = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->orderBy('no_peminjaman', 'DESC');

        if ($where !== false) {
            $builder->where($where);
        }

        return $builder->get();
    }

    public function getDataPeminjamanJoin($where = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota', 'LEFT');
        $builder->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin', 'LEFT');
        $builder->orderBy('tbl_peminjaman.no_peminjaman', 'DESC');

        if ($where !== false) {
            $builder->where($where);
        }

        return $builder->get();
    }

    public function getDataTemp($where = false)
    {
        $builder = $this->db->table($this->tableTmp);
        $builder->select('*');

        if ($where !== false) {
            $builder->where($where);
        }

        return $builder->get();
    }

    public function getDataTempJoin($where = false)
    {
        $builder = $this->db->table($this->tableTmp);
        $builder->select('*');
        $builder->join('tbl_buku', 'tbl_buku.id_buku = tbl_temp_peminjaman.id_buku', 'LEFT');

        if ($where !== false) {
            $builder->where($where);
        }

        return $builder->get();
    }

    public function saveDataPeminjaman($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function saveDataTemp($data)
    {
        return $this->db->table($this->tableTmp)->insert($data);
    }

    public function saveDataDetail($data)
    {
        return $this->db->table($this->tableDetail)->insert($data);
    }

    public function updateDataPeminjaman($data, $where)
    {
        return $this->db->table($this->table)->where($where)->update($data);
    }

    public function updateDataDetail($data, $where)
    {
        return $this->db->table($this->tableDetail)->where($where)->update($data);
    }

    public function hapusDataTemp($where)
    {
        return $this->db->table($this->tableTmp)->delete($where);
    }
}
?>