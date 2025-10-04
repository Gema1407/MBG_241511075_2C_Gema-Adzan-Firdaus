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

    public function index()
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

    // Menampilkan form tambah bahan baku
    public function newBahanBaku()
    {
        $data = [
            'title' => 'Tambah Bahan Baku',
            'validation' => \Config\Services::validation()
        ];
        return view('gudang/bahan_baku/tambah_bahan_baku    ', $data);
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
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Simpan data ke database
        $this->bahanBakuModel->save([
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => 'tersedia'
        ]);

        // Set pesan sukses dan redirect
        session()->setFlashdata('success', 'Data bahan baku berhasil ditambahkan.');
        return redirect()->to('/gudang');
    }
}