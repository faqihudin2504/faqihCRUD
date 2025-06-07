<?php

namespace App\Models;
use CodeIgniter\Model;

class M_PeminjamanBuku extends Model
{
    protected $table = 'tbl_peminjaman';
    protected $primaryKey = 'no_peminjaman';
    protected $allowedFields = ['no_peminjaman', 'id_anggota', 'tgl_pinjam', 'total_pinjam', 'status_transaksi', 'status_ambil_buku'];

    public function getDataPeminjaman()
    {
        return $this->select('tbl_peminjaman.*, tbl_anggota.nama_anggota')
                    ->join('tbl_anggota', 'tbl_anggota.id_anggota = tbl_peminjaman.id_anggota')
                    ->findAll();
    }

    public function getDetailPeminjaman($no_peminjaman)
    {
        return $this->db->table('peminjaman_detail')
                        ->join('buku', 'buku.id_buku = peminjaman_detail.id_buku')
                        ->where('no_peminjaman', $no_peminjaman)
                        ->get()
                        ->getResultArray();
    }
}
