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
                    <th>Kategori Program</th>
                    <th>Status Program</th>
                    <th>Kelulusan Program</th>
                    <th>Approve Program</th> <!-- Added new column for the approve button -->
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($program as $prog) : ?>
                <tbody>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $prog->NAMA_PROGRAM ?></td>
                        <td><?= $prog->KATEGORI_PROGRAM ?></td>
                        <td><?= $prog->APPROVAL_STATUS ?></td>
                        <td><a href="<?= base_url('hepa/approveProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Kelulusan Program</a></td>
                        <td>
                            <?php if ($prog->APPROVAL_STATUS == 'Approved') : ?>
                                <a href="<?= base_url('hepa/approveProgramForm/' . $prog->PROGRAM_ID) ?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Approve Program</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
</div>