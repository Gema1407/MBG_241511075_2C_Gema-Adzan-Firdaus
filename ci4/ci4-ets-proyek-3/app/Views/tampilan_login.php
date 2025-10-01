<?= $this->extend('layout/layout_template') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header text-center bg-custom-primary text-black">
                <h3>Login sebagai <?= (ucfirst($role) === 'Gudang') ? 'Petugas Gudang' : 'Petugas Dapur' ?></h3>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                
                <form action="/auth/processLogin" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="role" value="<?= $role ?>">
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="/">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>