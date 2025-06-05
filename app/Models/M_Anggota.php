<?php
namespace App\Models;

use CodeIgniter\Model;

class M_Anggota extends Model
{
    protected $table = 'tbl_anggota';
    protected $primaryKey = 'id_anggota';
    protected $allowedFields = ['id_anggota', 'nama_anggota', 'jenis_kelamin', 'no_tlp', 'alamat', 'email', 'password_anggota', 'is_delete_anggota', 'created_at', 'updated_at'];

    public function getDataAnggota($where = false)
    {
        $builder = $this->db->table($this->table);
        $builder->orderBy('nama_anggota', 'ASC');

        if ($where !== false) {
            $builder->where($where);
        }
        
        $builder->where('is_delete_anggota', '0');

        return $builder->get();
    }


    public function saveDataAnggota($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateDataAnggota($data, $where)
    {
        return $this->db->table($this->table)->where($where)->update($data);
    }

    public function autoNumber()
    {
        return $this->db->table($this->table)
            ->select('id_anggota')
            ->orderBy('id_anggota', 'DESC')
            ->limit(1)
            ->get();
    }
}