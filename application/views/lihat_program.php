<div class="container">
    <h2 class="mt-4 mb-4">Program Details</h2>
    <?php foreach ($program as $prog) : ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">Nama Kelab</th>
                    <td><?= htmlspecialchars($prog->nama_kelab) ?></td>
                </tr>
                <tr>
                    <th scope="row">Nama Program</th>
                    <td><?= htmlspecialchars($prog->nama_program) ?></td>
                </tr>
                <tr>
                    <th scope="row">Nama Pengarah</th>
                    <td><?= htmlspecialchars($prog->nama_pengarah) ?></td>
                </tr>
                <tr>
                    <th scope="row">Nama Anjuran</th>
                    <td><?= htmlspecialchars($prog->nama_anjuran) ?></td>
                </tr>
                <tr>
                    <th scope="row">Kategori Program</th>
                    <td><?= htmlspecialchars($prog->kategori_program) ?></td>
                </tr>
                <tr>
                    <th scope="row">Tarikh Mula</th>
                    <td><?= htmlspecialchars($prog->tarikh_mula) ?></td>
                </tr>
                <tr>
                    <th scope="row">Tarikh Tamat</th>
                    <td><?= htmlspecialchars($prog->tarikh_tamat) ?></td>
                </tr>
                <tr>
                    <th scope="row">Objektif Program</th>
                    <td><?= htmlspecialchars($prog->objektif_program) ?></td>
                </tr>
                <tr>
                    <th scope="row">Tempat Program</th>
                    <td><?= htmlspecialchars($prog->tempat_program) ?></td>
                </tr>
                <tr>
                    <th scope="row">Masa Program</th>
                    <td><?= htmlspecialchars($prog->masa_program) ?></td>
                </tr>
                <tr>
                    <th scope="row">Negeri Program</th>
                    <td><?= htmlspecialchars($prog->negeri_program) ?></td>
                </tr>
                <tr>
                    <th scope="row">Dokumen Program</th>
                    <td>
                        <a href="<?= base_url($prog->dokumen_program) ?>" target="_blank">
                            <?= htmlspecialchars($prog->dokumen_program) ?>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php endforeach ?>
    <div class="card-header">
        <h3 class="card-title">
            <a href="<?= base_url('presiden') ?>" class="btn btn-danger btn-sm">
                <i class="fas fa-back"></i> Go Back
            </a>
        </h3>
    </div>
</div>