<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Laptop</h1>

    <form action="<?= site_url('laptop/update/' . $laptop['ltp_id']); ?>" method="post">
        <div class="form-group">
            <label for="lab_id">Laboratorium</label>
            <select class="form-control" id="lab_id" name="lab_id" required>
                <?php if (!empty($laboratorium)) : ?>
                    <?php foreach ($laboratorium as $lab) : ?>
                        <option value="<?php echo $lab['lab_id']; ?>" <?php echo ($lab['lab_id'] == $laptop['lab_id']) ? 'selected' : ''; ?>>
                            <?= $lab['lab_nomor']; ?>
                        </option> <!-- Display user name -->
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <?= form_error('lab_id'); ?>
        </div>
        <div class="form-group">
            <label for="ltp_nomor">Nomor Laptop</label>
            <input type="text" class="form-control" id="ltp_nomor" name="ltp_nomor" value="<?= $laptop['ltp_nomor']; ?>" required>
            <?= form_error('ltp_nomor'); ?>
        </div>
        <div class="form-group">
            <label for="ltp_serialnumber">Serial Number Laptop</label>
            <input type="text" class="form-control" id="ltp_serialnumber" name="ltp_serialnumber" value="<?= $laptop['ltp_serialnumber']; ?>" required>
            <?= form_error('ltp_serialnumber'); ?>
        </div>
        <div class="form-group">
            <label for="ltp_tipe">Tipe Laptop</label>
            <input type="text" class="form-control" id="ltp_tipe" name="ltp_tipe" value="<?= $laptop['ltp_tipe']; ?>" required>
            <?= form_error('ltp_tipe'); ?>
        </div>
        <div class="form-group">
            <label for="status_tas">Status Tas</label>
            <select class="form-control" id="status_tas" name="status_tas" value="<?= $laptop['status_tas']; ?>" required>
                <option value="0">ADA</option>
                <option value="1">TIDAK ADA</option>
            </select>
            <?= form_error('status_tas'); ?>
        </div>
        <div class="form-group">
            <label for="status_charger">Status Charger</label>
            <select class="form-control" id="status_charger" name="status_charger" value="<?= $laptop['status_charger']; ?>" required>
                <option value="0">ADA</option>
                <option value="1">TIDAK ADA</option>
            </select>
            <?= form_error('status_charger'); ?>
        </div>
        <div class="form-group">
            <label for="ltp_status">Status Laptop</label>
            <select class="form-control" id="ltp_status" name="ltp_status" value="<?= $laptop['ltp_status']; ?>" required>
                <option value="0">ADA</option>
                <option value="1">TIDAK ADA</option>
            </select>
            <?= form_error('ltp_status'); ?>
        </div>


        <button type="button" class="btn btn-primary" id="updateBtn">Ubah</button>
        <a href="<?= site_url('laptop'); ?>" class="btn btn-secondary">Batal</a>
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
