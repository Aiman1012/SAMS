<?= $this->session->flashdata('message'); ?>

<div class="container">
    <h2 class="mt-4 mb-4">Program Approval</h2>

    <?php foreach ($program as $prog) : ?>
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th class="bg-info" scope="row">Nama Kelab</th>
                    <td><?= htmlspecialchars($prog->nama_kelab) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Nama Program</th>
                    <td><?= htmlspecialchars($prog->nama_program) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Nama Pengarah</th>
                    <td><?= htmlspecialchars($prog->nama_pengarah) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">No Matriks Pengarah Program</th>
                    <td><?= htmlspecialchars($prog->pengarah_matric) ?></td>
                </tr>
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
        <div class="text-center">
            <?php if ($this->session->userdata('role') === 'penasihat' && (($prog->approval_status == 'Pending') || ($prog->approval_status == 'Rejected by Penasihat'))) : ?>
                <!-- Buttons for Program Approval/Rejection for Penasihat -->
                <a href="<?= base_url('penasihat/lulusProgram/' . $prog->program_id) ?>" class="btn btn-success btn-sm">Approve Program</a>
                <button data-toggle="modal" data-target="#reject<?= $prog->program_id ?>" class=" btn btn-danger btn-sm">Reject Program</button>
            <?php elseif ($this->session->userdata('role') === 'mpp' && (($prog->approval_status == 'Pending MPP Approval') || ($prog->approval_status == 'Rejected by MPP'))) : ?>
                <!-- Buttons for Program Approval/Rejection for MPP -->
                <a href="<?= base_url('mpp/lulusProgram/' . $prog->program_id) ?>" class="btn btn-success btn-sm">Approve Program</a>
                <button data-toggle="modal" data-target="#reject<?= $prog->program_id ?>" class=" btn btn-danger btn-sm">Reject Program</button>
            <?php elseif ($this->session->userdata('role') === 'hepa' && (($prog->approval_status == 'Pending HEPA Approval') || ($prog->approval_status == 'Rejected by HEPA')) || ($prog->approval_status == 'Edit Request Sent')) : ?>
                <!-- Buttons for Program Approval/Rejection for HEPA -->
                <button onclick="approveProgram(<?= $prog->program_id ?>)" class="btn btn-success btn-sm">Approve Program</button>
                <button data-toggle="modal" data-target="#reject<?= $prog->program_id ?>" class=" btn btn-danger btn-sm">Reject Program</button>
            <?php endif; ?>
        </div>



    <?php endforeach ?>

    <div class="card-header">
        <h3 class="card-title">
            <?php if ($this->session->userdata('role') === 'penasihat') : ?>
                <a href="<?= base_url('penasihat') ?>" class="btn btn-danger btn-sm ml-auto">
                    <i class="fas fa-back"></i> Go Back
                </a>
            <?php endif; ?>
            <?php if ($this->session->userdata('role') === 'mpp') : ?>
                <a href="<?= base_url('mpp') ?>" class="btn btn-danger btn-sm ml-auto">
                    <i class="fas fa-back"></i> Go Back
                </a>
            <?php endif; ?>
            <?php if ($this->session->userdata('role') === 'hepa') : ?>
                <a href="<?= base_url('hepa') ?>" class="btn btn-danger btn-sm ml-auto">
                    <i class="fas fa-back"></i> Go Back
                </a>
            <?php endif; ?>
        </h3>
    </div>
</div>


<!-- Modal For Reject Program -->
<?php foreach ($program as $prog) : ?>
    <div class="modal fade" id="reject<?= $prog->program_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- penasihat session -->
                    <?php if ($this->session->userdata('role') === 'penasihat') : ?>
                        <form action="<?= base_url('penasihat/rejectProgram/' . $prog->program_id) ?>" method="POST">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Sebab Program Ditolak</label>
                                    <textarea name="program_notes" class="form-control"><?= $prog->program_notes ?></textarea>
                                    <?= form_error('program_notes', '<div class="text-small text-danger">', '</div>'); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                    <!-- mpp session -->
                    <?php if ($this->session->userdata('role') === 'mpp') : ?>
                        <form action="<?= base_url('mpp/rejectProgram/' . $prog->program_id) ?>" method="POST">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Sebab Program Ditolak</label>
                                    <textarea name="program_notes" class="form-control"><?= $prog->program_notes ?></textarea>
                                    <?= form_error('program_notes', '<div class="text-small text-danger">', '</div>'); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                    <!-- hepa session -->
                    <?php if ($this->session->userdata('role') === 'hepa') : ?>
                        <form action="<?= base_url('hepa/rejectProgram/' . $prog->program_id) ?>" method="POST">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Sebab Program Ditolak</label>
                                    <textarea name="program_notes" class="form-control"><?= $prog->program_notes ?></textarea>
                                    <?= form_error('program_notes', '<div class="text-small text-danger">', '</div>'); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- End Modal Reject Program-->


<!-- Modal For Assign Director -->
<?php foreach ($program as $prog) : ?>
    <div class="modal fade" id="assign<?= $prog->program_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Pengarah Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- hepa session -->
                    <?php if ($this->session->userdata('role') === 'hepa') : ?>
                        <form action="<?= base_url('hepa/assignPengarah/' . $prog->program_id) ?>" method="POST">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Nombor Matriks</label>
                                    <input type="text" name="pengarah_matric" class="form-control" value="<?= $prog->pengarah_matric ?>">
                                    <?= form_error('pengarah_matric', '<div class="text-small text-danger">', '</div>'); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- End Modal Assign Pengarah Program-->

<script>
    function approveProgram(programId) {

        // Navigate to the specified URL
        // Set the modal's data-target dynamically based on the program ID
        $('#assign' + programId).modal('show');
    }
</script>