<?php
$title = 'Print';
include '../components/config.php';
include '../components/meta.php';
include '../components/navbar.php';
date_default_timezone_set("Asia/Jakarta");
$Date = date("Y-m-d");

$AttendedStudents = $con->query("SELECT * FROM absen JOIN murid ON (absen.id_murid=murid.id_murid) JOIN kelas ON (kelas.id_kelas=murid.id_kelas) JOIN jurusan ON (jurusan.id_jurusan=murid.id_jurusan) WHERE tanggal = '$Date'AND kelas.id_kelas = $_SESSION[id_kelas] AND jurusan.id_jurusan = $_SESSION[id_jurusan] ORDER BY nama ASC");

?>
<style>
    @media print {
        .navbar {
            display: none;
        }
    }
</style>
<div class="container mt-6">
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
<script>
    window.print()
</script>