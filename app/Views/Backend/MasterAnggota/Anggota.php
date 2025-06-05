<?php namespace App\Controllers;

use App\Models\M_Anggota;

class Anggota extends BaseController
{
    public function index()
    {
        $model = new M_Anggota();
        $data['data_anggota'] = $model
            ->where('is_delete_anggota', 0)
            ->findAll();

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAnggota/master-data-anggota', $data);
        echo view('Backend/Template/footer');
    }

    public function create()
    {
        echo view('Backend/Template/header');
        echo view('Backend/Template/sidebar');
        echo view('Backend/MasterAnggota/input-anggota');
        echo view('Backend/Template/footer');
    }

    public function store()
    {
        $model = new M_Anggota();

        // Generate ID unik
        $id = 'ANG' . strtoupper(bin2hex(random_bytes(4)));

        $data = [
            'id_anggota'       => $id,
            'nama_anggota'     => $this->request->getPost('nama_anggota'),
            'jenis_kelamin'    => $this->request->getPost('jenis_kelamin'),
            'no_tlp'           => $this->request->getPost('no_tlp'),
            'alamat'           => $this->request->getPost('alamat'),
            'email'            => $this->request->getPost('email'),
            'password_anggota' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'is_delete_anggota'=> 0,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        $model->insert($data);
        return redirect()->to('/admin/master-data-anggota')
                         ->with('success', 'Data Anggota disimpan');
    }

    public function edit($hashId)
    {
        $model = new M_Anggota();
        $data['anggota'] = $model
            ->where('sha1(id_anggota)', $hashId)
            ->first();

        if (! $data['anggota']) {
            return redirect()->to('/admin/master-data-anggota')
                             ->with('error', 'Data anggota tidak ditemukan');
        }

        session()->set('idUpdate', $data['anggota']['id_anggota']);

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAnggota/edit-anggota', $data);
        echo view('Backend/Template/footer');
    }

    public function update()
    {
        $model = new M_Anggota();
        $id    = session()->get('idUpdate');

        // Ambil input
        $post = $this->request->getPost();

        // Siapkan data yang selalu di-update
        $data = [
            'nama_anggota'  => $post['nama'],
            'jenis_kelamin' => $post['jenis_kelamin'],
            'no_tlp'        => $post['no_tlp'],
            'alamat'        => $post['alamat'],
            'email'         => $post['email'],
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // Jika user mengisi password baru, validasi dan hash
        if (! empty($post['password'])) {
            if ($post['password'] !== $post['password_confirm']) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Password dan konfirmasi tidak cocok');
            }
            $data['password_anggota'] = password_hash($post['password'], PASSWORD_DEFAULT);
        }

        // Lakukan update
        $model->update($id, $data);
        session()->remove('idUpdate');

        return redirect()->to('/admin/master-data-anggota')
                         ->with('success', 'Data Anggota diperbarui');
    }

    public function delete($hashId)
    {
        $model = new M_Anggota();
        $record = $model->where('sha1(id_anggota)', $hashId)->first();

        if ($record) {
            $model->update($record['id_anggota'], [
                'is_delete_anggota' => 1,
                'updated_at'        => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->to('/admin/master-data-anggota')
                         ->with('success', 'Data Anggota dihapus');
    }
}
