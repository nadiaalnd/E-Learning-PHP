<?php $this->layout('templates/main', ['page_title' => 'Manage Matkul']) ?>

<?php $this->start('main') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Management Matkul</h6>
                <button type="button" class="btn btn-sm my-2 btn-primary" data-toggle="modal" data-target="#create">
                    Tambah Matkul
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Matkul</th>
                            <th>Dosen</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($data as $matkul) : ?>
                            <tr>
                                <td><?= ++$i ?></td>
                                <td><span class="badge badge-success"><?= $matkul['course_name'] ?></span></td>
                                <td>
                                    <?= $matkul['dosen'] ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $matkul['id'] ?>">
                                        Edit</button>
                                    <a href="/admin/manage-user/delete-user/<?= $matkul['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus user ini?')" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal<?= $matkul['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $matkul['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Matkul</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/admin/matkul/edit/<?= $matkul['id'] ?>" method="POST">
                                                <div class="form-group">
                                                    <label for="name">Nama Matkul</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Matkul" value="<?= $matkul['course_name'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="dosen">Dosen</label>
                                                    <select class="form-control" id="dosen" name="dosen">
                                                        <?php foreach ($dosen as $d) : ?>
                                                            <option value="<?= $d['id'] ?>" <?= $d['id'] == $matkul['instructor_id'] ? 'selected' : '' ?>><?= $d['name'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Deskripsi Matkul</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3"><?= $matkul['description'] ?></textarea>
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
                <form action="/admin/matkul/create" method="POST">
                    <div class="form-group">
                        <label for="name">Nama Matkul</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Matkul">
                    </div>
                    <div class="form-group">
                        <label for="dosen">Dosen</label>
                        <select class="form-control" id="dosen" name="dosen">
                            <?php foreach ($dosen as $d) : ?>
                                <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Matkul</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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