<?= $this->extend('layout/layout_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3 class="mt-4">Dashboard Dapur</h3>
    <p>Selamat datang, <strong><?= session()->get('name') ?></strong>! Berikut status permintaan bahan baku Anda.</p>
    
    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="h1 fw-bold"><?= $menunggu ?? 0 ?></div>
                            <div class="fs-6">Menunggu Persetujuan</div>
                        </div>
                        <i class="fas fa-hourglass-half fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="h1 fw-bold"><?= $disetujui ?? 0 ?></div>
                            <div class="fs-6">Permintaan Disetujui</div>
                        </div>
                        <i class="fas fa-check-circle fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="h1 fw-bold"><?= $ditolak ?? 0 ?></div>
                            <div class="fs-6">Permintaan Ditolak</div>
                        </div>
                        <i class="fas fa-ban fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>