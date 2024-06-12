<?= $this->session->flashdata('message') ?>

<div class="card">
    <!-- /.card-header -->
    <div class="title">
        <h5><?= $pageName ?></h5>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>Bil</th>
                    <th>Nama Program</th>
                    <th>Tarikh Mula</th>
                    <th>Tarikh Tamat</th>
                    <th>Status Program</th>
                    <th>Lihat Program</th>
                    <th>Cancel Program</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($program as $prog) : ?>
                <tbody>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $prog->NAMA_PROGRAM ?></td>
                        <td><?= $prog->TARIKH_MULA ?></td>
                        <td><?= $prog->TARIKH_TAMAT ?></td>
                        <td><?= $prog->APPROVAL_STATUS ?></td>
                        <td><a href="<?= base_url('pengarah/lihatProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>Lihat Program</a></td>
                        <td><a href="<?= base_url('pengarah/cancelProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to cancel the program?')"><i class="fas fa-exclamation-circle"></i> Cancel</a></td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
</div>