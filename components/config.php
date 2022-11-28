<?php

$con = mysqli_connect("localhost", "root", "", "absensi");

function get_total_attend($id_murid, $keterangan, $tanggal_awal, $tanggal_akhir)
{
    global $con;
    $Attend = $con->query("SELECT * FROM absen WHERE id_murid = '$id_murid' AND keterangan = '$keterangan' AND tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
    // var_dump($Attend);
    return mysqli_num_rows($Attend);
}
