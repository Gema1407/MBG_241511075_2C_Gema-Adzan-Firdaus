<?= $this->extend('layout/layout_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3 class="mt-4 mb-3">Daftar Permintaan Bahan Baku Masuk</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pemohon</th>
                            <th>Tanggal Masak</th>
                            <th>Menu</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($permintaan)) : ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">Belum ada permintaan masuk.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($permintaan as $item) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($item['nama_pemohon']) ?></td>
                                    <td><?= date('d M Y', strtotime($item['tgl_masak'])) ?></td>
                                    <td><?= esc($item['menu_makan']) ?></td>
                                    <td>
                                        <?php
                                            $statusClass = 'bg-secondary';
                                            if ($item['status'] == 'disetujui') $statusClass = 'bg-success';
                                            if ($item['status'] == 'ditolak') $statusClass = 'bg-danger';
                                            if ($item['status'] == 'menunggu') $statusClass = 'bg-warning text-dark';
                                        ?>
                                        <span class="badge <?= $statusClass ?>"><?= ucfirst($item['status']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <a href="/gudang/permintaan/detail/<?= $item['id']; ?>" class="btn btn-sm btn-info">Proses / Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>