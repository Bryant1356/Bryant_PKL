<?php
$title = 'Students List';
include '../components/config.php';
include '../components/meta.php';
include '../components/navbar.php';
date_default_timezone_set("Asia/Jakarta");
$Date = date("Y-m-d");
$StudentsList = $con->query("SELECT * FROM murid JOIN kelas ON (kelas.id_kelas=murid.id_kelas) JOIN jurusan ON (jurusan.id_jurusan=murid.id_jurusan) WHERE murid.id_kelas = $_SESSION[id_kelas] AND murid.id_jurusan = $_SESSION[id_jurusan] ORDER BY nama ASC");
$Student = mysqli_fetch_array($StudentsList, MYSQLI_ASSOC);
?>
<div class="container mt-6 p-3">
    <article class="panel is-primary">
        <p class="panel-heading">
            Welcome <?= $_SESSION['nama'] ?><br><br>
            <span class="is-flex is-justify-content-center">Daftar Murid Kelas : <?= $Student['kelas'] . "&nbsp;" . $Student['jurusan'] ?></span>
        </p>
        <div class="table-container">
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead class="has-background-primary">
                    <tr class="has-text-weight-bold">
                        <td scope="col" class="has-text-light">No</td>
                        <td scope="col" class="has-text-light">Nama</td>
                        <td scope="col" class="has-text-light">Email</td>
                        <td scope="col" class="has-text-light">Kelas</td>
                        <td scope="col" class="has-text-light">Jurusan</td>
                        <td scope="col" class="has-text-light">No tlp</td>
                        <td scope="col" class="has-text-light">Alamat</td>
                        <td scope="col" class="has-text-light">Jenis Kelamin&nbsp;(L/P)</td>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    $no = 1;
                    foreach ($StudentsList as $s) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $s['nama'] ?></td>
                            <td><?= $s['email'] ?></td>
                            <td><?= $s['kelas'] ?></td>
                            <td><?= $s['jurusan'] ?></td>
                            <td><?= $s['no_tlp'] ?></td>
                            <td><?= $s['alamat'] ?></td>
                            <td><?= $s['jk'] ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </article>
</div>