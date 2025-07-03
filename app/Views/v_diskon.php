<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>

<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Nominal</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($diskon)) :
            foreach ($diskon as $index => $item) : ?>
                <tr>
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $item['tanggal'] ?></td>
                    <td><?= number_to_currency($item['nominal'], 'IDR', 'id_ID', 0) ?></td>
                    <td>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $item['id'] ?>">
                            Ubah
                        </button>
                        <a href="<?= base_url('diskon/delete/' . $item['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
                            Hapus
                        </a>
                    </td>
                </tr>

                <!-- Edit Modal Begin -->
                <div class="modal fade" id="editModal-<?= $item['id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('diskon/edit/' . $item['id']) ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= $item['tanggal'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nominal">Nominal</label>
                                        <input type="number" name="nominal" class="form-control" id="nominal" value="<?= $item['nominal'] ?>" placeholder="Nominal Diskon" required>
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
                <!-- Edit Modal End -->
        <?php endforeach;
        endif; ?>
    </tbody>
</table>
<!-- End Table with stripped rows -->

<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('diskon') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="Tanggal Diskon" required>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="number" name="nominal" class="form-control" id="nominal" placeholder="Nominal Diskon" required>
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
<!-- Add Modal End -->

<?= $this->endSection() ?>
