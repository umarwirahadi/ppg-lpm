<div class="container my-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-7 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="mb-1">Register</h3>
                    <p class="text-muted mb-4">Buat akun untuk akses pengguna.</p>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert"><?= $error ?></div>
                    <?php endif; ?>
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success" role="alert"><?= $success ?></div>
                    <?php endif; ?>

                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger" role="alert"><?= validation_errors() ?></div>
                    <?php endif; ?>

                    <?= form_open(site_url('register'), ['method' => 'post']); ?>
                        <div class="mb-3">
                            <label class="form-label" for="full_name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?= set_value('full_name') ?>" required>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" required>
                            </div>
                        </div>

                        <div class="row g-3 mt-0">
                            <div class="col-md-6">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="password_confirm">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-4">Daftar</button>
                    <?= form_close(); ?>

                    <div class="text-center mt-3">
                        <a href="<?= site_url('login') ?>" class="small">Sudah punya akun? Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
