<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Admin LPM - Politeknik Piksi Ganesha' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom Admin CSS -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --sidebar-width: 260px;
            --header-height: 60px;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-color), #34495e);
            color: white;
            z-index: 1000;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header h5 {
            margin: 0.5rem 0 0.25rem 0;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .sidebar-header small {
            opacity: 0.8;
            font-size: 0.8rem;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-item {
            margin: 0.25rem 0;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .menu-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            padding-left: 2rem;
        }
        
        .menu-link.active {
            background: var(--secondary-color);
            color: white;
            border-right: 3px solid var(--accent-color);
        }
        
        .menu-link i {
            width: 20px;
            margin-right: 0.75rem;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        
        /* Header */
        .main-header {
            background: white;
            height: var(--header-height);
            padding: 0 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .header-left h6 {
            margin: 0;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .content-wrapper {
            padding: 2rem;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-menu-btn {
                display: block !important;
            }
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="text-center">
                <i class="fas fa-shield-alt fa-2x mb-2"></i>
                <h5>Admin LPM</h5>
                <small>Politeknik Piksi Ganesha</small>
            </div>
        </div>
        
        <nav class="sidebar-menu">
            <div class="menu-item">
                <a href="<?= base_url('admin') ?>" class="menu-link <?= (isset($active_menu) && $active_menu == 'dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </div>
            <div class="menu-item">
                <a href="<?= base_url('admin/kegiatan') ?>" class="menu-link <?= (isset($active_menu) && $active_menu == 'kegiatan') ? 'active' : '' ?>">
                    <i class="fas fa-calendar-alt"></i>
                    Kegiatan
                </a>
            </div>
            <div class="menu-item">
                <a href="<?= base_url('admin/struktur') ?>" class="menu-link <?= (isset($active_menu) && $active_menu == 'struktur') ? 'active' : '' ?>">
                    <i class="fas fa-sitemap"></i>
                    Struktur Organisasi
                </a>
            </div>
            <div class="menu-item">
                <a href="<?= base_url('admin/dokumen') ?>" class="menu-link <?= (isset($active_menu) && $active_menu == 'dokumen') ? 'active' : '' ?>">
                    <i class="fas fa-file-alt"></i>
                    Dokumen SPMI
                </a>
            </div>
            
            <div class="menu-item">
                <a href="<?= base_url('admin/prodi') ?>" class="menu-link <?= (isset($active_menu) && $active_menu == 'prodi') ? 'active' : '' ?>">
                    <i class="fas fa-graduation-cap"></i>
                    Program Studi
                </a>
            </div>            
            <div class="menu-item">
                <a href="<?= base_url('admin/akreditasi') ?>" class="menu-link <?= (isset($active_menu) && $active_menu == 'akreditasi') ? 'active' : '' ?>">
                    <i class="fas fa-certificate"></i>
                    Akreditasi
                </a>
            </div>
            <div class="menu-item">
                <a href="<?= base_url('admin/laporan') ?>" class="menu-link <?= (isset($active_menu) && $active_menu == 'laporan') ? 'active' : '' ?>">
                    <i class="fas fa-chart-bar"></i>
                    Laporan AMI
                </a>
            </div>
            <div class="menu-item">
                <a href="<?= base_url('admin/settingconfig') ?>" class="menu-link <?= (isset($active_menu) && $active_menu == 'pengaturan') ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i>
                    Pengaturan
                </a>
            </div>
        </nav>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div class="header-left">
                <button class="mobile-menu-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h6>Sistem Administrasi LPM</h6>
            </div>
            <div class="header-right">
                <div class="user-info">
                    <div class="user-avatar">
                        <?= strtoupper(substr($this->session->userdata('admin_name') ?? 'A', 0, 1)) ?>
                    </div>
                    <div>
                        <small class="text-muted d-block">Selamat datang,</small>
                        <strong><?= $this->session->userdata('admin_name') ?? 'Administrator' ?></strong>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= base_url('admin/profile') ?>">
                                <i class="fas fa-user me-2"></i>Profil
                            </a></li>
                            <li><a class="dropdown-item" href="<?= base_url('admin/pengaturan') ?>">
                                <i class="fas fa-cog me-2"></i>Pengaturan
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('admin/logout') ?>">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Content -->
        <div class="content-wrapper">
            <?= $content ?>
        </div>
    </div>
    
    <!-- Scripts -->
	 <script src="<?= base_url('assets/admin/assets/js/core/jquery-3.7.1.min.js') ?>"></script>
	 <script src="<?= base_url('assets/admin/assets/js/plugin/datatables/datatables.min.js') ?>"></script>
	 <script src="<?= base_url('assets/admin/assets/js/plugin/datatables/datatables.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/app.js') ?>"></script>
        <!-- SettingConfig AJAX CRUD -->
        <script src="<?= base_url('assets/js/app.settingconfig.js') ?>"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const menuBtn = document.querySelector('.mobile-menu-btn');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(e.target) && 
                !menuBtn.contains(e.target) && 
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>
</html>
