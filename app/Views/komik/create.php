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
                
                <form action="/komik/save" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="judulkomik" class="form-label">Judul Komik</label>
                        <input type="text" class="form-control <?= (validation_show_error('judul')) ? 'is-invalid':''; ?>" 
                        id="judulkomik" name="judul" autofocus>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('judul'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                    </div>
                    <div class="mb-4">
                        <label for="sampul" class="form-label d-block">Sampul</label>
                        
                        <img src="/img/default.png" width="100" class="mb-3 img-thumbnail preview">
                        
                        <input class="form-control <?= (validation_show_error('sampul')) ? 'is-invalid':''; ?>" 
                        type="file" id="sampul" name="sampul" aria-label="file example" onchange="thumbnail()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('sampul'); ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/komik" class="btn btn-primary btn-sm">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>