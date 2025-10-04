<?= $this->extend('layout/layout_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3 class="mt-4">Dashboard Gudang</h3>
    <p>Selamat datang, <strong><?= session()->get('name') ?></strong>! Berikut ringkasan status bahan baku saat ini.</p>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <div class="row mt-4">
        <div class="col-md-3 mb-4">
            </div>

        <div class="col-md-3 mb-4">
            </div>

        <div class="col-md-3 mb-4">
            </div>

        <div class="col-md-3 mb-4">
            </div>
    </div>
</div>
<?= $this->endSection() ?>