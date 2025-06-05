<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Anggota</li>
            <li class="active">Edit Anggota</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit Anggota</h3>
                    <hr />
                    <form action="<?= base_url('anggota/update-anggota/'.sha1($data_anggota['id_anggota'])); ?>" method="post">
                        <div class="form-group col-md-6">
                            <label>ID Anggota</label>
                            <input type="text" class="form-control" name="id_anggota" value="<?= $data_anggota['id_anggota']; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Anggota</label>
                            <input type="text" class="form-control" name="nama_anggota" value="<?= $data_anggota['nama_anggota']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="L" <?= $data_anggota['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="P" <?= $data_anggota['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>No. Telepon</label>
                            <input type="text" class="form-control" name="no_tlp" value="<?= $data_anggota['no_tlp']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" required><?= $data_anggota['alamat']; ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $data_anggota['email']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password (Kosongkan jika tidak diubah)</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password Baru">
                        </div>
                        
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= base_url('anggota/master-data-anggota'); ?>" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>