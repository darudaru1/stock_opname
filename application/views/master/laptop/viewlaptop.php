<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Master Data Laptop</h1>
        <a href="<?= site_url('master/laptop/addlaptop'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Laptop</a>
    </div>

    <div class="row">
        <!-- Data Table -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar laptop</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Laboratorium</th>
                                    <th>Nomor Laptop</th>
                                    <th>Serial Number Laptop</th>
                                    <th>Tipe Laptop</th>
                                    <th>Status Tas</th>
                                    <th>Status Charger</th>
                                    <th>Status Laptop</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($laptop)) : ?>
                                    <?php foreach ($laptop as $ltp) : ?>
                                        <tr>
                                            <td><?= $ltp['lab_nomor']; ?></td>
                                            <td><?= $ltp['ltp_nomor']; ?></td>
                                            <td><?= $ltp['ltp_serialnumber']; ?></td>
                                            <td><?= $ltp['ltp_tipe']; ?></td>
                                            <!-- Tampilkan Status Tas -->
                                            <td><?= $ltp['status_tas'] == 0 ? 'ADA' : 'TIDAK ADA'; ?></td>
                                            <!-- Tampilkan Status Charger -->
                                            <td><?= $ltp['status_charger'] == 0 ? 'ADA' : 'TIDAK ADA'; ?></td>
                                            <!-- Tampilkan Status Laptop -->
                                            <td><?= $ltp['ltp_status'] == 0 ? 'ADA' : 'TIDAK ADA'; ?></td>
                                            <td>
                                                <a href="<?= site_url('laptop/edit/' . $ltp['ltp_id']); ?>" class="btn btn-warning btn-sm">Ubah</a>
                                                <a href="javascript:void(0);" onclick="confirmDelete(<?= $ltp['ltp_id']; ?>)" class="btn btn-danger btn-sm">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function confirmDelete(ltp_id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data tidak akan bisa dikembalikan setelah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan penghapusan data menggunakan AJAX
                $.ajax({
                    url: '<?= site_url("laptop/delete/"); ?>' + ltp_id,
                    type: 'POST',
                    success: function(response) {
                        // Tampilkan SweetAlert sukses setelah data berhasil dihapus
                        Swal.fire({
                            title: 'Dihapus!',
                            text: 'Data berhasil dihapus.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Reload halaman setelah menutup alert
                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan SweetAlert error jika terjadi kesalahan
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menghapus data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        })
    }
</script>