```php
<?php

session_start();

require_once "../includes/auth.php";

$nama_admin = isset($_SESSION['admin_nama'])
    ? $_SESSION['admin_nama']
    : 'Admin';

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Produk - Mahira Printing</title>

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

        a {
            text-decoration: none;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #111111;
            color: #ffffff;
            padding: 28px 18px;
            z-index: 1000;
        }

        .brand {
            padding: 0 12px 35px;
            border-bottom: 1px solid #333333;
        }

        .brand h2 {
            font-size: 21px;
            letter-spacing: 1px;
        }

        .brand span {
            color: #ffd400;
        }

        .brand p {
            margin-top: 7px;
            font-size: 11px;
            color: #999999;
            letter-spacing: 1px;
        }

        .menu {
            margin-top: 28px;
        }

        .menu-title {
            color: #777777;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 12px;
            margin-bottom: 10px;
        }

        .menu a {
            display: block;
            color: #bbbbbb;
            padding: 13px 14px;
            margin-bottom: 5px;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #222222;
            color: #ffffff;
        }

        .menu a.active {
            background: #ffd400;
            color: #111111;
            font-weight: bold;
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

        /* MAIN */

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* TOPBAR */

        .topbar {
            height: 75px;
            background: #ffffff;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .topbar-title {
            font-size: 14px;
            color: #777777;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            background: #ffd400;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .admin-text strong {
            display: block;
            font-size: 13px;
        }

        .admin-text span {
            display: block;
            font-size: 11px;
            color: #888888;
            margin-top: 3px;
        }

        /* CONTENT */

        .content {
            padding: 35px;
            max-width: 1100px;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .breadcrumb {
            font-size: 12px;
            color: #999999;
            margin-bottom: 8px;
        }

        .breadcrumb span {
            color: #111111;
            font-weight: bold;
        }

        .page-header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #777777;
            font-size: 14px;
        }

        /* FORM CARD */

        .form-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 30px;
            border: 1px solid #e7e7e7;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eeeeee;
        }

        .section-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #ffd400;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: bold;
        }

        .section-title h2 {
            font-size: 17px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .required {
            color: #e00000;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            padding: 12px 14px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #111111;
            background: #ffffff;
            outline: none;
            transition: 0.2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #ffd400;
            box-shadow: 0 0 0 3px rgba(255, 212, 0, 0.15);
        }

        textarea {
            resize: vertical;
            min-height: 130px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .file-box {
            border: 1px dashed #cccccc;
            border-radius: 10px;
            padding: 18px;
            background: #fafafa;
        }

        .file-box input {
            background: #ffffff;
        }

        .file-note {
            font-size: 11px;
            color: #888888;
            margin-top: 8px;
            line-height: 1.5;
        }

        /* BUTTON */

        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #eeeeee;
        }

        .btn {
            display: inline-block;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            text-align: center;
        }

        .btn-primary {
            background: #ffd400;
            color: #111111;
        }

        .btn-primary:hover {
            background: #e6be00;
        }

        .btn-primary:disabled {
            background: #dddddd;
            color: #888888;
            cursor: not-allowed;
        }

        .btn-secondary {
            background: #eeeeee;
            color: #333333;
        }

        .btn-secondary:hover {
            background: #dddddd;
        }

        /* PESAN STATUS */

        #pesanProduk {
            display: none;
            margin-top: 18px;
            padding: 13px 15px;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.5;
        }

        #pesanProduk.sukses {
            display: block;
            background: #eaf8ee;
            color: #1f7a3f;
            border: 1px solid #b9e5c7;
        }

        #pesanProduk.gagal {
            display: block;
            background: #fff0f0;
            color: #c62828;
            border: 1px solid #f0bcbc;
        }

        #pesanProduk.proses {
            display: block;
            background: #fff9dc;
            color: #806b00;
            border: 1px solid #f0df78;
        }

        /* MOBILE */

        @media (max-width: 950px) {

            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
            }

            .content {
                padding: 25px;
            }

        }

        @media (max-width: 768px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding: 18px;
            }

            .brand {
                padding-bottom: 18px;
            }

            .menu {
                margin-top: 18px;
            }

            .menu a {
                display: inline-block;
                margin-right: 5px;
            }

            .sidebar-bottom {
                position: relative;
                bottom: auto;
                left: auto;
                right: auto;
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                padding: 0 20px;
            }

            .content {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

        }

        @media (max-width: 550px) {

            .topbar {
                height: auto;
                padding: 15px 18px;
            }

            .topbar-title {
                display: none;
            }

            .admin-info {
                margin-left: auto;
            }

            .content {
                padding: 15px;
            }

            .form-card {
                padding: 20px;
            }

            .page-header h1 {
                font-size: 23px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }

        }

    </style>

</head>

<body>

    <aside class="sidebar">

        <div class="brand">

            <h2>MAHIRA <span>PRINTING</span></h2>

            <p>ADMIN PANEL</p>

        </div>

        <div class="menu">

            <div class="menu-title">
                Menu Utama
            </div>

            <a href="index.php">
                Dashboard
            </a>

            <a href="produk.php" class="active">
                Produk
            </a>

        </div>

        <div class="sidebar-bottom">

            <a href="../index.php" class="website-btn">
                Lihat Website
            </a>

            <a href="logout.php" class="logout-btn">
                Logout
            </a>

        </div>

    </aside>

    <main class="main">

        <div class="topbar">

            <div class="topbar-title">
                Mahira Printing / Produk
            </div>

            <div class="admin-info">

                <div class="admin-avatar">
                    <?php echo strtoupper(substr($nama_admin, 0, 1)); ?>
                </div>

                <div class="admin-text">

                    <strong>
                        <?php echo htmlspecialchars($nama_admin); ?>
                    </strong>

                    <span>
                        Administrator
                    </span>

                </div>

            </div>

        </div>

        <div class="content">

            <div class="page-header">

                <div class="breadcrumb">
                    Katalog Mahira Printing / <span>Tambah Produk</span>
                </div>

                <h1>
                    Tambah Produk
                </h1>

                <p>
                    Tambahkan produk baru ke dalam katalog Mahira Printing.
                </p>

            </div>

            <div class="form-card">

                <form
                    id="formProduk"
                    action="proses_produk.php"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    <input
                        type="hidden"
                        name="aksi"
                        value="tambah"
                    >

                    <div class="section-title">

                        <div class="section-number">
                            1
                        </div>

                        <h2>
                            Informasi Produk
                        </h2>

                    </div>

                    <div class="form-group">

                        <label>
                            Nama Produk <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="nama"
                            placeholder="Contoh: Banner Promosi"
                            required
                        >

                    </div>

                    <div class="form-row">

                        <div class="form-group">

                            <label>
                                Kategori <span class="required">*</span>
                            </label>

                            <select
                                name="kategori"
                                required
                            >

                                <option value="">
                                    Pilih kategori
                                </option>

                                <option value="Textile & Sablon">
                                    Textile & Sablon
                                </option>

                                <option value="Advertising & Signage">
                                    Advertising & Signage
                                </option>

                                <option value="Custom & Souvenir">
                                    Custom & Souvenir
                                </option>

                                <option value="Kertas & Desain">
                                    Kertas & Desain
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>
                                Harga <span class="required">*</span>
                            </label>

                            <input
                                type="number"
                                name="harga"
                                min="0"
                                placeholder="Contoh: 50000"
                                required
                            >

                        </div>

                    </div>

                    <div class="form-group">

                        <label>
                            Stok <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            name="stok"
                            min="0"
                            placeholder="Contoh: 10"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            Deskripsi Produk <span class="required">*</span>
                        </label>

                        <textarea
                            name="deskripsi"
                            placeholder="Jelaskan detail produk, bahan, ukuran, kegunaan, atau informasi lainnya."
                            required
                        ></textarea>

                    </div>

                    <div class="section-title">

                        <div class="section-number">
                            2
                        </div>

                        <h2>
                            Foto Produk
                        </h2>

                    </div>

                    <div class="form-group">

                        <label>
                            Gambar Produk
                        </label>

                        <div class="file-box">

                            <input
                                type="file"
                                name="gambar"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <div class="file-note">
                                Format yang didukung: JPG, JPEG, PNG, atau WEBP.
                            </div>

                        </div>

                    </div>

                    <div class="form-actions">

                        <a
                            href="produk.php"
                            class="btn btn-secondary"
                        >
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                            id="btnSimpan"
                        >
                            Simpan Produk
                        </button>

                    </div>

                    <div id="pesanProduk"></div>

                </form>

            </div>

        </div>

    </main>

    <script>

        document.getElementById("formProduk").addEventListener("submit", function(e) {

            e.preventDefault();

            var form = this;
            var tombol = document.getElementById("btnSimpan");
            var pesan = document.getElementById("pesanProduk");

            pesan.className = "proses";
            pesan.innerHTML = "Sedang menyimpan produk...";

            tombol.disabled = true;
            tombol.innerHTML = "Menyimpan...";

            var data = new FormData(form);

            fetch("proses_produk.php", {
                method: "POST",
                body: data
            })

            .then(function(response) {

                if (!response.ok) {
                    throw new Error("Server error");
                }

                return response.json();

            })

            .then(function(result) {

                if (result.status === "success") {

                    pesan.className = "sukses";
                    pesan.innerHTML = result.message;

                    form.reset();

                    tombol.disabled = false;
                    tombol.innerHTML = "Simpan Produk";

                } else {

                    pesan.className = "gagal";
                    pesan.innerHTML = result.message;

                    tombol.disabled = false;
                    tombol.innerHTML = "Simpan Produk";

                }

            })

            .catch(function(error) {

                pesan.className = "gagal";

                pesan.innerHTML =
                    "Produk gagal disimpan. Terjadi kesalahan pada server.";

                tombol.disabled = false;
                tombol.innerHTML = "Simpan Produk";

            });

        });

    </script>

</body>

</html>
