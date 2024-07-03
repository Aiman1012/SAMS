<?= $this->session->flashdata('message'); ?>

<div class="card">
    <div class="title">
        <h5><?= $pageName ?></h5>
    </div>
    <form method="GET" action="<?= base_url('penasihat') ?>">
        <div class="row mb-3">
            <div class="col-md-3">
                <select name="status_filter" class="form-control">
                    <option value="" <?= !isset($_GET['status_filter']) ? 'selected' : '' ?>>All</option>
                    <option value="Approved" <?= (isset($_GET['status_filter']) && $_GET['status_filter'] == 'Approved') ? 'selected' : '' ?>>Approved</option>
                    <option value="Cancelled" <?= (isset($_GET['status_filter']) && $_GET['status_filter'] == 'Cancelled') ? 'selected' : '' ?>>Cancelled</option>
                    <option value="Pending" <?= (isset($_GET['status_filter']) && $_GET['status_filter'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                    <option value="Pending Hepa Approval" <?= (isset($_GET['status_filter']) && $_GET['status_filter'] == 'Pending Hepa Approval') ? 'selected' : '' ?>>Pending Hepa Approval</option>
                    <option value="Pending MPP Approval" <?= (isset($_GET['status_filter']) && $_GET['status_filter'] == 'Pending MPP Approval') ? 'selected' : '' ?>>Pending MPP Approval</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>Bil</th>
                <th>Nama Program</th>
                <th>Kategori Program</th>
                <th>Status Program</th>
                <th>Lihat Program</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($program as $prog) : ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $prog->NAMA_PROGRAM ?></td>
                    <td><?= $prog->KATEGORI_PROGRAM ?></td>
                    <td><?= $prog->APPROVAL_STATUS ?></td>
                    <td><a href="<?= base_url('penasihat/approveProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>Kelulusan Program</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>