<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row">
            <div class="col pt-3 pb-3">
                <h3>Data Anggota</h3>  
                <a href="/anggota/create" class="btn btn-success btn-sm mb-2 mt-2">Tambah Data</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Anggota" name="keyword">
                        <button type="button" class="btn btn-outline-secondary" id="button-addon2" name="submit">
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
                
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 + (10 * ($currentPage - 1)); ?>
                        <?php foreach($anggota as $data) : ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $data['nama_lengkap']; ?></td>
                                <td><?= $data['alamat']; ?></td>
                                <td>       
                                    <a href="/anggota/update/<?= $data['id_orang']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                    <form action="/anggota/<?= $data['id_orang']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick=" 
                                        return confirm('yakin ingin menghapusnya?');">Delete</a> 
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
                <?= $pager->links('orang', 'orang_paginasi') ?>  
            </div>
        </div>
    </div>
<?= $this->endSection() ?>