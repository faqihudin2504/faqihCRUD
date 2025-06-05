<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Anggota</li>
            <li class="active">Tambah Anggota</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Tambah Anggota</h3>
                    <hr />
                    <form action="<?= base_url('anggota/simpan-anggota'); ?>" method="post">
                        <div class="form-group col-md-6">
                            <label>ID Anggota</label>
                            <input type="text" class="form-control" name="id_anggota" value="<?= $id_anggota_auto; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Anggota</label>
                            <input type="text" class="form-control" name="nama_anggota" placeholder="Masukkan Nama Anggota" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>No. Telepon</label>
                            <input type="text" class="form-control" name="no_tlp" placeholder="Masukkan No. Telepon" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" required></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?= base_url('anggota/master-data-anggota'); ?>" class="btn btn-default">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>