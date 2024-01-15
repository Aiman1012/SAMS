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
    <div class="card-header">
        <h3 class="card-title"><a href="<?= base_url('presiden') ?>" class="btn btn-danger btn-sm"><i class="fas fa-back"></i>Go Back</a></h3>
    </div>
</div>