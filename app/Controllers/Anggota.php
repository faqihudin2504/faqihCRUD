<?php

namespace App\Controllers;

use App\Models\M_Anggota;

class Anggota extends BaseController
{
    public function master_data_anggota()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Anggota();
        $data = [
            'pages' => 'master-data-anggota',
            'data_anggota' => $model->getDataAnggota(['is_delete_anggota' => '0'])->getResultArray()
        ];

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAnggota/master-data-anggota', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function input_data_anggota()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Anggota();
        $hasil = $model->autoNumber()->getRowArray();
        $id = empty($hasil) ? "AGT001" : "AGT".sprintf("%03s", (int)substr($hasil['id_anggota'], -3) + 1);

        $data = [
            'id_anggota_auto' => $id
        ];

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAnggota/input-anggota', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function simpan_data_anggota()
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Anggota();
        $data = [
            'id_anggota' => $this->request->getPost('id_anggota'),
            'nama_anggota' => $this->request->getPost('nama_anggota'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_tlp' => $this->request->getPost('no_tlp'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'password_anggota' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'is_delete_anggota' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model->saveDataAnggota($data);
        session()->setFlashdata('success', 'Data Anggota Berhasil Ditambahkan!');
        return redirect()->to(base_url('anggota/master-data-anggota'));
    }

    public function edit_data_anggota($id)
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Anggota();
        $data_anggota = $model->getDataAnggota(['sha1(id_anggota)' => $id])->getRowArray();

        if(empty($data_anggota)) {
            session()->setFlashdata('error', 'Data tidak ditemukan!');
            return redirect()->to(base_url('anggota/master-data-anggota'));
        }

        $data = [
            'data_anggota' => $data_anggota
        ];

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAnggota/edit-anggota', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function update_data_anggota($id)
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Anggota();
        $data = [
            'nama_anggota' => $this->request->getPost('nama_anggota'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_tlp' => $this->request->getPost('no_tlp'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Update password jika diisi
        $password = $this->request->getPost('password');
        if(!empty($password)) {
            $data['password_anggota'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model->updateDataAnggota($data, ['sha1(id_anggota)' => $id]);
        session()->setFlashdata('success', 'Data Anggota Berhasil Diperbarui!');
        return redirect()->to(base_url('anggota/master-data-anggota'));
    }

    public function hapus_data_anggota($id)
    {
        if(session()->get('ses_id') == "" || session()->get('ses_user') == "" || session()->get('ses_level') == "") {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('admin/login-admin'));
        }

        $model = new M_Anggota();
        $model->updateDataAnggota([
            'is_delete_anggota' => '1',
            'updated_at' => date('Y-m-d H:i:s')
        ], ['sha1(id_anggota)' => $id]);

        session()->setFlashdata('success', 'Data Anggota Berhasil Dihapus!');
        return redirect()->to(base_url('anggota/master-data-anggota'));
    }
}