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
                    <h5><b><?= $item['lesson_name'] ?></b></h5>
                    <p class="btn btn-sm btn-info">
                        <a href="/mahasiswa/matkul/materi/download/<?= $item['id'] ?>" class="text-white">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php $this->stop() ?>