<?php $uri = service('uri'); ?>

<nav id="sidebar-themed" class="text-white p-3">
    <div class="sidebar-header border-bottom border-secondary pb-3 mb-3">
        <h3 class="text-center"><b>MBG</b> Monitor</h3>
    </div>

    <ul class="list-unstyled components">
        <p class="text-center small"><?= ucfirst(session()->get('role')) ?></p>
        
        <?php if (session()->get('role') == 'gudang') : ?>
            <li class="nav-item mb-1">
                <a class="nav-link text-white rounded <?= ($uri->getSegment(1) === 'gudang' && !$uri->getSegment(2)) ? 'active' : '' ?>" href="<?= site_url('gudang') ?>">
                    <i class="fas fa-tachometer-alt fa-fw me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-white rounded <?= ($uri->getSegment(1) === 'gudang' && $uri->getSegment(2) === 'bahan_baku') ? 'active' : '' ?>" href="<?= site_url('gudang/bahan_baku') ?>">
                    <i class="fas fa-boxes fa-fw me-2"></i>Data Bahan Baku
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-white rounded <?= ($uri->getSegment(1) === 'gudang' && $uri->getSegment(2) === 'permintaan') ? 'active' : '' ?>" href="<?= site_url('gudang/permintaan') ?>">
                    <i class="fas fa-clipboard-list fa-fw me-2"></i>Daftar Permintaan
                </a>
            </li>
        
        <?php elseif (session()->get('role') == 'dapur') : ?>
            <li class="nav-item mb-1">
                <a class="nav-link text-white rounded <?= ($uri->getSegment(1) === 'dapur' && !$uri->getSegment(2)) ? 'active' : '' ?>" href="<?= site_url('dapur') ?>">
                    <i class="fas fa-tachometer-alt fa-fw me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-white rounded <?= ($uri->getSegment(1) === 'dapur' && $uri->getSegment(2) === 'riwayat') ? 'active' : '' ?>" href="<?= site_url('dapur/riwayat') ?>">
                    <i class="fas fa-history fa-fw me-2"></i>Riwayat Permintaan
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>