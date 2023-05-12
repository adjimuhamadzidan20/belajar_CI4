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
                <div class="card" style="max-width: 800px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/img/<?= $detail['sampul']; ?>" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $detail['judul']; ?></h5>
                                <table>
                                    <tr>
                                        <td>ID</td>
                                        <td class="pe-4">:</td>
                                        <td><?= $detail['id_komik']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Slug</td>
                                        <td class="pe-4">:</td>
                                        <td><?= $detail['slug']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Penulis</td>
                                        <td class="pe-4">:</td>
                                        <td><?= $detail['penulis']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Penerbit</td>
                                        <td class="pe-4">:</td>
                                        <td><?= $detail['penerbit']; ?></td>
                                    </tr>
                                </table>
                                <a href="/komik" class="btn btn-primary btn-sm card-link mt-3">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>