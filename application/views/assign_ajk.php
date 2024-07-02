<?= $this->session->flashdata('message'); ?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">AJK Form for Program: <?= $program_name ?></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" action="<?= base_url('pengarah/assignAjkProgram/' . $PROGRAM_ID) ?>" method="POST">
        <div class="card-body">
            <div class="form-group row">
                <label for="noMatric" class="col-sm-2 col-form-label">No Matric</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="noMatric" name="NO_MATRIC" placeholder="SXXXXXX" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="namaAjk" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaAjk" name="NAMA_AJK" placeholder="John Doe" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="emailAjk" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="emailAjk" name="EMAIL_AJK" placeholder="john.doe@example.com" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="positionAjk" class="col-sm-2 col-form-label">Position</label>
                <div class="col-sm-10">
                    <select class="form-control" id="positionAjk" name="POSITION_AJK" required>
                        <option value="naib pengarah">Naib Pengarah</option>
                        <option value="setiausaha">Setiausaha</option>
                        <option value="naib setiausaha">Naib Setiausaha</option>
                        <option value="bendahari">Bendahari</option>
                        <option value="naib bendahari">Naib Bendahari</option>
                        <option value="ajk protokol">AJK Protokol</option>
                        <option value="ajk keselamatan">AJK Keselamatan</option>
                        <option value="ajk kesihatan">AJK Kesihatan</option>
                        <option value="ajk aktiviti">AJK Aktiviti</option>
                        <option value="ajk logistik">AJK Logistik</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="PROGRAM_ID" value="<?= $PROGRAM_ID ?>">
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Save</button>
            <a href="<?= base_url('pengarah/lihatProgram/' . $PROGRAM_ID) ?>" class="btn btn-danger btn-sm">
                <i class="fas fa-back"></i> Go Back
            </a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->

<!-- Add table for displaying AJKs -->
<div class="card card-info mt-3">
    <div class="card-header">
        <h3 class="card-title">List of AJKs for Program: <?= $program_name ?></h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No Matric</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ajk_list)) : ?>
                    <?php foreach ($ajk_list as $ajk) : ?>
                        <tr>
                            <td><?= $ajk->NO_MATRIC ?></td>
                            <td><?= $ajk->NAMA_AJK ?></td>
                            <td><?= $ajk->EMAIL_AJK ?></td>
                            <td><?= $ajk->POSITION_AJK ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">No AJKs found for this program.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>