<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Buku</li>
            <li class="active">Edit Data Buku</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit Buku</h3>
                    <hr />
                    <form action="<?php echo base_url('buku/update-data-buku'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-6">
                            <label>Judul Buku</label>
                            <input type="text" class="form-control" name="judul_buku" placeholder="Masukkan Judul Buku" value="<?= $data_buku['judul_buku']; ?>" required="required">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" placeholder="Masukkan Nama Pengarang" value="<?= $data_buku['pengarang']; ?>" required="required">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" placeholder="Masukkan Nama Penerbit" value="<?= $data_buku['penerbit']; ?>" required="required">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Tahun Terbit</label>
                            <input type="text" class="form-control" name="tahun" placeholder="Masukkan Tahun Terbit" value="<?= $data_buku['tahun']; ?>" required="required" maxlength="4">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Jumlah Eksemplar</label>
                            <input type="number" class="form-control" name="jumlah_eksemplar" placeholder="Masukkan Jumlah Eksemplar" value="<?= $data_buku['jumlah_eksemplar']; ?>" required="required" min="1">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Kategori</label>
                            <select class="form-control" name="id_kategori" required="required">
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach($data_kategori as $kategori): ?>
                                    <option value="<?= $kategori['id_kategori']; ?>" <?= ($kategori['id_kategori'] == $data_buku['id_kategori']) ? 'selected' : ''; ?>>
                                        <?= $kategori['nama_kategori']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Rak</label>
                            <select class="form-control" name="id_rak" required="required">
                                <option value="">-- Pilih Rak --</option>
                                <?php foreach($data_rak as $rak): ?>
                                    <option value="<?= $rak['id_rak']; ?>" <?= ($rak['id_rak'] == $data_buku['id_rak']) ? 'selected' : ''; ?>>
                                        <?= $rak['nama_rak']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan Buku"><?= $data_buku['keterangan']; ?></textarea>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Cover Buku Saat Ini</label><br>
                            <?php if($data_buku['cover_buku']): ?>
                                <img src="<?= base_url('uploads/cover_buku/'.$data_buku['cover_buku']); ?>" width="100" class="img-thumbnail">
                            <?php else: ?>
                                <span class="text-muted">Tidak ada cover</span>
                            <?php endif; ?>
                            <br><br>
                            <label>Ubah Cover Buku</label>
                            <input type="file" class="form-control" name="cover_buku" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah cover</small>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>E-Book Saat Ini</label><br>
                            <?php if($data_buku['e_book']): ?>
                                <span><?= $data_buku['e_book']; ?></span>
                            <?php else: ?>
                                <span class="text-muted">Tidak ada e-book</span>
                            <?php endif; ?>
                            <br><br>
                            <label>Ubah E-Book (PDF)</label>
                            <input type="file" class="form-control" name="e_book" accept=".pdf">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah e-book</small>
                        </div>
                        <div style="clear:both;"></div>
                        
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= base_url('buku/master-data-buku'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>