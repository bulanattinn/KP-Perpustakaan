<?php
include 'inc/koneksi.php'; // Pastikan file koneksi database di-include dengan path yang benar

// Kode 9 digit
$carikode = mysqli_query($koneksi, "SELECT id_buku FROM tb_buku ORDER BY id_buku DESC");
$datakode = mysqli_fetch_array($carikode);
$kode = isset($datakode['id_buku']) ? $datakode['id_buku'] : 'B000';
$urut = substr($kode, 1, 3);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1) {
    $format = "B00" . $tambah;
} elseif (strlen($tambah) == 2) {
    $format = "B0" . $tambah;
} else {
    $format = "B" . $tambah;
}
?>

<section class="content-header">
    <ol class="breadcrumb">
        <li>
            <a href="index.php">
                <i class="fa fa-home"></i>
                <b>Si Perpustakaan</b>
            </a>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Buku</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>ID Buku</label>
                            <input type="text" name="id_buku" id="id_buku" class="form-control" value="<?php echo $format; ?>" readonly/>
                        </div>

                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="judul_buku" id="judul_buku" class="form-control" placeholder="Judul Buku">
                        </div>

                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" name="pengarang" id="pengarang" class="form-control" placeholder="Nama Pengarang">
                        </div>

                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" class="form-control" placeholder="Penerbit">
                        </div>

                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" name="th_terbit" id="th_terbit" class="form-control" placeholder="Tahun Terbit">
                        </div>

                        <div class="form-group">
                            <label>Subjek</label>
                            <input type="text" name="subjek" id="subjek" class="form-control" placeholder="Subjek">
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
                        <a href="?page=MyApp/data_buku" class="btn btn-warning">Batal</a>
                    </div>
                </form>
            </div>
            <!-- /.box -->
</section>

<?php
if (isset($_POST['Simpan'])) {
    $id_buku = $_POST['id_buku'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $th_terbit = $_POST['th_terbit'];
    $subjek = $_POST['subjek'];

    $sql_simpan = "INSERT INTO tb_buku (id_buku, judul_buku, pengarang, penerbit, th_terbit, subjek) VALUES (
        '$id_buku',
        '$judul_buku',
        '$pengarang',
        '$penerbit',
        '$th_terbit',
        '$subjek')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);

    if ($query_simpan) {
        echo "<script>
        Swal.fire({
            title: 'Tambah Data Berhasil',
            text: '',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_buku';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Tambah Data Gagal',
            text: '',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/add_buku';
            }
        })</script>";
    }
    mysqli_close($koneksi);
}
?>
