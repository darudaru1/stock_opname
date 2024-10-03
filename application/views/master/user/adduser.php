<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Data User</h1>

    <form action="<?= site_url('user/store'); ?>" method="post" id="userForm">
        <div class="form-group">
            <label for="usr_no">Nomor User</label>
            <input type="text" class="form-control" id="usr_no" name="usr_no" required>
            <?= form_error('usr_no'); ?>
        </div>
        <div class="form-group">
            <label for="usr_nama">Nama User</label>
            <input type="text" class="form-control" id="usr_nama" name="usr_nama" required>
            <?= form_error('usr_nama'); ?>
        </div>
        <div class="form-group">
            <label for="role">Role User</label>
            <select class="form-control" id="role" name="role" required>
                <option value="">Pilih Role</option>
                <option value="PIC ASSET">PIC ASSET</option>
                <option value="PIC LABORATORIUM">PIC LABORATORIUM</option>
                <option value="PIC ADMIN">PIC ADMIN</option>
            </select>
            <?= form_error('role'); ?>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
            <?= form_error('username'); ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <?= form_error('password'); ?>
        </div>

        <button type="button" class="btn btn-primary" id="submitBtn">Simpan</button>
        <a href="<?= site_url('user'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('submitBtn').addEventListener('click', function(e) {
        // Validasi form sebelum submit
        const form = document.getElementById('userForm');
        let isValid = form.checkValidity();
        if (isValid) {
            // Jika form valid, tampilkan SweetAlert sukses
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data Berhasil Disimpan',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim form setelah SweetAlert ditutup
                    document.querySelector('form').submit();
                }
            });
        } else {
            // Jika form tidak valid, tampilkan SweetAlert gagal
            Swal.fire({
                title: 'Error!',
                text: 'Gagal Mengirim Data. Periksa input Anda!',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        }
    });
</script>