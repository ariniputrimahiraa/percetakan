```php
<?php

require_once "config/database.php";

$id = isset($_GET['id'])
    ? (int)$_GET['id']
    : 0;

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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo htmlspecialchars($produk['nama']); ?> | Mahira Printing</title>

<style>

* {
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background: #f6f6f6;
    color: #111111;
}

a {
    text-decoration: none;
}

.container {
    width: 90%;
    max-width: 1180px;
    margin: auto;
}

/* =========================
NAVBAR
========================= */

.navbar {
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    padding: 15px 0;
    background: rgba(17, 17, 17, 0.96);
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
}

.nav-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo {
    display: flex;
    flex-direction: column;
    line-height: 0.85;
    color: #ffffff;
    width: 170px;
}

.logo span {
    font-size: 24px;
    font-weight: 900;
    letter-spacing: 2px;
}

.logo small {


    color: #ffd400;
    font-size: 9px;
    font-weight: bold;
    letter-spacing: 4px;
    margin-top: 6px;
}

.nav-menu {
    display: flex;
    gap: 32px;
}

.nav-menu a {
    color: #ffffff;
    font-size: 14px;
    font-weight: bold;
    position: relative;
}

.nav-menu a:after {
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    background: #ffd400;
    bottom: -8px;
    left: 0;
    transition: 0.3s;
}

.nav-menu a:hover:after,
.nav-menu a.active:after {
    width: 100%;
}

.nav-button {
    background: #ffd400;
    color: #111111;
    padding: 12px 20px;
    border-radius: 4px;
    font-size: 13px;
    font-weight: bold;
}

.menu-toggle {
    display: none;
    border: none;
    background: none;
    color: #ffffff;
    font-size: 25px;
    cursor: pointer;
}

/* =========================
DETAIL HEADER
========================= */

.detail-header {
    background: #111111;
    color: #ffffff;
    padding: 135px 0 55px;
    position: relative;
    overflow: hidden;
}

.detail-pattern {
    position: absolute;
    width: 400px;
    height: 400px;
    right: -160px;
    top: -170px;
    border: 55px solid #ffd400;
    border-radius: 50%;
    opacity: 0.08;
}

.breadcrumb {
    position: relative;
    z-index: 2;
    font-size: 12px;
    color: #888888;
}

.breadcrumb a {
    color: #ffd400;
}

.breadcrumb span {
    margin: 0 8px;
}

/* =========================
DETAIL
========================= */

.detail-section {
    padding: 75px 0 100px;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 70px;
    align-items: start;
}

/* =========================
IMAGE
========================= */

.detail-image-wrapper {
    background: #ffffff;
    position: relative;
    overflow: hidden;
}

.detail-image {
    width: 100%;
    height: auto;
    object-fit: contain;
    display: block;
}

.detail-no-image {
    width: 100%;
    min-height: 400px;
    background: #111111;
    color: #ffd400;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: bold;
    letter-spacing: 3px;
}

.detail-tag {
    position: absolute;
    top: 20px;
    left: 20px;
    background: #ffd400;
    color: #111111;
    padding: 8px 12px;
    font-size: 10px;
    font-weight: bold;
}

/* =========================
INFO
========================= */

.detail-info {
    padding-top: 10px;
}

.detail-category {
    color: #d1ad00;
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: bold;
    text-transform: uppercase;
}

.detail-info h1 {
    font-size: 46px;
    line-height: 1.1;
    margin: 15px 0 20px;
}

.detail-price {
    font-size: 25px;
    font-weight: 900;
    margin-bottom: 30px;
}

.detail-divider {
    height: 1px;
    background: #dddddd;
    margin-bottom: 25px;
}

.detail-description-title {
    font-size: 12px;
    font-weight: bold;
    letter-spacing: 2px;
    margin-bottom: 10px;
}

.detail-description {
    color: #666666;
    font-size: 14px;
    line-height: 1.8;
    margin-bottom: 30px;
}

.detail-stock {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #ffffff;
    padding: 13px 18px;
    border-left: 4px solid #ffd400;
    font-size: 13px;
    margin-bottom: 30px;
}

.detail-stock strong {
    font-size: 14px;
}

.detail-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-yellow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    padding: 15px 25px;
    background: #ffd400;
    color: #111111;
    font-size: 14px;
    font-weight: bold;
    border-radius: 4px;
    transition: 0.3s;
}

.btn-yellow:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(255, 212, 0, 0.25);
}

.btn-dark {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    padding: 15px 25px;
    background: #111111;
    color: #ffffff;
    font-size: 14px;
    font-weight: bold;
    border-radius: 4px;
    transition: 0.3s;
}

.btn-dark:hover {
    background: #ffd400;
    color: #111111;
}

/* =========================
PRODUCT INFO
========================= */

.product-note {
    margin-top: 50px;
    background: #ffffff;
    padding: 25px;
    border-left: 4px solid #ffd400;
}

.product-note strong {
    display: block;
    font-size: 13px;
    margin-bottom: 8px;
}

.product-note p {
    color: #777777;
    font-size: 12px;
    line-height: 1.7;
    margin: 0;
}

/* =========================
CTA
========================= */

.cta {
    background: #111111;
    color: #ffffff;
    padding: 80px 0;
}

.cta-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.cta span {
    color: #ffd400;
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: bold;
}

.cta h2 {
    font-size: 42px;
    line-height: 1.1;
    margin: 15px 0 0;
}

.cta h2 strong {
    color: #ffd400;
}

/* =========================
FOOTER
========================= */

footer {
    background: #090909;
    color: #ffffff;
    padding: 35px 0;
}

.footer-content {
    display: flex;
    align-items: center;
    gap: 25px;
}

.footer-logo {
    display: flex;
    flex-direction: column;
    width: 130px;
}

.footer-logo strong {
    font-size: 20px;
}

.footer-logo span {
    color: #ffd400;
    font-size: 9px;
    letter-spacing: 3px;
}

.footer-content p {
    color: #777777;
    font-size: 12px;
}

.copyright {
    margin-left: auto;
}

/* =========================
BACK TOP
========================= */

.back-top {
    position: fixed;
    right: 25px;
    bottom: 25px;
    width: 45px;
    height: 45px;
    background: #ffd400;
    color: #111111;
    border: none;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: 0.3s;
    z-index: 999;
}

.back-top.show {
    opacity: 1;
    visibility: visible;
}

/* =========================
RESPONSIVE
========================= */

@media(max-width: 950px) {
    .detail-grid {
        gap: 40px;
    }

    .detail-info h1 {
        font-size: 38px;
    }
}

@media(max-width: 768px) {
    .nav-button {
        display: none;
    }

    .menu-toggle {
        display: block;
    }

    .nav-menu {
        position: absolute;
        top: 75px;
        left: 0;
        width: 100%;
        padding: 20px 5%;
        background: #111111;
        display: none;
        flex-direction: column;
    }

    .nav-menu.show {
        display: flex;
    }

    .detail-header {
        padding: 125px 0 45px;
    }

    .detail-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .detail-image-wrapper {
        height: auto;
    }

    .detail-info {
        padding-top: 0;
    }

    .cta-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 30px;
    }
}

@media(max-width: 550px) {
    .container {
        width: 88%;
    }

    .detail-image-wrapper {
        height: auto;
    }

    .detail-info h1 {
        font-size: 34px;
    }

    .detail-price {
        font-size: 22px;
    }

    .detail-actions {
        flex-direction: column;
    }

    .detail-actions a {
        width: 100%;
    }

    .cta h2 {
        font-size: 32px;
    }

    .footer-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .copyright {
        margin-left: 0;
    }
}
</style>

</head>

<body>

<!-- NAVBAR -->

<header class="navbar">

    <div class="container nav-content">

        <a href="index.php" class="logo">

             <img src="assets/img/logo1.png" alt="">
        </a>


        <nav class="nav-menu">

            <a href="index.php">
                Beranda
            </a>

            <a href="produk.php" class="active">
                Produk
            </a>

            <a href="tentang.php">
                Tentang Kami
            </a>

        </nav>


        <a
            href="https://wa.me/628xxxxxxxxxx"
            target="_blank"
            class="nav-button"
        >
            Pesan Sekarang
        </a>


        <button
            class="menu-toggle"
            id="menuToggle"
            type="button"
        >
            ☰
        </button>

    </div>

</header>


<!-- DETAIL HEADER -->

<section class="detail-header">

    <div class="detail-pattern"></div>

    <div class="container">

        <div class="breadcrumb">

            <a href="index.php">
                Beranda
            </a>

            <span> / </span>

            <a href="produk.php">
                Produk
            </a>

            <span> / </span>

            Detail Produk

        </div>

    </div>

</section>


<!-- DETAIL PRODUCT -->

<section class="detail-section">

    <div class="container">

        <div class="detail-grid">


            <!-- IMAGE -->

            <div class="detail-image-wrapper">

                <?php if (!empty($produk['gambar'])): ?>

                    <img
                        src="uploads/produk/<?php echo htmlspecialchars($produk['gambar']); ?>"
                        class="detail-image"
                        alt="<?php echo htmlspecialchars($produk['nama']); ?>"
                    >

                <?php else: ?>

                    <div class="detail-no-image">
                        MAHIRA PRINTING
                    </div>

                <?php endif; ?>


                <div class="detail-tag">
                    PRODUK MAHIRA
                </div>

            </div>


            <!-- INFO -->

            <div class="detail-info">

                <span class="detail-category">

                    <?php

                    if (!empty($produk['kategori'])) {

                        echo htmlspecialchars(
                            $produk['kategori']
                        );

                    } else {

                        echo 'PRODUK';

                    }

                    ?>

                </span>


                <h1>
                    <?php echo htmlspecialchars($produk['nama']); ?>
                </h1>


                <div class="detail-price">

                    Rp <?php echo number_format(
                        $produk['harga'],
                        0,
                        ',',
                        '.'
                    ); ?>

                </div>


                <div class="detail-divider"></div>


                <div class="detail-description-title">
                    DESKRIPSI PRODUK
                </div>


                <div class="detail-description">

                    <?php

                    if (!empty($produk['deskripsi'])) {

                        echo nl2br(
                            htmlspecialchars(
                                $produk['deskripsi']
                            )
                        );

                    } else {

                        echo 'Informasi produk belum tersedia.';

                    }

                    ?>

                </div>


                <div class="detail-stock">

                    <span>
                        Stok
                    </span>

                    <strong>
                        <?php echo $produk['stok']; ?>
                    </strong>

                </div>


                <div class="detail-actions">

                    <a
                        href="https://wa.me/628xxxxxxxxxx"
                        target="_blank"
                        class="btn-yellow"
                    >
                        Pesan Sekarang
                        <span>→</span>
                    </a>


                    <a
                        href="produk.php"
                        class="btn-dark"
                    >
                        Kembali ke Produk
                    </a>

                </div>


                <div class="product-note">

                    <strong>
                        BUTUH CUSTOM?
                    </strong>

                    <p>
                        Jika produk ingin disesuaikan dengan ukuran,
                        desain, warna, jumlah, atau kebutuhan lainnya,
                        silakan konsultasikan terlebih dahulu melalui
                        WhatsApp Mahira Printing.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- CTA -->

<section class="cta">

    <div class="container cta-content">

        <div>

            <span>
                BUTUH CETAKAN?
            </span>

            <h2>
                Punya kebutuhan cetak?
                <br>
                <strong>Mari kita kerjakan.</strong>
            </h2>

        </div>


        <a
            href="https://wa.me/628xxxxxxxxxx"
            target="_blank"
            class="btn-yellow"
        >
            Hubungi Mahira
            <span>→</span>
        </a>

    </div>

</section>


<!-- FOOTER -->

<footer>

    <div class="container footer-content">

        <div class="footer-logo">

             <img src="assets/img/logo1.png" alt="">


        </div>


        <p>
            Percetakan & Digital Printing
        </p>


        <p class="copyright">
            © 2026 Mahira Printing. All rights reserved.
        </p>

    </div>

</footer>


<!-- BACK TO TOP -->

<button
    id="backTop"
    class="back-top"
    type="button"
>
    ↑
</button>


<script>

var backTop = document.getElementById("backTop");
var menuToggle = document.getElementById("menuToggle");
var navMenu = document.querySelector(".nav-menu");

window.addEventListener("scroll", function() {

    if (window.scrollY > 400) {

        backTop.classList.add("show");

    } else {

        backTop.classList.remove("show");

    }

});


backTop.addEventListener("click", function() {

    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });

});


menuToggle.addEventListener("click", function() {

    navMenu.classList.toggle("show");

});

</script>

</body>

</html>
```
