<?php $this->layout('templates/main', ['page_title' => 'Mata Kuliah']) ?>

<?php $this->start('main') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mata Kuliah</h6>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <?php foreach ($data as $item) : ?>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5><b><?= $item['course_name'] ?></b></h5>
                    <p class="text-secondary"><?= $item['description'] ?></p>
                    <a href="/mahasiswa/matkul/materi/<?= $item['id'] ?>" class="btn btn-sm btn-primary">Materi</a>
                    <a href="/mahasiswa/matkul/tugas/<?= $item['id'] ?>" class="btn btn-sm btn-info">Tugas</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php $this->stop() ?>