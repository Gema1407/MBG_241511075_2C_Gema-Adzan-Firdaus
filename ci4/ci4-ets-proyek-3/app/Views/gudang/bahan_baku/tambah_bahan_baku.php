<?= $this->extend('layout/layout_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3 class="mt-4">Tambah Bahan Baku Baru</h3>
    <p>Silakan isi form di bawah ini untuk menambahkan bahan baku baru.</p>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="<?= site_url('gudang/bahan_baku/create') ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Bahan</label>
                            <input type="text" class="form-control <?= session('validation')?->getError('nama') ?> ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Contoh: Beras Medium">
                            <div class="invalid-feedback">
                                <?= session('validation')?->getError('nama') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control <?= session('validation')?->getError('kategori') ? 'is-invalid' : '' ?>" id="kategori" name="kategori" value="<?= old('kategori') ?>" placeholder="Contoh: Karbohidrat">
                            <div class="invalid-feedback">
                                  <?= session('validation')?->getError('kategori') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jumlah" class="form-label">Jumlah Stok</label>
                                <input type="number" class="form-control <?= session('validation')?->getError('jumlah') ? 'is-invalid' : '' ?>" id="jumlah" name="jumlah" value="<?= old('jumlah') ?>" placeholder="Contoh: 500">
                                <div class="invalid-feedback">
                                    <?= session('validation')?->getError('jumlah') ?>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control <?= session('validation')?->getError('satuan') ?> ? 'is-invalid' : '' ?>" id="satuan" name="satuan" value="<?= old('satuan') ?>" placeholder="Contoh: kg">
                                <div class="invalid-feedback">
                                    <?= session('validation')?->getError('satuan') ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control <?= session('validation')?->getError('tanggal_masuk') ?> ? 'is-invalid' : '' ?>" id="tanggal_masuk" name="tanggal_masuk" value="<?= old('tanggal_masuk') ?>">
                            <div class="invalid-feedback">
                                <?= session('validation')?->getError('tanggal_masuk') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                            <input type="date" class="form-control <?= session('validation')?->getError('tanggal_kadaluarsa') ?> ? 'is-invalid' : '' ?>" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?= old('tanggal_kadaluarsa') ?>">
                            <div class="invalid-feedback">
                                <?= session('validation')?->getError('tanggal_kadaluarsa') ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan Bahan Baku</button>
                    <a href="<?= site_url('gudang') ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>