<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Master Data Anggota</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Master Data Anggota
                        <a href="<?= base_url('anggota/input-anggota'); ?>"><button type="button" class="btn btn-sm btn-primary pull-right">Tambah Anggota</button>
                        </a>
                    </h3>
                    <hr />
                    <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">             
                        <thead>
                            <tr>
                                <th data-sortable="true">#</th>
                                <th data-sortable="true">ID Anggota</th>
                                <th data-sortable="true">Nama Anggota</th>
                                <th data-sortable="true">Jenis Kelamin</th>
                                <th data-sortable="true">No. Telepon</th>
                                <th data-sortable="true">Email</th>
                                <th data-sortable="true">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($data_anggota as $data) { 
                            ?>
                            <tr>
                                <td><?= ++$no; ?></td>
                                <td><?= $data['id_anggota']; ?></td>
                                <td><?= $data['nama_anggota']; ?></td>
                                <td><?= $data['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                <td><?= $data['no_tlp']; ?></td>
                                <td><?= $data['email']; ?></td>
                                <td>
                                    <?php if (session()->get('ses_level') == "1" || session()->get('ses_level') == "2") { ?>
                                    <a href="<?= base_url('anggota/edit-anggota/'.sha1($data['id_anggota']));?>"><button type="button" class="btn btn-sm btn-success">Edit</button></a>
                                    <a href="#" onclick="doDelete('<?= sha1($data['id_anggota']);?>')"><button type="button" class="btn btn-sm btn-danger">Hapus</button></a>
                                    <?php } else { echo "#"; } ?>
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
            title: "Hapus Data Anggota?",
            text: "Data ini akan terhapus secara permanen!!",
            icon: "warning",
            buttons: true,
            dangerMode: false,
        })
        .then((ok) => {
            if(ok){
                window.location.href = '<?= base_url();?>/anggota/hapus-anggota/' + idDelete;
            }
        });
    }
</script>