<?= $this->session->flashdata('message'); ?>

<div class="container">
    <?php foreach ($program as $prog) : ?>
        <h2 class="mt-4 mb-4"><?= htmlspecialchars($prog->nama_program) ?></h2>

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th class="bg-info" scope="row">Nama Anjuran</th>
                    <td><?= htmlspecialchars($prog->nama_anjuran) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Kategori Program</th>
                    <td><?= htmlspecialchars($prog->kategori_program) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Tarikh Mula</th>
                    <td><?= htmlspecialchars($prog->tarikh_mula) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Tarikh Tamat</th>
                    <td><?= htmlspecialchars($prog->tarikh_tamat) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Objektif Program</th>
                    <td><?= htmlspecialchars($prog->objektif_program) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Tempat Program</th>
                    <td><?= htmlspecialchars($prog->tempat_program) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Masa Program</th>
                    <td><?= htmlspecialchars($prog->masa_program) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Negeri Program</th>
                    <td><?= htmlspecialchars($prog->negeri_program) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Dokumen Program</th>
                    <td>
                        <a href="<?= base_url($prog->dokumen_program) ?>" target="_blank">
                            <?= htmlspecialchars($prog->dokumen_program) ?>
                        </a>
                    </td>
                </tr>

                <tr>
                    <th class="bg-info" scope="row">Status Program</th>
                    <td><?= htmlspecialchars($prog->approval_status) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Nota Program</th>
                    <td><?= htmlspecialchars($prog->program_notes) ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Edit button centered below the table -->
        <div class="d-flex justify-content-center mt-3">
            <button data-toggle="modal" data-target="#edit<?= $prog->program_id ?>" class=" btn btn-primary btn-sm">
                <i class="fas fa-edit"></i>Edit Program</button>
        </div>
</div>

<?php endforeach ?>

<div class="card-header d-flex justify-content-end mt-3">
    <h3 class="card-title">
        <a href="<?= base_url('pengarah') ?>" class="btn btn-danger btn-sm">
            <i class="fas fa-back"></i> Go Back
        </a>
    </h3>
</div>


<!-- Modal -->
<?php foreach ($program as $prog) : ?>
    <div class="modal fade" id="edit<?= $prog->program_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('pengarah/editProgram/' . $prog->program_id) ?>" method="POST">
                        <div class="form-group">
                            <label for="">Nama Anjuran</label>
                            <input type="text" name="nama_anjuran" class="form-control" value="<?= $prog->nama_anjuran ?>">
                            <?= form_error('nama_anjuran', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori Program</label>
                            <select name="kategori_program" class="form-control">
                                <option value="Akademik" <?= ($prog->kategori_program == 'Akademik') ? 'selected' : ''; ?>>Akademik</option>
                                <option value="Sukan" <?= ($prog->kategori_program == 'Sukan') ? 'selected' : ''; ?>>Sukan</option>
                                <!-- Add more options as needed -->
                            </select>
                            <?= form_error('kategori_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tarikh Mula</label>
                            <input type="date" name="tarikh_mula" class="form-control" value="<?= $prog->tarikh_mula ?>">
                            <?= form_error('tarikh_mula', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tarikh Tamat</label>
                            <input type="date" name="tarikh_tamat" class="form-control" value="<?= $prog->tarikh_tamat ?>">
                            <?= form_error('tarikh_tamat', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Objektif Program</label>
                            <textarea name="objektif_program" class="form-control"><?= $prog->objektif_program ?></textarea>
                            <?= form_error('objektif_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tempat Program</label>
                            <input type="text" name="tempat_program" class="form-control" value="<?= $prog->tempat_program ?>">
                            <?= form_error('tempat_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Masa Program</label>
                            <input type="time" name="masa_program" class="form-control" value="<?= $prog->masa_program ?>">
                            <?= form_error('masa_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="negeri_program">Negeri Program</label>
                            <select name="negeri_program" class="form-control">
                                <?php
                                $states = [
                                    'Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan',
                                    'Pahang', 'Penang', 'Perak', 'Perlis', 'Sabah', 'Sarawak',
                                    'Selangor', 'Terengganu', 'Kuala Lumpur', 'Labuan', 'Putrajaya'
                                ];
                                foreach ($states as $state) {
                                    $selected = ($prog->negeri_program == $state) ? 'selected' : '';
                                    echo "<option value=\"$state\" $selected>$state</option>";
                                }
                                ?>
                            </select>
                            <?= form_error('negeri_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Dokumen Program</label>
                            <input type="file" name="dokumen_program" class="form-control-file">
                            <?= form_error('dokumen_program', '<div class="text-small text-danger">', '</div>'); ?>
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