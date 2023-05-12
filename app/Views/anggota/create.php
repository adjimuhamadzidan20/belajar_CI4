<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row">
            <div class="col pt-3 pb-3">
                <h3><?= $judul; ?></h3>  
            </div>
        </div>
        <div class="row">
            <div class="col">
                
                <form action="/anggota/save" method="post">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="namalengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid':''; ?>" 
                        id="namalengkap" name="nama" autofocus>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('nama'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control <?= (validation_show_error('alamat')) ? 'is-invalid':''; ?>" id="alamat" name="alamat">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('alamat'); ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/anggota" class="btn btn-primary btn-sm">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>