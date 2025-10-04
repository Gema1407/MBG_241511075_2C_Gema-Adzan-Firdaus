<?= $this->extend('layout/layout_template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Form Edit Bahan Baku</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data: <?= esc($bahan['nama']); ?></h6>
        </div>
        <div class="card-body">
            <form action="/gudang/bahan_baku/edit/<?= $bahan['id']; ?>" method="post">
                <?= csrf_field(); ?>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Bahan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama', $bahan['nama']); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" id="kategori" name="kategori" value="<?= old('kategori', $bahan['kategori']); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kategori'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= old('jumlah', $bahan['jumlah']); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jumlah'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" id="satuan" name="satuan" value="<?= old('satuan', $bahan['satuan']); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('satuan'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_masuk')) ? 'is-invalid' : ''; ?>" id="tanggal_masuk" name="tanggal_masuk" value="<?= old('tanggal_masuk', $bahan['tanggal_masuk']); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_masuk'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal_kadaluarsa" class="col-sm-2 col-form-label">Tanggal Kadaluarsa</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_kadaluarsa')) ? 'is-invalid' : ''; ?>" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?= old('tanggal_kadaluarsa', $bahan['tanggal_kadaluarsa']); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_kadaluarsa'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="/gudang/bahan_baku" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>