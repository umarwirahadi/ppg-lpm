<!-- Dashboard Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
</div>

<!-- Dashboard Statistics -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-white"><?= $stats['total_kegiatan'] ?? ''?></h4>
                        <p class="mb-0">Total Kegiatan</p>
                    </div>
                    <div class="widget-icon">
                        <i class="fas fa-calendar-alt fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-white"><?= $stats['kegiatan_berlangsung'] ?? '' ?></h4>
                        <p class="mb-0">Kegiatan Berlangsung</p>
                    </div>
                    <div class="widget-icon">
                        <i class="fas fa-play-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-white"><?= $stats['total_dokumen'] ?? '' ?></h4>
                        <p class="mb-0">Dokumen SPMI</p>
                    </div>
                    <div class="widget-icon">
                        <i class="fas fa-file-alt fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-white"><?= $stats['total_prodi'] ?? '' ?></h4>
                        <p class="mb-0">Program Studi</p>
                    </div>
                    <div class="widget-icon">
                        <i class="fas fa-graduation-cap fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Activities -->
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock me-2"></i>Aktivitas Terbaru
                </h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <?php foreach($recent_activities as $activity): ?>
                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <i class="<?= $activity['icon'] ?? '' ?> text-<?= $activity['type'] ?? '' ?>"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 class="timeline-title"><?= $activity['title'] ?? '' ?></h6>
                            <p class="timeline-description"><?= $activity['description'] ?? '' ?></p>
                            <small class="text-muted"><?= $activity['time'] ?? '' ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upcoming Events -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar-check me-2"></i>Agenda Mendatang
                </h5>
            </div>
            <div class="card-body">
                <div class="upcoming-events">
                    <?php foreach($upcoming_events ?? [] as $event): ?>
                    <div class="event-item mb-3 p-3 border rounded">
                        <h6 class="event-title mb-1"><?= $event['title'] ?? '' ?></h6>
                        <div class="event-details">
                            <small class="text-muted d-block">
                                <i class="fas fa-calendar me-1"></i><?= $event['date'] ?? '' ?>
                            </small>
                            <small class="text-muted d-block">
                                <i class="fas fa-clock me-1"></i><?= $event['time'] ?? '' ?>
                            </small>
                            <small class="text-muted d-block">
                                <i class="fas fa-map-marker-alt me-1"></i><?= $event['location'] ?? '' ?>
                            </small>
                        </div>
                        <span class="badge bg-<?= $event['status'] === 'scheduled' ? 'primary' : 'warning' ?> mt-1">
                            <?= $event['status'] === 'scheduled' ? 'Terjadwal' : 'Persiapan' ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center">
                    <a href="<?= base_url('admin/kegiatan') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye me-1"></i>Lihat Semua
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt me-2"></i>Aksi Cepat
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('admin/kegiatan/add') ?>" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-2"></i>Tambah Kegiatan
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('admin/dokumen') ?>" class="btn btn-success w-100">
                            <i class="fas fa-file-upload me-2"></i>Upload Dokumen
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('admin/audit') ?>" class="btn btn-warning w-100">
                            <i class="fas fa-clipboard-check me-2"></i>Buat Audit
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('admin/laporan') ?>" class="btn btn-info w-100">
                            <i class="fas fa-chart-bar me-2"></i>Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Specific Styles */
.page-title-box {
    padding-bottom: 20px;
}

.page-title {
    margin: 0;
    font-size: 1.75rem;
    font-weight: 600;
    color: #495057;
}

.breadcrumb {
    background: none;
    padding: 0;
    margin-bottom: 0;
}

.widget-icon {
    opacity: 0.8;
}

/* Timeline Styles */
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 25px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 2px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: white;
    border: 2px solid #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
}

.timeline-content {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    border-left: 3px solid #dee2e6;
}

.timeline-title {
    margin: 0 0 5px 0;
    font-size: 1rem;
    font-weight: 600;
    color: #495057;
}

.timeline-description {
    margin: 0 0 8px 0;
    color: #6c757d;
    font-size: 0.9rem;
}

/* Event Item Styles */
.event-item {
    transition: all 0.2s ease;
}

.event-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transform: translateY(-1px);
}

.event-title {
    color: #495057;
    font-weight: 600;
}

.event-details small {
    line-height: 1.4;
}

/* Card Hover Effects */
.card {
    transition: all 0.2s ease;
    border: 1px solid rgba(0,0,0,.125);
}

.card:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Statistics Cards */
.card.bg-primary:hover,
.card.bg-success:hover,
.card.bg-warning:hover,
.card.bg-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}
</style>
