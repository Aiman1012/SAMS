<?= $this->session->flashdata('message'); ?>

<div class="container">
    <h2 class="mt-4 mb-4">Program Approval</h2>

    <?php foreach ($program as $prog) : ?>
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th class="bg-info" scope="row">Nama Kelab</th>
                    <td><?= htmlspecialchars($prog->NAMA_KELAB) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Nama Program</th>
                    <td><?= htmlspecialchars($prog->NAMA_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Nama Pengarah</th>
                    <td><?= htmlspecialchars($prog->NAMA_PENGARAH) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">No Matriks Pengarah Program</th>
                    <td><?= htmlspecialchars($prog->PENGARAH_MATRIC) ?></td>
                </tr>
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
                <tr>
                    <th class="bg-info" scope="row">Tarikh Tamat</th>
                    <td><?= htmlspecialchars($prog->TARIKH_TAMAT) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Objektif Program</th>
                    <td><?= htmlspecialchars($prog->OBJEKTIF_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Tempat Program</th>
                    <td><?= htmlspecialchars($prog->TEMPAT_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Masa Program</th>
                    <td><?= htmlspecialchars($prog->MASA_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Negeri Program</th>
                    <td><?= htmlspecialchars($prog->NEGERI_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th class="bg-info" scope="row">Dokumen Program</th>
                    <td>
                        <a href="<?= base_url($prog->DOKUMEN_PROGRAM) ?>" target="_blank">
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
        <div class="text-center">
            <?php if ($this->session->userdata('role') === 'penasihat' && (($prog->APPROVAL_STATUS == 'Pending') || ($prog->APPROVAL_STATUS == 'Rejected by Penasihat'))) : ?>
                <!-- Buttons for Program Approval/Rejection for Penasihat -->
                <a href="<?= base_url('penasihat/lulusProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-success btn-sm">Approve Program</a>
                <button data-toggle="modal" data-target="#reject<?= $prog->PROGRAM_ID ?>" class=" btn btn-danger btn-sm">Reject Program</button>
            <?php elseif ($this->session->userdata('role') === 'mpp' && (($prog->APPROVAL_STATUS == 'Pending MPP Approval') || ($prog->APPROVAL_STATUS == 'Rejected by MPP'))) : ?>
                <!-- Buttons for Program Approval/Rejection for MPP -->
                <a href="<?= base_url('mpp/lulusProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-success btn-sm">Approve Program</a>
                <button data-toggle="modal" data-target="#reject<?= $prog->PROGRAM_ID ?>" class=" btn btn-danger btn-sm">Reject Program</button>
            <?php elseif ($this->session->userdata('role') === 'hepa' && (($prog->APPROVAL_STATUS == 'Pending HEPA Approval') || ($prog->APPROVAL_STATUS == 'Rejected by HEPA')) || ($prog->APPROVAL_STATUS == 'Edit Request Sent')) : ?>
                <!-- Buttons for Program Approval/Rejection for HEPA -->
                <button onclick="approveProgram(<?= $prog->PROGRAM_ID ?>)" class="btn btn-success btn-sm">Approve Program</button>
                <button data-toggle="modal" data-target="#reject<?= $prog->PROGRAM_ID ?>" class=" btn btn-danger btn-sm">Reject Program</button>
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
    <div class="modal fade" id="reject<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form action="<?= base_url('penasihat/rejectProgram/' . $prog->PROGRAM_ID) ?>" method="POST">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Sebab Program Ditolak</label>
                                    <textarea name="PROGRAM_NOTES" class="form-control"><?= $prog->PROGRAM_NOTES ?></textarea>
                                    <?= form_error('PROGRAM_NOTES', '<div class="text-small text-danger">', '</div>'); ?>
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
                        <form action="<?= base_url('mpp/rejectProgram/' . $prog->PROGRAM_ID) ?>" method="POST">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Sebab Program Ditolak</label>
                                    <textarea name="PROGRAM_NOTES" class="form-control"><?= $prog->PROGRAM_NOTES ?></textarea>
                                    <?= form_error('PROGRAM_NOTES', '<div class="text-small text-danger">', '</div>'); ?>
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
                        <form action="<?= base_url('hepa/rejectProgram/' . $prog->PROGRAM_ID) ?>" method="POST">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Sebab Program Ditolak</label>
                                    <textarea name="PROGRAM_NOTES" class="form-control"><?= $prog->PROGRAM_NOTES ?></textarea>
                                    <?= form_error('PROGRAM_NOTES', '<div class="text-small text-danger">', '</div>'); ?>
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
    <div class="modal fade" id="assign<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form action="<?= base_url('hepa/assignPengarah/' . $prog->PROGRAM_ID) ?>" method="POST">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Nombor Matriks</label>
                                    <input type="text" name="PENGARAH_MATRIC" class="form-control" value="<?= $prog->PENGARAH_MATRIC ?>">
                                    <?= form_error('PENGARAH_MATRIC', '<div class="text-small text-danger">', '</div>'); ?>
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