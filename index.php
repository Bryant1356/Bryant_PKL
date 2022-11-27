<?php
$title = 'Login';
session_start();
include 'components/config.php';

date_default_timezone_set("Asia/Jakarta");
$tanggal_pemesanan =  date("Y-m-d H:i:s");

if (isset($_COOKIE['tgl']) && isset($_COOKIE['admin']) && isset($_COOKIE['guru'])) {
    echo "<script>
            alert('Anda Sudah Login');
            document.location.href = 'teacher/index.php';
        </script>";
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = hash('md5', $_POST['password']);
    $query = $con->query("SELECT * FROM guru WHERE email = '$email' AND password = '$password'");
    $row = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) == 1) {
        if ($password == $row['password']) {
            $_SESSION['guru'] = true;
            $_SESSION['id_guru'] = $row['id_guru'];
            $_SESSION['id_kelas'] = $row['id_kelas'];
            $_SESSION['id_jurusan'] = $row['id_jurusan'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['notif'] = 'login';
            if (isset($_POST['remember'])) {
                setcookie("tgl", $tanggal_pemesanan, time() + 86400);
                setcookie("admin", $row['email'], time() + 86400);
                setcookie("guru", hash('md5', $row['password']), time() + 86400);
            } else {
            }
            echo "<script>
                        alert('Berhasil Login');
                        document.location.href = 'teacher/index.php';
                    </script>";
        }
    }
}
?>
<!-- Meta -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="public/img/absensi_ae.png" type="image/x-icon">
<!-- CSS -->
<link rel="stylesheet" href="public/assets/bulma/css/bulma.min.css">
<link rel="stylesheet" href="public/assets/css/datatables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<!-- JS -->
<script src="public/assets/jquery/jquery-3.6.1.min.js"></script>
<script src="public/assets/js/datatables.min.js"></script>
<script src="public/assets/js/modal.js"></script>
<title><?= $title ?></title>
<style>
    @media only screen and (min-width: 320px) {
        img {
            margin-bottom: 20px;
        }

        .columns {
            margin-top: 8vh;
            padding: 2vh;
        }
    }

    @media only screen and (min-width: 992px) {
        .columns {
            margin-top: 15vh;
        }
    }

    .card {
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 0 15px #13cfac;
        padding: 50px;
    }
</style>

<body class="has-background-primary-light">
    <div class="container p-3">
        <div class="columns is-desktop is-justify-content-center">
            <div class="column is-half">
                <div class="card p-3 has-background-white-ter has-text-primary has-text-weight-bold">
                    <div class="card-content">
                        <div class="is-flex is-justify-content-center mb-5">
                            <h4 class="has-text-weight-bold is-size-3">Login</h4>
                        </div>
                        <div class="is-flex is-justify-content-center">
                            <figure class="image is-128x128">
                                <img src="public/img/logo.png">
                            </figure>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="email">Email :</label>
                            <div class="control has-icons-left">
                                <input type="text" name="email" id="email" required class="input is-primary mb-3 is-rounded" placeholder="Masukkan Email">
                                <span class="icon is-left has-text-primary">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                            <label for="password">Password :</label>
                            <div class="control has-icons-left">
                                <input type="password" name="password" id="password" required class="input is-primary mb-3 is-rounded" placeholder="Masukkan Password"><br>
                                <span class="icon is-left has-text-primary">
                                    <i class="bi bi-key"></i>
                                </span>
                            </div>
                            <div class="is-flex is-justify-content-space-between">
                                <div class="control">
                                    <input type="checkbox" name="show" id="show" aria-hidden="true" onclick="toggle()">
                                    <label for="show">Show Password</label>
                                </div>
                                <div class="control">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">Remember me</label>
                                </div>
                            </div>
                            <div class="is-flex is-justify-content-center">
                                <input type="submit" value="Login" name="submit" class="button is-primary mt-5 has-text-weight-bold is-rounded">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var state = false;

        function toggle() {
            if (state) {
                document.getElementById("password").setAttribute("type", "password");
                document.getElementById("show");
                state = false;
            } else {
                document.getElementById("password").setAttribute("type", "text");
                document.getElementById("show");
                state = true;
            }
        }
    </script>
</body>

</html>