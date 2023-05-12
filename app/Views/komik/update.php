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
                
                <form action="/komik/update_proses/<?= $data['id_komik']; ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="judulkomik" class="form-label">Judul Komik</label>
                        <input type="text" class="form-control <?= (validation_show_error('judul')) ? 'is-invalid':''; ?>" 
                        id="judulkomik" name="judul" value="<?= $data['judul']; ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('judul'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="slug" value="<?= $data['slug']; ?>" hidden="hidden">
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" 
                        value="<?= (old('penulis')) ? old('penulis') : $data['penulis']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" 
                        value="<?= (old('penerbit')) ? old('penerbit') : $data['penerbit']; ?>">
                    </div>
                    <div class="mb-4">
                        <label for="sampul" class="form-label d-block">Sampul</label>

                        <img src="/img/<?= (old('sampul')) ? old('sampul') : $data['sampul']; ?>" width="100" class="mb-3 img-thumbnail preview" title="<?= $data['sampul']; ?>">

                        <input class="form-control <?= (validation_show_error('sampul')) ? 'is-invalid':''; ?>" 
                        type="file" id="sampul" name="sampul" aria-label="file example" onchange="thumbnail()">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('sampul'); ?>
                        </div>

                    </div>

                    <!-- file sampul lama -->
                    <input type="hidden" name="sampulLama" value="<?= $data['sampul']; ?>">

                    <div class="d-flex justify-content-between">
                        <a href="/komik" class="btn btn-primary btn-sm">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>