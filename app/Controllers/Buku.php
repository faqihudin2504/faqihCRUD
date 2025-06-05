<?php

namespace App\Controllers;

use App\Models\M_Buku;
use App\Models\M_Kategori;
use App\Models\M_Rak;

class Buku extends BaseController
{
    public function master_data_buku()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin'); ?>";
            </script>
            <?php
        } 
        else {
            $modelBuku = new M_Buku();
            $modelKategori = new M_Kategori();
            $modelRak = new M_Rak();

            $uri = service('uri');
            $pages = $uri->getSegment(2);
            
            $dataBuku = $modelBuku->getDataBuku(['is_delete_buku' => '0'])->getResultArray();
            $dataKategori = $modelKategori->getDataKategori(['is_delete_kategori' => '0'])->getResultArray();
            $dataRak = $modelRak->getDataRak(['is_delete_rak' => '0'])->getResultArray();

            $data = [
                'pages' => $pages,
                'data_buku' => $dataBuku,
                'data_kategori' => $dataKategori,
                'data_rak' => $dataRak
            ];

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/MasterBuku/master-data-buku', $data);
            echo view('Backend/Template/footer', $data);
        }
    }

    public function input_data_buku()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin'); ?>";
            </script>
            <?php
        } 
        else {
            $modelKategori = new M_Kategori();
            $modelRak = new M_Rak();

            $dataKategori = $modelKategori->getDataKategori(['is_delete_kategori' => '0'])->getResultArray();
            $dataRak = $modelRak->getDataRak(['is_delete_rak' => '0'])->getResultArray();

            $data = [
                'data_kategori' => $dataKategori,
                'data_rak' => $dataRak
            ];

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/MasterBuku/input-buku', $data);
            echo view('Backend/Template/footer', $data);
        }
    }

    public function simpan_data_buku()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin'); ?>";
            </script>
            <?php
        } 
        else {
            $modelBuku = new M_Buku();
            
            // Generate ID Buku
            $hasil = $modelBuku->autoNumber()->getRowArray();
            if(!$hasil) {
                $id = "BUK001";
            } else {
                $kode = $hasil['id_buku'];
                $noUrut = (int) substr($kode, -3);
                $noUrut++;
                $id = "BUK".sprintf("%03s", $noUrut);
            }

            // Handle file upload for cover
            $coverFile = $this->request->getFile('cover_buku');
            $coverName = 'default.jpg'; // default cover

            if($coverFile->isValid() && !$coverFile->hasMoved()) {
                $coverName = $coverFile->getRandomName();
                $coverFile->move('uploads/cover_buku', $coverName);
            }

            // Handle file upload for e-book
            $eBookFile = $this->request->getFile('e_book');
            $eBookName = null;

            if($eBookFile->isValid() && !$eBookFile->hasMoved()) {
                $eBookName = $eBookFile->getRandomName();
                $eBookFile->move('uploads/e_book', $eBookName);
            }

            $dataSimpan = [
                'id_buku' => $id,
                'judul_buku' => $this->request->getPost('judul_buku'),
                'pengarang' => $this->request->getPost('pengarang'),
                'penerbit' => $this->request->getPost('penerbit'),
                'tahun' => $this->request->getPost('tahun'),
                'jumlah_eksemplar' => $this->request->getPost('jumlah_eksemplar'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'keterangan' => $this->request->getPost('keterangan'),
                'id_rak' => $this->request->getPost('id_rak'),
                'cover_buku' => $coverName,
                'e_book' => $eBookName,
                'is_delete_buku' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $modelBuku->saveDataBuku($dataSimpan);
            session()->setFlashdata('success', 'Data Buku Berhasil Ditambahkan!!');
            ?>
            <script>
                document.location = "<?= base_url('buku/master-data-buku'); ?>";
            </script>
            <?php
        }
    }

    public function edit_data_buku($idEdit)
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin'); ?>";
            </script>
            <?php
        } 
        else {
            $modelBuku = new M_Buku();
            $modelKategori = new M_Kategori();
            $modelRak = new M_Rak();

            $dataBuku = $modelBuku->getDataBuku(['sha1(id_buku)' => $idEdit])->getRowArray();
            session()->set(['idUpdate' => $dataBuku['id_buku']]);

            $dataKategori = $modelKategori->getDataKategori(['is_delete_kategori' => '0'])->getResultArray();
            $dataRak = $modelRak->getDataRak(['is_delete_rak' => '0'])->getResultArray();

            $data = [
                'data_buku' => $dataBuku,
                'data_kategori' => $dataKategori,
                'data_rak' => $dataRak
            ];

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/MasterBuku/edit-buku', $data);
            echo view('Backend/Template/footer', $data);
        }
    }

    public function update_data_buku()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin'); ?>";
            </script>
            <?php
        } 
        else {
            $modelBuku = new M_Buku();
            $idUpdate = session()->get('idUpdate');

            // Get existing data
            $existingData = $modelBuku->getDataBuku(['id_buku' => $idUpdate])->getRowArray();

            // Handle file upload for cover
            $coverFile = $this->request->getFile('cover_buku');
            $coverName = $existingData['cover_buku'];

            if($coverFile->isValid() && !$coverFile->hasMoved()) {
                // Delete old cover if not default
                if($coverName != 'default.jpg' && file_exists('uploads/cover_buku/'.$coverName)) {
                    unlink('uploads/cover_buku/'.$coverName);
                }
                
                $coverName = $coverFile->getRandomName();
                $coverFile->move('uploads/cover_buku', $coverName);
            }

            // Handle file upload for e-book
            $eBookFile = $this->request->getFile('e_book');
            $eBookName = $existingData['e_book'];

            if($eBookFile->isValid() && !$eBookFile->hasMoved()) {
                // Delete old e-book if exists
                if($eBookName && file_exists('uploads/e_book/'.$eBookName)) {
                    unlink('uploads/e_book/'.$eBookName);
                }
                
                $eBookName = $eBookFile->getRandomName();
                $eBookFile->move('uploads/e_book', $eBookName);
            }

            $dataUpdate = [
                'judul_buku' => $this->request->getPost('judul_buku'),
                'pengarang' => $this->request->getPost('pengarang'),
                'penerbit' => $this->request->getPost('penerbit'),
                'tahun' => $this->request->getPost('tahun'),
                'jumlah_eksemplar' => $this->request->getPost('jumlah_eksemplar'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'keterangan' => $this->request->getPost('keterangan'),
                'id_rak' => $this->request->getPost('id_rak'),
                'cover_buku' => $coverName,
                'e_book' => $eBookName,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $whereUpdate = ['id_buku' => $idUpdate];

            $modelBuku->updateDataBuku($dataUpdate, $whereUpdate);
            session()->remove('idUpdate');
            session()->setFlashdata('success', 'Data Buku Berhasil Diperbaharui!');
            ?>
            <script>
                document.location = "<?= base_url('buku/master-data-buku'); ?>";
            </script>
            <?php
        }
    }

    public function hapus_data_buku($idHapus)
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin'); ?>";
            </script>
            <?php
        } 
        else {
            $modelBuku = new M_Buku();

            $dataUpdate = [
                'is_delete_buku' => '1',
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $whereUpdate = ['sha1(id_buku)' => $idHapus];
            $modelBuku->updateDataBuku($dataUpdate, $whereUpdate);
            session()->setFlashdata('success', 'Data Buku Berhasil Dihapus!');
            ?>
            <script>
                document.location = "<?= base_url('buku/master-data-buku'); ?>";
            </script>
            <?php
        }
    }
}