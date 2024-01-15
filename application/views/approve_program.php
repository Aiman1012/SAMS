<div>
    <h2>Program Details</h2>
    <?php foreach ($program as $prog) : ?>
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
    <?php endforeach ?>
    <form action="<?= base_url('presiden/mohon_program_action') ?>" method="POST">
        <div>
            <label for="">Kelulusan Program</label><br>
            <input type="radio" id="html" name="approval_program" value="Lulus">
            <label for="Lulus">Lulus</label><br>
            <input type="radio" id="css" name="approval_program" value="Tolak">
            <label for="Tolak">Tolak</label><br>
        </div>
        <div class="form-group">
            <label for="">Catatan Program</label>
            <textarea name="catatan_program" class="form-control"></textarea>
            <?= form_error('objektif_program', '<div class="text-small text-danger">', '</div>'); ?>
        </div>
    </form>

    <div class="card-header">
        <h3 class="card-title"><a href="<?= base_url('hepa') ?>" class="btn btn-danger btn-sm"><i class="fas fa-back"></i>Go Back</a></h3>
    </div>
</div>