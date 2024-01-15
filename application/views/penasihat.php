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
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($program as $prog) : ?>
                <tbody>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $prog->nama_program ?></td>
                        <td><?= $prog->kategori_program ?></td>
                        <td>Successful</td>
                        <td><a href="<?= base_url('hepa/approveProgram/' . $prog->program_id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>Kelulusan Program</a></td>

                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
</div>