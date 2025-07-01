<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Gagal Menambah Data!</h4>
        <hr>
        <p class="mb-0">
            <?php foreach (session()->getFlashData('errors') as $error) : ?>
                <?= esc($error) ?>
            <?php endforeach ?>
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>

<div class="table-responsive">
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nominal (Rp)</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($diskon as $index => $item) : ?>
                <tr>
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $item['tanggal'] ?></td>
                    <td><?= number_format($item['nominal'], 0, ',', '.') ?></td>
                    <td>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $item['id'] ?>">
                            Ubah
                        </button>
                        <a href="<?= base_url('diskon/delete/' . $item['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                            Hapus
                        </a>
                    </td>
                </tr>

                <div class="modal fade" id="editModal-<?= $item['id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data Diskon</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('diskon/update/' . $item['id']) ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" value="<?= $item['tanggal'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nominal">Nominal</label>
                                        <input type="number" name="nominal" class="form-control" value="<?= $item['nominal'] ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Diskon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('diskon/create') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="number" name="nominal" class="form-control" placeholder="Contoh: 50000" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>