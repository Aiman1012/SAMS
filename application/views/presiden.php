<?= $this->session->flashdata('message'); ?>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a href="<?= base_url('presiden/mohonProgram') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Mohon Program
            </a>
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form method="GET" action="<?= base_url('presiden') ?>">
            <div class="row mb-3">
                <div class="col-md-3">
                    <select name="status_filter" class="form-control">
                        <option value="" <?= !isset($_GET['status_filter']) ? 'selected' : '' ?>>All</option>
                        <option value="APPROVED" <?= (isset($_GET['status_filter']) && $_GET['status_filter'] == 'APPROVED') ? 'selected' : '' ?>>Approved</option>
                        <option value="CANCELLED" <?= (isset($_GET['status_filter']) && $_GET['status_filter'] == 'CANCELLED') ? 'selected' : '' ?>>Cancelled</option>
                        <option value="PENDING" <?= (isset($_GET['status_filter']) && $_GET['status_filter'] == 'PENDING') ? 'selected' : '' ?>>Pending</option>
                        <option value="PENDING HEPA APPROVAL" <?= (isset($_GET['status_filter']) && $_GET['status_filter'] == 'PENDING HEPA APPROVAL') ? 'selected' : '' ?>>Pending HEPA Approval</option>
                        <option value="PENDING MPP APPROVAL" <?= (isset($_GET['status_filter']) && $_GET['status_filter'] == 'PENDING MPP APPROVAL') ? 'selected' : '' ?>>Pending MPP Approval</option>
                    </select>

                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>Bil</th>
                    <th>Nama Program</th>
                    <th>Kategori Program</th>
                    <th>Status Program</th>
                    <th>Lihat Program</th>
                    <!-- <th>Kehadiran</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($program as $prog) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $prog->NAMA_PROGRAM ?></td>
                        <td><?= $prog->KATEGORI_PROGRAM ?></td>
                        <td><?= $prog->APPROVAL_STATUS ?></td>
                        <td><a href="<?= base_url('presiden/lihatProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat Program</a></td>
                        <!-- <td><a href="<?= base_url('presiden/kehadiranProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Kehadiran</a></td> -->
                        <td>
                            <?php if ($prog->APPROVAL_STATUS == 'Approved') : ?>
                                <button data-toggle="modal" data-target="#assignPengarahModal<?= $prog->PROGRAM_ID ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Assign Pengarah</button>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <button data-toggle="modal" data-target="#edit<?= $prog->PROGRAM_ID ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>Edit</button>
                            <!-- <a href="<?= base_url('presiden/deleteProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a> -->
                            <a href="<?= base_url('presiden/cancelProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to cancel the program?')"><i class="fas fa-exclamation-circle"></i> Cancel</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>





<!-- Modal for edit program -->
<?php foreach ($program as $prog) : ?>
    <div class="modal fade" id="edit<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('presiden/edit/' . $prog->PROGRAM_ID) ?>" method="POST">
                        <div class="form-group">
                            <label for="">Nama Kelab</label>
                            <input type="text" name="NAMA_KELAB" class="form-control" value="<?= $prog->NAMA_KELAB ?>">
                            <?= form_error('NAMA_KELAB', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Program</label>
                            <input type="text" name="NAMA_PROGRAM" class="form-control" value="<?= $prog->NAMA_PROGRAM ?>">
                            <?= form_error('NAMA_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pengarah</label>
                            <input type="text" name="NAMA_PENGARAH" class="form-control" value="<?= $prog->NAMA_PENGARAH ?>">
                            <?= form_error('NAMA_PENGARAH', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nombor Matriks Pengarah Program</label>
                            <input type="text" name="PENGARAH_MATRIC" class="form-control" value="<?= $prog->PENGARAH_MATRIC ?>">
                            <?= form_error('PENGARAH_MATRIC', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Anjuran</label>
                            <input type="text" name="NAMA_ANJURAN" class="form-control" value="<?= $prog->NAMA_ANJURAN ?>">
                            <?= form_error('NAMA_ANJURAN', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori Program</label>
                            <select name="KATEGORI_PROGRAM" class="form-control">
                                <option value="Akademik" <?= ($prog->KATEGORI_PROGRAM == 'Akademik') ? 'selected' : ''; ?>>Akademik</option>
                                <option value="Sukan" <?= ($prog->KATEGORI_PROGRAM == 'Sukan') ? 'selected' : ''; ?>>Sukan</option>
                                <!-- Add more options as needed -->
                            </select>
                            <?= form_error('KATEGORI_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tarikh Mula</label>
                            <input type="date" name="TARIKH_MULA" class="form-control" value="<?= $prog->TARIKH_MULA ?>">
                            <?= form_error('TARIKH_MULA', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tarikh Tamat</label>
                            <input type="date" name="TARIKH_TAMAT" class="form-control" value="<?= $prog->TARIKH_TAMAT ?>">
                            <?= form_error('TARIKH_TAMAT', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Objektif Program</label>
                            <textarea name="OBJEKTIF_PROGRAM" class="form-control"><?= $prog->OBJEKTIF_PROGRAM ?></textarea>
                            <?= form_error('OBJEKTIF_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tempat Program</label>
                            <input type="text" name="TEMPAT_PROGRAM" class="form-control" value="<?= $prog->TEMPAT_PROGRAM ?>">
                            <?= form_error('TEMPAT_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Masa Program</label>
                            <input type="time" name="MASA_PROGRAM" class="form-control" value="<?= $prog->MASA_PROGRAM ?>">
                            <?= form_error('MASA_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="NEGERI_PROGRAM">Negeri Program</label>
                            <select name="NEGERI_PROGRAM" class="form-control">
                                <?php
                                $states = [
                                    'Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan',
                                    'Pahang', 'Penang', 'Perak', 'Perlis', 'Sabah', 'Sarawak',
                                    'Selangor', 'Terengganu', 'Kuala Lumpur', 'Labuan', 'Putrajaya'
                                ];
                                foreach ($states as $state) {
                                    $selected = ($prog->NEGERI_PROGRAM == $state) ? 'selected' : '';
                                    echo "<option value=\"$state\" $selected>$state</option>";
                                }
                                ?>
                            </select>
                            <?= form_error('NEGERI_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Dokumen Program</label>
                            <input type="file" name="DOKUMEN_PROGRAM" class="form-control-file">
                            <?= form_error('DOKUMEN_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Assign Pengarah Modal -->
<?php foreach ($program as $prog) : ?>
    <div class="modal fade" id="assignPengarahModal<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="assignPengarahModalLabel<?= $prog->PROGRAM_ID ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignPengarahModalLabel<?= $prog->PROGRAM_ID ?>">Assign Pengarah for <?= htmlspecialchars($prog->NAMA_PROGRAM) ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('presiden/assignPengarah/' . $prog->PROGRAM_ID) ?>" method="post">
                        <div class="form-group">
                            <label for="PENGARAH_MATRIC">Pengarah Matric Number</label>
                            <input type="text" class="form-control" id="PENGARAH_MATRIC" name="PENGARAH_MATRIC" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>