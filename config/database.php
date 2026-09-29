<?php

$host = "localhost";
$user = "root";
$password = "arin12345";
$database = "percetakan-1";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}