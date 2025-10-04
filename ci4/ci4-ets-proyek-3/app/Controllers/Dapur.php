<?php

namespace App\Controllers;

use App\Models\PermintaanModel;

class Dapur extends BaseController
{
    public function __construct()
    {
        $this->permintaanModel = new PermintaanModel();
    }
    
    public function index()
    {
        $pemohonId = session()->get('user_id');

        $data = [
            'title'             => 'Dashboard Dapur',
            'menunggu'          => $this->permintaanModel->where(['pemohon_id' => $pemohonId, 'status' => 'menunggu'])->countAllResults(),
            'disetujui'         => $this->permintaanModel->where(['pemohon_id' => $pemohonId, 'status' => 'disetujui'])->countAllResults(),
            'ditolak'           => $this->permintaanModel->where(['pemohon_id' => $pemohonId, 'status' => 'ditolak'])->countAllResults(),
        ];
        return view('dapur/dashboard_dapur', $data);
    }
}