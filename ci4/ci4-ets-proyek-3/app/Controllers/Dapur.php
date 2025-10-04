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
        return view('dapur/dashboard_dapur');
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
}