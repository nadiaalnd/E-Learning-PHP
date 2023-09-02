<?php $this->layout('templates/main', ['page_title' => 'Mata Kuliah']) ?>

<?php $this->start('main') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-muted">Matkul : <span class="text-primary"><?= $matkul ?></span></h6>
                <button type="button" class="btn btn-sm my-2 btn-primary" data-toggle="modal" data-target="#create">
                    Tambah Tugas
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
                    <h5><b><?= $item['assignment_name'] ?></b></h5>
                    <p class="text-secondary">Deadline : <span class="text-primary"><?= Date('d/m/Y', strtotime($item['deadline'])) ?></span></p>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?= $item['id'] ?>">
                        Edit</button>
                    <a href="/dosen/matkul/tugas/delete-tugas/<?= $item['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus materi ini?')" class="btn btn-danger btn-sm">Delete</a>
                    <a href="/dosen/matkul/tugas/submit/<?= $item['id'] ?>" class="btn btn-info btn-sm">Nilai</a>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Tugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/dosen/matkul/tugas/edit/<?= $item['id'] ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="matkul" value="<?= $id ?>">
                            <div class="form-group">
                                <label for="nama">Nama Tugas</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Tugas" value="<?= $item['assignment_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="deadline">Deadline</label>
                                <input type="datetime-local" class="form-control" id="deadline" name="deadline" placeholder="Deadline" value="<?= $item['deadline'] ?>">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/dosen/matkul/tugas/create" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="matkul" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="nama">Nama Tugas</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Tugas">
                    </div>
                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input type="datetime-local" class="form-control" id="deadline" name="deadline" placeholder="Deadline">
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