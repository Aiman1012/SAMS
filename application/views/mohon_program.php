<?php if ($this->session->flashdata('message')) : ?>
    <?= $this->session->flashdata('message'); ?>
<?php endif; ?>

<form action="<?= base_url('presiden/mohon_program_action') ?>" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="">Nama Kelab</label>
        <input type="text" name="NAMA_KELAB" class="form-control">
        <?= form_error('NAMA_KELAB', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Nama Program</label>
        <input type="text" name="NAMA_PROGRAM" class="form-control">
        <?= form_error('NAMA_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Nama Pengarah</label>
        <input type="text" name="NAMA_PENGARAH" class="form-control">
        <?= form_error('NAMA_PENGARAH', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Nombor Matriks Pengarah Program</label>
        <input type="text" name="PENGARAH_MATRIC" class="form-control">
        <?= form_error('PENGARAH_MATRIC', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Nama Anjuran Bersama</label>
        <input type="text" name="NAMA_ANJURAN" class="form-control">
        <?= form_error('NAMA_ANJURAN', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Kategori Program</label>
        <select name="KATEGORI_PROGRAM" class="form-control">
            <option value="akademik">Akademik</option>
            <option value="sukan">Sukan</option>
            <!-- Add more options as needed -->
        </select>
        <?= form_error('KATEGORI_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <label for="">Duration</label>
    <div>
        <input type="radio" id="one_day" name="duration" value="one_day" onclick="toggleFields()" checked>
        <label for="one_day">A day</label>
        <input type="radio" id="two_or_more_days" name="duration" value="two_or_more_days" onclick="toggleFields()">
        <label for="two_or_more_days">2 days or more</label>
    </div>
    <div class="form-group">
        <label for="">Tarikh Mula</label>
        <input type="date" id="TARIKH_MULA" name="TARIKH_MULA" class="form-control" onchange="setMinTarikhTamat()">
        <?= form_error('TARIKH_MULA', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <div class="form-group" id="TARIKH_TAMAT_container" style="display: none;">
        <label for="">Tarikh Tamat</label>
        <input type="date" id="TARIKH_TAMAT" name="TARIKH_TAMAT" class="form-control">
        <?= form_error('TARIKH_TAMAT', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group" id="MASA_PROGRAM_container">
        <label for="">Masa Program</label>
        <input type="time" name="MASA_PROGRAM" class="form-control">
        <?= form_error('MASA_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Objektif Program</label>
        <textarea name="OBJEKTIF_PROGRAM" class="form-control"></textarea>
        <?= form_error('OBJEKTIF_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Tempat Program</label>
        <input type="text" name="TEMPAT_PROGRAM" class="form-control">
        <?= form_error('TEMPAT_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="NEGERI_PROGRAM">Negeri Program</label>
        <select name="NEGERI_PROGRAM" class="form-control">
            <option value="" selected disabled>Select State</option>
            <option value="Johor">Johor</option>
            <option value="Kedah">Kedah</option>
            <option value="Kelantan">Kelantan</option>
            <option value="Melaka">Melaka</option>
            <option value="Negeri Sembilan">Negeri Sembilan</option>
            <option value="Pahang">Pahang</option>
            <option value="Penang">Penang</option>
            <option value="Perak">Perak</option>
            <option value="Perlis">Perlis</option>
            <option value="Sabah">Sabah</option>
            <option value="Sarawak">Sarawak</option>
            <option value="Selangor">Selangor</option>
            <option value="Terengganu">Terengganu</option>
            <option value="Kuala Lumpur">Kuala Lumpur</option>
            <option value="Labuan">Labuan</option>
            <option value="Putrajaya">Putrajaya</option>
        </select>
        <?= form_error('NEGERI_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="DOKUMEN_PROGRAM">Dokumen Program</label>
        <input type="file" id="DOKUMEN_PROGRAM" name="DOKUMEN_PROGRAM" class="form-control-file">
        <?= form_error('DOKUMEN_PROGRAM', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>

<script>
    function toggleFields() {
        var oneDayRadio = document.getElementById('one_day');
        var tarikhTamatContainer = document.getElementById('TARIKH_TAMAT_container');
        var masaProgramContainer = document.getElementById('MASA_PROGRAM_container');
        if (oneDayRadio.checked) {
            tarikhTamatContainer.style.display = 'none';
            masaProgramContainer.style.display = 'block';
            document.getElementById('TARIKH_TAMAT').value = ''; // Clear the value when hidden
        } else {
            tarikhTamatContainer.style.display = 'block';
            masaProgramContainer.style.display = 'none';
        }
    }

    function setMinTarikhTamat() {
        var tarikhMula = document.getElementById('TARIKH_MULA').value;
        var tarikhTamat = document.getElementById('TARIKH_TAMAT');
        tarikhTamat.min = tarikhMula;
    }

    // Ensure the correct state is displayed on page load
    document.addEventListener('DOMContentLoaded', (event) => {
        toggleFields();
        setMinTarikhTamat();
    });
</script>