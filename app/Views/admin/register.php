<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Admin Perpustakaan</title>

    <link href="/Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Assets/css/styles.css" rel="stylesheet">
    <link href="/Assets/css/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading" style="text-align: center;">Registrasi Admin Baru</div>
                <div class="panel-body">
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <p><?= $error ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form role="form" action="<?= base_url('admin/process-register') ?>" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Nama Lengkap" name="nama_admin" type="text" autofocus value="<?= old('nama_admin') ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username_admin" type="text" value="<?= old('username_admin') ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password_admin" type="password">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Konfirmasi Password" name="confirm_password" type="password">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="akses_level">
                                    <option value="">Pilih Level Akses</option>
                                    <option value="2">Kepala Perpustakaan</option>
                                    <option value="3">Admin Perpustakaan</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                            <div class="text-center" style="margin-top: 15px;">
                                <a href="<?= base_url('admin/login-admin') ?>">Sudah punya akun? Login disini</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/Assets/js/jquery-1.11.1.min.js"></script>
    <script src="/Assets/js/bootstrap.min.js"></script>
    <script src="/Assets/js/sweetalert2.min.js"></script>
</body>
</html>