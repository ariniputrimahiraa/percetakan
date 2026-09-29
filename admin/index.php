<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$total_produk = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM produk"
);

$data_produk = mysqli_fetch_assoc($total_produk);

$total_kategori = mysqli_query(
    $conn,
    "SELECT COUNT(DISTINCT kategori) AS total FROM produk"
);

$data_kategori = mysqli_fetch_assoc($total_kategori);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Mahira Printing</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            color: #111111;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #111111;
            position: fixed;
            left: 0;
            top: 0;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .brand {
            padding: 5px 15px 35px;
            border-bottom: 1px solid #333333;
            margin-bottom: 25px;
            width: 80px;
        }

        .brand span {
            display: block;
            color: #ffd400;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 4px;
        }

        .brand h1 {
            color: #ffffff;
            font-size: 25px;
            letter-spacing: 1px;
        }

        .menu-title {
            color: #777777;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 0 15px 12px;
            text-transform: uppercase;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu a {
            text-decoration: none;
            color: #bbbbbb;
            padding: 13px 15px;
            border-radius: 7px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #ffd400;
            color: #111111;
            font-weight: bold;
        }

        .sidebar-bottom {
            margin-top: auto;
        }

        .sidebar-bottom a {
            display: block;
            text-decoration: none;
            color: #bbbbbb;
            padding: 13px 15px;
            border-radius: 7px;
            font-size: 14px;
            transition: 0.2s;
        }

        .sidebar-bottom a:hover {
            background: #222222;
            color: #ffffff;
        }

        .logout {
            margin-top: 5px;
        }

        .logout:hover {
            color: #ffd400 !important;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 75px;
            background: #ffffff;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
        }

        .page-title {
            font-size: 14px;
            font-weight: bold;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #ffd400;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .admin-name {
            font-size: 13px;
            font-weight: bold;
        }

        .admin-role {
            font-size: 11px;
            color: #888888;
            margin-top: 3px;
        }

        .content {
            padding: 40px;
        }

        .welcome {
            margin-bottom: 35px;
        }

        .welcome small {
            color: #c09f00;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .welcome h1 {
            font-size: 32px;
            margin: 8px 0 10px;
        }

        .welcome p {
            color: #777777;
            font-size: 14px;
        }

        /* =========================
           STATISTICS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e7e7e7;
            border-radius: 10px;
            padding: 25px;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: "";
            width: 6px;
            height: 100%;
            background: #ffd400;
            position: absolute;
            left: 0;
            top: 0;
        }

        .stat-label {
            font-size: 12px;
            color: #777777;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-number {
            font-size: 35px;
            font-weight: 800;
        }

        .stat-description {
            margin-top: 8px;
            font-size: 12px;
            color: #999999;
        }

        .status {
            color: #111111;
        }

        .status span {
            display: inline-block;
            background: #ffd400;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        /* =========================
           MANAGEMENT
        ========================= */

        .management {
            background: #111111;
            color: #ffffff;
            border-radius: 12px;
            padding: 35px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            position: relative;
            overflow: hidden;
        }

        .management::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border: 35px solid #ffd400;
            border-radius: 50%;
            right: -80px;
            bottom: -100px;
            opacity: 0.15;
        }

        .management-content {
            position: relative;
            z-index: 2;
        }

        .management small {
            color: #ffd400;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .management h2 {
            font-size: 24px;
            margin: 8px 0 10px;
        }

        .management p {
            color: #aaaaaa;
            font-size: 13px;
            line-height: 1.6;
        }

        .manage-button {
            position: relative;
            z-index: 2;
            display: inline-block;
            background: #ffd400;
            color: #111111;
            text-decoration: none;
            padding: 14px 22px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
            transition: 0.2s;
        }

        .manage-button:hover {
            background: #ffffff;
            transform: translateY(-2px);
        }

        /* =========================
           QUICK MENU
        ========================= */

        .section-title {
            margin: 35px 0 15px;
            font-size: 18px;
        }

        .quick-menu {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .quick-card {
            background: #ffffff;
            border: 1px solid #e7e7e7;
            border-radius: 9px;
            padding: 20px;
            text-decoration: none;
            color: #111111;
            transition: 0.2s;
        }

        .quick-card:hover {
            border-color: #ffd400;
            transform: translateY(-2px);
        }

        .quick-card h3 {
            font-size: 15px;
            margin-bottom: 6px;
        }

        .quick-card p {
            font-size: 12px;
            color: #888888;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 950px) {

            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
            }

            .stat-card:last-child {
                grid-column: span 2;
            }

            .content {
                padding: 30px;
            }

        }

        @media (max-width: 700px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding: 20px;
            }

            .brand {
                padding-bottom: 20px;
                margin-bottom: 15px;
            }

            .menu {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .menu-title {
                display: none;
            }

            .sidebar-bottom {
                margin-top: 15px;
            }

            .sidebar-bottom a {
                display: inline-block;
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                padding: 0 20px;
            }

            .content {
                padding: 25px 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .stat-card:last-child {
                grid-column: auto;
            }

            .management {
                flex-direction: column;
                align-items: flex-start;
            }

            .quick-menu {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 450px) {

            .topbar {
                height: auto;
                padding: 15px 20px;
            }

            .page-title {
                display: none;
            }

            .admin-info {
                margin-left: auto;
            }

            .welcome h1 {
                font-size: 26px;
            }

            .management {
                padding: 25px;
            }

        }
 .sidebar-bottom {
            position: absolute;
            bottom: 25px;
            left: 18px;
            right: 18px;
        }

        .website-btn {
            display: block;
            padding: 12px;
            text-align: center;
            border: 1px solid #444444;
            border-radius: 8px;
            color: #ffffff;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .website-btn:hover {
            border-color: #ffd400;
            color: #ffd400;
        }

        .logout-btn {
            display: block;
            padding: 12px;
            text-align: center;
            background: #ffd400;
            color: #111111;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
        }

    </style>

</head>

<body>


<!-- SIDEBAR -->

<aside class="sidebar">

    <div class="brand">

        <img style="width: 180px;"  src="../assets/img/logo1.png" alt="">

    </div>


    <div class="menu-title">
        Menu Utama
    </div>


    <nav class="menu">

        <a
            href="index.php"
            class="active"
        >
            Dashboard
        </a>

        <a href="produk.php">
            Produk
        </a>

    </nav>


          <div class="sidebar-bottom">

            <a href="../index.php" class="website-btn">
                Lihat Website
            </a>

            <a href="logout.php" class="logout-btn">
                Logout
            </a>

        </div>

</aside>


<!-- MAIN -->

<main class="main">


    <!-- TOPBAR -->

    <header class="topbar">

        <div class="page-title">
            Dashboard Admin
        </div>


        <div class="admin-info">

            <div class="admin-avatar">

                <?php

                $nama_admin = isset($_SESSION['admin_nama'])
                    ? $_SESSION['admin_nama']
                    : 'Admin';

                echo strtoupper(substr($nama_admin, 0, 1));

                ?>

            </div>


            <div>

                <div class="admin-name">

                    <?php

                    echo htmlspecialchars($nama_admin);

                    ?>

                </div>

                <div class="admin-role">
                    Administrator
                </div>

            </div>

        </div>

    </header>


    <!-- CONTENT -->

    <div class="content">


        <!-- WELCOME -->

        <div class="welcome">

            <small>
                Mahira Printing
            </small>

            <h1>
                Dashboard Admin
            </h1>

            <p>
                Kelola katalog dan informasi website Mahira Printing dari sini.
            </p>

        </div>


        <!-- STATISTICS -->

        <div class="stats">


            <div class="stat-card">

                <div class="stat-label">
                    Total Produk
                </div>

                <div class="stat-number">
                    <?php echo $data_produk['total']; ?>
                </div>

                <div class="stat-description">
                    Produk tersedia di katalog
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-label">
                    Total Kategori
                </div>

                <div class="stat-number">
                    <?php echo $data_kategori['total']; ?>
                </div>

                <div class="stat-description">
                    Kategori produk
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-label">
                    Status Website
                </div>

                <div class="stat-number status">
                    <span>Aktif</span>
                </div>

                <div class="stat-description">
                    Website dapat diakses
                </div>

            </div>


        </div>


        <!-- MANAGEMENT -->

        <div class="management">

            <div class="management-content">

                <small>
                    KATALOG
                </small>

                <h2>
                    Kelola Produk
                </h2>

                <p>
                    Tambahkan, ubah, atau hapus produk yang ditampilkan
                    pada katalog Mahira Printing.
                </p>

            </div>


            <a
                href="produk.php"
                class="manage-button"
            >
                Kelola Produk →
            </a>

        </div>


        <!-- QUICK MENU -->

        <h2 class="section-title">
            Akses Cepat
        </h2>


        <div class="quick-menu">

            <a
                href="produk.php"
                class="quick-card"
            >

                <h3>
                    Manajemen Produk
                </h3>

                <p>
                    Kelola katalog produk Mahira Printing.
                </p>

            </a>


            <a
                href="../index.php"
                class="quick-card"
            >

                <h3>
                    Lihat Website
                </h3>

                <p>
                    Buka tampilan website pelanggan.
                </p>

            </a>

        </div>


    </div>

</main>

</body>

</html>