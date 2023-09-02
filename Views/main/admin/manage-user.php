<?php $this->layout('templates/main', ['page_title' => 'Manage User']) ?>

<?php $this->start('main') ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Management User</h6>
                <button type="button" class="btn btn-sm my-2 btn-primary" data-toggle="modal" data-target="#create">
                    Tambah User
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NRP / NIP</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $user) : ?>
                            <tr>
                                <td><?= $user['nrp'] ?></td>
                                <td><?= $user['name'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td>
                                    <span class="badge badge-success"><?= $user['role'] ?></span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?= $user['id'] ?>">
                                        Edit</button>
                                    <a href="/admin/manage-user/delete-user/<?= $user['id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus user ini?')" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal<?= $user['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $user['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/admin/manage-user/edit/<?= $user['id'] ?>" method="POST">
                                                <div class="form-group">
                                                    <label for="nrp">NRP / NIP</label>
                                                    <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP / NIP" value="<?= $user['nrp'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nrp">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $user['name'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nrp">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $user['email'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nrp">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nrp">Role</label>
                                                    <select name="role" id="role" class="form-control">
                                                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                                        <option value="dosen" <?= $user['role'] == 'dosen' ? 'selected' : '' ?>>Dosen</option>
                                                        <option value="mahasiswa" <?= $user['role'] == 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/manage-user/create" method="POST">
                    <div class="form-group">
                        <label for="nrp">NRP / NIP</label>
                        <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP / NIP">
                    </div>
                    <div class="form-group">
                        <label for="nrp">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="nrp">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="nrp">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="nrp">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="dosen">Dosen</option>
                            <option value="mahasiswa">Mahasiswa</option>
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