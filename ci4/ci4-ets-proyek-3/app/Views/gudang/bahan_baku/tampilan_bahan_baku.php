<?= $this->extend('layout/layout_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3>Data Bahan Baku</h3>
        <a href="<?= site_url('gudang/bahan_baku/tambah') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Data
        </a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bahan</th>
                            <th>Kategori</th>
                            <th class="text-center">Stok</th>
                            <th>Satuan</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl Kadaluarsa</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($semua_bahan)) : ?>
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">Belum ada data bahan baku.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($semua_bahan as $bahan) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($bahan['nama']) ?></td>
                                    <td><?= esc($bahan['kategori']) ?></td>
                                    <td class="text-center"><?= esc($bahan['jumlah']) ?></td>
                                    <td><?= esc($bahan['satuan']) ?></td>
                                    <td><?= date('d M Y', strtotime($bahan['tanggal_masuk'])) ?></td>
                                    <td><?= date('d M Y', strtotime($bahan['tanggal_kadaluarsa'])) ?></td>
                                    <td class="text-center">
                                        <?php
                                        $statusClass = 'bg-secondary';
                                        switch ($bahan['status']) {
                                            case 'tersedia':
                                                $statusClass = 'bg-success';
                                                break;
                                            case 'segera_kadaluarsa':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'kadaluarsa':
                                                $statusClass = 'bg-danger';
                                                break;
                                            case 'habis':
                                                $statusClass = 'bg-dark';
                                                break;
                                        }
                                        ?>
                                        <span class="badge <?= $statusClass ?>"><?= ucfirst(str_replace('_', ' ', $bahan['status'])) ?></span>
                                    </td>
                                    <td class="text-center">
                                       <a href="/gudang/bahan_baku/edit/<?= $bahan['id']; ?>" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div class="modal fade" id="updateStokModal<?= $bahan['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Stok: <?= $bahan['nama']; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/gudang/bahan_baku/editStokBahanBaku/<?= $bahan['id']; ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="jumlah">Jumlah Stok Baru</label>
                                                            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $bahan['jumlah']; ?>" min="0" required>
                                                            <small class="form-text text-muted">Stok saat ini: <?= $bahan['jumlah'] . ' ' . $bahan['satuan']; ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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