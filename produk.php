<?php

require_once "config/database.php";

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

if ($keyword != '') {

    $keyword_safe = mysqli_real_escape_string(
        $conn,
        $keyword
    );

    $query = mysqli_query(
        $conn,
        "SELECT * FROM produk
         WHERE nama LIKE '%$keyword_safe%'
         ORDER BY id DESC"
    );

} else {

    $query = mysqli_query(
        $conn,
        "SELECT * FROM produk
         ORDER BY id DESC"
    );
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Produk | Mahira Printing</title>

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
    background: #ffffff;
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
    align-items: center;
    width: 170px;
}

.logo img {
    width: 145px;
    height: auto;
    display: block;
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
    transition: 0.3s;
}

.nav-button:hover {
    background: #ffffff;
    transform: translateY(-2px);
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
PAGE HEADER
========================= */

.page-header {
    background: #111111;
    color: #ffffff;
    padding: 150px 0 80px;
    position: relative;
    overflow: hidden;
}

.page-pattern {
    position: absolute;
    width: 450px;
    height: 450px;
    right: -180px;
    top: -150px;
    border: 60px solid #ffd400;
    border-radius: 50%;
    opacity: 0.08;
}

.page-header-content {
    position: relative;
    z-index: 2;
}

.page-label {
    color: #ffd400;
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: bold;
}

.page-header h1 {
    font-size: 52px;
    line-height: 1.1;
    margin: 15px 0;
    max-width: 700px;
}

.page-header h1 span {
    color: #ffd400;
}

.page-header p {
    color: #cccccc;
    max-width: 600px;
    font-size: 15px;
    line-height: 1.8;
    margin: 0;
}

/* =========================
PRODUCT SECTION
========================= */

.products {
    padding: 80px 0 110px;
    background: #f6f6f6;
}

/* =========================
SEARCH
========================= */

.search-box {
    background: #ffffff;
    padding: 25px;
    margin-bottom: 45px;
    border-left: 5px solid #ffd400;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
}

.search-title {
    font-size: 13px;
    font-weight: bold;
    margin-bottom: 15px;
}

.search-form {
    display: flex;
    gap: 10px;
}

.search-form input {
    flex: 1;
    height: 48px;
    border: 1px solid #dddddd;
    padding: 0 15px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
    outline: none;
}

.search-form input:focus {
    border-color: #ffd400;
}

.search-button {
    height: 48px;
    padding: 0 25px;
    border: none;
    background: #111111;
    color: #ffd400;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.search-button:hover {
    background: #ffd400;
    color: #111111;
}

.reset-button {
    height: 48px;
    padding: 0 20px;
    border: 1px solid #dddddd;
    background: #ffffff;
    color: #111111;
    font-weight: bold;
    display: flex;
    align-items: center;
    transition: 0.3s;
}

.reset-button:hover {
    border-color: #111111;
}

/* =========================
PRODUCT HEADING
========================= */

.product-heading {
    display: flex;
    justify-content: space-between;
    align-items: end;
    margin-bottom: 35px;
}

.product-heading span {
    color: #d1ad00;
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: bold;
}

.product-heading h2 {
    font-size: 38px;
    line-height: 1.1;
    margin: 12px 0 0;
}

.product-heading h2 span {
    color: #111111;
    font-size: inherit;
    letter-spacing: normal;
}

.product-count {
    color: #777777;
    font-size: 13px;
}

/* =========================
PRODUCT GRID
========================= */

.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
}

/* =========================
PRODUCT CARD
========================= */

.product-card {
    background: #ffffff;
    overflow: hidden;
    transition: 0.3s;
    border: 1px solid #eeeeee;
}

.product-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

/* =========================
PRODUCT IMAGE
IG 4:5
========================= */

.product-image-wrapper {
    width: 100%;
    aspect-ratio: 4 / 5;
    position: relative;
    overflow: hidden;
    background: #f3f3f3;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: center;
    display: block;
    transition: 0.5s;
}

.product-card:hover .product-image {
    transform: scale(1.03);
}

.no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #111111;
    color: #ffd400;
    font-size: 15px;
    font-weight: bold;
    letter-spacing: 2px;
}

/* =========================
PRODUCT TAG
========================= */

.product-tag {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #ffd400;
    color: #111111;
    padding: 7px 10px;
    font-size: 9px;
    font-weight: bold;
    z-index: 2;
}

/* =========================
PRODUCT INFO
========================= */

.product-info {
    padding: 22px;
}

.product-category {
    color: #999999;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.product-info h3 {
    font-size: 19px;
    line-height: 1.35;
    margin: 8px 0 10px;
}

.product-description {
    color: #777777;
    font-size: 13px;
    line-height: 1.6;
    min-height: 42px;
    margin: 0 0 20px;
}

/* =========================
PRODUCT BOTTOM
========================= */

.product-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid #eeeeee;
    padding-top: 18px;
}

.product-bottom strong {
    font-size: 16px;
}

.detail-button {
    width: 38px;
    height: 38px;
    background: #111111;
    color: #ffd400;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    transition: 0.3s;
}

.detail-button:hover {
    background: #ffd400;
    color: #111111;
}

/* =========================
EMPTY PRODUCT
========================= */

.empty-product {
    background: #ffffff;
    padding: 70px 30px;
    text-align: center;
    grid-column: 1 / -1;
}

.empty-product strong {
    display: block;
    font-size: 20px;
    margin-bottom: 10px;
}

.empty-product p {
    color: #777777;
    font-size: 14px;
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

.btn-yellow {
    display: inline-flex;
    align-items: center;
    gap: 15px;
    padding: 15px 24px;
    background: #ffd400;
    color: #111111;
    font-weight: bold;
    font-size: 14px;
    border-radius: 4px;
    transition: 0.3s;
}

.btn-yellow:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(255, 212, 0, 0.25);
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
    align-items: center;
    width: 130px;
}

.footer-logo img {
    width: 125px;
    height: auto;
    display: block;
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

.back-top:hover {
    background: #111111;
    color: #ffd400;
}

/* =========================
REVEAL
========================= */

.reveal {
    opacity: 0;
    transform: translateY(25px);
    transition: 0.7s ease;
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}

/* =========================
TABLET
========================= */

@media(max-width: 950px) {

    .nav-menu {
        gap: 15px;
    }

    .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}

/* =========================
MOBILE
========================= */

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
        gap: 22px;
    }

    .nav-menu.show {
        display: flex;
    }

    .page-header {
        padding: 130px 0 65px;
    }

    .page-header h1 {
        font-size: 42px;
    }

    .product-heading {
        align-items: flex-start;
        flex-direction: column;
        gap: 10px;
    }

    .search-form {
        flex-wrap: wrap;
    }

    .search-form input {
        width: 100%;
        flex: none;
    }

    .search-button,
    .reset-button {
        flex: 1;
        justify-content: center;
    }

    .cta-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 30px;
    }

}

/* =========================
SMALL MOBILE
========================= */

@media(max-width: 550px) {

    .container {
        width: 88%;
    }

    .logo {
        width: 140px;
    }

    .logo img {
        width: 125px;
    }

    .page-header h1 {
        font-size: 36px;
    }

    .page-header p {
        font-size: 14px;
    }

    .product-grid {
        grid-template-columns: 1fr;
    }

    .product-heading h2 {
        font-size: 32px;
    }

    /*
    Gambar tetap 4:5 seperti
    postingan Instagram
    */
    .product-image-wrapper {
        width: 100%;
        aspect-ratio: 4 / 5;
        height: auto;
    }

    .product-info {
        padding: 20px;
    }

    .product-info h3 {
        font-size: 18px;
    }

    .product-description {
        font-size: 13px;
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

    .back-top {
        right: 18px;
        bottom: 18px;
    }

}
</style>

</head>

<body>

<!-- NAVBAR -->

<header class="navbar" id="navbar">

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
            href="https://wa.me/6288291614900"
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


<!-- PAGE HEADER -->

<section class="page-header">

    <div class="page-pattern"></div>

    <div class="container page-header-content reveal">

        <span class="page-label">
            KATALOG MAHIRA PRINTING
        </span>

        <h1>
            Temukan Produk
            <span>Yang Kamu Butuhkan.</span>
        </h1>

        <p>
            Jelajahi berbagai kebutuhan percetakan, custom,
            promosi, souvenir, dan desain dari Mahira Printing.
        </p>

    </div>

</section>


<!-- PRODUCTS -->

<section class="products">

    <div class="container">

        <!-- SEARCH -->

        <div class="search-box reveal">

            <div class="search-title">
                CARI PRODUK
            </div>

            <form
                method="GET"
                class="search-form"
            >

                <input
                    type="text"
                    name="keyword"
                    placeholder="Cari nama produk..."
                    value="<?php echo htmlspecialchars($keyword); ?>"
                >

                <button
                    type="submit"
                    class="search-button"
                >
                    Cari Produk
                </button>

                <?php if ($keyword != ''): ?>

                    <a
                        href="produk.php"
                        class="reset-button"
                    >
                        Reset
                    </a>

                <?php endif; ?>

            </form>

        </div>


        <!-- HEADING -->

        <div class="product-heading reveal">

            <div>

                <span>
                    <?php
                    if ($keyword != '') {
                        echo 'HASIL PENCARIAN';
                    } else {
                        echo 'SEMUA PRODUK';
                    }
                    ?>
                </span>

                <h2>
                    Pilihan Produk
                    <span>Mahira.</span>
                </h2>

            </div>

            <div class="product-count">

                <?php

                $total_produk = mysqli_num_rows($query);

                echo $total_produk . ' produk ditemukan';

                ?>

            </div>

        </div>


        <!-- PRODUCT GRID -->

        <div class="product-grid">

            <?php if (mysqli_num_rows($query) > 0): ?>

                <?php while ($row = mysqli_fetch_assoc($query)): ?>

                    <div class="product-card reveal">

                        <div class="product-image-wrapper">

                            <?php if (!empty($row['gambar'])): ?>

                                <img
                                    src="uploads/produk/<?php echo htmlspecialchars($row['gambar']); ?>"
                                    class="product-image"
                                    alt="<?php echo htmlspecialchars($row['nama']); ?>"
                                >

                            <?php else: ?>

                                <div class="no-image">
                                    MAHIRA PRINTING
                                </div>

                            <?php endif; ?>

                            <div class="product-tag">
                                MAHIRA
                            </div>

                        </div>


                        <div class="product-info">

                            <span class="product-category">

                                <?php

                                if (!empty($row['kategori'])) {
                                    echo htmlspecialchars($row['kategori']);
                                } else {
                                    echo 'PRODUK';
                                }

                                ?>

                            </span>

                            <h3>
                                <?php echo htmlspecialchars($row['nama']); ?>
                            </h3>

                            <p class="product-description">

                                <?php

                                if (!empty($row['deskripsi'])) {

                                    echo htmlspecialchars(
                                        $row['deskripsi']
                                    );

                                } else {

                                    echo 'Produk percetakan Mahira Printing.';

                                }

                                ?>

                            </p>


                            <div class="product-bottom">

                                <strong>
                                    Rp <?php echo number_format(
                                        $row['harga'],
                                        0,
                                        ',',
                                        '.'
                                    ); ?>
                                </strong>

                                <a
                                    href="detail.php?id=<?php echo $row['id']; ?>"
                                    class="detail-button"
                                >
                                    →
                                </a>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="empty-product">

                    <strong>
                        Produk tidak ditemukan
                    </strong>

                    <p>
                        Coba gunakan kata kunci lain untuk mencari produk.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>


<!-- CTA -->

<section class="cta">

    <div class="container cta-content reveal">

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
            href="https://wa.me/6288291614900"
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

var navbar = document.getElementById("navbar");
var backTop = document.getElementById("backTop");
var menuToggle = document.getElementById("menuToggle");
var navMenu = document.querySelector(".nav-menu");

window.addEventListener("scroll", function() {

    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    }

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


var reveals = document.querySelectorAll(".reveal");

function revealOnScroll() {

    for (var i = 0; i < reveals.length; i++) {

        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 100;

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("active");
        }

    }

}

window.addEventListener("scroll", revealOnScroll);

revealOnScroll();

</script>

</body>

</html>