<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Peminjaman Laptop - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar (content sidebar Anda) -->
        <!-- ... -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <!-- ... -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Master Data laboratorium</h1>
                        <a href="<?= site_url('master/laboratorium/addlaboratorium'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Laboratorium</a>
                    </div>

                    <div class="row">
                        <!-- Data Table -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar laboratorium</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Nomor Laboratorium</th>
                                                    <th>Nama Laboratorium</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($laboratorium)) : ?>
                                                    <?php foreach ($laboratorium as $lab) : ?>
                                                        <tr>
                                                            <td><?= $lab['usr_nama']; ?></td>
                                                            <td><?= $lab['lab_nomor']; ?></td>
                                                            <td><?= $lab['lab_nama']; ?></td>
                                                            <td>
                                                            <a href="<?= site_url('laboratorium/edit/' . $lab['lab_id']); ?>" class="btn btn-warning btn-sm">Ubah</a>
                                                            <a href="javascript:void(0);" onclick="confirmDelete(<?= $lab['lab_id']; ?>)" class="btn btn-danger btn-sm">Hapus</a>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- ... -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<script type="text/javascript">
    function confirmDelete(lab_id) {
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
                    url: '<?= site_url("laboratorium/delete/"); ?>' + lab_id,
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

