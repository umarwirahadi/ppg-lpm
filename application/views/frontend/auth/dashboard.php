<div class="container my-5 pt-5">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="mb-1">Dashboard</h4>
                    <p class="text-muted mb-0">Akun pengguna</p>

                    <hr>

                    <div class="small text-muted">Login sebagai</div>
                    <div class="fw-semibold">
                        <?= htmlspecialchars(($user['full_name'] ?? $user['username'] ?? 'User')) ?>
                    </div>
                    <div class="text-muted small">
                        <?= htmlspecialchars(($user['email'] ?? '')) ?>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <a class="btn btn-outline-secondary" href="<?= site_url('logout') ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert"><?= $error ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success" role="alert"><?= $success ?></div>
            <?php endif; ?>

            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Profil</h5>

                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger" role="alert"><?= validation_errors() ?></div>
                    <?php endif; ?>

                    <?= form_open(site_url('dashboard'), ['method' => 'post']); ?>
                        <input type="hidden" name="action" value="profile">

                        <div class="mb-3">
                            <label class="form-label" for="full_name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?= set_value('full_name', $form_user['full_name'] ?? '') ?>" required>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email', $form_user['email'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="phone">No. HP</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?= set_value('phone', $form_user['phone'] ?? '') ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Simpan Profil</button>
                    <?= form_close(); ?>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-3">Ubah Password</h5>

                    <?= form_open(site_url('dashboard'), ['method' => 'post']); ?>
                        <input type="hidden" name="action" value="password">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="new_password">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-primary mt-4">Ubah Password</button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
