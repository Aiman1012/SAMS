<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Program Details PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Program Details</h1>
    <?php if (!empty($program)) : ?>
        <table>
            <tr>
                <th>Nama Program</th>
                <td><?= htmlspecialchars($program->NAMA_PROGRAM) ?></td>
            </tr>
            <tr>
                <th>Nama Kelab</th>
                <td><?= htmlspecialchars($program->NAMA_KELAB) ?></td>
            </tr>
            <tr>
                <th>Nama Pengarah</th>
                <td><?= htmlspecialchars($program->NAMA_PENGARAH) ?></td>
            </tr>
            <tr>
                <th>Pengarah Matric</th>
                <td><?= htmlspecialchars($program->PENGARAH_MATRIC) ?></td>
            </tr>
            <tr>
                <th>Nama Anjuran</th>
                <td><?= htmlspecialchars($program->NAMA_ANJURAN) ?></td>
            </tr>
            <tr>
                <th>Kategori Program</th>
                <td><?= htmlspecialchars($program->KATEGORI_PROGRAM) ?></td>
            </tr>
            <tr>
                <th>Tarikh Mula</th>
                <td><?= htmlspecialchars($program->TARIKH_MULA) ?></td>
            </tr>
            <?php if (!empty($program->TARIKH_TAMAT) && $program->TARIKH_TAMAT !== '-') : ?>
                <tr>
                    <th>Tarikh Tamat</th>
                    <td><?= htmlspecialchars($program->TARIKH_TAMAT) ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <th>Objektif Program</th>
                <td><?= htmlspecialchars($program->OBJEKTIF_PROGRAM) ?></td>
            </tr>
            <tr>
                <th>Tempat Program</th>
                <td><?= htmlspecialchars($program->TEMPAT_PROGRAM) ?></td>
            </tr>
            <?php if (!empty($program->MASA_PROGRAM) && $program->MASA_PROGRAM !== '-') : ?>
                <tr>
                    <th>Masa Program</th>
                    <td><?= htmlspecialchars($program->MASA_PROGRAM) ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <th>Negeri Program</th>
                <td><?= htmlspecialchars($program->NEGERI_PROGRAM) ?></td>
            </tr>
            <tr>
                <th>Dokumen Program</th>
                <td>
                    <a href="<?= base_url('uploads/' . $program->DOKUMEN_PROGRAM) ?>" target="_blank">
                        <?= htmlspecialchars($program->DOKUMEN_PROGRAM) ?>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Approval Status</th>
                <td><?= htmlspecialchars($program->APPROVAL_STATUS) ?></td>
            </tr>
            <tr>
                <th>Program Notes</th>
                <td><?= htmlspecialchars($program->PROGRAM_NOTES) ?></td>
            </tr>
            <tr>
                <th>Nota Penasihat Kelab</th>
                <td><?= htmlspecialchars($program->NOTA_PENASIHATKELAB) ?></td>
            </tr>
            <tr>
                <th>Nota MPP</th>
                <td><?= htmlspecialchars($program->NOTA_MPP) ?></td>
            </tr>
            <tr>
                <th>Nota HEPA</th>
                <td><?= htmlspecialchars($program->NOTA_HEPA) ?></td>
            </tr>
            <!-- Add other fields from TBL_SURAT_HEPA here -->
            <tr>
                <th>Peruntukan Kewangan HEPA</th>
                <td><?= htmlspecialchars($program->PERUNTUKAN_KEWANGAN_HEPA) ?></td>
            </tr>
            <tr>
                <th>Dana Tabung Amanah</th>
                <td><?= htmlspecialchars($program->DANA_TABUNG_AMANAH) ?></td>
            </tr>
            <tr>
                <th>Bilangan Sijil TNC HEPA</th>
                <td><?= htmlspecialchars($program->BILANGAN_SIJIL_TNC_HEPA) ?></td>
            </tr>
            <tr>
                <th>Bilangan Sijil Pengarah PPHKP</th>
                <td><?= htmlspecialchars($program->BILANGAN_SIJIL_PENGARAH_PPHKP) ?></td>
            </tr>
            <tr>
                <th>Kutipan Yuran Peserta</th>
                <td><?= htmlspecialchars($program->KUTIPAN_YURAN_PESERTA) ?></td>
            </tr>
            <tr>
                <th>Pegawai Pengiring 1 Nama</th>
                <td><?= htmlspecialchars($program->PEGAWAI_PENGIRING_1_NAMA) ?></td>
            </tr>
            <tr>
                <th>Pegawai Pengiring 1 No KP</th>
                <td><?= htmlspecialchars($program->PEGAWAI_PENGIRING_1_NO_KP) ?></td>
            </tr>
            <tr>
                <th>Pegawai Pengiring 1 Jawatan</th>
                <td><?= htmlspecialchars($program->PEGAWAI_PENGIRING_1_JAWATAN) ?></td>
            </tr>
            <tr>
                <th>Pegawai Pengiring 1 No Tel</th>
                <td><?= htmlspecialchars($program->PEGAWAI_PENGIRING_1_NO_TEL) ?></td>
            </tr>
            <?php if (!empty($program->PEGAWAI_PENGIRING_2_NAMA) && $program->PEGAWAI_PENGIRING_2_NAMA !== '-') : ?>
                <tr>
                    <th>Pegawai Pengiring 2 Nama</th>
                    <td><?= htmlspecialchars($program->PEGAWAI_PENGIRING_2_NAMA) ?></td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($program->PEGAWAI_PENGIRING_2_NO_KP) && $program->PEGAWAI_PENGIRING_2_NO_KP !== '-') : ?>
                <tr>
                    <th>Pegawai Pengiring 2 No KP</th>
                    <td><?= htmlspecialchars($program->PEGAWAI_PENGIRING_2_NO_KP) ?></td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($program->PEGAWAI_PENGIRING_2_JAWATAN) && $program->PEGAWAI_PENGIRING_2_JAWATAN !== '-') : ?>
                <tr>
                    <th>Pegawai Pengiring 2 Jawatan</th>
                    <td><?= htmlspecialchars($program->PEGAWAI_PENGIRING_2_JAWATAN) ?></td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($program->PEGAWAI_PENGIRING_2_NO_TEL) && $program->PEGAWAI_PENGIRING_2_NO_TEL !== '-') : ?>
                <tr>
                    <th>Pegawai Pengiring 2 No Tel</th>
                    <td><?= htmlspecialchars($program->PEGAWAI_PENGIRING_2_NO_TEL) ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <th>Kenderaan Universiti</th>
                <td><?= htmlspecialchars($program->KENDERAAN_UNIVERSITI) ?></td>
            </tr>
            <tr>
                <th>Peserta</th>
                <td><?= htmlspecialchars($program->PESERTA) ?></td>
            </tr>
            <tr>
                <th>Disediakan Nama</th>
                <td><?= htmlspecialchars($program->DISEDIAKAN_NAMA) ?></td>
            </tr>
            <tr>
                <th>Disediakan Jawatan</th>
                <td><?= htmlspecialchars($program->DISEDIAKAN_JAWATAN) ?></td>
            </tr>
            <tr>
                <th>Disediakan Bagi Pihak</th>
                <td><?= htmlspecialchars($program->DISEDIAKAN_BAGI_PIHAK) ?></td>
            </tr>
            <tr>
                <th>Disediakan Status</th>
                <td><?= htmlspecialchars($program->DISEDIAKAN_STATUS) ?></td>
            </tr>
            <tr>
                <th>Disokong Nama</th>
                <td><?= htmlspecialchars($program->DISOKONG_NAMA) ?></td>
            </tr>
            <tr>
                <th>Disokong Jawatan</th>
                <td><?= htmlspecialchars($program->DISOKONG_JAWATAN) ?></td>
            </tr>
            <tr>
                <th>Disokong Bagi Pihak</th>
                <td><?= htmlspecialchars($program->DISOKONG_BAGI_PIHAK) ?></td>
            </tr>
            <tr>
                <th>Disokong Status</th>
                <td><?= htmlspecialchars($program->DISOKONG_STATUS) ?></td>
            </tr>
            <tr>
                <th>Kelulusan Nama</th>
                <td><?= htmlspecialchars($program->KELULUSAN_NAMA) ?></td>
            </tr>
            <tr>
                <th>Kelulusan Jawatan</th>
                <td><?= htmlspecialchars($program->KELULUSAN_JAWATAN) ?></td>
            </tr>
            <tr>
                <th>Kelulusan Bagi Pihak</th>
                <td><?= htmlspecialchars($program->KELULUSAN_BAGI_PIHAK) ?></td>
            </tr>
            <tr>
                <th>Kelulusan Status</th>
                <td><?= htmlspecialchars($program->KELULUSAN_STATUS) ?></td>
            </tr>
            <tr>
                <th>Created At</th>
                <td><?= htmlspecialchars($program->CREATED_AT) ?></td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td><?= htmlspecialchars($program->UPDATED_AT) ?></td>
            </tr>
        </table>
    <?php else : ?>
        <p>No program details found.</p>
    <?php endif; ?>
</body>

</html>