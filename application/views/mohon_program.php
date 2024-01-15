<form action="<?= base_url('presiden/mohon_program_action') ?>" method="POST">
    <div class="form-group">
        <label for="">Nama Kelab</label>
        <input type="text" name="nama_kelab" class="form-control">
        <?= form_error('nama_kelab', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Nama Program</label>
        <input type="text" name="nama_program" class="form-control">
        <?= form_error('nama_program', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Nama Pengarah</label>
        <input type="text" name="nama_pengarah" class="form-control">
        <?= form_error('nama_pengarah', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Nama Anjuran</label>
        <input type="text" name="nama_anjuran" class="form-control">
        <?= form_error('nama_anjuran', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Kategori Program</label>
        <select name="kategori_program" class="form-control">
            <option value="akademik">Akademik</option>
            <option value="sukan">Sukan</option>
            <!-- Add more options as needed -->
        </select>
        <?= form_error('kategori_program', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Tarikh Mula</label>
        <input type="date" name="tarikh_mula" class="form-control">
        <?= form_error('tarikh_mula', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Tarikh Tamat</label>
        <input type="date" name="tarikh_tamat" class="form-control">
        <?= form_error('tarikh_tamat', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Objektif Program</label>
        <textarea name="objektif_program" class="form-control"></textarea>
        <?= form_error('objektif_program', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Tempat Program</label>
        <input type="text" name="tempat_program" class="form-control">
        <?= form_error('tempat_program', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Masa Program</label>
        <input type="time" name="masa_program" class="form-control">
        <?= form_error('masa_program', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Negeri Program</label>
        <input type="text" name="negeri_program" class="form-control">
        <?= form_error('negeri_program', '<div class="text-small text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="">Dokumen Program</label>
        <input type="file" name="dokumen_program" class="form-control-file">
        <?= form_error('dokumen_program', '<div class="text-small text-danger">', '</div>'); ?>
    </div>

    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>