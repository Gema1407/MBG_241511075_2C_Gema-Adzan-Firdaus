<?php

namespace App\Controllers;

use App\Models\BahanBakuModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class Dapur extends BaseController
{
    protected $bahanBakuModel;
    protected $permintaanModel;
    protected $permintaanDetailModel;

    public function __construct()
    {
        $this->bahanBakuModel = new BahanBakuModel();
        $this->permintaanModel = new PermintaanModel();
        $this->permintaanDetailModel = new PermintaanDetailModel();
    }

    public function dashboardDapur()
    {
        $userId = session()->get('user_id');

        $data = [
            'title' => 'Dashboard Dapur',
            'total_permintaan' => $this->permintaanModel->where('pemohon_id', $userId)->countAllResults(),
            'permintaan_menunggu' => $this->permintaanModel->where('pemohon_id', $userId)->where('status', 'menunggu')->countAllResults(),
            'permintaan_disetujui' => $this->permintaanModel->where('pemohon_id', $userId)->where('status', 'disetujui')->countAllResults(),
            'permintaan_ditolak' => $this->permintaanModel->where('pemohon_id', $userId)->where('status', 'ditolak')->countAllResults(),
        ];
        return view('dapur/dashboard_dapur', $data);
    }

    public function riwayatPermintaan()
    {
        $data = [
            'title' => 'Riwayat Permintaan Bahan',
            'permintaan' => $this->permintaanModel
                ->where('pemohon_id', session()->get('user_id'))
                ->orderBy('created_at', 'DESC')
                ->findAll()
        ];
        return view('dapur/riwayat_permintaan', $data);
    }

    public function detailPermintaan($id)
    {
        $permintaan = $this->permintaanModel->find($id);

        if (!$permintaan || $permintaan['pemohon_id'] != session()->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Detail Permintaan',
            'permintaan' => $permintaan,
            'detail_bahan' => $this->permintaanDetailModel
                ->select('permintaan_detail.*, bahan_baku.nama, bahan_baku.satuan')
                ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
                ->where('permintaan_id', $id)
                ->findAll()
        ];

        return view('dapur/detail_permintaan', $data);
    }

    // menampilkan form permintaan bahan
    public function buatPermintaan()
    {
        $data = [
            'title' => 'Buat Permintaan Bahan Baku',

            'bahan_tersedia' => $this->bahanBakuModel
                ->where('jumlah >', 0)
                ->where('status !=', 'kadaluarsa')
                ->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('dapur/buat_permintaan', $data);
    }

    // menyimpan data permintaan baru
    public function simpanPermintaan()
    {
        $rules = [
            'tgl_masak'    => 'required|valid_date',
            'menu_makan'   => 'required|min_length[5]',
            'jumlah_porsi' => 'required|numeric|greater_than[0]',
            'bahan_id'     => 'required',
            'jumlah'       => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('dapur/permintaan/buat')->withInput();
        }

        $permintaanId = $this->permintaanModel->insert([
            'pemohon_id'   => session()->get('user_id'),
            'tgl_masak'    => $this->request->getPost('tgl_masak'),
            'menu_makan'   => $this->request->getPost('menu_makan'),
            'jumlah_porsi' => $this->request->getPost('jumlah_porsi'),
            'status'       => 'menunggu'
        ]);

        $bahanIds = $this->request->getPost('bahan_id');
        $jumlahDiminta = $this->request->getPost('jumlah');

        foreach ($bahanIds as $index => $bahanId) {
            if (!empty($bahanId) && !empty($jumlahDiminta[$index])) {
                $this->permintaanDetailModel->save([
                    'permintaan_id' => $permintaanId,
                    'bahan_id'      => $bahanId,
                    'jumlah_diminta' => $jumlahDiminta[$index]
                ]);
            }
        }

        session()->setFlashdata('success', 'Permintaan bahan baku berhasil dibuat dan sedang menunggu persetujuan.');
        return redirect()->to('/dapur');
    }
}
