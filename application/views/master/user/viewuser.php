<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Master Data User</h1>
        <a href="<?= site_url('master/user/adduser'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah User</a>
    </div>

    <!-- Filter untuk menampilkan pengguna yang tidak aktif -->
    <div class="mb-4">
        <a href="<?= site_url('user/index'); ?>" class="btn btn-success">Lihat Pengguna Aktif</a>
        <a href="<?= site_url('user/inactive_users'); ?>" class="btn btn-danger">Lihat Pengguna Tidak Aktif</a>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar User <?= isset($inactive) && $inactive ? 'Tidak Aktif' : 'Aktif'; ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor User</th>
                                    <th>Nama User</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <?php if (!$inactive) : ?>
                                        <th>Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($user)) : ?>
                                    <?php foreach ($user as $usr) : ?>
                                        <tr>
                                            <td><?= $usr['usr_no']; ?></td>
                                            <td><?= $usr['usr_nama']; ?></td>
                                            <td><?= $usr['role']; ?></td>
                                            <td>
                                                <?php if ($usr['status'] == 'Aktif') : ?>
                                                    <span class="badge badge-success">Aktif</span> <!-- Warna hijau untuk Aktif -->
                                                <?php else : ?>
                                                    <span class="badge badge-danger">Tidak Aktif</span> <!-- Warna merah untuk Tidak Aktif -->
                                                <?php endif; ?>
                                            </td>
                                            <?php if (!$inactive) : ?>
                                                <td>
                                                    <a href="<?= site_url('user/edit/' . $usr['usr_id']); ?>" class="btn btn-warning btn-sm">Ubah</a>
                                                    <a href="javascript:void(0);" onclick="confirmDelete(<?= $usr['usr_id']; ?>)" class="btn btn-danger btn-sm">Hapus</a>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="<?= $inactive ? '4' : '5'; ?>" class="text-center">Tidak ada data</td>
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
    function confirmDelete(usr_id) {
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
                    url: '<?= site_url("user/delete/"); ?>' + usr_id,
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