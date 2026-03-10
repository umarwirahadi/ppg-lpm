<div class="container my-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="mb-1">Login</h3>
                    <p class="text-muted mb-4">Masuk untuk mengakses fitur pengguna.</p>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert"><?= $error ?></div>
                    <?php endif; ?>
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success" role="alert"><?= $success ?></div>
                    <?php endif; ?>

                    <?= form_open(site_url('login'), ['method' => 'post']); ?>
                        <div class="mb-3">
                            <label class="form-label" for="username">Username / Email</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    <?= form_close(); ?>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="<?= site_url('register') ?>" class="small">Belum punya akun? Daftar</a>
                        <a href="<?= site_url('admin/login') ?>" class="small">Login Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
