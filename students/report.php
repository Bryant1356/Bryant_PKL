<?php
$title = 'Report per Month';
include '../components/config.php';
include '../components/meta.php';
include '../components/navbar.php';
date_default_timezone_set("Asia/Jakarta");
// $Date = date("M");

?>
<style>
    @media print {
        .navbar {
            display: none;
        }

        .button {
            display: none;
        }

        .print {
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
    <form action="" method="get" enctype="multipart/form-data">
        <div class="is-flex is-align-items-center mb-3">
            <div class="mr-2 print">
                <label for="date_now">Dari Tanggal : </label>
                <?php if (isset($_GET['date_now'])) : ?>
                    <input type="date" name="date_now" id="date_now" class="input is-focused" required value="<?= $_GET['date_now'] ?>">
                <?php else : ?>
                    <input type="date" name="date_now" id="date_now" class="input is-focused" required>
                <?php endif; ?>
            </div>
            <div class="mr-2 print">
                <label for="date_now">Sampai Tanggal : </label>
                <?php if (isset($_GET['until'])) : ?>
                    <input type="date" name="until" id="until" class="input is-focused" required value="<?= $_GET['until'] ?>">
                <?php else : ?>
                    <input type="date" name="until" id="until" class="input is-focused" required>
                <?php endif; ?>
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
        <span class="has-text-weight-bold is-flex is-justify-content-center mb-5">Laporan Absensi Siswa</span>
        <?php if (isset($_GET['date_now']) && isset($_GET['until'])) : ?>
            <span class="has-text-weight-bold">Bulan : <?= $_GET['date_now'] ?> s/d <?= $_GET['until'] ?></span>
        <?php else : ?>
            <span class="has-text-weight-bold">Bulan : - s/d -</span>
        <?php endif; ?>
    </p>
    <div class="table-container">
        <table class="table is-striped is-hoverable is-fullwidth is-narrow">
            <thead class="has-background-primary">
                <tr class="has-text-weight-bold">
                    <td scope="col" class="has-text-light">No</td>
                    <td scope="col" class="has-text-light">Nama</td>
                    <td scope="col" class="has-text-light">Sakit</td>
                    <td scope="col" class="has-text-light">Izin</td>
                    <td scope="col" class="has-text-light">Alpa</td>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                $no = 1;
                $AttendedStudents = $con->query("SELECT * FROM murid JOIN kelas ON (kelas.id_kelas=murid.id_kelas) JOIN jurusan ON (jurusan.id_jurusan=murid.id_jurusan) WHERE kelas.id_kelas = $_SESSION[id_kelas] AND jurusan.id_jurusan = $_SESSION[id_jurusan] ORDER BY nama");
                if (isset($_GET['filter'])) :
                    $tanggal_awal = mysqli_real_escape_string($con, $_GET['date_now']);
                    $tanggal_akhir = mysqli_real_escape_string($con, $_GET['until']);
                    foreach ($AttendedStudents as $s) :
                ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $s['nama'] ?></td>
                            <td>
                                <?= get_total_attend($s['id_murid'], "Sakit", $tanggal_awal, $tanggal_akhir); ?>
                            </td>
                            <td>
                                <?= get_total_attend($s['id_murid'], "Izin", $tanggal_awal, $tanggal_akhir); ?>
                            </td>
                            <td>
                                <?= get_total_attend($s['id_murid'], "Alpa", $tanggal_awal, $tanggal_akhir); ?>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                else : ?>
                    <tr>
                        <td class="has-text-centered" colspan="5">
                            <h4>Tidak Ada Data</h4>
                        </td>
                    </tr>
                <?php endif;
                ?>
            </tbody>
        </table>
    </div>
</article>
</div>