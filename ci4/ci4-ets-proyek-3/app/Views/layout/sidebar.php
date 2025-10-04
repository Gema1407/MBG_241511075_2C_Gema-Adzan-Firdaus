<?php $uri = service('uri'); ?>

<nav id="sidebar-themed" class="text-white p-3">
    <div class="sidebar-header border-bottom border-secondary pb-3 mb-3">
        <h3 class="text-center"><b>MBG</b> Monitor</h3>
    </div>

     <ul class="list-unstyled components">
        <p class="text-center small"><?= ucfirst(session()->get('role')) ?></p>
        
        <?php if (session()->get('role') == 'gudang') : ?>
            <li class="nav-item mb-1">
                <?php ?>
                <a class="nav-link text-white rounded <?= ($uri->getSegment(1) === 'gudang' && !$uri->getSegment(2)) ? 'active' : '' ?>" href="<?= site_url('gudang') ?>">
                    <i class="fas fa-tachometer-alt fa-fw me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <?php ?>
                <a class="nav-link text-white rounded <?= ($uri->getSegment(1) === 'gudang' && $uri->getSegment(2) === 'bahan_baku' && !$uri->getSegment(3)) ? 'active' : '' ?>" href="<?= site_url('gudang/bahan_baku') ?>">
                    <i class="fas fa-boxes fa-fw me-2"></i>Data Bahan Baku
                </a>
            </li>
            <li class="nav-item mb-1">
                 <?php ?>
                <a class="nav-link text-white rounded <?= ($uri->getSegment(1) === 'gudang' && $uri->getSegment(2) === 'bahan_baku' && $uri->getSegment(3) === 'tambah') ? 'active' : '' ?>" href="<?= site_url('gudang/bahan_baku/tambah') ?>">
                    <i class="fas fa-plus fa-fw me-2"></i>Tambah Bahan
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-white rounded" href="#">
                    <i class="fas fa-clipboard-list fa-fw me-2"></i>Permintaan Dapur
                </a>
            </li>
        <?php else : ?>
            <?php // Logika untuk role dapur ?>
            <li class="nav-item">
                <a class="nav-link text-white rounded <?= ($uri->getSegment(1) == 'dapur' && !$uri->getSegment(2)) ? 'active' : '' ?>" href="<?= site_url('dapur') ?>">
                    <i class="fas fa-tachometer-alt fa-fw me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white rounded" href="#"><i class="fas fa-plus fa-fw me-2"></i>Buat Permintaan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white rounded" href="#"><i class="fas fa-history fa-fw me-2"></i>Riwayat Permintaan</a>
            </li>
        <?php endif; ?>
    </ul>
    
    </nav>