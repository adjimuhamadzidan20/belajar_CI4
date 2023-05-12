<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row">
            <div class="col pt-3 pb-3">
                <h3>Data Komik</h3>  
                <a href="/komik/create" class="btn btn-success btn-sm mb-2 mt-2">Tambah Data</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Komik" name="keyword">
                        <button type="submit" class="btn btn-outline-secondary" id="button-addon2" name="submit">
                        Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">

                <!-- notif pesan -->
                <?php if (session()->getFlashData('pesan')) : ?>
                    <div class="alert alert-success" role="alert" id="pop-up">
                        <?= session()->getFlashData('pesan'); ?>
                    </div>
                <?php endif; ?>
                
                <table class="table text-center">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul Komik</th>
                        <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 + (5 * ($currentPage - 1)); ?>
                        <?php foreach($komik as $data) : ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td>
                                    <img src="/img/<?= $data['sampul']; ?>" alt="sampul_komik"class="sampul">
                                </td>
                                <td><?= $data['judul']; ?></td>
                                <td>
                                    <a href="/komik/<?= $data['slug']; ?>" class="btn btn-primary btn-sm">Detail</a>
                                    
                                    <a href="/komik/update/<?= $data['slug']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                    <form action="/komik/<?= $data['id_komik']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick=" 
                                        return confirm('yakin ingin menghapusnya?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $pager->links('komik', 'komik_paginasi') ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>