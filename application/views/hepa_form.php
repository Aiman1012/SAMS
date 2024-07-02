<?= $this->session->flashdata('message'); ?>

<div class="container">
    <h2><?= $title ?></h2>
    <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('hepa/submitApproval') ?>" method="POST">
        <input type="hidden" name="PROGRAM_ID" value="<?= $PROGRAM_ID ?>">

        <div class="card mb-4">
            <div class="card-header">
                <h4>Bantuan dan Kelulusan HEPA</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="PERUNTUKAN_KEWANGAN_HEPA">Peruntukan Kewangan Hepa (RM)</label>
                        <input type="number" step="0.01" class="form-control" id="PERUNTUKAN_KEWANGAN_HEPA" name="PERUNTUKAN_KEWANGAN_HEPA" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="DANA_TABUNG_AMANAH">Dana Tabung Amanah (RM)</label>
                        <input type="number" step="0.01" class="form-control" id="DANA_TABUNG_AMANAH" name="DANA_TABUNG_AMANAH" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="BILANGAN_SIJIL_TNC_HEPA">Bilangan Sijil (Tandatangan TNC HEPA)</label>
                        <input type="number" class="form-control" id="BILANGAN_SIJIL_TNC_HEPA" name="BILANGAN_SIJIL_TNC_HEPA" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="BILANGAN_SIJIL_PENGARAH_PPHKP">Bilangan Sijil (Tandatangan Pengarah PPHKP)</label>
                        <input type="number" class="form-control" id="BILANGAN_SIJIL_PENGARAH_PPHKP" name="BILANGAN_SIJIL_PENGARAH_PPHKP" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="KUTIPAN_YURAN_PESERTA">Kutipan Yuran Peserta (RM)</label>
                        <input type="number" step="0.01" class="form-control" id="KUTIPAN_YURAN_PESERTA" name="KUTIPAN_YURAN_PESERTA" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>Pegawai Pengiring</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="PEGAWAI_PENGIRING_1_NAMA">Nama Pegawai Pengiring 1</label>
                        <input type="text" class="form-control" id="PEGAWAI_PENGIRING_1_NAMA" name="PEGAWAI_PENGIRING_1_NAMA" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="PEGAWAI_PENGIRING_1_NO_KP">No K/P Pegawai Pengiring 1</label>
                        <input type="text" class="form-control" id="PEGAWAI_PENGIRING_1_NO_KP" name="PEGAWAI_PENGIRING_1_NO_KP" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="PEGAWAI_PENGIRING_1_JAWATAN">Jawatan Pegawai Pengiring 1</label>
                        <input type="text" class="form-control" id="PEGAWAI_PENGIRING_1_JAWATAN" name="PEGAWAI_PENGIRING_1_JAWATAN" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="PEGAWAI_PENGIRING_1_NO_TEL">No Tel Pegawai Pengiring 1</label>
                        <input type="text" class="form-control" id="PEGAWAI_PENGIRING_1_NO_TEL" name="PEGAWAI_PENGIRING_1_NO_TEL" required>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="PEGAWAI_PENGIRING_2_NAMA">Nama Pegawai Pengiring 2</label>
                        <input type="text" class="form-control" id="PEGAWAI_PENGIRING_2_NAMA" name="PEGAWAI_PENGIRING_2_NAMA">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="PEGAWAI_PENGIRING_2_NO_KP">No K/P Pegawai Pengiring 2</label>
                        <input type="text" class="form-control" id="PEGAWAI_PENGIRING_2_NO_KP" name="PEGAWAI_PENGIRING_2_NO_KP">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="PEGAWAI_PENGIRING_2_JAWATAN">Jawatan Pegawai Pengiring 2</label>
                        <input type="text" class="form-control" id="PEGAWAI_PENGIRING_2_JAWATAN" name="PEGAWAI_PENGIRING_2_JAWATAN">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="PEGAWAI_PENGIRING_2_NO_TEL">No Tel Pegawai Pengiring 2</label>
                        <input type="text" class="form-control" id="PEGAWAI_PENGIRING_2_NO_TEL" name="PEGAWAI_PENGIRING_2_NO_TEL">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>Kenderaan Universiti</h4>
            </div>
            <div class="card-body" id="kenderaan_section">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="KENDERAAN_UNIVERSITI">Jenis Kenderaan Universiti</label>
                        <select class="form-control" id="KENDERAAN_UNIVERSITI" name="KENDERAAN_UNIVERSITI[]" required>
                            <option value="Bus">Bus</option>
                            <option value="Van">Van</option>
                            <option value="Car">Car</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="bilangan_kenderaan">Bilangan</label>
                        <input type="number" class="form-control" id="bilangan_kenderaan" name="bilangan_kenderaan[]" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" onclick="addKenderaan()">Add Kenderaan</button>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>Peserta Program</h4>
            </div>
            <div class="card-body" id="peserta_section">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="bil_peserta">Bil Peserta</label>
                        <input type="number" class="form-control" id="bil_peserta" name="bil_peserta[]" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="bayaran_peserta">Bayaran (RM)</label>
                        <input type="number" step="0.01" class="form-control" id="bayaran_peserta" name="bayaran_peserta[]" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" onclick="addPeserta()">Add Peserta</button>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>Disediakan Oleh</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="DISEDIAKAN_NAMA">Nama</label>
                        <input type="text" class="form-control" id="DISEDIAKAN_NAMA" name="DISEDIAKAN_NAMA" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="DISEDIAKAN_JAWATAN">Jawatan</label>
                        <input type="text" class="form-control" id="DISEDIAKAN_JAWATAN" name="DISEDIAKAN_JAWATAN" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="DISEDIAKAN_BAGI_PIHAK">Bagi Pihak</label>
                        <input type="text" class="form-control" id="DISEDIAKAN_BAGI_PIHAK" name="DISEDIAKAN_BAGI_PIHAK" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="DISEDIAKAN_STATUS" id="DISEDIAKAN_STATUS_AKTIF" value="Aktif" required>
                                <label class="form-check-label" for="DISEDIAKAN_STATUS_AKTIF">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="DISEDIAKAN_STATUS" id="DISEDIAKAN_STATUS_TIDAK_AKTIF" value="Tidak Aktif" required>
                                <label class="form-check-label" for="DISEDIAKAN_STATUS_TIDAK_AKTIF">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>Disokong Oleh</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="DISOKONG_NAMA">Nama</label>
                        <input type="text" class="form-control" id="DISOKONG_NAMA" name="DISOKONG_NAMA" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="DISOKONG_JAWATAN">Jawatan</label>
                        <input type="text" class="form-control" id="DISOKONG_JAWATAN" name="DISOKONG_JAWATAN" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="DISOKONG_BAGI_PIHAK">Bagi Pihak</label>
                        <input type="text" class="form-control" id="DISOKONG_BAGI_PIHAK" name="DISOKONG_BAGI_PIHAK" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="DISOKONG_STATUS" id="DISOKONG_STATUS_AKTIF" value="Aktif" required>
                                <label class="form-check-label" for="DISOKONG_STATUS_AKTIF">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="DISOKONG_STATUS" id="DISOKONG_STATUS_TIDAK_AKTIF" value="Tidak Aktif" required>
                                <label class="form-check-label" for="DISOKONG_STATUS_TIDAK_AKTIF">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h4>Kelulusan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="KELULUSAN_NAMA">Nama</label>
                        <input type="text" class="form-control" id="KELULUSAN_NAMA" name="KELULUSAN_NAMA" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="KELULUSAN_JAWATAN">Jawatan</label>
                        <input type="text" class="form-control" id="KELULUSAN_JAWATAN" name="KELULUSAN_JAWATAN" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="KELULUSAN_BAGI_PIHAK">Bagi Pihak</label>
                        <input type="text" class="form-control" id="KELULUSAN_BAGI_PIHAK" name="KELULUSAN_BAGI_PIHAK" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="KELULUSAN_STATUS" id="KELULUSAN_STATUS_AKTIF" value="Aktif" required>
                                <label class="form-check-label" for="KELULUSAN_STATUS_AKTIF">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="KELULUSAN_STATUS" id="KELULUSAN_STATUS_TIDAK_AKTIF" value="Tidak Aktif" required>
                                <label class="form-check-label" for="KELULUSAN_STATUS_TIDAK_AKTIF">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>
    function addPeserta() {
        const pesertaSection = document.getElementById('peserta_section');
        const newPeserta = document.createElement('div');
        newPeserta.classList.add('row', 'mb-3');
        newPeserta.innerHTML = `
            <div class="col-md-6 form-group">
                <label for="bil_peserta">Bil Peserta</label>
                <input type="number" class="form-control" name="bil_peserta[]" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="bayaran_peserta">Bayaran (RM)</label>
                <input type="number" step="0.01" class="form-control" name="bayaran_peserta[]" required>
            </div>
        `;
        pesertaSection.appendChild(newPeserta);
    }

    function addKenderaan() {
        const kenderaanSection = document.getElementById('kenderaan_section');
        const newKenderaan = document.createElement('div');
        newKenderaan.classList.add('row', 'mb-3');
        newKenderaan.innerHTML = `
            <div class="col-md-6 form-group">
                <label for="KENDERAAN_UNIVERSITI">Jenis Kenderaan Universiti</label>
                <select class="form-control" name="KENDERAAN_UNIVERSITI[]" required>
                    <option value="Bus">Bus</option>
                    <option value="Van">Van</option>
                    <option value="Car">Car</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label for="bilangan_kenderaan">Bilangan</label>
                <input type="number" class="form-control" name="bilangan_kenderaan[]" required>
            </div>
        `;
        kenderaanSection.appendChild(newKenderaan);
    }
</script>