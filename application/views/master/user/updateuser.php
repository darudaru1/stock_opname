<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data User</h1>

    <form action="<?= site_url('user/update/' . $user['usr_id']); ?>" method="post">
        <div class="form-group">
            <label for="usr_no">Nomor User</label>
            <input type="text" class="form-control" id="usr_no" name="usr_no" value="<?= $user['usr_no']; ?>" required>
            <?= form_error('usr_no'); ?>
        </div>
        <div class="form-group">
            <label for="usr_nama">Nama User</label>
            <input type="text" class="form-control" id="usr_nama" name="usr_nama" value="<?= $user['usr_nama']; ?>" required>
            <?= form_error('usr_nama'); ?>
        </div>
        <div class="form-group">
            <label for="role">Role User</label>
            <select class="form-control" id="role" name="role" required>
                <option value="PIC ASSET" <?= ($user['role'] == 'PIC ASSET') ? 'selected' : ''; ?>>PIC ASSET</option>
                <option value="PIC LABORATIORUM" <?= ($user['role'] == 'PIC LABORATIORUM') ? 'selected' : ''; ?>>PIC LABORATIORUM</option>
                <option value="PIC ADMIN" <?= ($user['role'] == 'PIC ADMIN') ? 'selected' : ''; ?>>PIC ADMIN</option>
            </select>
            <?= form_error('role'); ?>
        </div>
        <button type="button" class="btn btn-primary" id="updateBtn">Ubah</button>
        <a href="<?= site_url('user'); ?>" class="btn btn-secondary">Batal</a>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('updateBtn').addEventListener('click', function(e) {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data Berhasil Diubah',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form setelah SweetAlert ditutup
                document.querySelector('form').submit();
            }
        });
    });
</script>