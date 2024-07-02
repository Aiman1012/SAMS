<?= $this->session->flashdata('message'); ?>

<div class="container">
    <?php foreach ($program as $prog) : ?>
        <h2 class="mt-4 mb-4"><?= htmlspecialchars($prog->NAMA_PROGRAM) ?></h2>

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th class="bg-info" scope="row">Nama Anjuran</th>
                    <td><?= htmlspecialchars($prog->NAMA_ANJURAN) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Kategori Program</th>
                    <td><?= htmlspecialchars($prog->KATEGORI_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Tarikh Mula</th>
                    <td><?= htmlspecialchars($prog->TARIKH_MULA) ?></td>
                </tr>
                <?php if (!empty($prog->TARIKH_TAMAT)) : ?>
                    <tr>
                        <th class="bg-info" scope="row">Tarikh Tamat</th>
                        <td><?= htmlspecialchars($prog->TARIKH_TAMAT) ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th class="bg-info" scope="row">Objektif Program</th>
                    <td><?= htmlspecialchars($prog->OBJEKTIF_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Tempat Program</th>
                    <td><?= htmlspecialchars($prog->TEMPAT_PROGRAM) ?></td>
                </tr>
                <?php if (empty($prog->TARIKH_TAMAT)) : ?>
                    <tr>
                        <th class="bg-info" scope="row">Masa Program</th>
                        <td><?= htmlspecialchars($prog->MASA_PROGRAM) ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th class="bg-info" scope="row">Negeri Program</th>
                    <td><?= htmlspecialchars($prog->NEGERI_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Dokumen Program</th>
                    <td>
                        <a href="<?= base_url('uploads/' . $prog->DOKUMEN_PROGRAM) ?>" target="_blank">
                            <?= htmlspecialchars($prog->DOKUMEN_PROGRAM) ?>
                        </a>
                    </td>
                </tr>

                <tr>
                    <th class="bg-info" scope="row">Status Program</th>
                    <td><?= htmlspecialchars($prog->APPROVAL_STATUS) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Nota Program</th>
                    <td><?= htmlspecialchars($prog->PROGRAM_NOTES) ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Edit button centered below the table -->
        <div class="d-flex justify-content-center mt-3">
            <button data-toggle="modal" data-target="#edit<?= $prog->PROGRAM_ID ?>" class=" btn btn-primary btn-sm">
                <i class="fas fa-edit"></i>Edit Program
            </button>
            <button onclick="window.location.href='<?= base_url('pengarah/assignAjkProgram/' . $prog->PROGRAM_ID) ?>'" class="btn btn-secondary btn-sm ml-2">
                <i class="fas fa-user-plus"></i> Assign AJK Program
            </button>
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
                    <form action="<?= base_url('pengarah/editProgram/' . $prog->PROGRAM_ID) ?>" method="POST" enctype="multipart/form-data">
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