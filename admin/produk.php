<?php

session_start();

require_once "../includes/auth.php";
require_once "../config/database.php";

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$where = array();

if ($keyword != '') {

    $keyword_safe = mysqli_real_escape_string($conn, $keyword);

    $where[] = "nama LIKE '%$keyword_safe%'";

}

if ($kategori != '') {

    $kategori_safe = mysqli_real_escape_string($conn, $kategori);

    $where[] = "kategori = '$kategori_safe'";

}

$where_sql = "";

if (count($where) > 0) {

    $where_sql = "WHERE " . implode(" AND ", $where);

}


/* PAGINATION */

$per_page = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $per_page;


/* TOTAL DATA */

$count_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM produk
     $where_sql"
);

$count_data = mysqli_fetch_assoc($count_query);

$total_data = $count_data['total'];

$total_page = ceil($total_data / $per_page);


/* DATA PRODUK */

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM produk
     $where_sql
     ORDER BY id DESC
     LIMIT $per_page OFFSET $offset"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Kelola Produk - Mahira Printing</title>

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

        .sidebar-bottom .logout:hover {
            color: #ffd400;
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


        /* =========================
           PAGE HEADER
        ========================= */

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-header small {
            color: #c09f00;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .page-header h1 {
            font-size: 32px;
            margin-top: 8px;
        }

        .page-header p {
            color: #777777;
            font-size: 14px;
            margin-top: 8px;
        }

        .add-button {
            display: inline-block;
            background: #ffd400;
            color: #111111;
            text-decoration: none;
            padding: 13px 20px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
            transition: 0.2s;
        }

        .add-button:hover {
            background: #111111;
            color: #ffffff;
            transform: translateY(-2px);
        }


        /* =========================
           FLASH
        ========================= */

        .flash-wrapper {
            margin-bottom: 20px;
        }


        /* =========================
           FILTER
        ========================= */

        .filter-card {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .filter-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr 220px auto auto;
            gap: 12px;
            align-items: end;
        }

        .form-group label {
            display: block;
            font-size: 11px;
            font-weight: bold;
            color: #555555;
            margin-bottom: 7px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            height: 44px;
            border: 1px solid #dddddd;
            border-radius: 6px;
            padding: 0 12px;
            font-size: 13px;
            background: #fafafa;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #ffd400;
            background: #ffffff;
        }

        .search-button {
            height: 44px;
            border: none;
            background: #111111;
            color: #ffffff;
            padding: 0 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .search-button:hover {
            background: #ffd400;
            color: #111111;
        }

        .reset-button {
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 18px;
            border: 1px solid #dddddd;
            border-radius: 6px;
            text-decoration: none;
            color: #555555;
            font-size: 13px;
            font-weight: bold;
        }

        .reset-button:hover {
            border-color: #111111;
            color: #111111;
        }


        /* =========================
           TABLE
        ========================= */

        .table-card {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-header {
            padding: 22px 25px;
            border-bottom: 1px solid #eeeeee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            font-size: 16px;
        }

        .table-count {
            color: #888888;
            font-size: 12px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th {
            background: #111111;
            color: #ffffff;
            font-size: 11px;
            text-align: left;
            padding: 14px 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eeeeee;
            font-size: 13px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #fffdf0;
        }

        .number {
            color: #888888;
            width: 50px;
        }

        .product-image {
            width: 65px;
            height: 65px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #eeeeee;
        }

        .no-image {
            width: 65px;
            height: 65px;
            background: #111111;
            color: #ffd400;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 8px;
            font-weight: bold;
            border-radius: 6px;
        }

        .product-name {
            font-weight: bold;
            color: #111111;
        }

        .category {
            display: inline-block;
            background: #fff4a8;
            color: #111111;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
        }

        .price {
            font-weight: bold;
        }

        .stock {
            color: #555555;
        }


        /* =========================
           ACTION
        ========================= */

        .actions {
            display: flex;
            gap: 6px;
        }

        .action-button {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 11px;
            font-weight: bold;
        }

        .edit-button {
            background: #ffd400;
            color: #111111;
        }

        .delete-button {
            background: #eeeeee;
            color: #c62828;
        }

        .edit-button:hover {
            background: #111111;
            color: #ffffff;
        }

        .delete-button:hover {
            background: #c62828;
            color: #ffffff;
        }


        /* =========================
           EMPTY DATA
        ========================= */

        .empty-data {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-data h3 {
            font-size: 17px;
            margin-bottom: 8px;
        }

        .empty-data p {
            color: #888888;
            font-size: 13px;
        }


        /* =========================
           PAGINATION
        ========================= */

        .pagination {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 25px;
        }

        .pagination a {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 6px;
            text-decoration: none;
            color: #555555;
            font-size: 12px;
            font-weight: bold;
        }

        .pagination a:hover,
        .pagination a.active {
            background: #ffd400;
            border-color: #ffd400;
            color: #111111;
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

            .content {
                padding: 30px;
            }

            .filter-form {
                grid-template-columns: 1fr 1fr;
            }

            .search-button,
            .reset-button {
                width: 100%;
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

            .menu-title {
                display: none;
            }

            .menu {
                flex-direction: row;
                flex-wrap: wrap;
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

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .add-button {
                width: 100%;
                text-align: center;
            }

        }


        @media (max-width: 500px) {

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

            .page-header h1 {
                font-size: 26px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .filter-card {
                padding: 20px;
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

        <a href="index.php">
            Dashboard
        </a>

        <a
            href="produk.php"
            class="active"
        >
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
            Kelola Produk
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


        <!-- PAGE HEADER -->

        <div class="page-header">

            <div>

                <small>
                    Katalog Mahira Printing
                </small>

                <h1>
                    Kelola Produk
                </h1>

                <p>
                    Tambahkan dan kelola produk yang ditampilkan di website.
                </p>

            </div>


            <a
                href="tambah.php"
                class="add-button"
            >
                + Tambah Produk
            </a>

        </div>


        <!-- FLASH MESSAGE -->

        <div class="flash-wrapper">

            <?php include "../includes/flash.php"; ?>

        </div>


        <!-- FILTER -->

        <div class="filter-card">

            <div class="filter-title">
                Cari & Filter Produk
            </div>


            <form
                method="GET"
                class="filter-form"
            >


                <div class="form-group">

                    <label>
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="keyword"
                        placeholder="Masukkan nama produk"
                        value="<?php echo htmlspecialchars($keyword); ?>"
                    >

                </div>


                <div class="form-group">

                    <label>
                        Kategori
                    </label>

                    <select name="kategori">

                        <option value="">
                            Semua Kategori
                        </option>

                        <option
                            value="Textile & Sablon"
                            <?php
                            if ($kategori == 'Textile & Sablon') {
                                echo 'selected';
                            }
                            ?>
                        >
                            Textile & Sablon
                        </option>

                        <option
                            value="Advertising & Signage"
                            <?php
                            if ($kategori == 'Advertising & Signage') {
                                echo 'selected';
                            }
                            ?>
                        >
                            Advertising & Signage
                        </option>

                        <option
                            value="Custom & Souvenir"
                            <?php
                            if ($kategori == 'Custom & Souvenir') {
                                echo 'selected';
                            }
                            ?>
                        >
                            Custom & Souvenir
                        </option>

                        <option
                            value="Kertas & Desain"
                            <?php
                            if ($kategori == 'Kertas & Desain') {
                                echo 'selected';
                            }
                            ?>
                        >
                            Kertas & Desain
                        </option>

                    </select>

                </div>


                <button
                    type="submit"
                    class="search-button"
                >
                    Cari
                </button>


                <a
                    href="produk.php"
                    class="reset-button"
                >
                    Reset
                </a>


            </form>

        </div>


        <!-- TABLE -->

        <div class="table-card">


            <div class="table-header">

                <h2>
                    Daftar Produk
                </h2>

                <div class="table-count">

                    <?php echo $total_data; ?> produk

                </div>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php

                    $no = $offset + 1;

                    if ($total_data > 0) {

                        while ($row = mysqli_fetch_assoc($query)) {

                    ?>


                        <tr>


                            <td class="number">

                                <?php echo $no++; ?>

                            </td>


                            <td>

                                <?php

                                if (!empty($row['gambar'])) {

                                ?>

                                    <img
                                        src="../uploads/produk/<?php echo htmlspecialchars($row['gambar']); ?>"
                                        class="product-image"
                                        alt="<?php echo htmlspecialchars($row['nama']); ?>"
                                    >

                                <?php

                                } else {

                                ?>

                                    <div class="no-image">
                                        MAHIRA
                                    </div>

                                <?php

                                }

                                ?>

                            </td>


                            <td>

                                <div class="product-name">

                                    <?php echo htmlspecialchars($row['nama']); ?>

                                </div>

                            </td>


                            <td>

                                <span class="category">

                                    <?php echo htmlspecialchars($row['kategori']); ?>

                                </span>

                            </td>


                            <td class="price">

                                Rp <?php echo number_format(
                                    $row['harga'],
                                    0,
                                    ',',
                                    '.'
                                ); ?>

                            </td>


                            <td class="stock">

                                <?php echo $row['stok']; ?>

                            </td>


                            <td>

                                <div class="actions">

                                    <a
                                        href="edit.php?id=<?php echo $row['id']; ?>"
                                        class="action-button edit-button"
                                    >
                                        Edit
                                    </a>


                                    <a
                                        href="hapus.php?id=<?php echo $row['id']; ?>"
                                        class="action-button delete-button"
                                        onclick="return confirm('Yakin ingin menghapus produk?')"
                                    >
                                        Hapus
                                    </a>

                                </div>

                            </td>


                        </tr>


                    <?php

                        }

                    } else {

                    ?>


                        <tr>

                            <td colspan="7">

                                <div class="empty-data">

                                    <h3>
                                        Produk Tidak Ditemukan
                                    </h3>

                                    <p>
                                        Belum ada produk yang sesuai dengan pencarian.
                                    </p>

                                </div>

                            </td>

                        </tr>


                    <?php

                    }

                    ?>


                    </tbody>

                </table>

            </div>

        </div>


        <!-- PAGINATION -->

        <?php

        if ($total_page > 1) {

        ?>

            <div class="pagination">

                <?php

                for ($i = 1; $i <= $total_page; $i++) {

                    $active = '';

                    if ($i == $page) {
                        $active = 'active';
                    }

                ?>

                    <a
                        href="?page=<?php echo $i; ?>&keyword=<?php echo urlencode($keyword); ?>&kategori=<?php echo urlencode($kategori); ?>"
                        class="<?php echo $active; ?>"
                    >
                        <?php echo $i; ?>
                    </a>

                <?php

                }

                ?>

            </div>

        <?php

        }


        ?>

    </div>

</main>


</body>

</html>