<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-light">
            <i class="fas fa-align-left"></i>
        </button>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw me-1"></i>
                    <?= session()->get('name') ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= site_url('logout') ?>">Logout</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>