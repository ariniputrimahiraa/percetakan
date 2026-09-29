<?php

require_once "config/database.php";

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk
     ORDER BY id DESC
     LIMIT 3"
);

?>

<!DOCTYPE html>

<html lang="id">

<head>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mahira Printing | Percetakan & Digital Printing</title>

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
padding: 22px 0;
background: transparent;
transition: 0.3s;
}

.navbar.scrolled {
background: rgba(17, 17, 17, 0.96);
padding: 15px 0;
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
HERO
========================= */

.hero {
min-height: 720px;
background: #111111;
color: #ffffff;
position: relative;
overflow: hidden;
display: flex;
align-items: center;
}

.hero-pattern {
position: absolute;
width: 650px;
height: 650px;
right: -250px;
top: 50px;
border: 80px solid #ffd400;
border-radius: 50%;
opacity: 0.08;
}

.hero-content {
display: grid;
grid-template-columns: 1fr 0.9fr;
gap: 70px;
align-items: center;
padding-top: 80px;
}

.hero-label {
color: #ffd400;
font-size: 12px;
font-weight: bold;
letter-spacing: 3px;
}

.hero h1 {
font-size: 68px;
line-height: 1.02;
margin: 20px 0;
max-width: 650px;
}

.hero h1 span {
color: #ffd400;
}

.hero p {
color: #cccccc;
font-size: 17px;
line-height: 1.8;
max-width: 560px;
}

.hero-buttons {
display: flex;
gap: 14px;
margin-top: 35px;
}

.btn {
display: inline-flex;
align-items: center;
gap: 15px;
padding: 15px 24px;
font-weight: bold;
font-size: 14px;
border-radius: 4px;
transition: 0.3s;
}

.btn-yellow {
background: #ffd400;
color: #111111;
}

.btn-yellow:hover {
transform: translateY(-3px);
box-shadow: 0 12px 25px rgba(255, 212, 0, 0.25);
}

.btn-outline {
border: 1px solid #555555;
color: #ffffff;
}

.btn-outline:hover {
border-color: #ffd400;
color: #ffd400;
}

/* HERO VISUAL */

.hero-visual {
min-height: 450px;
position: relative;
display: flex;
align-items: center;
justify-content: center;
}

.yellow-circle {
width: 330px;
height: 330px;
border-radius: 50%;
background: #ffd400;
position: absolute;
}

.hero-box {
width: 300px;
height: 350px;
background: #ffffff;
color: #111111;
position: relative;
z-index: 2;
padding: 45px 35px;
transform: rotate(-5deg);
box-shadow: 25px 25px 0 #222222;
}

.box-top {
font-size: 32px;
font-weight: 900;
letter-spacing: 3px;
}

.box-middle {
font-size: 14px;
font-weight: bold;
letter-spacing: 6px;
color: #777777;
margin-top: 8px;
}

.box-line {
height: 8px;
width: 100%;
background: #ffd400;
margin-top: 60px;
}

.hero-box p {
color: #111111;
font-size: 10px;
font-weight: bold;
letter-spacing: 2px;
}

.print-card {
position: absolute;
z-index: 4;
background: #111111;
border: 2px solid #ffd400;
padding: 15px 20px;
display: flex;
flex-direction: column;
min-width: 130px;
box-shadow: 8px 8px 0 rgba(0, 0, 0, 0.2);
}

.print-card strong {
margin-top: 8px;
}

.print-card small {
color: #aaaaaa;
margin-top: 3px;
}

.mini-icon {
width: 32px;
height: 32px;
display: flex;
align-items: center;
justify-content: center;
background: #ffd400;
color: #111111;
font-weight: 900;
}

.card-one {
left: 10px;
top: 70px;
transform: rotate(-8deg);
}

.card-two {
right: 0;
bottom: 70px;
transform: rotate(7deg);
}

/* =========================
STATS
========================= */

.stats {
background: #ffd400;
}

.stats-grid {
display: grid;
grid-template-columns: repeat(4, 1fr);
}

.stat-item {
padding: 28px 20px;
border-right: 1px solid rgba(0, 0, 0, 0.12);
}

.stat-item strong {
display: block;
font-size: 28px;
font-weight: 900;
}

.stat-item span {
display: block;
margin-top: 5px;
font-size: 13px;
font-weight: bold;
}

/* =========================
SERVICES
========================= */

.services {
padding: 110px 0;
}

.section-heading {
max-width: 700px;
margin-bottom: 55px;
}

.section-heading span,
.product-heading span,
.cta span {
color: #d1ad00;
font-size: 11px;
letter-spacing: 3px;
font-weight: bold;
}

.section-heading h2,
.product-heading h2 {
font-size: 44px;
line-height: 1.1;
margin: 15px 0;
}

.section-heading p {
color: #777777;
line-height: 1.7;
}

.service-grid {
display: grid;
grid-template-columns: repeat(4, 1fr);
gap: 18px;
}

.service-card {
padding: 35px;
min-height: 300px;
background: #f4f4f4;
transition: 0.3s;
}

.service-card:hover {
transform: translateY(-8px);
}

.service-number {
font-size: 12px;
color: #888888;
font-weight: bold;
}

.service-card h3 {
font-size: 22px;
margin-top: 70px;
}

.service-card p {
color: #666666;
font-size: 13px;
line-height: 1.7;
}

.service-card a {
display: inline-block;
margin-top: 15px;
color: #111111;
font-size: 13px;
font-weight: bold;
}

.dark-card {
background: #111111;
color: #ffffff;
}

.dark-card p {
color: #aaaaaa;
}

.dark-card a {
color: #ffd400;
}

.yellow-card {
background: #ffd400;
}

/* =========================
PRODUCTS
========================= */

.products {
padding: 100px 0;
background: #f6f6f6;
}

.product-heading {
display: flex;
justify-content: space-between;
align-items: end;
margin-bottom: 45px;
}

.product-heading h2 {
margin-bottom: 0;
}

.product-heading h2 span {
color: #111111;
font-size: inherit;
letter-spacing: 0;
}

.view-all {
color: #111111;
font-size: 13px;
font-weight: bold;
}

.product-grid {
display: grid;
grid-template-columns: repeat(3, 1fr);
gap: 25px;
}

.product-card {
background: #ffffff;
transition: 0.3s;
overflow: hidden;
}

.product-card:hover {
transform: translateY(-7px);
box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.product-image-wrapper {
    position: relative;
    overflow: hidden;
    background: #eeeeee;
}

.product-image {
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
    transition: 0.5s;
}

.product-card:hover .product-image {
transform: scale(1.05);
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

.product-tag {
position: absolute;
top: 15px;
left: 15px;
background: #ffd400;
color: #111111;
padding: 7px 10px;
font-size: 9px;
font-weight: bold;
}

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
margin: 8px 0 20px;
}

.product-bottom {
display: flex;
align-items: center;
justify-content: space-between;
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
BACK TO TOP
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
REVEAL ANIMATION
========================= */

.reveal {
opacity: 0;
transform: translateY(30px);
transition: 0.7s ease;
}

.reveal.active {
opacity: 1;
transform: translateY(0);
}

/* =========================
RESPONSIVE
========================= */

@media(max-width: 950px) {


.nav-menu {
    gap: 15px;
}

.hero h1 {
    font-size: 52px;
}

.hero-content {
    gap: 30px;
}

.service-grid {
    grid-template-columns: repeat(2, 1fr);
}


}

@media(max-width: 768px) {


.navbar {
    background: #111111;
}

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

.hero {
    min-height: auto;
    padding: 120px 0 70px;
}

.hero-content {
    grid-template-columns: 1fr;
}

.hero h1 {
    font-size: 45px;
}

.hero-visual {
    min-height: 400px;
}

.stats-grid {
    grid-template-columns: repeat(2, 1fr);
}

.product-grid {
    grid-template-columns: 1fr 1fr;
}

.product-heading {
    align-items: start;
    flex-direction: column;
    gap: 20px;
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

.hero h1 {
    font-size: 39px;
}

.hero p {
    font-size: 15px;
}

.hero-buttons {
    flex-direction: column;
    align-items: stretch;
}

.hero-buttons .btn {
    justify-content: center;
}

.hero-box {
    width: 250px;
    height: 300px;
}

.yellow-circle {
    width: 280px;
    height: 280px;
}

.card-one {
    left: 0;
}

.card-two {
    right: 0;
}

.service-grid {
    grid-template-columns: 1fr;
}

.product-grid {
    grid-template-columns: 1fr;
}

.section-heading h2,
.product-heading h2 {
    font-size: 35px;
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

<header class="navbar" id="navbar">


<div class="container nav-content">

    <a href="index.php" class="logo">
        <img src="assets/img/logo1.png" alt="">
    </a>

    <nav class="nav-menu">

        <a href="index.php" class="active">
            Beranda
        </a>

        <a href="produk.php">
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

<!-- HERO -->

<section class="hero">


<div class="hero-pattern"></div>

<div class="container hero-content">

    <div class="hero-text reveal">

        <span class="hero-label">
            PERCETAKAN & DIGITAL PRINTING
        </span>

        <h1>
            Cetak Apa Saja,
            <span>Lebih Mudah.</span>
        </h1>

        <p>
            Solusi percetakan untuk kebutuhan bisnis, acara,
            promosi, hingga kebutuhan personal dengan hasil
            yang rapi dan berkualitas.
        </p>

        <div class="hero-buttons">

            <a
                href="produk.php"
                class="btn btn-yellow"
            >
                Lihat Produk
                <span>→</span>
            </a>

            <a
                href="https://wa.me/6288291614900"
                target="_blank"
                class="btn btn-outline"
            >
                Konsultasi
            </a>

        </div>

    </div>

    <div class="hero-visual reveal">

        <div class="yellow-circle"></div>

        <div class="print-card card-one">
            <div class="mini-icon">A</div>
            <strong>Design</strong>
            <small>Creative</small>
        </div>

        <div class="print-card card-two">
            <div class="mini-icon">P</div>
            <strong>Printing</strong>
            <small>Quality Print</small>
        </div>

        <div class="hero-box">

            <div class="box-top">
                MAHIRA
            </div>

            <div class="box-middle">
                PRINTING
            </div>

            <div class="box-line"></div>

            <p>
                PRINT • DESIGN • CUSTOM
            </p>

        </div>

    </div>

</div>


</section>

<!-- STATS -->

<section class="stats">


<div class="container stats-grid">

    <div class="stat-item reveal">
        <strong>01</strong>
        <span>Solusi Percetakan</span>
    </div>

    <div class="stat-item reveal">
        <strong>02</strong>
        <span>Desain & Custom</span>
    </div>

    <div class="stat-item reveal">
        <strong>03</strong>
        <span>Untuk Bisnis & Personal</span>
    </div>

    <div class="stat-item reveal">
        <strong>04</strong>
        <span>Pesan via WhatsApp</span>
    </div>

</div>


</section>

<!-- LAYANAN -->

<section class="services">


<div class="container">

    <div class="section-heading reveal">

        <span>
            LAYANAN KAMI
        </span>

        <h2>
            Semua Kebutuhan Cetak
            <br>
            Ada di Sini.
        </h2>

        <p>
            Pilih kebutuhanmu dan temukan produk yang sesuai
            untuk bisnis, acara, promosi, maupun kebutuhan pribadi.
        </p>

    </div>


    <div class="service-grid">

        <div class="service-card reveal">

            <div class="service-number">
                01
            </div>

            <h3>
                Textile & Sablon
            </h3>

            <p>
                Jersey, kaos sablon dan berbagai kebutuhan
                custom berbahan textile.
            </p>

            <a href="produk.php">
                Lihat layanan →
            </a>

        </div>


        <div class="service-card dark-card reveal">

            <div class="service-number">
                02
            </div>

            <h3>
                Advertising & Signage
            </h3>

            <p>
                Banner, neon box, letter sign dan kebutuhan
                promosi visual lainnya.
            </p>

            <a href="produk.php">
                Lihat layanan →
            </a>

        </div>


        <div class="service-card reveal">

            <div class="service-number">
                03
            </div>

            <h3>
                Custom & Souvenir
            </h3>

            <p>
                Piala, souvenir, gelas sablon dan berbagai
                produk custom untuk kebutuhan acara.
            </p>

            <a href="produk.php">
                Lihat layanan →
            </a>

        </div>


        <div class="service-card yellow-card reveal">

            <div class="service-number">
                04
            </div>

            <h3>
                Kertas & Desain
            </h3>

            <p>
                Nota, undangan, kebutuhan administrasi,
                desain dan berbagai produk berbahan kertas.
            </p>

            <a href="produk.php">
                Lihat layanan →
            </a>

        </div>

    </div>

</div>


</section>

<!-- PRODUK TERBARU -->

<section class="products">


<div class="container">

    <div class="product-heading reveal">

        <div>

            <span>
                PRODUK TERBARU
            </span>

            <h2>
                Pilihan Produk
                <span>Mahira.</span>
            </h2>

        </div>

        <a
            href="produk.php"
            class="view-all"
        >
            Lihat Semua Produk →
        </a>

    </div>


    <div class="product-grid">

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
                        TERBARU
                    </div>

                </div>


                <div class="product-info">

                    <span class="product-category">
                        <?php echo htmlspecialchars($row['kategori']); ?>
                    </span>

                    <h3>
                        <?php echo htmlspecialchars($row['nama']); ?>
                    </h3>

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
        class="btn btn-yellow"
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



</button>

<script>

var navbar = document.getElementById("navbar");
var backTop = document.getElementById("backTop");
var menuToggle = document.getElementById("menuToggle");
var navMenu = document.querySelector(".nav-menu");

window.addEventListener("scroll", function() {

    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
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
