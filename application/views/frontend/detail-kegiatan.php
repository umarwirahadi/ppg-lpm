
<!-- Activity Detail Content -->
<section class="content-section mt-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Activity Information -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="card-title text-primary mb-3">
                            <i class="fas fa-info-circle me-2"></i>Informasi Kegiatan
                        </h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>📅 Tanggal:</strong><br>
                                <span class="text-muted"><?= isset($kegiatan['tanggal']) ? $kegiatan['tanggal'] : '15-20 Januari 2026' ?></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>⏰ Waktu:</strong><br>
                                <span class="text-muted"><?= isset($kegiatan['waktu']) ? $kegiatan['waktu'] : '08:00 - 16:00 WIB' ?></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>📍 Tempat:</strong><br>
                                <span class="text-muted"><?= isset($kegiatan['tempat']) ? $kegiatan['tempat'] : 'Kampus Politeknik Piksi Ganesha' ?></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>👥 Peserta:</strong><br>
                                <span class="text-muted"><?= isset($kegiatan['peserta']) ? $kegiatan['peserta'] : 'Dosen dan Tenaga Kependidikan' ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Description -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="card-title text-primary mb-3">
                            <i class="fas fa-align-left me-2"></i>Deskripsi Kegiatan
                        </h3>
                        <div class="activity-description">
                            <?php if(isset($kegiatan['deskripsi'])): ?>
                                <?= $kegiatan['deskripsi'] ?>
                            <?php else: ?>
                                <p>Audit Mutu Internal (AMI) merupakan kegiatan rutin yang dilaksanakan oleh Lembaga Penjaminan Mutu (LPM) Politeknik Piksi Ganesha untuk memastikan bahwa seluruh program studi dan unit kerja telah menjalankan sistem penjaminan mutu yang telah ditetapkan.</p>
                                
                                <h5>Tujuan Kegiatan:</h5>
                                <ul>
                                    <li>Memastikan implementasi Sistem Penjaminan Mutu Internal (SPMI) di seluruh unit kerja</li>
                                    <li>Mengidentifikasi area-area yang perlu diperbaiki dalam proses pembelajaran dan pengelolaan</li>
                                    <li>Memberikan rekomendasi untuk peningkatan mutu berkelanjutan</li>
                                    <li>Mempersiapkan dokumentasi untuk akreditasi eksternal</li>
                                </ul>

                                <h5>Ruang Lingkup Audit:</h5>
                                <ul>
                                    <li>Standar Pendidikan (Kompetensi Lulusan, Isi, Proses, Penilaian)</li>
                                    <li>Standar Penelitian</li>
                                    <li>Standar Pengabdian kepada Masyarakat</li>
                                    <li>Standar Pengelolaan dan Kemahasiswaan</li>
                                    <li>Standar Sarana dan Prasarana</li>
                                    <li>Standar Pembiayaan</li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Activity Photos/Gallery -->
                <?php if(isset($kegiatan['gallery']) && !empty($kegiatan['gallery'])): ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="card-title text-primary mb-3">
                            <i class="fas fa-images me-2"></i>Galeri Kegiatan
                        </h3>
                        <div class="row">
                            <?php foreach($kegiatan['gallery'] as $photo): ?>
                            <div class="col-md-4 mb-3">
                                <img src="<?= base_url('assets/img/gallery/' . $photo) ?>" class="img-fluid rounded shadow-sm" alt="Foto Kegiatan" style="height: 200px; object-fit: cover; width: 100%;">
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="card-title text-primary mb-3">
                            <i class="fas fa-images me-2"></i>Galeri Kegiatan
                        </h3>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <img src="<?= base_url('assets/img/audit-1.jpg') ?>" class="img-fluid rounded shadow-sm" alt="Audit Meeting" style="height: 200px; object-fit: cover; width: 100%;">
                                <p class="small text-muted mt-1">Rapat persiapan audit</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <img src="<?= base_url('assets/img/audit-2.jpg') ?>" class="img-fluid rounded shadow-sm" alt="Document Review" style="height: 200px; object-fit: cover; width: 100%;">
                                <p class="small text-muted mt-1">Review dokumen</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <img src="<?= base_url('assets/img/audit-3.jpg') ?>" class="img-fluid rounded shadow-sm" alt="Interview Session" style="height: 200px; object-fit: cover; width: 100%;">
                                <p class="small text-muted mt-1">Sesi wawancara</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Activity Timeline -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="card-title text-primary mb-3">
                            <i class="fas fa-calendar-alt me-2"></i>Jadwal Kegiatan
                        </h3>
                        <div class="timeline">
                            <?php if(isset($kegiatan['timeline']) && !empty($kegiatan['timeline'])): ?>
                                <?php foreach($kegiatan['timeline'] as $item): ?>
                                <div class="timeline-item">
                                    <div class="timeline-time"><?= $item['waktu'] ?></div>
                                    <div class="timeline-content">
                                        <h6><?= $item['judul'] ?></h6>
                                        <p class="mb-0"><?= $item['deskripsi'] ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="timeline-item">
                                    <div class="timeline-time">Hari 1</div>
                                    <div class="timeline-content">
                                        <h6>Persiapan dan Briefing Tim Auditor</h6>
                                        <p class="mb-0">Koordinasi tim auditor internal dan persiapan dokumen audit</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-time">Hari 2-4</div>
                                    <div class="timeline-content">
                                        <h6>Pelaksanaan Audit ke Program Studi</h6>
                                        <p class="mb-0">Audit dokumentasi, observasi, dan wawancara di seluruh program studi</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-content">
                                        <h6>Audit Unit Penunjang</h6>
                                        <p class="mb-0">Audit pada unit-unit penunjang akademik</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-time">Hari 5</div>
                                    <div class="timeline-content">
                                        <h6>Kompilasi Hasil dan Pelaporan</h6>
                                        <p class="mb-0">Penyusunan laporan hasil audit dan rekomendasi perbaikan</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Contact Person -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary mb-3">
                            <i class="fas fa-user-tie me-2"></i>Penanggung Jawab
                        </h5>
                        <div class="contact-person">
                            <p><strong><?= isset($kegiatan['pic_nama']) ? $kegiatan['pic_nama'] : 'Dr. Ahmad Sutanto, M.T.' ?></strong></p>
                            <p class="text-muted"><?= isset($kegiatan['pic_jabatan']) ? $kegiatan['pic_jabatan'] : 'Ketua LPM' ?></p>
                            <p><i class="fas fa-phone me-2"></i><?= isset($kegiatan['pic_phone']) ? $kegiatan['pic_phone'] : '(022) 1234-5678' ?></p>
                            <p><i class="fas fa-envelope me-2"></i><?= isset($kegiatan['pic_email']) ? $kegiatan['pic_email'] : 'lpm@piksi.ac.id' ?></p>
                        </div>
                    </div>
                </div>

                <!-- Related Documents -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary mb-3">
                            <i class="fas fa-file-alt me-2"></i>Dokumen Terkait
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <i class="fas fa-file-pdf text-danger me-2"></i>Panduan AMI 2026.pdf
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <i class="fas fa-file-word text-primary me-2"></i>Form Checklist Audit.docx
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <i class="fas fa-file-excel text-success me-2"></i>Jadwal Audit Detail.xlsx
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <i class="fas fa-file-pdf text-danger me-2"></i>Standar SPMI Politeknik.pdf
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary mb-3">
                            <i class="fas fa-cog me-2"></i>Aksi Cepat
                        </h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-primary">
                                <i class="fas fa-calendar-plus me-2"></i>Daftarkan Kegiatan
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-download me-2"></i>Download Materi
                            </a>
                            <a href="#" class="btn btn-outline-secondary">
                                <i class="fas fa-share-alt me-2"></i>Bagikan Kegiatan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Related Activities -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary mb-3">
                            <i class="fas fa-list-alt me-2"></i>Kegiatan Terkait
                        </h5>
                        <div class="related-activities">
                            <div class="mb-3 pb-3 border-bottom">
                                <h6><a href="#" class="text-decoration-none">Workshop SPMI</a></h6>
                                <p class="small text-muted mb-1">25 Januari 2026</p>
                                <span class="badge bg-primary small">Akan Datang</span>
                            </div>
                            <div class="mb-3 pb-3 border-bottom">
                                <h6><a href="#" class="text-decoration-none">Rapat Tinjauan Manajemen</a></h6>
                                <p class="small text-muted mb-1">5 Februari 2026</p>
                                <span class="badge bg-info small">Persiapan</span>
                            </div>
                            <div class="mb-0">
                                <h6><a href="#" class="text-decoration-none">Pelatihan Auditor Internal</a></h6>
                                <p class="small text-muted mb-1">15 Februari 2026</p>
                                <span class="badge bg-primary small">Akan Datang</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="row mt-4">
            <div class="col-12">
                <a href="<?= base_url('kegiatan') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Kegiatan
                </a>
            </div>
        </div>
    </div>
</section>

<style>
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
    background: var(--primary-color);
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -24px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: var(--accent-color);
    border: 2px solid white;
    box-shadow: 0 0 0 3px var(--primary-color);
}

.timeline-time {
    font-weight: bold;
    color: var(--primary-color);
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.timeline-content h6 {
    margin-bottom: 5px;
    color: var(--text-color);
}

.timeline-content p {
    color: #666;
    font-size: 0.9rem;
}

/* Contact Person Styling */
.contact-person p {
    margin-bottom: 8px;
}

.contact-person i {
    width: 20px;
    color: var(--primary-color);
}

/* Activity Description Styling */
.activity-description h5 {
    color: var(--primary-color);
    margin-top: 25px;
    margin-bottom: 15px;
}

.activity-description ul {
    padding-left: 20px;
}

.activity-description li {
    margin-bottom: 8px;
}

/* Related Activities Styling */
.related-activities h6 a:hover {
    color: var(--primary-color) !important;
}

/* Badge Styling */
.badge.fs-6 {
    font-size: 1rem !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-section .row {
        text-align: center;
    }
    
    .hero-section .col-md-4 {
        margin-top: 20px;
    }
    
    .timeline {
        padding-left: 20px;
    }
    
    .timeline::before {
        left: 10px;
    }
    
    .timeline-item::before {
        left: -19px;
    }
}
</style>
