<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Authentication</title>
</head>

<body>
    <h2>Role Authentication</h2>

    <form action="<?= base_url('roleauth/setRole') ?>" method="post">
        <label>
            <input type="radio" name="role" value="presiden" <?= $this->session->userdata('presiden') === 'presiden' ? 'checked' : '' ?>>
            Presiden Kelab
        </label>

        <label>
            <input type="radio" name="role" value="penasihat" <?= $this->session->userdata('role') === 'penasihat' ? 'checked' : '' ?>>
            Penasihat Kelab
        </label>

        <label>
            <input type="radio" name="role" value="mpp" <?= $this->session->userdata('role') === 'mpp' ? 'checked' : '' ?>>
            MPP
        </label>

        <label>
            <input type="radio" name="role" value="hepa" <?= $this->session->userdata('role') === 'hepa' ? 'checked' : '' ?>>
            HEPA
        </label>

        <button type="submit">Set Role</button>
    </form>

    <p>Current Role: <?= $this->session->userdata('role') ?></p>

    <?php if ($this->session->userdata('role')) : ?>
        <a href="<?= base_url($this->session->userdata('role')) ?>">Go to Main Page</a>
    <?php endif; ?>
</body>

</html>