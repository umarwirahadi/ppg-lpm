<!-- Organizational Structure -->
<section class="org-section py-5 mt-5">
    <div class="container">
        <!-- Page Header -->
        <div class="org-header text-center mb-5 animate-fade-in">
            <h1 class="org-title">Struktur Organisasi</h1>
            <p class="org-subtitle">Lembaga Penjaminan Mutu Politeknik Piksi Ganesha</p>
            <div class="org-divider"></div>
        </div>

        <?php 
        $hasData = !empty($struktur_data) && (!empty($struktur_data['direktur']) || !empty($struktur_data['manajer']) || !empty($struktur_data['staff']) || !empty($struktur_data['admin']));
        $cardIndex = 0;
        ?>

        <?php if ($hasData): ?>
        <!-- Org Chart Tree -->
        <div class="org-tree">
            
            <!-- Direktur (Top Level) -->
            <?php if (!empty($struktur_data['direktur'])): ?>
            <div class="org-level org-level-top mb-5">
                <div class="row justify-content-center">
                    <?php foreach ($struktur_data['direktur'] as $direktur): ?>
                    <div class="col-lg-5 col-md-7">
                        <div class="org-card org-card--leader animate-card" data-delay="<?= $cardIndex++ ?>">
                            <div class="org-card__ribbon">Pimpinan</div>
                            <div class="org-card__avatar org-card__avatar--lg">
                                <?php if (!empty($direktur['foto'])): ?>
                                    <img src="<?= base_url('assets/img/struktur/' . $direktur['foto']) ?>" alt="<?= htmlspecialchars($direktur['nama']) ?>">
                                <?php else: ?>
                                    <div class="org-card__avatar-placeholder">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/></svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="org-card__body">
                                <h3 class="org-card__name"><?= htmlspecialchars($direktur['nama']) ?></h3>
                                <span class="org-card__role"><?= htmlspecialchars($direktur['jabatan']) ?></span>
                                <?php if (!empty($direktur['pendidikan_terakhir'])): ?>
                                <span class="org-card__edu"><?= htmlspecialchars($direktur['pendidikan_terakhir']) ?></span>
                                <?php endif; ?>
                                <?php if (!empty($direktur['deskripsi'])): ?>
                                <p class="org-card__desc"><?= htmlspecialchars($direktur['deskripsi']) ?></p>
                                <?php endif; ?>
                                <div class="org-card__contact">
                                    <?php if (!empty($direktur['email'])): ?>
                                    <a href="mailto:<?= $direktur['email'] ?>" class="org-card__link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/></svg>
                                        <?= htmlspecialchars($direktur['email']) ?>
                                    </a>
                                    <?php endif; ?>
                                    <?php if (!empty($direktur['telepon'])): ?>
                                    <a href="tel:<?= $direktur['telepon'] ?>" class="org-card__link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg>
                                        <?= htmlspecialchars($direktur['telepon']) ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($struktur_data['manajer']) || !empty($struktur_data['staff']) || !empty($struktur_data['admin'])): ?>
                <div class="org-connector"></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Manajer (Second Level) -->
            <?php if (!empty($struktur_data['manajer'])): ?>
            <div class="org-level org-level-mid mb-5">
                <h4 class="org-level__title animate-fade-in">
                    <span>Manajer</span>
                </h4>
                <div class="row g-4 justify-content-center">
                    <?php foreach ($struktur_data['manajer'] as $manajer): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="org-card org-card--manager animate-card" data-delay="<?= $cardIndex++ ?>">
                            <div class="org-card__badge org-card__badge--success">Manajer</div>
                            <div class="org-card__avatar">
                                <?php if (!empty($manajer['foto'])): ?>
                                    <img src="<?= base_url('assets/img/struktur/' . $manajer['foto']) ?>" alt="<?= htmlspecialchars($manajer['nama']) ?>">
                                <?php else: ?>
                                    <div class="org-card__avatar-placeholder">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/></svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="org-card__body">
                                <h4 class="org-card__name"><?= htmlspecialchars($manajer['nama']) ?></h4>
                                <span class="org-card__role"><?= htmlspecialchars($manajer['jabatan']) ?></span>
                                <?php if (!empty($manajer['pendidikan_terakhir'])): ?>
                                <span class="org-card__edu"><?= htmlspecialchars($manajer['pendidikan_terakhir']) ?></span>
                                <?php endif; ?>
                                <div class="org-card__contact">
                                    <?php if (!empty($manajer['email'])): ?>
                                    <a href="mailto:<?= $manajer['email'] ?>" class="org-card__link" title="<?= htmlspecialchars($manajer['email']) ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/></svg>
                                    </a>
                                    <?php endif; ?>
                                    <?php if (!empty($manajer['telepon'])): ?>
                                    <a href="tel:<?= $manajer['telepon'] ?>" class="org-card__link" title="<?= htmlspecialchars($manajer['telepon']) ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($struktur_data['staff']) || !empty($struktur_data['admin'])): ?>
                <div class="org-connector org-connector--short"></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Staff (Third Level) -->
            <?php if (!empty($struktur_data['staff'])): ?>
            <div class="org-level org-level-staff mb-5">
                <h4 class="org-level__title animate-fade-in">
                    <span>Staff</span>
                </h4>
                <div class="row g-3 justify-content-center">
                    <?php foreach ($struktur_data['staff'] as $staff): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="org-card org-card--staff animate-card" data-delay="<?= $cardIndex++ ?>">
                            <div class="org-card__badge org-card__badge--info">Staff</div>
                            <div class="org-card__avatar org-card__avatar--sm">
                                <?php if (!empty($staff['foto'])): ?>
                                    <img src="<?= base_url('assets/img/struktur/' . $staff['foto']) ?>" alt="<?= htmlspecialchars($staff['nama']) ?>">
                                <?php else: ?>
                                    <div class="org-card__avatar-placeholder">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/></svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="org-card__body">
                                <h5 class="org-card__name"><?= htmlspecialchars($staff['nama']) ?></h5>
                                <span class="org-card__role"><?= htmlspecialchars($staff['jabatan']) ?></span>
                                <div class="org-card__contact org-card__contact--compact">
                                    <?php if (!empty($staff['email'])): ?>
                                    <a href="mailto:<?= $staff['email'] ?>" class="org-card__icon-link" title="Email">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/></svg>
                                    </a>
                                    <?php endif; ?>
                                    <?php if (!empty($staff['telepon'])): ?>
                                    <a href="tel:<?= $staff['telepon'] ?>" class="org-card__icon-link" title="Telepon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($struktur_data['admin'])): ?>
                <div class="org-connector org-connector--short"></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Admin (Fourth Level) -->
            <?php if (!empty($struktur_data['admin'])): ?>
            <div class="org-level org-level-admin">
                <h4 class="org-level__title animate-fade-in">
                    <span>Administrasi</span>
                </h4>
                <div class="row g-3 justify-content-center">
                    <?php foreach ($struktur_data['admin'] as $admin): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="org-card org-card--admin animate-card" data-delay="<?= $cardIndex++ ?>">
                            <div class="org-card__badge org-card__badge--warning">Admin</div>
                            <div class="org-card__avatar org-card__avatar--sm">
                                <?php if (!empty($admin['foto'])): ?>
                                    <img src="<?= base_url('assets/img/struktur/' . $admin['foto']) ?>" alt="<?= htmlspecialchars($admin['nama']) ?>">
                                <?php else: ?>
                                    <div class="org-card__avatar-placeholder">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/></svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="org-card__body">
                                <h5 class="org-card__name"><?= htmlspecialchars($admin['nama']) ?></h5>
                                <span class="org-card__role"><?= htmlspecialchars($admin['jabatan']) ?></span>
                                <div class="org-card__contact org-card__contact--compact">
                                    <?php if (!empty($admin['email'])): ?>
                                    <a href="mailto:<?= $admin['email'] ?>" class="org-card__icon-link" title="Email">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/></svg>
                                    </a>
                                    <?php endif; ?>
                                    <?php if (!empty($admin['telepon'])): ?>
                                    <a href="tel:<?= $admin['telepon'] ?>" class="org-card__icon-link" title="Telepon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <!-- Empty State -->
        <div class="org-empty text-center py-5 animate-fade-in">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="text-muted mb-4" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/></svg>
            <h3 class="text-muted mb-2">Data Struktur Organisasi Belum Tersedia</h3>
            <p class="text-muted small">Saat ini data struktur organisasi belum diinputkan atau sedang dalam proses pembaruan.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* ===== Organization Chart Styles ===== */
.org-section { background: linear-gradient(180deg, #f8fafc 0%, #fff 100%); }

/* Header */
.org-header { padding-top: 1rem; }
.org-title { font-size: 2rem; font-weight: 700; color: #1e293b; margin-bottom: .5rem; }
.org-subtitle { color: #64748b; font-size: 1rem; margin-bottom: 1rem; }
.org-divider { width: 60px; height: 4px; background: linear-gradient(90deg, #3b82f6, #8b5cf6); border-radius: 2px; margin: 0 auto; }

/* Connector Lines */
.org-connector { width: 2px; height: 40px; background: linear-gradient(180deg, #cbd5e1, #e2e8f0); margin: 0 auto; position: relative; }
.org-connector::after { content: ''; position: absolute; bottom: -6px; left: 50%; transform: translateX(-50%); width: 12px; height: 12px; background: #e2e8f0; border-radius: 50%; border: 2px solid #fff; }
.org-connector--short { height: 30px; }

/* Level Titles */
.org-level__title { text-align: center; margin-bottom: 1.5rem; font-size: .875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; }
.org-level__title span { background: #f8fafc; padding: 0 1rem; position: relative; }
.org-level__title::before { content: ''; position: absolute; left: 0; right: 0; top: 50%; height: 1px; background: #e2e8f0; z-index: -1; }
.org-level__title { position: relative; }

/* Cards Base */
.org-card { background: #fff; border-radius: 1rem; padding: 1.5rem 1.25rem; text-align: center; position: relative; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,.04); height: 100%; display: flex; flex-direction: column; align-items: center; }

/* Card Variants */
.org-card--leader { border-top: 4px solid #3b82f6; background: linear-gradient(180deg, #eff6ff 0%, #fff 40%); }
.org-card--manager { border-top: 3px solid #10b981; }
.org-card--staff { border-top: 3px solid #06b6d4; padding: 1.25rem 1rem; }
.org-card--admin { border-top: 3px solid #f59e0b; padding: 1.25rem 1rem; }

/* Ribbon (Leader) */
.org-card__ribbon { position: absolute; top: 12px; right: -8px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: #fff; font-size: .7rem; font-weight: 600; padding: .35rem .75rem; border-radius: 4px 0 0 4px; box-shadow: 0 2px 4px rgba(59,130,246,.3); }
.org-card__ribbon::after { content: ''; position: absolute; right: 0; bottom: -6px; border: 3px solid transparent; border-top-color: #1e40af; border-right-color: #1e40af; }

/* Badge (Others) */
.org-card__badge { position: absolute; top: 10px; right: 10px; font-size: .65rem; font-weight: 600; padding: .25rem .5rem; border-radius: 4px; text-transform: uppercase; letter-spacing: .5px; }
.org-card__badge--success { background: #d1fae5; color: #065f46; }
.org-card__badge--info { background: #cffafe; color: #0e7490; }
.org-card__badge--warning { background: #fef3c7; color: #92400e; }

/* Avatar */
.org-card__avatar { width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin-bottom: 1rem; border: 3px solid #fff; box-shadow: 0 4px 12px rgba(0,0,0,.08); flex-shrink: 0; }
.org-card__avatar--lg { width: 130px; height: 130px; border-width: 4px; }
.org-card__avatar--sm { width: 70px; height: 70px; border-width: 2px; }
.org-card__avatar img { width: 100%; height: 100%; object-fit: cover; }
.org-card__avatar-placeholder { width: 100%; height: 100%; background: linear-gradient(135deg, #f1f5f9, #e2e8f0); display: flex; align-items: center; justify-content: center; color: #94a3b8; }

/* Card Body */
.org-card__body { flex: 1; display: flex; flex-direction: column; align-items: center; width: 100%; }
.org-card__name { font-size: 1.1rem; font-weight: 600; color: #1e293b; margin: 0 0 .35rem; line-height: 1.3; }
.org-card--staff .org-card__name, .org-card--admin .org-card__name { font-size: .95rem; }
.org-card__role { display: block; font-size: .8rem; color: #64748b; margin-bottom: .5rem; }
.org-card__edu { display: inline-block; font-size: .7rem; background: #f1f5f9; color: #475569; padding: .2rem .6rem; border-radius: 999px; margin-bottom: .75rem; }
.org-card__desc { font-size: .8rem; color: #64748b; line-height: 1.5; margin-bottom: .75rem; flex-grow: 1; }

/* Contact */
.org-card__contact { display: flex; flex-direction: column; gap: .4rem; margin-top: auto; width: 100%; }
.org-card__contact--compact { flex-direction: row; justify-content: center; gap: .75rem; }
.org-card__link { display: inline-flex; align-items: center; gap: .4rem; font-size: .8rem; color: #64748b; text-decoration: none; transition: color .2s; }
.org-card__link:hover { color: #3b82f6; }
.org-card__icon-link { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 50%; background: #f1f5f9; color: #64748b; transition: all .2s; }
.org-card__icon-link:hover { background: #3b82f6; color: #fff; transform: scale(1.1); }

/* Hover Effects */
.org-card { transition: transform .25s ease, box-shadow .25s ease; }
.org-card:hover { transform: translateY(-6px); box-shadow: 0 12px 28px rgba(0,0,0,.1); }

/* Empty State */
.org-empty svg { opacity: .5; }

/* ===== Animations ===== */
@keyframes fadeInUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.03); } }

.animate-fade-in { animation: fadeIn .6s ease-out both; }
.animate-card { opacity: 0; transform: translateY(24px); }
.animate-card.is-visible { animation: fadeInUp .5s ease-out forwards; }

/* Responsive */
@media (max-width: 768px) {
    .org-title { font-size: 1.5rem; }
    .org-card { padding: 1.25rem 1rem; }
    .org-card__avatar--lg { width: 100px; height: 100px; }
    .org-card__name { font-size: 1rem; }
    .org-connector { height: 30px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for scroll animations
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var delay = parseInt(entry.target.getAttribute('data-delay') || 0, 10);
                setTimeout(function() {
                    entry.target.classList.add('is-visible');
                }, delay * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.animate-card').forEach(function(card) {
        observer.observe(card);
    });
});
</script>
