<?php
$title = 'Print';
include '../components/config.php';
include '../components/meta.php';
include '../components/navbar.php';
date_default_timezone_set("Asia/Jakarta");
$Date = date("Y-m-d");

if (isset($_POST['filter'])) :
    $from = mysqli_real_escape_string($con, $_POST['date_now']);
    $until = mysqli_real_escape_string($con, $_POST['date_between']);
    $AttendedStudents = $con->query("SELECT * FROM absen JOIN murid ON (absen.id_murid=murid.id_murid) JOIN kelas ON (kelas.id_kelas=murid.id_kelas) JOIN jurusan ON (jurusan.id_jurusan=murid.id_jurusan) WHERE tanggal BETWEEN '$from' AND '$until' AND kelas.id_kelas = $_SESSION[id_kelas] AND jurusan.id_jurusan = $_SESSION[id_jurusan] ORDER BY nama ASC");
else :
    $AttendedStudents = $con->query("SELECT * FROM absen JOIN murid ON (absen.id_murid=murid.id_murid) JOIN kelas ON (kelas.id_kelas=murid.id_kelas) JOIN jurusan ON (jurusan.id_jurusan=murid.id_jurusan) WHERE tanggal = '$Date' AND kelas.id_kelas = $_SESSION[id_kelas] AND jurusan.id_jurusan = $_SESSION[id_jurusan] ORDER BY nama ASC");
endif;
?>
<style>
    @media print {
        .navbar {
            display: none;
        }

        .button {
            display: none;
        }
    }
</style>
<script>
    function toggle() {
        window.print()
    }
</script>
<div class="container mt-6">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="is-flex is-align-items-center mb-3">
            <div class="mr-2 print">
                <label for="date_now">Dari Tanggal : </label>
                <input type="date" name="date_now" id="date_now" class="input is-focused" required>
            </div>
            <div class="mr-2 print">
                <label for="date_now">Sampai Tanggal : </label>
                <input type="date" name="date_between" id="date_between" class="input is-focused" required>
            </div>
            <div class="mr-2 print">
                <input type="submit" name="filter" id="filter" class="button is-primary mt-5 mr-2 has-text-weight-bold" value="Filter" required>
            </div>
    </form>
    <div class="ml-auto mt-5 print">
        <a href="#" class="button is-primary" aria-hidden="true" onclick="toggle()"><i class="bi bi-printer"></i>&nbsp;Print</a>
    </div>
</div>
<article class="panel is-primary">
    <p class="panel-heading">
        <span class="has-text-weight-bold is-flex is-justify-content-center">Laporan Absensi Siswa</span>
        <span class="has-text-weight-bold">Tanggal : <?= $Date ?></span>
    </p>
    <div class="table-container">
        <table class="table is-striped is-hoverable is-fullwidth is-narrow">
            <thead class="has-background-primary">
                <tr class="has-text-weight-bold">
                    <td scope="col" class="has-text-light">No</td>
                    <td scope="col" class="has-text-light">Nama</td>
                    <td scope="col" class="has-text-light">Keterangan</td>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                $no = 1;
                foreach ($AttendedStudents as $s) :
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $s['nama'] ?></td>
                        <td><?= $s['keterangan'] ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</article>
</div>
<!-- <script>
    window.print()
</script> -->