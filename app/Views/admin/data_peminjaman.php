<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-4">
    <h4>Transaksi Peminjaman Buku</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Peminjaman</th>
                <th>Nama Anggota</th>
                <th>Tanggal Peminjaman</th>
                <th>Total Buku Yang Dipinjam</th>
                <th>Status Transaksi</th>
                <th>Status Ambil Buku</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peminjaman as $p): ?>
            <tr>
                <td><?= $p['no_peminjaman'] ?></td>
                <td><?= $p['nama'] ?></td>
                <td><?= $p['tgl_pinjam'] ?></td>
                <td><?= $p['total_pinjam'] ?></td>
                <td><span class="badge bg-warning text-dark"><?= $p['status_transaksi'] ?></span></td>
                <td><?= $p['status_ambil_buku'] ?></td>
                <td>
                    <a href="<?= base_url('admin/detail-transaksi/' . $p['no_peminjaman']) ?>" class="btn btn-primary btn-sm">Lihat Detail</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>
