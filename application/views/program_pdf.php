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
            <h2>SYARAT-SYARAT KELULUSAN AKTIVITI BADAN PELAJAR</h2>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>Nama Program</th>
                    <td><?= htmlspecialchars($program->NAMA_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th>Anjuran/Penyertaan</th>
                    <td><?= htmlspecialchars($program->NAMA_KELAB) ?></td>
                </tr>
                <tr>
                    <th>Anjuran Bersama</th>
                    <td><?= htmlspecialchars($program->NAMA_ANJURAN) ?></td>
                </tr>
                <tr>
                    <th>Dengan Kerjasama</th>
                    <td><?= htmlspecialchars($program->NAMA_ANJURAN) ?></td>
                </tr>
                <tr>
                    <th>Tarikh Mula Pelaksanaan Program</th>
                    <td><?= htmlspecialchars($program->TARIKH_MULA) ?></td>
                </tr>
                <?php if (!empty($program->TARIKH_TAMAT)) : ?>
                    <tr>
                        <th>Tarikh Tamat Program</th>
                        <td><?= htmlspecialchars($program->TARIKH_TAMAT) ?></td>
                    </tr>
                <?php endif; ?>
                <?php if (!empty($program->MASA_PROGRAM)) : ?>
                    <tr>
                        <th>Masa Program</th>
                        <td><?= htmlspecialchars($program->MASA_PROGRAM) ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th>Tempat Program</th>
                    <td><?= htmlspecialchars($program->TEMPAT_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th>Kos Program</th>
                    <td><?= htmlspecialchars($program->KOS_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th>Kategori Program</th>
                    <td><?= htmlspecialchars($program->KATEGORI_PROGRAM) ?></td>
                </tr>
                <tr>
                    <th>Objektif Program</th>
                    <td><?= htmlspecialchars($program->OBJEKTIF_PROGRAM) ?></td>
                </tr>


                <tr>
                    <th>Kewangan HEPA</th>
                    <td><?= htmlspecialchars($program->PERUNTUKAN_KEWANGAN_HEPA) ?></td>
                </tr>
                <tr>
                    <th>Dana Tabung Amanah</th>
                    <td><?= htmlspecialchars($program->DANA_TABUNG_AMANAH) ?></td>
                </tr>
                <tr>
                    <th>Permohonan Sijil HEPA</th>
                    <td><?= htmlspecialchars($program->BILANGAN_SIJIL_TNC_HEPA) ?></td>
                </tr>
                <tr>
                    <th>Permohonan Sijil PPHKP</th>
                    <td><?= htmlspecialchars($program->BILANGAN_SIJIL_PENGARAH_PPHKP) ?></td>
                </tr>
                <tr>
                    <th>Penyertaan Program</th>
                    <td><?= htmlspecialchars($program->KUTIPAN_YURAN_PESERTA) ?></td>
                </tr>
                <tr>
                    <th>Kelulusan Kenderaan Universiti</th>
                    <td><?= htmlspecialchars($program->KENDERAAN_UNIVERSITI) ?></td>
                </tr>
                <!-- Senarai Pegawai Pengiring -->
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