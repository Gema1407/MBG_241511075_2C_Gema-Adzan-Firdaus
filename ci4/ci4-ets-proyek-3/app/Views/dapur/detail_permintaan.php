<?= $this->extend('layout/layout_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3 class="mt-4 mb-3">Detail Permintaan Bahan</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Tanggal Masak:</strong> <?= date('d F Y', strtotime($permintaan['tgl_masak'])) ?></p>
                    <p><strong>Menu:</strong> <?= esc($permintaan['menu_makan']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Jumlah Porsi:</strong> <?= esc($permintaan['jumlah_porsi']) ?></p>
                    <p><strong>Status:</strong> 
                        <?php
                            $statusClass = 'bg-secondary';
                            if ($permintaan['status'] == 'disetujui') $statusClass = 'bg-success';
                            if ($permintaan['status'] == 'ditolak') $statusClass = 'bg-danger';
                            if ($permintaan['status'] == 'menunggu') $statusClass = 'bg-warning text-dark';
                        ?>
                        <span class="badge <?= $statusClass ?>"><?= ucfirst($permintaan['status']) ?></span>
                    </p>
                </div>
            </div>

            <h5>Bahan yang Diminta:</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th>Jumlah Diminta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($detail_bahan as $bahan): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($bahan['nama']) ?></td>
                            <td><?= esc($bahan['jumlah_diminta']) ?> <?= esc($bahan['satuan']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <a href="/dapur/riwayat" class="btn btn-primary mt-3">Kembali ke Riwayat</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>