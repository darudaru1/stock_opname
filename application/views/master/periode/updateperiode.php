<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Periode</h1>

    <form action="<?= site_url('periode/update/' . $periode['prd_id']); ?>" method="post">
        <div class="form-group">
            <label for="prd_tahun">Tahun</label>
            <input type="text" class="form-control" id="prd_tahun" name="prd_tahun" value="<?= $periode['prd_tahun']; ?>" required>
            <?= form_error('prd_tahun'); ?>
        </div>
        <div class="form-group">
            <label for="prd_tgl_awal">Tanggal Awal</label>
            <input type="date" class="form-control" id="prd_tgl_awal" name="prd_tgl_awal" value="<?= $periode['prd_tgl_awal']; ?>" required>
            <?= form_error('prd_tgl_awal'); ?>
        </div>
        <div class="form-group">
            <label for="prd_tgl_akhir">Tanggal Akhir</label>
            <input type="date" class="form-control" id="prd_tgl_akhir" name="prd_tgl_akhir" value="<?= $periode['prd_tgl_akhir']; ?>" required>
            <?= form_error('prd_tgl_akhir'); ?>
        </div>
        <button type="button" class="btn btn-primary" id="updateBtn">Ubah</button>
        <a href="<?= site_url('periode'); ?>" class="btn btn-secondary">Batal</a>
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
