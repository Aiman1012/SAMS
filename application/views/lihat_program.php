<div class="container">
    <h2 class="mt-4 mb-4">Program Details</h2>
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
    <?php endforeach ?>
    <div class="card-header">
        <h3 class="card-title">
            <a href="<?= base_url('presiden') ?>" class="btn btn-danger btn-sm">
                <i class="fas fa-back"></i> Go Back
            </a>
        </h3>
    </div>
</div>