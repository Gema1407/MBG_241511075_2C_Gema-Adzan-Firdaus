views dapur buat_permintaan.php

<?= $this->extend('layout/layout_template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h3 class="mt-4 mb-3">Buat Permintaan Bahan Baku (H-1)</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="/dapur/permintaan/simpan" method="post">
                <?= csrf_field(); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tgl_masak" class="form-label">Tanggal Masak</label>
                            <input type="date" class="form-control" id="tgl_masak" name="tgl_masak" value="<?= old('tgl_masak') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jumlah_porsi" class="form-label">Jumlah Porsi</label>
                            <input type="number" class="form-control" id="jumlah_porsi" name="jumlah_porsi" value="<?= old('jumlah_porsi') ?>" min="1" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="menu_makan" class="form-label">Menu yang Akan Dibuat</label>
                    <textarea class="form-control" id="menu_makan" name="menu_makan" rows="2" required><?= old('menu_makan') ?></textarea>
                </div>

                <hr>

                <h5>Daftar Bahan Baku yang Diminta</h5>
                <div id="daftar-bahan">
                </div>

                <button type="button" id="tambah-bahan" class="btn btn-outline-primary mt-2">
                    <i class="fas fa-plus"></i> Tambah Bahan
                </button>

                <div class="mt-4">
                    <a href="/dapur" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Kirim Permintaan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('daftar-bahan');
        const addButton = document.getElementById('tambah-bahan');
        let bahanCounter = 0;

        function addBahanRow() {
            bahanCounter++;
            const row = document.createElement('div');
            row.className = 'row align-items-end mb-2 bahan-row';
            row.innerHTML = `
                <div class="col-md-6">
                    <label class="form-label">Nama Bahan</label>
                    <select class="form-select" name="bahan_id[]" required>
                        <option value="">-- Pilih Bahan --</option>
                        <?php foreach ($bahan_tersedia as $bahan) : ?>
                            <option value="<?= $bahan['id'] ?>"><?= esc($bahan['nama']) ?> (Stok: <?= $bahan['jumlah'] ?> <?= $bahan['satuan'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah[]" min="1" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-bahan w-100">Hapus</button>
                </div>
            `;
            container.appendChild(row);
        }
        addBahanRow();

        addButton.addEventListener('click', addBahanRow);
        container.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-bahan')) {
                // Jangan hapus jika hanya ada satu baris
                if (container.querySelectorAll('.bahan-row').length > 1) {
                    e.target.closest('.bahan-row').remove();
                } else {
                    alert('Minimal harus ada satu bahan baku yang diminta.');
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>