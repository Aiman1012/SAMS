<?= $this->session->flashdata('message'); ?>

<div class="container">
    <h2 class="mt-4 mb-4">Program Approval</h2>

    <?php foreach ($program as $prog) : ?>
        <table class="table table-bordered">
            <!-- Display program details here -->
            <p><strong>Nama Kelab:</strong> <?= htmlspecialchars($prog->nama_kelab) ?></p>
            <p><strong>Nama Program:</strong> <?= htmlspecialchars($prog->nama_program) ?></p>
            <p><strong>Nama Pengarah:</strong> <?= htmlspecialchars($prog->nama_pengarah) ?></p>
            <p><strong>Nama Anjuran:</strong> <?= htmlspecialchars($prog->nama_anjuran) ?></p>
            <p><strong>Kategori Program:</strong> <?= htmlspecialchars($prog->kategori_program) ?></p>
            <p><strong>Tarikh Mula:</strong> <?= htmlspecialchars($prog->tarikh_mula) ?></p>
            <p><strong>Tarikh Tamat:</strong> <?= htmlspecialchars($prog->tarikh_tamat) ?></p>
            <p><strong>Objektif Program:</strong> <?= htmlspecialchars($prog->objektif_program) ?></p>
            <p><strong>Tempat Program:</strong> <?= htmlspecialchars($prog->tempat_program) ?></p>
            <p><strong>Masa Program:</strong> <?= htmlspecialchars($prog->masa_program) ?></p>
            <p><strong>Negeri Program:</strong> <?= htmlspecialchars($prog->negeri_program) ?></p>
            <p><strong>Dokumen Program:</strong> <a href="<?= base_url('' . $prog->dokumen_program) ?>" target="_blank"><?= $prog->dokumen_program ?></a></p>
            <p><strong>Status Program:</strong> <?= htmlspecialchars($prog->approval_status) ?></p>
            <p><strong>Nota Program:</strong> <?= htmlspecialchars($prog->program_notes) ?></p>
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
                <a href="<?= base_url('hepa/lulusProgram/' . $prog->program_id) ?>" class="btn btn-success btn-sm">Approve Program</a>
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


<!-- Modal -->
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