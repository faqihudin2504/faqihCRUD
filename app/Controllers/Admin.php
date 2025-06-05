<?php

namespace App\Controllers;
//load models
use App\Models\M_Admin;
use App\Models\M_Anggota;
use App\Models\M_Buku;
use App\Models\M_Peminjaman;

class Admin extends BaseController
{
    public function login()
    {
        return view('Backend/Login/login');
    }

    public function belajar_segment()
    {
       $uri = service('uri');
       $parameter1 = $uri->getSegment(3);
       $parameter2 = $uri->getSegment(4);
       $parameter3 = $uri->getSegment(5);

       $data['p1'] = $parameter1;
       $data['p2'] = $parameter2;
       $data['p3'] = $parameter3;

       return view('segment_view.php', $data);

    }

    // Register
    public function register()
    {
        return view('admin/register');
    }

    public function process_register()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_admin' => 'required',
            'username_admin' => 'required|is_unique[tbl_admin.username_admin]',
            'password_admin' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password_admin]',
            'akses_level' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new M_Admin();
        $data = [
            'id_admin' => $this->generateAdminId(),
            'nama_admin' => $this->request->getPost('nama_admin'),
            'username_admin' => $this->request->getPost('username_admin'),
            'password_admin' => password_hash($this->request->getPost('password_admin'), PASSWORD_BCRYPT),
            'akses_level' => $this->request->getPost('akses_level'),
        ];

        if ($model->saveDataAdmin($data)) {
            return redirect()->to('/admin/login-admin')->with('success', 'Registrasi berhasil! Silakan login.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal melakukan registrasi.');
        }
    }

    private function generateAdminId()
    {
        $model = new M_Admin();
        $lastId = $model->autoNumber()->getRow();
        
        if ($lastId) {
            $lastNumber = (int) substr($lastId->id_admin, 3);
            $newNumber = $lastNumber + 1;
            return 'ADM' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
        }
        
        return 'ADM01';
    }

    public function dashboard()
    {
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','silakan login terlebih dahulu!');
        ?>
        <script>
            document.location = "<?= base_url('admin/login-admin');?>";
        </script>
        <?php
        }
        else{
            echo view('Backend/Template/header');
            echo view('Backend/Template/sidebar');
            echo view('Backend/Login/dashboard_admin');
            echo view('Backend/Template/footer');
        }
    }

    public function input_data_admin(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin');?>";
            </script>
            <?php
        }
        else{
            echo view('Backend/Template/header');
            echo view('Backend/Template/sidebar');
            echo view('Backend/MasterAdmin/input-admin');
            echo view('Backend/Template/footer');
        }
    }
    public function simpan_data_admin(){
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){
            session()->setFlashdata('error','silakan login terlebih dahulu!');
        ?>
        <script>
            document.location = "<?= base_url('admin/login-admin');?>";
        </script>
        <?php
    }
    else{
        $modelAdmin = new M_Admin; //inisialisasi

        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $level = $this->request->getPost('level');

        $cekUname = $modelAdmin->getDataAdmin(['username_admin' => $username])->getNumRows();
        if($cekUname > 0){
               session()->setFlashdata('error','Username sudah digunakan!!!');
              ?>
              <script>
                 history.go(-1);
              </script>
              <?php
         }
        else{
            $hasil = $modelAdmin->autoNumber()->getRowArray();
            if(!$hasil){
                $id = "ADM001";
            }
            else{
                $kode = $hasil['id_admin'];
                $noUrut = (int) substr($kode, -3);
                $noUrut++;
                $id = "ADM".sprintf("%03s", $noUrut);
            }
            $dataSimpan = [
                'id_admin' => $id,
                'nama_admin' => $nama,
                'username_admin' => $username,
                'password_admin' => password_hash('pass_admin', PASSWORD_DEFAULT),
                'akses_level' => $level,
                'is_delete_admin' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $modelAdmin->saveDataAdmin($dataSimpan);
            session()->setFlashdata('success', 'Data Admin Berhasil Ditambahkan!!');
            ?>
            <script>
                document.location = "<?= base_url('admin/master-data-admin'); ?>";
            </script>
            <?php
            }
        }
    }

    public function master_data_admin() {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin'); ?>";
            </script>
            <?php
        } 
        else {
            $modelAdmin = new M_Admin; // Inisialisasi model

            $uri = service('uri');
            $pages = $uri->getSegment(2);
            $dataUser = $modelAdmin->getDataAdmin(['is_delete_admin' => '0', 'akses_level !=' => '1'])->getResultArray();

            $data = [
                'pages' => $pages,
                'data_user' => $dataUser
            ];

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/MasterAdmin/master-data-admin', $data);
            echo view('Backend/Template/footer', $data);
        }
    }

    public function edit_data_admin()
    {
        $uri = service('uri');
        $idEdit = $uri->getSegment(3);
        $modelAdmin = new M_Admin;
        // Mengambil data admin dari table admin di database berdasarkan parameter yang dikirimkan
        $dataAdmin = $modelAdmin->getDataAdmin(['sha(id_admin)' => $idEdit])->getRowArray();
        session()->set(['idUpdate' => $dataAdmin['id_admin']]);

        $page = $uri->getSegment(2);

        $data['page'] = $page;
        $data['web_title'] = "Edit Data Admin";
        $data['data_admin'] = $dataAdmin; // mengirim array data admin ke view

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAdmin/edit-admin', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function update_data_admin()
    {
        $modelAdmin = new M_Admin;

        $idUpdate = session()->get('idUpdate');
        $nama = $this->request->getPost('nama');
        $level = $this->request->getPost('level');

        if($nama=="" or $level==""){
            session()->setFlashdata('error', 'Isian tidak boleh kosong!!');
            ?>
            <script>
            history.go(-1);
            </script>
            <?php
        }
        else{
            $dataUpdate = [
                'nama_admin' => $nama,
                'akses_level' => $level,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $whereUpdate = ['id_admin' => $idUpdate];

            $modelAdmin->updateDataAdmin($dataUpdate, $whereUpdate);
            session()->remove('idUpdate');
            session()->setFlashdata('success', 'Data Admin Berhasil Diperbaharui!');
            ?>
            <script>
                document.location = "<?= base_url('admin/master-data-admin');?>";
            </script>
            <?php
        }
    }

    public function hapus_data_admin()
    {
        $modelAdmin = new M_Admin;

        $uri = service('uri');
        $idHapus = $uri->getSegment(3);

        $dataUpdate = [
            'is_delete_admin' => '1',
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $whereUpdate = ['sha1(id_admin)' => $idHapus];
        $modelAdmin->updateDataAdmin($dataUpdate, $whereUpdate);
        session()->setFlashdata('success', 'Data Admin Berhasil Dihapus!');
    ?>
    <script>
        document.location = "<?= base_url('admin/master-data-admin');?>";
    </script>
    <?php
    }
    // Akhir modul admin

    public function autentikasi(){
    $modelAdmin = new M_Admin; // proses inisiasi model
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $cekUsername = $modelAdmin->getDataAdmin(['username_admin' => $username, 'is_delete_admin' => '0'])->getNumRows();
        if($cekUsername == 0){
            session()->setFlashdata('error', 'Username Tidak Ditemukan!');
            ?>
            <script>
                history.go(-1);
            </script>
            <?php
        }
        else{
            $dataUser = $modelAdmin->getDataAdmin(['username_admin' => $username, 'is_delete_admin' => '0'])->getRowArray();
            $passwordUser = $dataUser['password_admin'];

            $verifikasiPassword = password_verify($password, $passwordUser);
            if(!$verifikasiPassword){
                session()->setFlashdata('error', 'Password Tidak Sesuai!');
                ?>
                <script>
                    history.go(-1);
                </script>
                <?php
            }
            else{
                $dataSession = [
                    'ses_id'    => $dataUser['id_admin'],
                    'ses_user'  => $dataUser['nama_admin'],
                    'ses_level' => $dataUser['akses_level']
                ];
                session()->set($dataSession);
                session()->setFlashdata('success', 'Login Berhasil!');
                ?>
                <script>
                    document.location = "<?= base_url('admin/dashboard-admin'); ?>";
                </script>
                <?php
            }
        }
    }
    public function logout(){
        session()->remove('ses_id');
        session()->remove('ses_user');
        session()->remove('ses_level');
        session()->setFlashdata('info','Anda telah keluar dari sistem!');
        ?>
        <script>
            document.location = "<?= base_url('admin/login-admin');?>";
        </script>
        <?php
    }

    public function peminjaman_step1()
    {
        $uri = service('uri');
        $page = $uri->getSegment(2);

        $data['page'] = $page;
        $data['web_title'] = "Transaksi Peminjaman";

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/Transaksi/peminjaman-step-1', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function peminjaman_step2()
    {
        $modelAnggota = new M_Anggota;
        $modelBuku = new M_Buku;
        $modelPeminjaman = new M_Peminjaman;
        $uri = service('uri');
        $page = $uri->getSegment(2);

        if($this->request->getPost('id_anggota')){
            $idAnggota = $this->request->getPost('id_anggota');
            session()->set(['idAgt' => $idAnggota]);
        }
        else{
            $idAnggota = session()->get('idAgt');
        }

        $cekPeminjaman = $modelPeminjaman->getDataPeminjaman(['id_anggota' => $idAnggota, 'status_transaksi' => "Berjalan"])->getNumRows();
        if($cekPeminjaman > 0){
            session()->setFlashdata('error','Transaksi Tidak Dapat Dilakukan, Masih Ada Transaksi Peminjaman yang Belum Diselesaikan!!');
            ?>
            <script>
                history.go(-1);
            </script>
            <?php
        }
        else{
            $dataAnggota = $modelAnggota->getDataAnggota(['id_anggota' => $idAnggota])->getRowArray();
            $dataBuku = $modelBuku->getDataBukuJoin()->getResultArray();

            $jumlahTemp = $modelPeminjaman->getDataTemp(['id_anggota' => $idAnggota])->getNumRows();
            $data['jumlahTemp'] = $jumlahTemp;
            // Mengambil data keseluruhan buku dari table buku di database

            $dataTemp = $modelPeminjaman->getDataTempJoin(['tbl_temp_peminjaman.id_anggota' => $idAnggota])->getResultArray();

            $data['page'] = $page;
            $data['web_title'] = 'Transaksi Peminjaman';
            $data['dataAnggota'] = $dataAnggota;
            $data['dataBuku'] = $dataBuku;
            $data['dataTemp'] = $dataTemp;

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/Transaksi/peminjaman-step-2', $data);
            echo view('Backend/Template/footer', $data);
        }
    }
}
