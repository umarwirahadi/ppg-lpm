<?php
// application/views/frontend/detail-prodi.php
// Expects $prodi passed from controller
?>
<div class="container py-4">
    <div class="row mb-3">
        <div class="col-12">
            <a href="<?php echo site_url('prodi'); ?>" class="btn btn-link">&larr; Kembali ke Daftar Program Studi</a>
            <h1 class="h3 mt-2"><?php echo htmlspecialchars($prodi['nama_prodi']); ?></h1>
            <p class="text-muted"><?php echo htmlspecialchars($prodi['fakultas'] ?? ''); ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Informasi Umum</h5>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Kode</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($prodi['kode'] ?? '-'); ?></dd>

                        <dt class="col-sm-4">Ketua Prodi</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($prodi['ketua_prodi'] ?? '-'); ?></dd>

                        <dt class="col-sm-4">Sekretaris Prodi</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($prodi['sekretaris_prodi'] ?? '-'); ?></dd>

                        <dt class="col-sm-4">Akreditasi</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($prodi['akreditasi'] ?? '-'); ?></dd>

                        <dt class="col-sm-4">Berlaku Akreditasi</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($prodi['tgl_berlaku_akreditasi'] ?? '-'); ?></dd>

                        <dt class="col-sm-4">Berakhir Akreditasi</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($prodi['tgl_berakhir_akreditasi'] ?? '-'); ?></dd>

                        <dt class="col-sm-4">No. SK</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($prodi['no_sk'] ?? '-'); ?></dd>
                    </dl>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Keterangan</h5>
                    <div>
                        <?php echo !empty($prodi['keterangan']) ? $prodi['keterangan'] : '<p>Tidak ada keterangan tambahan.</p>'; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kontak & Informasi</h5>
                    <p class="mb-0">Untuk informasi lebih lanjut terkait program studi, silakan hubungi pihak fakultas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
