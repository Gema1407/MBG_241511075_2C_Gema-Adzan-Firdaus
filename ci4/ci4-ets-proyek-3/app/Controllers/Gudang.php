<?php

namespace App\Controllers;

use App\Models\BahanBakuModel;

class Gudang extends BaseController
{
    protected $bahanBakuModel;

    public function __construct()
    {
        $this->bahanBakuModel = new BahanBakuModel();
    }

    public function dashboardGudang()
    {
        $data = [
            'title'                 => 'Dashboard Gudang',
            'total_bahan'           => $this->bahanBakuModel->countAllResults(),
            'segera_kadaluarsa'     => $this->bahanBakuModel->where('status', 'segera_kadaluarsa')->countAllResults(),
            'sudah_kadaluarsa'      => $this->bahanBakuModel->where('status', 'kadaluarsa')->countAllResults(),
            'stok_habis'            => $this->bahanBakuModel->where('status', 'habis')->countAllResults(),
        ];
        return view('gudang/dashboard_gudang', $data);
    }

    // menampilkan data bahan baku
    public function lihatBahanBaku()
    {
        $data = [
            'title' => 'Data Bahan Baku',
            'semua_bahan' => $this->bahanBakuModel->findAll()
        ];
        return view('gudang/bahan_baku/tampilan_bahan_baku', $data);
    }

    // Menampilkan form tambah bahan baku
    public function tambahBahanBaku()
    {
        $data = [
            'title' => 'Tambah Bahan Baku',
        ];
        return view('gudang/bahan_baku/tambah_bahan_baku', $data);
    }

    // Menyimpan Data
    public function createBahanBaku()
    {
        // Aturan validasi
        $rules = [
            'nama' => 'required|min_length[3]',
            'kategori' => 'required',
            'jumlah' => 'required|numeric|greater_than_equal_to[0]',
            'satuan' => 'required',
            'tanggal_masuk' => 'required|valid_date',
            'tanggal_kadaluarsa' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('gudang/bahan_baku/tambah')->withInput()->with('validation', $this->validator);
        }

        // Simpan data ke database
         $tanggalKadaluarsa = $this->request->getPost('tanggal_kadaluarsa');
        $jumlah = $this->request->getPost('jumlah');

        $status = 'tersedia';
        if ($jumlah <= 0) {
            $status = 'habis';
        } elseif (strtotime($tanggalKadaluarsa) < strtotime(date('Y-m-d'))) {
            $status = 'kadaluarsa';
        }

        $this->bahanBakuModel->save([
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $jumlah,
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $tanggalKadaluarsa,
            'status' => $status
        ]);

        // Set pesan sukses dan redirect
        session()->setFlashdata('success', 'Data bahan baku berhasil ditambahkan.');
        return redirect()->to('/gudang');
    }

    public function editStokBahanBaku($id)
    {
        $jumlahBaru = $this->request->getPost('jumlah');

        if ($jumlahBaru === null || $jumlahBaru < 0) {
            session()->setFlashdata('error', 'Update stok gagal! Jumlah tidak boleh kurang dari 0.');
            return redirect()->to('/gudang/bahan_baku');
        }

        $data = ['jumlah' => $jumlahBaru];

        if ($this->bahanBakuModel->update($id, $data)) {
            session()->setFlashdata('success', 'Stok bahan baku berhasil diperbarui.');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui stok bahan baku.');
        }
        return redirect()->to('/gudang/bahan_baku');
    }

    public function editBahanBaku($id)
    {
        $data = [
            'title' => 'Edit Bahan Baku',
            'bahan' => $this->bahanBakuModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        if (empty($data['bahan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data bahan baku tidak ditemukan.');
        }

        return view('gudang/bahan_baku/edit_bahan_baku', $data);
    }

    public function updateBahanBaku($id)
    {
        $rules = [
            'nama' => 'required|min_length[3]',
            'kategori' => 'required',
            'jumlah' => 'required|numeric|greater_than_equal_to[0]',
            'satuan' => 'required',
            'tanggal_masuk' => 'required|valid_date',
            'tanggal_kadaluarsa' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/gudang/bahan_baku/edit/' . $id)->withInput();
        }

        $tanggalKadaluarsa = $this->request->getPost('tanggal_kadaluarsa');
        $jumlah = $this->request->getPost('jumlah');

        $status = 'tersedia';
        if ($jumlah <= 0) {
            $status = 'habis';
        } elseif (strtotime($tanggalKadaluarsa) < strtotime(date('Y-m-d'))) {
            $status = 'kadaluarsa';
        }

        $this->bahanBakuModel->save([
            'id' => $id,
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $jumlah,
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $tanggalKadaluarsa,
            'status' => $status
        ]);

        session()->setFlashdata('success', 'Data bahan baku berhasil diubah.');
        return redirect()->to('/gudang/bahan_baku');
    }

    public function hapusBahanBaku($id)
    { 
        $bahan = $this->bahanBakuModel->find($id);

        if ($bahan && $bahan['status'] == 'kadaluarsa') {
            $this->bahanBakuModel->delete($id);
            session()->setFlashdata('success', 'Data bahan baku berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Hanya bahan baku dengan status "Kadaluarsa" yang dapat dihapus.');
        }

        return redirect()->to('/gudang/bahan_baku');
    }
}
