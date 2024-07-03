<?= $this->session->flashdata('message'); ?>

<div class="container">
    <h2 class="mt-4 mb-4">Program Approval</h2>

    <?php if (is_array($program)) : ?>
        <?php foreach ($program as $prog) : ?>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th class="bg-info" scope="row">Nama Kelab</th>
                        <td><?= htmlspecialchars($prog->NAMA_KELAB) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-info" scope="row">Nama Program</th>
                        <td><?= htmlspecialchars($prog->NAMA_PROGRAM) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-info" scope="row">Nama Pengarah</th>
                        <td><?= htmlspecialchars($prog->NAMA_PENGARAH) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-info" scope="row">No Matriks Pengarah Program</th>
                        <td><?= htmlspecialchars($prog->PENGARAH_MATRIC) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-info" scope="row">Nama Anjuran</th>
                        <td><?= htmlspecialchars($prog->NAMA_ANJURAN) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-info" scope="row">Kategori Program</th>
                        <td><?= htmlspecialchars($prog->KATEGORI_PROGRAM) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-info" scope="row">Tarikh Mula</th>
                        <td><?= htmlspecialchars($prog->TARIKH_MULA) ?></td>
                    </tr>
                    <?php if (!empty($prog->TARIKH_TAMAT)) : ?>
                        <tr>
                            <th class="bg-info" scope="row">Tarikh Tamat</th>
                            <td><?= htmlspecialchars($prog->TARIKH_TAMAT) ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th class="bg-info" scope="row">Objektif Program</th>
                        <td><?= htmlspecialchars($prog->OBJEKTIF_PROGRAM) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-info" scope="row">Tempat Program</th>
                        <td><?= htmlspecialchars($prog->TEMPAT_PROGRAM) ?></td>
                    </tr>
                    <?php if (empty($prog->TARIKH_TAMAT)) : ?>
                        <tr>
                            <th class="bg-info" scope="row">Masa Program</th>
                            <td><?= htmlspecialchars($prog->MASA_PROGRAM) ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th class="bg-info" scope="row">Negeri Program</th>
                        <td><?= htmlspecialchars($prog->NEGERI_PROGRAM) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-info" scope="row">Dokumen Program</th>
                        <td>
                            <a href="<?= base_url('uploads/' . $prog->DOKUMEN_PROGRAM) ?>" target="_blank">
                                <?= htmlspecialchars($prog->DOKUMEN_PROGRAM) ?>
                            </a>
                        </td>
                    </tr>
                    <!-- Nota Penasihat Kelab Row -->
                    <?php if ($this->session->userdata('role') !== 'mpp' && $this->session->userdata('role') !== 'hepa') : ?>
                        <tr>
                            <th class="bg-info" scope="row">Nota Penasihat Kelab</th>
                            <td>
                                <?php if ($this->session->userdata('role') === 'penasihat' && $prog->APPROVAL_STATUS !== 'Pending MPP Approval' && $prog->APPROVAL_STATUS !== 'Approved') : ?>
                                    <?php if (empty($prog->NOTA_PENASIHATKELAB) || $prog->NOTA_PENASIHATKELAB === 'TIADA') : ?>
                                        <button data-toggle="modal" data-target="#tambahNotaPenasihatModal<?= $prog->PROGRAM_ID ?>" class="btn btn-primary btn-sm">Tambah Nota</button>
                                    <?php else : ?>
                                        <?= htmlspecialchars($prog->NOTA_PENASIHATKELAB) ?>
                                        <button data-toggle="modal" data-target="#editNotaPenasihatModal<?= $prog->PROGRAM_ID ?>" class="btn btn-warning btn-sm">Edit Nota</button>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?= htmlspecialchars($prog->NOTA_PENASIHATKELAB) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <!-- Nota MPP Row -->
                    <?php if ($this->session->userdata('role') !== 'penasihat' && $this->session->userdata('role') !== 'hepa') : ?>
                        <tr>
                            <th class="bg-info" scope="row">Nota MPP</th>
                            <td>
                                <?php if ($this->session->userdata('role') === 'mpp' && $prog->APPROVAL_STATUS !== 'Pending HEPA Approval' && $prog->APPROVAL_STATUS !== 'Approved') : ?>
                                    <?php if (empty($prog->NOTA_MPP) || $prog->NOTA_MPP === 'TIADA') : ?>
                                        <button data-toggle="modal" data-target="#tambahNotaMPPModal<?= $prog->PROGRAM_ID ?>" class="btn btn-primary btn-sm">Tambah Nota</button>
                                    <?php else : ?>
                                        <?= htmlspecialchars($prog->NOTA_MPP) ?>
                                        <button data-toggle="modal" data-target="#editNotaMPPModal<?= $prog->PROGRAM_ID ?>" class="btn btn-warning btn-sm">Edit Nota</button>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?= htmlspecialchars($prog->NOTA_MPP) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <!-- Nota HEPA Row -->
                    <?php if ($this->session->userdata('role') !== 'penasihat' && $this->session->userdata('role') !== 'mpp') : ?>
                        <tr>
                            <th class="bg-info" scope="row">Nota HEPA</th>
                            <td>
                                <?php if ($this->session->userdata('role') === 'hepa' && $prog->APPROVAL_STATUS !== 'Approved') : ?>
                                    <?php if (empty($prog->NOTA_HEPA) || $prog->NOTA_HEPA === 'TIADA') : ?>
                                        <button data-toggle="modal" data-target="#tambahNotaHEPAModal<?= $prog->PROGRAM_ID ?>" class="btn btn-primary btn-sm">Tambah Nota</button>
                                    <?php else : ?>
                                        <?= htmlspecialchars($prog->NOTA_HEPA) ?>
                                        <button data-toggle="modal" data-target="#editNotaHEPAModal<?= $prog->PROGRAM_ID ?>" class="btn btn-warning btn-sm">Edit Nota</button>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?= htmlspecialchars($prog->NOTA_HEPA) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>



                </tbody>
            </table>
            <div class="text-center">
                <?php if ($this->session->userdata('role') === 'penasihat' && (($prog->APPROVAL_STATUS == 'Pending') || ($prog->APPROVAL_STATUS == 'Rejected by Penasihat'))) : ?>
                    <a href="<?= base_url('penasihat/lulusProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-success btn-sm">Approve Program</a>
                    <button data-toggle="modal" data-target="#reject<?= $prog->PROGRAM_ID ?>" class="btn btn-danger btn-sm">Reject Program</button>
                <?php elseif ($this->session->userdata('role') === 'mpp' && (($prog->APPROVAL_STATUS == 'Pending MPP Approval') || ($prog->APPROVAL_STATUS == 'Rejected by MPP'))) : ?>
                    <a href="<?= base_url('mpp/lulusProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-success btn-sm">Approve Program</a>
                    <button data-toggle="modal" data-target="#reject<?= $prog->PROGRAM_ID ?>" class="btn btn-danger btn-sm">Reject Program</button>
                <?php elseif ($this->session->userdata('role') === 'hepa' && (($prog->APPROVAL_STATUS == 'Pending HEPA Approval') || ($prog->APPROVAL_STATUS == 'Rejected by HEPA') || ($prog->APPROVAL_STATUS == 'Edit Request Sent'))) : ?>
                    <a href="<?= base_url('hepa/lulusProgram/' . $prog->PROGRAM_ID) ?>" class="btn btn-success btn-sm">Approve Program</a>
                    <button data-toggle="modal" data-target="#reject<?= $prog->PROGRAM_ID ?>" class="btn btn-danger btn-sm">Reject Program</button>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


    <div class="card-header">
        <h3 class="card-title">
            <?php if ($this->session->userdata('role') === 'penasihat') : ?>
                <a href="<?= base_url('penasihat') ?>" class="btn btn-danger btn-sm ml-auto">
                    <i class="fas fa-back"></i> Go Back
                </a>
            <?php elseif ($this->session->userdata('role') === 'mpp') : ?>
                <a href="<?= base_url('mpp') ?>" class="btn btn-danger btn-sm ml-auto">
                    <i class="fas fa-back"></i> Go Back
                </a>
            <?php elseif ($this->session->userdata('role') === 'hepa') : ?>
                <a href="<?= base_url('hepa') ?>" class="btn btn-danger btn-sm ml-auto">
                    <i class="fas fa-back"></i> Go Back
                </a>
                <?php if ($prog->APPROVAL_STATUS == 'Approved') : ?>
                    <a href="<?= base_url('hepa/programDetails/' . $prog->PROGRAM_ID) ?>" class="btn btn-primary btn-sm ml-auto">
                        <i class="fas fa-back"></i> View Program Details
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </h3>
    </div>



    <!-- Modal For Reject Program -->
    <?php foreach ($program as $prog) : ?>
        <div class="modal fade" id="reject<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reject Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if ($this->session->userdata('role') === 'penasihat') : ?>
                            <form action="<?= base_url('penasihat/rejectProgram/' . $prog->PROGRAM_ID) ?>" method="POST">
                                <div class="form-group">
                                    <label for="PROGRAM_NOTES">Sebab Program Ditolak</label>
                                    <textarea name="PROGRAM_NOTES" class="form-control"><?= htmlspecialchars($prog->PROGRAM_NOTES) ?></textarea>
                                    <?= form_error('PROGRAM_NOTES', '<div class="text-small text-danger">', '</div>'); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                                </div>
                            </form>
                        <?php elseif ($this->session->userdata('role') === 'mpp') : ?>
                            <form action="<?= base_url('mpp/rejectProgram/' . $prog->PROGRAM_ID) ?>" method="POST">
                                <div class="form-group">
                                    <label for="PROGRAM_NOTES">Sebab Program Ditolak</label>
                                    <textarea name="PROGRAM_NOTES" class="form-control"><?= htmlspecialchars($prog->PROGRAM_NOTES) ?></textarea>
                                    <?= form_error('PROGRAM_NOTES', '<div class="text-small text-danger">', '</div>'); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                                </div>
                            </form>
                        <?php elseif ($this->session->userdata('role') === 'hepa') : ?>
                            <form action="<?= base_url('hepa/rejectProgram/' . $prog->PROGRAM_ID) ?>" method="POST">
                                <div class="form-group">
                                    <label for="PROGRAM_NOTES">Sebab Program Ditolak</label>
                                    <textarea name="PROGRAM_NOTES" class="form-control"><?= htmlspecialchars($prog->PROGRAM_NOTES) ?></textarea>
                                    <?= form_error('PROGRAM_NOTES', '<div class="text-small text-danger">', '</div>'); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- End Modal Reject Program-->

    <!-- Start Modal Add Notes for Penasihat-->
    <?php foreach ($program as $prog) : ?>
        <div class="modal fade" id="tambahNotaPenasihatModal<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="tambahNotaPenasihatModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahNotaPenasihatModalLabel">Tambah Nota Penasihat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('penasihat/tambahNota/' . $prog->PROGRAM_ID) ?>" method="POST">
                            <div class="form-group">
                                <label for="PROGRAM_NOTES">Nota Program</label>
                                <textarea name="PROGRAM_NOTES" class="form-control"><?= htmlspecialchars($prog->NOTA_PENASIHATKELAB) ?></textarea>
                                <?= form_error('PROGRAM_NOTES', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- End Modal Add Notes for Penasihat-->


    <!-- Start Modal Edit Notes for Penasihat-->
    <?php foreach ($program as $prog) : ?>
        <div class="modal fade" id="editNotaPenasihatModal<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="editNotaPenasihatModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNotaPenasihatModalLabel">Edit Nota Penasihat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('penasihat/editNota/' . $prog->PROGRAM_ID) ?>" method="POST">
                            <div class="form-group">
                                <label for="PROGRAM_NOTES">Nota Program</label>
                                <textarea name="PROGRAM_NOTES" class="form-control"><?= htmlspecialchars($prog->NOTA_PENASIHATKELAB) ?></textarea>
                                <?= form_error('PROGRAM_NOTES', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- End Modal Edit Notes for Penasihat-->

    <!-- Start Modal Add Notes for MPP-->
    <?php foreach ($program as $prog) : ?>
        <div class="modal fade" id="tambahNotaMPPModal<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="tambahNotaMPPModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahNotaMPPModalLabel">Tambah Nota MPP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('mpp/tambahNota/' . $prog->PROGRAM_ID) ?>" method="POST">
                            <div class="form-group">
                                <label for="PROGRAM_NOTES">Nota Program</label>
                                <textarea name="PROGRAM_NOTES" class="form-control"><?= htmlspecialchars($prog->NOTA_MPP) ?></textarea>
                                <?= form_error('PROGRAM_NOTES', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- End Modal Add Notes for MPP-->

    <!-- Start Modal Edit Notes for MPP-->
    <?php foreach ($program as $prog) : ?>
        <div class="modal fade" id="editNotaMPPModal<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="editNotaMPPModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNotaMPPModalLabel">Edit Nota MPP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('mpp/editNota/' . $prog->PROGRAM_ID) ?>" method="POST">
                            <div class="form-group">
                                <label for="PROGRAM_NOTES">Nota Program</label>
                                <textarea name="PROGRAM_NOTES" class="form-control"><?= htmlspecialchars($prog->NOTA_MPP) ?></textarea>
                                <?= form_error('PROGRAM_NOTES', '<div class="text-small text-danger">', '</div>'); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- End Modal Edit Notes for MPP-->

    <!-- Modal for Adding HEPA Note -->
    <div class="modal fade" id="tambahNotaHEPAModal<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="tambahNotaHEPAModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('hepa/tambahNota/' . $prog->PROGRAM_ID) ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahNotaHEPAModalLabel">Tambah Nota HEPA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nota_hepa">Nota</label>
                            <textarea class="form-control" id="nota_hepa" name="nota_hepa" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Editing HEPA Note -->
    <div class="modal fade" id="editNotaHEPAModal<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="editNotaHEPAModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('hepa/editNota/' . $prog->PROGRAM_ID) ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNotaHEPAModalLabel">Edit Nota HEPA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nota_hepa">Nota</label>
                            <textarea class="form-control" id="nota_hepa" name="nota_hepa" rows="3"><?= htmlspecialchars($prog->NOTA_HEPA) ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Modal For Assign Director -->
    <?php foreach ($program as $prog) : ?>
        <div class="modal fade" id="assign<?= $prog->PROGRAM_ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Assign Pengarah Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- hepa session -->
                        <?php if ($this->session->userdata('role') === 'hepa') : ?>
                            <form action="<?= base_url('hepa/assignPengarah/' . $prog->PROGRAM_ID) ?>" method="POST">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Nombor Matriks</label>
                                        <input type="text" name="PENGARAH_MATRIC" class="form-control" value="<?= $prog->PENGARAH_MATRIC ?>">
                                        <?= form_error('PENGARAH_MATRIC', '<div class="text-small text-danger">', '</div>'); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <!-- End Modal Assign Pengarah Program-->

    <script>
        function approveProgram(programId) {

            // Navigate to the specified URL
            // Set the modal's data-target dynamically based on the program ID
            $('#assign' + programId).modal('show');
        }
    </script>