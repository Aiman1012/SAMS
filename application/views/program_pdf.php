<!DOCTYPE html>
<html>

<head>
    <title>Program Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header,
        .footer {
            text-align: center;
        }

        .header {
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 20px;
        }

        .content {
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Program Details</h2>
        </div>
        <div class="content">
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
                    <th>Anjuran / Penyertaan</th>
                    <td><?= htmlspecialchars($program->NAMA_ANJURAN) ?></td>
                </tr>
                <tr>
                    <th>Kategori Program</th>
                    <td><?= htmlspecialchars($program->KATEGORI_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th>Tarikh Mula Program</th>
                    <td><?= htmlspecialchars($program->TARIKH_MULA) ?></td>
                </tr>
                <?php if (!empty($program->TARIKH_TAMAT)) : ?>
                    <tr>
                        <th>Tarikh Tamat Program</th>
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
                <tr>
                    <th>Objektif Program</th>
                    <td><?= htmlspecialchars($program->OBJEKTIF_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th>Masa Program</th>
                    <td><?= htmlspecialchars($program->MASA_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th>Negeri Program</th>
                    <td><?= htmlspecialchars($program->NEGERI_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th>Tempat</th>
                    <td><?= htmlspecialchars($program->TEMPAT) ?></td>
                </tr>
                <tr>
                    <th>Kos Program</th>
                    <td><?= htmlspecialchars($program->KOS_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th>Penyertaan Program</th>
                    <td><?= htmlspecialchars($program->PENYERTAAN_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th>Objektif Program</th>
                    <td><?= nl2br(htmlspecialchars($program->OBJEKTIF_PROGRAM)) ?></td>
                </tr>
                <!-- Add other necessary fields similarly -->
            </table>
            <div class="footer">
                <p>Disediakan oleh:</p>
                <p>......................................................<br />
                    (ENCIK MOHD SALLEH BIN BAIN)<br />
                    Penolong Pendaftar (Seksyen Pembangunan Kepimpinan dan Transformasi Mahasiswa)<br />
                    Pusat Pembangunan Holistik Pelajar (PPHP)<br />
                    Tarikh Cetak: <?= date('d M Y') ?>
                </p>
                <p>Disokong Oleh:</p>
                <p>......................................................<br />
                    ( )<br />
                    Ketua Pusat Pembangunan Holistik dan Kaunseling Pelajar (PPHKP)<br />
                    b.p: Timbalan Naib Canselor, Pejabat Hal Ehwal Pelajar dan Alumni
                </p>
            </div>
        </div>
    </div>
</body>

</html>