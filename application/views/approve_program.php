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
        </table>

        <div class="text-center">
            <?php if ($this->session->userdata('role') === 'penasihat' && $prog->approval_status == 'Pending') : ?>
                <!-- Buttons for Program Approval/Rejection for Penasihat -->
                <a href="<?= base_url('penasihat/lulusProgram/' . $prog->program_id) ?>" class="btn btn-success btn-sm">Penasihat Approve Program</a>
                <a href="<?= base_url('penasihat/rejectProgram/' . $prog->program_id) ?>" class="btn btn-danger btn-sm">Reject Program</a>
            <?php elseif ($this->session->userdata('role') === 'mpp' && $prog->approval_status == 'Pending MPP Approval') : ?>
                <!-- Buttons for Program Approval/Rejection for MPP -->
                <a href="<?= base_url('mpp/lulusProgram/' . $prog->program_id) ?>" class="btn btn-success btn-sm">MPP Approve Program</a>
                <a href="<?= base_url('mpp/rejectProgram/' . $prog->program_id) ?>" class="btn btn-danger btn-sm">Reject Program</a>
            <?php elseif ($this->session->userdata('role') === 'hepa' && $prog->approval_status == 'Pending HEPA Approval') : ?>
                <!-- Buttons for Program Approval/Rejection for HEPA -->
                <a href="<?= base_url('hepa/lulusProgram/' . $prog->program_id) ?>" class="btn btn-success btn-sm">HEPA Approve Program</a>
                <a href="<?= base_url('hepa/rejectProgram/' . $prog->program_id) ?>" class="btn btn-danger btn-sm">Reject Program</a>
            <?php endif; ?>
        </div>



    <?php endforeach ?>

    <div class="card-header">
        <h3 class="card-title">
            <a href="<?= base_url('penasihat') ?>" class="btn btn-danger btn-sm ml-auto">
                <i class="fas fa-back"></i> Go Back
            </a>
        </h3>
    </div>
</div>