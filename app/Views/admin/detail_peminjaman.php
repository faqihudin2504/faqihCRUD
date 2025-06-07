<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-4">
    <h4>Detail Transaksi - <?= $id ?></h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Status Pinjam</th>
                <th>Perpanjangan</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detail as $d): ?>
            <tr>
                <td><?= $d['judul'] ?></td>
                <td><?= $d['status_pinjam'] ?></td>
                <td><?= $d['perpanjangan'] ?>x</td>
                <td><?= $d['tgl_kembali'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>
