<?php
session_start();
if (!isset($_SESSION['guru'])) :
    echo "
    <script>
    alert('Anda Belum Melakukan Login');
    document.location.href = '../index.php';
    </script>
    ";
endif;
?>
<nav class="navbar has-background-light" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="../teacher/index.php">
                <img src="../public/img/logo.png" width="112">
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-end">
                <a class="navbar-item" href="../teacher/index.php">Dahsboard</a>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Features
                    </a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="../students/index.php">Students List</a>
                        <a class="navbar-item" href="../teacher/absen.php">Attendance</a>
                        <a class="navbar-item" href="../students/report.php">Report</a>
                    </div>
                </div>
                <div class="navbar-item">
                    <a class="button is-primary" href="../logout.php">
                        <strong>Sign Out</strong>
                    </a>
                </div>
            </div>
        </div>
</nav>
<script>
    $(document).ready(function() {

        // Check for click events on the navbar burger icon
        $(".navbar-burger").click(function() {

            // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");

        });
    });
</script>