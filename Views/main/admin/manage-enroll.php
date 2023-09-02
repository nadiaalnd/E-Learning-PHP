<?php $this->layout('templates/main', ['page_title' => 'Manage Enroll']) ?>

<?php $this->start('main') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Management Enroll</h6>
                <button type="button" class="btn btn-sm my-2 btn-primary" data-toggle="modal" data-target="#create">
                    Tambah Enroll
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Matkul</th>
                            <th>Mahasiswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($data as $enroll) : ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><span class="badge badge-success"><?= $enroll['matkul'] ?></span></td>
                                <td>
                                    <?= $enroll['mahasiswa'] ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $enroll['id'] ?>">
                                        Edit</button>
                                    <a href="/admin/enroll/delete-enroll/<?= $enroll['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus user ini?')" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal<?= $enroll['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Matkul</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/admin/enroll/edit/<?= $enroll['id'] ?>" method="POST">
                                                <div class="form-group">
                                                    <label for="mahasiswa">Mahasiswa</label>
                                                    <select class="form-control" id="mahasiswa" name="mahasiswa">
                                                        <option value="" selected disabled>Pilih Mahasiswa</option>
                                                        <?php foreach ($mahasiswa as $m) : ?>
                                                            <option value="<?= $m['id'] ?>" <?= $m['id'] == $enroll['user_id'] ? 'selected' : '' ?>><?= $m['name'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="matkul">Matkul</label>
                                                    <select class="form-control" id="matkul" name="matkul">
                                                        <option value="" selected disabled>Pilih Matkul</option>
                                                        <?php foreach ($course as $m) : ?>
                                                            <option value="<?= $m['id'] ?>" <?= $m['id'] == $enroll['course_id'] ? 'selected' : '' ?>><?= $m['course_name'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Insert -->
<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Matkul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/enroll/create" method="POST">
                    <div class="form-group">
                        <label for="mahasiswa">Mahasiswa</label>
                        <select class="form-control" id="mahasiswa" name="mahasiswa">
                            <option value="" selected disabled>Pilih Mahasiswa</option>
                            <?php foreach ($mahasiswa as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="matkul">Matkul</label>
                        <select class="form-control" id="matkul" name="matkul">
                            <option value="" selected disabled>Pilih Matkul</option>
                            <?php foreach ($course as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['course_name'] ?></option>
                            <?php endforeach ?>
                        </select>
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