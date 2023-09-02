<?php $this->layout('templates/main', ['page_title' => 'Mata Kuliah']) ?>

<?php $this->start('main') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-muted">Matkul : <span class="text-primary"><?= $matkul ?></span></h6>
                <button type="button" class="btn btn-sm my-2 btn-primary" data-toggle="modal" data-target="#create">
                    Tambah Materi
                </button>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <?php foreach ($data as $item) : ?>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5><b><?= $item['lesson_name'] ?></b></h5>
                    <p class="btn btn-sm btn-info">
                        <a href="/dosen/matkul/materi/download/<?= $item['id'] ?>" class="text-white">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </p>
                    <br>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?= $item['id'] ?>">
                        Edit</button>
                    <a href="/dosen/matkul/materi/delete-materi/<?= $item['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus materi ini?')" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/dosen/matkul/materi/edit/<?= $item['id'] ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="matkul" value="<?= $id ?>">
                            <div class="form-group">
                                <label for="nama">Nama Materi</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Materi" value="<?= $item['lesson_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="file">File </label>
                                <input type="file" class="form-control" id="file" name="file" placeholder="File">
                                <small class="text-danger">Kosongkan jika tidak ingin mengubah file</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/dosen/matkul/materi/create" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="matkul" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="nama">Nama Materi</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Materi">
                    </div>
                    <div class="form-group">
                        <label for="file">File </label>
                        <input type="file" class="form-control" id="file" name="file" placeholder="File">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>