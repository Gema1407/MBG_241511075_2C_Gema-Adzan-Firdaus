<?= $this->extend('layout/layout_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3 class="mt-4 mb-3">Proses & Detail Permintaan</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Pemohon:</strong> <?= esc($permintaan['nama_pemohon']) ?></p>
                    <p><strong>Tanggal Masak:</strong> <?= date('d F Y', strtotime($permintaan['tgl_masak'])) ?></p>
                    <p><strong>Menu:</strong> <?= esc($permintaan['menu_makan']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Jumlah Porsi:</strong> <?= esc($permintaan['jumlah_porsi']) ?></p>
                    <p><strong>Status Saat Ini:</strong> 
                        <span class="badge bg-info text-dark"><?= ucfirst($permintaan['status']) ?></span>
                    </p>
                </div>
            </div>

            <h5>Bahan yang Diminta:</h5>
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th>Jumlah Diminta</th>
                        <th>Stok Tersedia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($detail_bahan as $bahan): ?>
                        <tr class="<?= ($bahan['jumlah_diminta'] > $bahan['stok_saat_ini']) ? 'table-danger' : '' ?>">
                            <td><?= $no++ ?></td>
                            <td><?= esc($bahan['nama']) ?></td>
                            <td><?= esc($bahan['jumlah_diminta']) ?> <?= esc($bahan['satuan']) ?></td>
                            <td><?= esc($bahan['stok_saat_ini']) ?> <?= esc($bahan['satuan']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="mt-4">
                <a href="/gudang/permintaan" class="btn btn-secondary">Kembali ke Daftar</a>
                
                <?php if ($permintaan['status'] == 'menunggu') : ?>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>