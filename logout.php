<?php

session_start();
unset($_SESSION['guru']);
setcookie("tgl", $tanggal_pemesanan, time() - 86400);
setcookie("admin", $row['email'], time() - 86400);
setcookie("guru", hash('md5', $row['password']), time() - 86400);

echo
"<script>
        alert('Logout Berhasil!');
        document.location.href = 'index.php';
    </script>";
