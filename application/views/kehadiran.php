<?= $this->session->flashdata('message'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <a href="https://me-qr.com/?bannerid=9387104426&utm_source=google&utm_medium=cpc&utm_campaign=12683487332&utm_adgroupid=161497118118&utm_content=696066668106&audience=161497118118&keyword=qr%20generator&utm_target=&device=c&gad_source=1&gclid=CjwKCAjwrcKxBhBMEiwAIVF8rFR0aDew05FItBP3KlAKwJ-1Ho9SgKzgAJBioU9iwx9UO7RzQhPahxoCaeUQAvD_BwE" class="btn btn-primary">Generate QR</a>
        </div>
        <div class="col-md-6">
            <!-- Button to trigger modal -->
            <button data-toggle="modal" data-target="#manualEntryModal" class="btn btn-warning btn-sm"><i></i>Enter Manually</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="manualEntryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Matric Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process.php" method="POST">
                    <div class="form-group">
                        <label for="matricNumber">Matric Number</label>
                        <input type="text" name="matricNumber" class="form-control" id="matricNumber" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>