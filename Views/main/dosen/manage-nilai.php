<?php $this->layout('templates/main', ['page_title' => 'Nilai']) ?>

<?php $this->start('main') ?>
<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nilai Tugas : <?= $tugas['assignment_name'] ?></h6>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nrp</th>
              <th scope="col">Nama</th>
              <th scope="col">File</th>
              <th scope="col">Nilai</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0;
            foreach ($data as $item) : ?>
              <tr>
                <th scope="row"><?= ++$i; ?></th>
                <td><?= $item['nrp'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><a href="/dosen/matkul/tugas/download/<?= $item['id'] ?>" class="btn btn-sm btn-primary">Download</a></td>
                <td><?= ($item['nilai']) ?? '-' ?></td>
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nilai<?= $item['id'] ?>">
                    Nilai
                  </button>
                </td>
              </tr>
              <div class="modal fade" id="nilai<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="/dosen/matkul/tugas/submit/nilai/<?= $item['id'] ?>" method="post">
                        <div class="form-group">
                          <label for="">Nilai</label>
                          <input type="number" name="nilai" id="nilai" class="form-control" value="<?= $item['nilai'] ?>">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->stop() ?>