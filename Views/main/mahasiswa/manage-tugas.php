<?php $this->layout('templates/main', ['page_title' => 'Mata Kuliah']) ?>

<?php $this->start('main') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-muted">Matkul : <span class="text-primary"><?= $matkul ?></span></h6>
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
                    <p class="text-secondary">Deadline : <span class="text-primary"><?= Date('d/m/Y H:i:s', strtotime($item['deadline'])) ?></span></p>
                    <?php if ($item['file']) : ?>
                        <p class="text-secondary">File : <span class="text-primary"><a href="/mahasiswa/matkul/tugas/download/<?= $item['submission_id'] ?>">
                                    <?= $item['file'] ?></a>
                            </span></p>
                    <?php endif ?>
                    <p class="text-secondary">Nilai : <?= $item['nilai'] ?? 'Belum Dinilai' ?></p>
                    <p class="text-secondary">Status : <span class="text-primary"><?= ($item['file']) ? 'Sudah' : 'Belum' ?> Upload</span></p>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#upload<?= $item['id'] ?>">
                        Upload Tugas</button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="upload<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="uploadLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Tugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/mahasiswa/matkul/tugas/submit" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="tugas" value="<?= $item['id'] ?>">
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
    <?php endforeach ?>
</div>
<?php $this->stop() ?>