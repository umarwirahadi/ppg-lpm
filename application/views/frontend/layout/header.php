<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'LPM - Web Solutions' ?></title>
    
    <?php if(isset($meta_description) && !empty($meta_description)): ?>
    <meta name="description" content="<?= $meta_description ?>">
    <?php endif; ?>
    
    <?php if(isset($meta_keywords) && !empty($meta_keywords)): ?>
    <meta name="keywords" content="<?= $meta_keywords ?>">
    <?php endif; ?>
    
    <meta name="author" content="LPM Web Solutions">
    <meta name="robots" content="index, follow">
    
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.ico') ?>">
</head>
<body>
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="LPM Logo" class="img-fluid">
                <span class="ms-2 fw-bold">Lembaga Penjaminan Mutu (LPM) <br><small>Politeknik Piksi Ganesha</small></span>
            </a>
            
            <!-- Mobile Menu Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_menu) && $active_menu == 'home') ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= (isset($active_menu) && $active_menu == 'profile') ? 'active' : '' ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item <?= (isset($active_submenu) && $active_submenu == 'visi-misi') ? 'active' : '' ?>" href="<?= base_url('profile/visi-misi') ?>">Visi Misi</a></li>
                            <li><a class="dropdown-item <?= (isset($active_submenu) && $active_submenu == 'struktur-organisasi') ? 'active' : '' ?>" href="<?= site_url('profile/struktur-organisasi') ?>">Struktur Organisasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_menu) && $active_menu == 'prodi') ? 'active' : '' ?>" href="<?= base_url('data-program-studi') ?>">Program Studi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_menu) && $active_menu == 'laporan') ? 'active' : '' ?>" href="<?= base_url('data-laporan') ?>">Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_menu) && $active_menu == 'dokumen-spmi') ? 'active' : '' ?>" href="<?= base_url('dokumen-spmi') ?>">Dokumen SPMI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($active_menu) && $active_menu == 'kegiatan') ? 'active' : '' ?>" href="<?= base_url('kegiatan') ?>">Kegiatan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
