<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">MyNemo</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Please select the role</p>

                <div class="card-body">
                    <form action="<?= base_url('roleauth/setRole') ?>" method="post" onsubmit="updateSessionValue()">
                        <div class="form-group">
                            <label for="role">Role Authentication</label>
                            <select id="role" name="role" class="form-control select2" style="width: 100%;" onchange="togglePengarahInput()">
                                <option value="presiden" <?= $this->session->userdata('role') === 'presiden' ? 'selected' : '' ?>>Presiden Kelab</option>
                                <option value="pengarah" <?= $this->session->userdata('role') === 'pengarah' ? 'selected' : '' ?>>Pengarah Program</option>
                                <option value="penasihat" <?= $this->session->userdata('role') === 'penasihat' ? 'selected' : '' ?>>Penasihat Kelab</option>
                                <option value="mpp" <?= $this->session->userdata('role') === 'mpp' ? 'selected' : '' ?>>MPP</option>
                                <option value="hepa" <?= $this->session->userdata('role') === 'hepa' ? 'selected' : '' ?>>HEPA</option>
                            </select>
                        </div>

                        <div id="pengarahInput" class="form-group" style="display: none;">
                            <label for="pengarah_matric">Pengarah Text Input</label>
                            <input type="text" id="pengarah_matric" name="pengarah_matric" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Set Role</button>
                    </form>

                    <p>Current Role: <?= $this->session->userdata('role') ?></p>

                    <script>
                        function togglePengarahInput() {
                            var roleSelect = document.getElementById('role');
                            var pengarahInput = document.getElementById('pengarahInput');
                            var pengarah_matric = document.getElementById('pengarah_matric');

                            if (roleSelect.value === 'pengarah') {
                                pengarahInput.style.display = 'block';
                                pengarah_matric.setAttribute('required', 'required'); // Make the input required if needed
                            } else {
                                pengarahInput.style.display = 'none';
                                pengarah_matric.removeAttribute('required'); // Remove the required attribute
                            }
                        }

                        function updateSessionValue() {
                            var roleSelect = document.getElementById('role');
                            var pengarah_matric = document.getElementById('pengarah_matric');

                            // Check if 'pengarah' is selected and update the session value
                            if (roleSelect.value === 'pengarah') {
                                // You may want to validate the value before updating the session
                                var newValue = pengarah_matric.value;
                                if (newValue.trim() !== '') {
                                    // Use AJAX to update the session value
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST', '<?= base_url('roleauth/updatepengarah_matric') ?>', true);
                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                    xhr.send('pengarah_matric=' + encodeURIComponent(newValue));

                                    // You can handle success or error responses if needed
                                }
                            }
                        }
                    </script>
                </div>

            </div>
        </div>
    </div>
    <!-- /.login-box -->