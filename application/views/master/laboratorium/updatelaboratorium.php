<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Laboraotrium</h1>

    <form action="<?= site_url('laboratorium/update/' . $laboratorium['lab_id']); ?>" method="post">
        <div class="form-group">
            <label for="usr_id">User</label>
            <select class="form-control" id="usr_id" name="usr_id" required>
                <option value="">Pilih User</option>
                <?php if (!empty($user)) : ?>
                    <?php foreach ($user as $usr) : ?>
                        <option value="<?php echo $usr['usr_id']; ?>" <?php echo ($usr['usr_id'] == $laboratorium['usr_id']) ? 'selected' : ''; ?>>
                            <?= $usr['usr_nama']; ?>
                        </option> <!-- Display user name -->
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <?= form_error('usr_id'); ?>
        </div>
        <div class="form-group">
            <label for="lab_nomor">Lab No</label>
            <input type="text" class="form-control" id="lab_nomor" name="lab_nomor" value="<?= $laboratorium['lab_nomor']; ?>" required>
            <?= form_error('lab_nomor'); ?>
        </div>
        <div class="form-group">
            <label for="lab_nama">Lab Nama</label>
            <input type="text" class="form-control" id="lab_nama" name="lab_nama" value="<?= $laboratorium['lab_nama']; ?>" required>
            <?= form_error('lab_nama'); ?>
        </div>
        <button type="button" class="btn btn-primary" id="updateBtn">Ubah</button>
        <a href="<?= site_url('laboratorium'); ?>" class="btn btn-secondary">Batal</a>
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