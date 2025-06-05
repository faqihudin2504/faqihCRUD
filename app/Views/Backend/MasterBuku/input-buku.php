<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>Master Data Buku</li>
            <li class="active">Input Data Buku</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Input Buku</h3>
                    <hr />
                    <form action="<?php echo base_url('buku/simpan-data-buku'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-6">
                            <label>Judul Buku</label>
                            <input type="text" class="form-control" name="judul_buku" placeholder="Masukkan Judul Buku" required="required">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" placeholder="Masukkan Nama Pengarang" required="required">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" placeholder="Masukkan Nama Penerbit" required="required">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Tahun Terbit</label>
                            <input type="text" class="form-control" name="tahun" placeholder="Masukkan Tahun Terbit" required="required" maxlength="4">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Jumlah Eksemplar</label>
                            <input type="number" class="form-control" name="jumlah_eksemplar" placeholder="Masukkan Jumlah Eksemplar" required="required" min="1">
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Kategori</label>
                            <select class="form-control" name="id_kategori" required="required">
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach($data_kategori as $kategori): ?>
                                    <option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Rak</label>
                            <select class="form-control" name="id_rak" required="required">
                                <option value="">-- Pilih Rak --</option>
                                <?php foreach($data_rak as $rak): ?>
                                    <option value="<?= $rak['id_rak']; ?>"><?= $rak['nama_rak']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan Buku"></textarea>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Cover Buku</label>
                            <input type="file" class="form-control" name="cover_buku" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                        </div>
                        <div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>E-Book (PDF)</label>
                            <input type="file" class="form-control" name="e_book" accept=".pdf">
                            <small class="text-muted">Format: PDF. Maksimal 5MB</small>
                        </div>
                        <div style="clear:both;"></div>
                        
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-danger">Batal</button>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>