<?= $this->session->flashdata('message'); ?>


<div class="card">
    <div class="card-header">
        <h3 class="card-title"><a href="<?= base_url('presiden/mohonProgram') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Mohon Program</a></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>Bil</th>
                    <th>Nama Program</th>
                    <th>Kategori Program</th>
                    <th>Status Program</th>
                    <th>Lihat Program</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($program as $prog) : ?>
                <tbody>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $prog->nama_program ?></td>
                        <td><?= $prog->kategori_program ?></td>
                        <td><?= $prog->approval_status ?></td>
                        <td><a href="<?= base_url('presiden/lihatProgram/' . $prog->program_id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat Program</a></td>
                        <td class="text-center"><button data-toggle="modal" data-target="#edit<?= $prog->program_id ?>" class=" btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <a href="<?= base_url('presiden/deleteProgram/' . $prog->program_id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
</div>




<!-- Modal -->
<?php foreach ($program as $prog) : ?>
    <div class="modal fade" id="edit<?= $prog->program_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Program</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('presiden/edit/' . $prog->program_id) ?>" method="POST">
                        <div class="form-group">
                            <label for="">Nama Kelab</label>
                            <input type="text" name="nama_kelab" class="form-control" value="<?= $prog->nama_kelab ?>">
                            <?= form_error('nama_kelab', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Program</label>
                            <input type="text" name="nama_program" class="form-control" value="<?= $prog->nama_program ?>">
                            <?= form_error('nama_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pengarah</label>
                            <input type="text" name="nama_pengarah" class="form-control" value="<?= $prog->nama_pengarah ?>">
                            <?= form_error('nama_pengarah', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Anjuran</label>
                            <input type="text" name="nama_anjuran" class="form-control" value="<?= $prog->nama_anjuran ?>">
                            <?= form_error('nama_anjuran', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Kategori Program</label>
                            <select name="kategori_program" class="form-control">
                                <option value="Akademik" <?= ($prog->kategori_program == 'Akademik') ? 'selected' : ''; ?>>Akademik</option>
                                <option value="Sukan" <?= ($prog->kategori_program == 'Sukan') ? 'selected' : ''; ?>>Sukan</option>
                                <!-- Add more options as needed -->
                            </select>
                            <?= form_error('kategori_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tarikh Mula</label>
                            <input type="date" name="tarikh_mula" class="form-control" value="<?= $prog->tarikh_mula ?>">
                            <?= form_error('tarikh_mula', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tarikh Tamat</label>
                            <input type="date" name="tarikh_tamat" class="form-control" value="<?= $prog->tarikh_tamat ?>">
                            <?= form_error('tarikh_tamat', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Objektif Program</label>
                            <textarea name="objektif_program" class="form-control"><?= $prog->objektif_program ?></textarea>
                            <?= form_error('objektif_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tempat Program</label>
                            <input type="text" name="tempat_program" class="form-control" value="<?= $prog->tempat_program ?>">
                            <?= form_error('tempat_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Masa Program</label>
                            <input type="time" name="masa_program" class="form-control" value="<?= $prog->masa_program ?>">
                            <?= form_error('masa_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Negeri Program</label>
                            <input type="text" name="negeri_program" class="form-control" value="<?= $prog->negeri_program ?>">
                            <?= form_error('negeri_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Dokumen Program</label>
                            <input type="file" name="dokumen_program" class="form-control-file">
                            <?= form_error('dokumen_program', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>