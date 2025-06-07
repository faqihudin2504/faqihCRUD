<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Master Data Buku</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Master Data Buku
                        <a href="<?= base_url('buku/input-data-buku'); ?>"><button type="button" class="btn btn-sm btn-primary pull-right">Input Data Buku</button>
                        </a>
                    </h3>
                    <hr />
                    <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">             
                        <thead>
                            <tr>
                                <th data-sortable="true">#</th>
                                <th data-sortable="true">Judul Buku</th>
                                <th data-sortable="true">Pengarang</th>
                                <th data-sortable="true">Penerbit</th>
                                <th data-sortable="true">Tahun</th>
                                <th data-sortable="true">Jumlah</th>
                                <th data-sortable="true">Kategori</th>
                                <th data-sortable="true">Rak</th>
                                <th data-sortable="true">Cover</th>
                                <th data-sortable="true">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($data_buku as $data) { 
                            ?>
                            <tr>
                                <td><?= $no=$no+1;?></td>
                                <td><?= $data['judul_buku']; ?></td>
                                <td><?= $data['pengarang']; ?></td>
                                <td><?= $data['penerbit']; ?></td>
                                <td><?= $data['tahun']; ?></td>
                                <td><?= $data['jumlah_eksemplar']; ?></td>
                                <td>
                                    <?php 
                                        foreach($data_kategori as $kategori) {
                                            if($kategori['id_kategori'] == $data['id_kategori']) {
                                                echo $kategori['nama_kategori'];
                                                break;
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        foreach($data_rak as $rak) {
                                            if($rak['id_rak'] == $data['id_rak']) {
                                                echo $rak['nama_rak'];
                                                break;
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php if($data['cover_buku']): ?>
                                        <img src="<?= base_url('/uploads/cover_buku/'.$data['cover_buku']); ?>" width="50">
                                    <?php else: ?>
                                        <span class="text-muted">No Cover</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('buku/edit-data-buku/'.sha1($data['id_buku'])); ?>">
                                        <button type="button" class="btn btn-sm btn-success">Edit</button>
                                    </a>
                                    <a href="#" onclick="doDelete('<?= sha1($data['id_buku']); ?>')">
                                        <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div><!--/.main-->

<script type="text/javascript">
    function doDelete(idDelete){
        swal({
            title : "Hapus Data Buku?",
            text : "Data ini akan terhapus secara permanen!!",
            icon : "warning",
            buttons : true,
            dangerMode : false,
        })
        .then((ok) => {
            if(ok){
                window.location.href = '<?= base_url(); ?>/buku/hapus-data-buku/' + idDelete;
            }
            else{
                $(this).removeAttr('disabled')
            }
        })
    }
</script>