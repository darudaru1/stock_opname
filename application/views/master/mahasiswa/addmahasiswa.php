<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Lab</h1>

    <form action="<?= site_url('mahasiswa/store'); ?>" method="post">
        <div class="form-group">
            <label for="lab_id">Laboratorium</label>
            <select class="form-control" id="lab_id" name="lab_id" required>
                <option value="">Pilih Lab</option>
                <?php if (!empty($laboratorium)) : ?>
                    <?php foreach ($laboratorium as $lab) : ?>
                        <option value="<?= $lab['lab_id']; ?>"><?= $lab['lab_nomor']; ?></option> <!-- Display user name -->
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <?= form_error('lab_id'); ?>
        </div>
        <div class="form-group">
            <label for="mhs_nim">NIM Mahasiswa</label>
            <input type="text" class="form-control" id="mhs_nim" name="mhs_nim" required>
            <?= form_error('mhs_nim'); ?>
        </div>
        <div class="form-group">
            <label for="mhs_nama">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="mhs_nama" name="mhs_nama" required>
            <?= form_error('mhs_nama'); ?>
        </div>
        <button type="button" class="btn btn-primary" id="submitBtn">Simpan</button>
        <a href="<?= site_url('mahasiswa'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('submitBtn').addEventListener('click', function(e) {
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
    });
</script>