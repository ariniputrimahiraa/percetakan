<?php

session_start();

require_once "../includes/auth.php";
require_once "../config/database.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     WHERE id = $id"
);

$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    die("Produk tidak ditemukan.");
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Produk - Mahira Printing</title>

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

        /* SIDEBAR */

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


        /* MAIN */

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
            max-width: 1100px;
        }


        /* PAGE HEADER */

        .page-header {
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


        /* FORM CARD */

        .form-card {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            padding: 35px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .section-heading {
            font-size: 16px;
            font-weight: bold;
            padding-bottom: 15px;
            margin-bottom: 22px;
            border-bottom: 1px solid #eeeeee;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            border: 1px solid #dddddd;
            border-radius: 7px;
            padding: 12px 14px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            background: #fafafa;
            outline: none;
            transition: 0.2s;
        }

        .form-group input,
        .form-group select {
            height: 46px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 130px;
            line-height: 1.6;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #ffd400;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(255, 212, 0, 0.12);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }


        /* IMAGE */

        .image-upload {
            border: 1px dashed #cccccc;
            border-radius: 8px;
            padding: 20px;
            background: #fafafa;
        }

        .image-upload input {
            background: #ffffff;
        }

        .image-note {
            font-size: 11px;
            color: #888888;
            margin-top: 8px;
        }

        .current-image {
            margin-top: 20px;
        }

        .current-image-title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .current-image img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dddddd;
            display: block;
        }


        /* BUTTON */

        .form-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 25px;
            border-top: 1px solid #eeeeee;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 45px;
            padding: 0 22px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-update {
            background: #ffd400;
            color: #111111;
        }

        .btn-update:hover {
            background: #111111;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .btn-back {
            background: #eeeeee;
            color: #555555;
        }

        .btn-back:hover {
            background: #dddddd;
            color: #111111;
        }


        /* RESPONSIVE */

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

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
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

            .form-card {
                padding: 22px;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
            }

        }

    </style>

</head>

<body>


<!-- SIDEBAR -->

<aside class="sidebar">

    <div class="brand">

        <span>MAHIRA</span>

        <h1>PRINTING</h1>

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

        <a href="../index.php">
            Lihat Website
        </a>

        <a
            href="logout.php"
            class="logout"
        >
            Logout
        </a>

    </div>

</aside>


<!-- MAIN -->

<main class="main">


    <!-- TOPBAR -->

    <header class="topbar">

        <div class="page-title">
            Edit Produk
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

            <small>
                Katalog Mahira Printing
            </small>

            <h1>
                Edit Produk
            </h1>

            <p>
                Perbarui informasi produk yang sudah tersimpan di katalog.
            </p>

        </div>


        <!-- FLASH -->

        <?php include "../includes/flash.php"; ?>


        <!-- FORM -->

        <div class="form-card">


            <form
                action="proses_produk.php"
                method="POST"
                enctype="multipart/form-data"
            >


                <input
                    type="hidden"
                    name="aksi"
                    value="edit"
                >


                <input
                    type="hidden"
                    name="id"
                    value="<?php echo $produk['id']; ?>"
                >


                <!-- INFORMASI PRODUK -->

                <div class="form-section">

                    <div class="section-heading">
                        Informasi Produk
                    </div>


                    <div class="form-group">

                        <label for="nama">
                            Nama Produk
                        </label>

                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="<?php echo htmlspecialchars($produk['nama']); ?>"
                            placeholder="Masukkan nama produk"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="kategori">
                            Kategori
                        </label>

                        <select
                            name="kategori"
                            id="kategori"
                            required
                        >

                            <option value="">
                                Pilih Kategori
                            </option>


                            <option
                                value="Textile & Sablon"
                                <?php

                                if ($produk['kategori'] == 'Textile & Sablon') {
                                    echo 'selected';
                                }

                                ?>
                            >
                                Textile & Sablon
                            </option>


                            <option
                                value="Advertising & Signage"
                                <?php

                                if ($produk['kategori'] == 'Advertising & Signage') {
                                    echo 'selected';
                                }

                                ?>
                            >
                                Advertising & Signage
                            </option>


                            <option
                                value="Custom & Souvenir"
                                <?php

                                if ($produk['kategori'] == 'Custom & Souvenir') {
                                    echo 'selected';
                                }

                                ?>
                            >
                                Custom & Souvenir
                            </option>


                            <option
                                value="Kertas & Desain"
                                <?php

                                if ($produk['kategori'] == 'Kertas & Desain') {
                                    echo 'selected';
                                }

                                ?>
                            >
                                Kertas & Desain
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="deskripsi">
                            Deskripsi Produk
                        </label>

                        <textarea
                            name="deskripsi"
                            id="deskripsi"
                            placeholder="Masukkan deskripsi produk"
                            required
                        ><?php echo htmlspecialchars($produk['deskripsi']); ?></textarea>

                    </div>


                    <div class="form-row">


                        <div class="form-group">

                            <label for="harga">
                                Harga
                            </label>

                            <input
                                type="number"
                                id="harga"
                                name="harga"
                                value="<?php echo $produk['harga']; ?>"
                                min="0"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label for="stok">
                                Stok
                            </label>

                            <input
                                type="number"
                                id="stok"
                                name="stok"
                                value="<?php echo $produk['stok']; ?>"
                                min="0"
                                required
                            >

                        </div>


                    </div>

                </div>


                <!-- GAMBAR -->

                <div class="form-section">

                    <div class="section-heading">
                        Foto Produk
                    </div>


                    <div class="image-upload">

                        <div class="form-group">

                            <label for="gambar">
                                Ganti Gambar
                            </label>

                            <input
                                type="file"
                                name="gambar"
                                id="gambar"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <div class="image-note">
                                Kosongkan jika tidak ingin mengganti gambar.
                            </div>

                        </div>


                        <?php

                        if (!empty($produk['gambar'])) {

                        ?>

                            <div class="current-image">

                                <div class="current-image-title">
                                    Gambar Saat Ini
                                </div>

                                <img
                                    src="../uploads/produk/<?php echo htmlspecialchars($produk['gambar']); ?>"
                                    alt="<?php echo htmlspecialchars($produk['nama']); ?>"
                                >

                            </div>

                        <?php

                        }

                        ?>

                    </div>

                </div>


                <!-- ACTION -->

                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-update"
                    >
                        Update Produk
                    </button>


                    <a
                        href="produk.php"
                        class="btn btn-back"
                    >
                        Kembali
                    </a>

                </div>


            </form>

        </div>


    </div>

</main>


</body>

</html>