<nav id="sidebar" class="bg-dark text-white p-3">
    <div class="sidebar-header">
        <h3 class="text-center">MBG Monitor</h3>
    </div>

    <ul class="list-unstyled components">
        <p class="text-center"><?= session()->get('name') ?> <br><small>(<?= ucfirst(session()->get('role')) ?>)</small></p>
        
        <?php if (session()->get('role') == 'gudang') : ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= site_url('gudang') ?>"><i class="fas fa-tachometer-alt fa-fw me-2"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#"><i class="fas fa-boxes fa-fw me-2"></i>Data Bahan Baku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= site_url('gudang/bahan-baku/new') ?>"><i class="fas fa-plus fa-fw me-2"></i>Tambah Bahan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#"><i class="fas fa-clipboard-list fa-fw me-2"></i>Permintaan Dapur</a>
            </li>
        <?php else : ?>
            <?php endif; ?>
    </ul>

    <ul class="list-unstyled CTAs mt-auto">
        <li>
            <a href="<?= site_url('logout') ?>" class="btn btn-danger w-100">Logout <i class="fas fa-sign-out-alt"></i></a>
        </li>
    </ul>
</nav>