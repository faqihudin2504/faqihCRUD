<?php

namespace App\Controllers;

use App\Models\M_Kategori;

class Kategori extends BaseController
{
    public function master_data_kategori()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Kategori();
        $data = [
            'pages' => 'master-data-kategori',
            'data_kategori' => $model->getDataKategori(['is_delete_kategori' => '0'])->getResultArray()
        ];

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterKategori/master-data-kategori', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function input_data_kategori()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Kategori();
        $hasil = $model->autoNumber()->getRowArray();
        $id = empty($hasil) ? "KTG001" : "KTG".sprintf("%03s", (int)substr($hasil['id_kategori'], -3) + 1);

        $data = [
            'id_kategori_auto' => $id
        ];

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterKategori/input-kategori', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function simpan_data_kategori()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Kategori();
        $data = [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'is_delete_kategori' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model->saveDataKategori($data);
        session()->setFlashdata('success', 'Data Kategori Berhasil Ditambahkan!');
        return redirect()->to(base_url('kategori/master-data-kategori'));
    }

    public function edit_data_kategori($id)
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Kategori();
        $data_kategori = $model->getDataKategori(['sha1(id_kategori)' => $id])->getRowArray();

        if(empty($data_kategori)) {
            session()->setFlashdata('error', 'Data tidak ditemukan!');
            return redirect()->to(base_url('kategori/master-data-kategori'));
        }

        $data = [
            'data_kategori' => $data_kategori
        ];

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterKategori/edit-kategori', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function update_data_kategori()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Kategori();
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $where = ['id_kategori' => $this->request->getPost('id_kategori')];
        $model->updateDataKategori($data, $where);
        session()->setFlashdata('success', 'Data Kategori Berhasil Diperbarui!');
        return redirect()->to(base_url('kategori/master-data-kategori'));
    }

    public function hapus_data_kategori($id)
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Kategori();
        $model->updateDataKategori([
            'is_delete_kategori' => '1',
            'updated_at' => date('Y-m-d H:i:s')
        ], ['sha1(id_kategori)' => $id]);

        session()->setFlashdata('success', 'Data Kategori Berhasil Dihapus!');
        return redirect()->to(base_url('kategori/master-data-kategori'));
    }
}