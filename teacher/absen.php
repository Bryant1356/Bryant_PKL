<?php
$title = 'Absen';
include '../components/config.php';
include '../components/meta.php';
include '../components/navbar.php';
date_default_timezone_set("Asia/Jakarta");
$Date = date("Y-m-d");

$id_murid = 0;
$nama = "";
$keterangan = "";
// Status apakah murid sudah absen atau belum
$Attend = $con->query("SELECT * FROM absen");

// Menampilkan data murid yang belum diabsen hari ini
$Absen = $con->query("SELECT * FROM murid JOIN kelas ON (kelas.id_kelas=murid.id_kelas) JOIN jurusan ON (jurusan.id_jurusan=murid.id_jurusan) WHERE id_murid NOT IN (SELECT id_murid FROM absen WHERE tanggal = '" . $Date . "') AND kelas.id_kelas = $_SESSION[id_kelas] AND jurusan.id_jurusan = $_SESSION[id_jurusan] ORDER BY nama ASC");

// Menampilkan Data murid yang sudah diabsen
$AttendedStudents = $con->query("SELECT * FROM murid JOIN kelas ON (kelas.id_kelas=murid.id_kelas) JOIN jurusan ON (jurusan.id_jurusan=murid.id_jurusan) JOIN absen ON (absen.id_murid=murid.id_murid) WHERE tanggal = '$Date' AND kelas.id_kelas = $_SESSION[id_kelas] AND jurusan.id_jurusan = $_SESSION[id_jurusan] ORDER BY nama ASC");
?>
<?php
if (isset($_SESSION['absen']) == true) {
?>
    <script>
        const information = $("#notif", function() {
            Swal.fire({
                title: "Absen Berhasil",
                icon: "success"
            });
        });
    </script>
    <div class="notif" id="notif" data-infodata="info"></div>
<?php
    unset($_SESSION['absen']);
}
?>
<div class="container mt-5 p-3">
    <div class="is-flex is-justify-content-space-between">
        <button class="js-modal-trigger button has-background-primary has-text-weight-bold has-text-light mb-3" data-target="modal-js-example">
            <i class="bi bi-plus"></i>&nbsp;Absen
        </button>
        <a href="../students/print.php" class="button is-primary"><i class="bi bi-printer"></i>&nbsp;Print</a>
    </div>
    <article class="panel is-primary">
        <p class="panel-heading">
            <span class="has-text-weight-bold is-flex is-justify-content-center">Absensi Siswa</span>
            <span class="has-text-weight-bold">Tanggal : <?= $Date ?></span>
        </p>
        <div class="modal" id="modal-js-example">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Absen Siswa</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <form action="" method="post" enctype="multipart/form-data">
                    <section class="modal-card-body">
                        <label for="nama">Nama :</label>
                        <div class="is-primary">
                            <select name="nama" class="input is-focused" required>
                                <option value="---">---</option>
                                <?php $no = 1;
                                foreach ($Absen as $s) {
                                    if ($nama == $s['id_murid']) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                ?>
                                    <option value="<?= $s['id_murid'] ?>" <?= $selected ?>> <?= $s['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select><br>
                            <label for="keterangan">Keterangan :</label>
                            <select name="keterangan" class="input is-focused" required>
                                <option value="---">---</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Alpa">Alpa</option>
                            </select>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-success" name="absen">Absen</button>
                        <button class="button">Cancel</button>
                    </footer>
                </form>
                <?php
                if (isset($_POST['absen'])) :
                    $nama = $_POST['nama'];
                    $keterangan = $_POST['keterangan'];
                    $CekAbsen = $con->query("INSERT INTO absen VALUES (NULL, '$nama', '$keterangan', '$Date')");
                    if (
                        $CekAbsen == true
                    ) {
                        $_SESSION['absen'] = true;
                        echo
                        "<script>
                        document.location.href = 'absen.php';
                        </script>";
                    } else {
                        echo
                        "<script>
                        alert('Absen Gagal');
                        document.location.href = 'absen.php';
                        </script>";
                    }
                endif;
                ?>
            </div>
        </div>
        <div class="table-container">
            <table class="table is-striped is-hoverable is-fullwidth is-narrow">
                <thead class="has-background-primary">
                    <tr class="has-text-weight-bold">
                        <td scope="col" class="has-text-light">No</td>
                        <td scope="col" class="has-text-light">Nama</td>
                        <td scope="col" class="has-text-light">Kelas</td>
                        <td scope="col" class="has-text-light">Jurusan</td>
                        <td scope="col" class="has-text-light">Keterangan</td>
                        <td scope="col" class="has-text-light">Tanggal</td>
                        <td scope="col" class="has-text-light">Edit</td>
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
                            <td><?= $s['kelas'] ?></td>
                            <td><?= $s['jurusan'] ?></td>
                            <td>
                                <?php if ($s['keterangan'] == "Sakit") : ?>
                                    <span class="tag is-warning is-light is-medium"><?= $s['keterangan'] ?></span>
                                <?php elseif ($s['keterangan'] == "Izin") : ?>
                                    <span class="tag is-success is-light is-medium"><?= $s['keterangan'] ?></span>
                                <?php elseif ($s['keterangan'] == "Alpa") : ?>
                                    <span class="tag is-danger is-light is-medium"><?= $s['keterangan'] ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= $s['tanggal'] ?></td>
                            <td>
                                <button class="js-modal-trigger button has-background-primary has-text-weight-bold has-text-light mb-3" data-target="edit<?= $s['id_murid'] ?>">
                                    <i class="bi bi-pencil-square"></i>&nbsp;Edit
                                </button>
                            </td>
                        </tr>
                        <div class="modal" id="edit<?= $s['id_murid'] ?>">
                            <div class="modal-background"></div>
                            <div class="modal-card">
                                <header class="modal-card-head">
                                    <p class="modal-card-title">Absen Siswa</p>
                                    <button class="delete" aria-label="close"></button>
                                </header>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <section class="modal-card-body">
                                        <label for="nama">Nama :</label>
                                        <div class="is-primary">
                                            <input type="text" name="id_murid" id="id_murid" class="input is-focused is-hidden" value="<?= $s['id_murid'] ?>" readonly>
                                            <input type="text" name="nama" id="nama" class="input is-focused" value="<?= $s['nama'] ?>" readonly>
                                            <label for="keterangan">Keterangan :</label>
                                            <select name="keterangan" class="input is-focused" required>
                                                <option value="<?= $s['keterangan'] ?>"><?= $s['keterangan'] ?></option>
                                                <option value="Izin">Izin</option>
                                                <option value="Sakit">Sakit</option>
                                                <option value="Alpa">Alpa</option>
                                            </select>
                                        </div>
                                    </section>
                                    <footer class="modal-card-foot">
                                        <button class="button is-success" name="edit">Absen</button>
                                        <button class="button">Cancel</button>
                                    </footer>
                                </form>
                                <?php
                                if (isset($_POST['edit'])) :
                                    $keterangan = $_POST['keterangan'];
                                    $UpdateQuery = $con->query("UPDATE absen SET keterangan = '$keterangan' WHERE id_murid = '$_POST[id_murid]' AND tanggal = '$Date'");
                                    if ($UpdateQuery == true) :
                                        echo "
                                        <script>
                                        alert('Absensi Berhasil Diubah!');
                                        document.location.href = 'absen.php';
                                        </script>
                                        ";
                                    else :
                                        echo "
                                            <script>
                                            alert('Absensi Gagal Diubah!');
                                            document.location.href = 'absen.php';
                                            </script>
                                            ";
                                    endif;
                                endif;
                                ?>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </article>
</div>