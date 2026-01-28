<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Buat Kegiatan Baru</h4>
            <a href="<?= site_url('admin/kegiatan') ?>" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card-body">
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger"><?= validation_errors() ?></div>
            <?php endif; ?>
            <?php if (!empty($upload_errors) && is_array($upload_errors)): ?>
                <div class="alert alert-warning">
                    <?php foreach ($upload_errors as $ue): ?>
                        <div><?= htmlspecialchars($ue) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <form id="kegiatanForm" method="post" action="<?= site_url('admin/kegiatan/store') ?>" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input name="title" class="form-control" required value="<?= set_value('title') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug (opsional)</label>
                            <input name="slug" class="form-control" value="<?= set_value('slug') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" rows="6" class="form-control"><?= set_value('description') ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input name="category" class="form-control" value="<?= set_value('category') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penyelenggara</label>
                            <input name="organizer" class="form-control" value="<?= set_value('organizer') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input name="location" class="form-control" value="<?= set_value('location') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input name="start_date" type="datetime-local" class="form-control" value="<?= set_value('start_date') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input name="end_date" type="datetime-local" class="form-control" value="<?= set_value('end_date') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Peserta (jumlah)</label>
                            <input name="participants" type="number" min="0" class="form-control" value="<?= set_value('participants', 0) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kontak Person</label>
                            <input name="contact_person" class="form-control" value="<?= set_value('contact_person') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telepon Kontak</label>
                            <input name="contact_phone" class="form-control" value="<?= set_value('contact_phone') ?>">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Dokumen (file)</label>
                                <input type="file" name="document_file" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gambar (thumbnail)</label>
                                <input type="file" name="image_file" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="draft" <?= set_select('status','draft', true) ?>>Draft</option>
                                    <option value="published" <?= set_select('status','published') ?>>Published</option>
                                    <option value="cancelled" <?= set_select('status','cancelled') ?>>Cancelled</option>
                                    <option value="completed" <?= set_select('status','completed') ?>>Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?= set_checkbox('is_active','1', true) ?>>
                            <label class="form-check-label" for="is_active">Aktif</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= site_url('admin/kegiatan') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* tiny tweaks */
form#kegiatanForm .form-label { font-weight: 600; }
</style>
