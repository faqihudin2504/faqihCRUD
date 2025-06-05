<?php

namespace App\Controllers;

use App\Models\M_Rak;

class Rak extends BaseController
{
    public function master_data_rak()
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
            $modelRak = new M_Rak();

            $uri = service('uri');
            $pages = $uri->getSegment(2);
            $dataRak = $modelRak->getDataRak(['is_delete_rak' => '0'])->getResultArray();

            $data = [
                'pages' => $pages,
                'data_rak' => $dataRak
            ];

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/MasterRak/master-data-rak', $data);
            echo view('Backend/Template/footer', $data);
        }
    }

    public function input_data_rak()
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
            $modelRak = new M_Rak();
            $hasil = $modelRak->autoNumber()->getRowArray();
            if(!$hasil){
                $id = "RAK001";
            }
            else{
                $kode = $hasil['id_rak'];
                $noUrut = (int) substr($kode, -3);
                $noUrut++;
                $id = "RAK".sprintf("%03s", $noUrut);
            }

            $data = [
                'id_rak_auto' => $id
            ];

            echo view('Backend/Template/header', $data);
            echo view('Backend/Template/sidebar', $data);
            echo view('Backend/MasterRak/input-rak', $data);
            echo view('Backend/Template/footer', $data);
        }
    }

    public function simpan_data_rak()
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
            $modelRak = new M_Rak();

            $id_rak = $this->request->getPost('id_rak');
            $nama_rak = $this->request->getPost('nama_rak');

            $dataSimpan = [
                'id_rak' => $id_rak,
                'nama_rak' => $nama_rak,
                'is_delete_rak' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $modelRak->saveDataRak($dataSimpan);
            session()->setFlashdata('success', 'Data Rak Berhasil Ditambahkan!!');
            ?>
            <script>
                document.location = "<?= base_url('rak/master-data-rak'); ?>";
            </script>
            <?php
        }
    }

    public function edit_data_rak()
    {
        $uri = service('uri');
        $idEdit = $uri->getSegment(3);
        $modelRak = new M_Rak();
        
        $dataRak = $modelRak->getDataRak(['sha1(id_rak)' => $idEdit])->getRowArray();
        session()->set(['idUpdate' => $dataRak['id_rak']]);

        $page = $uri->getSegment(2);

        $data['page'] = $page;
        $data['web_title'] = "Edit Data Rak";
        $data['data_rak'] = $dataRak;

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterRak/edit-rak', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function update_data_rak()
    {
        $modelRak = new M_Rak();

        $idUpdate = session()->get('idUpdate');
        $nama_rak = $this->request->getPost('nama_rak');

        if($nama_rak==""){
            session()->setFlashdata('error', 'Isian tidak boleh kosong!!');
            ?>
            <script>
            history.go(-1);
            </script>
            <?php
        }
        else{
            $dataUpdate = [
                'nama_rak' => $nama_rak,
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $whereUpdate = ['id_rak' => $idUpdate];

            $modelRak->updateDataRak($dataUpdate, $whereUpdate);
            session()->remove('idUpdate');
            session()->setFlashdata('success', 'Data Rak Berhasil Diperbaharui!');
            ?>
            <script>
                document.location = "<?= base_url('rak/master-data-rak');?>";
            </script>
            <?php
        }
    }

    public function hapus_data_rak()
    {
        $modelRak = new M_Rak();

        $uri = service('uri');
        $idHapus = $uri->getSegment(3);

        $dataUpdate = [
            'is_delete_rak' => '1',
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $whereUpdate = ['sha1(id_rak)' => $idHapus];
        $modelRak->updateDataRak($dataUpdate, $whereUpdate);
        session()->setFlashdata('success', 'Data Rak Berhasil Dihapus!');
    ?>
    <script>
        document.location = "<?= base_url('rak/master-data-rak');?>";
    </script>
    <?php
    }
}