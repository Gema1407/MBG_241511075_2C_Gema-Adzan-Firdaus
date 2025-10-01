<?= $this->extend('layout/layout_template') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header text-center text-white bg-primary">
                <h3>Sistem Pemantauan Bahan Baku MBG</h3>
            </div>
            <div class="card-body text-center">
                <p class="fs-5">Selamat datang! Silakan pilih peran Anda untuk masuk ke sistem:</p>
                <div class="d-grid gap-3">
                    <a href="/auth/login/gudang" class="btn btn-primary btn-lg">
                        <i class="fas fa-warehouse"></i> Login sebagai Petugas Gudang
                    </a>
                    <a href="/auth/login/dapur" class="btn btn-info text-white btn-lg">
                        <i class="fas fa-utensils"></i> Login sebagai Petugas Dapur
                    </a>
                </div>
                
                <hr class="my-4">
                
                <p class="text-muted">Aksi Tambahan:</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="/auth/register/gudang" class="btn btn-outline-success">Daftar Petugas Gudang Baru</a>
                    <a href="/auth/register/dapur" class="btn btn-outline-warning">Daftar Petugas Dapur Baru</a>
                </div>
            </div>  
        </div>
    </div>
</div>
<?= $this->endSection() ?>