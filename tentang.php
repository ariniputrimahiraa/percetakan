```php
<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tentang Kami | Mahira Printing</title>

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
    width: 500px;
    height: 500px;
    right: -200px;
    top: -170px;
    border: 65px solid #ffd400;
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
ABOUT
========================= */

.about {
    padding: 100px 0;
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}

.about-label {
    color: #d1ad00;
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: bold;
}

.about-content h2 {
    font-size: 42px;
    line-height: 1.15;
    margin: 15px 0 25px;
}

.about-content h2 span {
    color: #d1ad00;
}

.about-content p {
    color: #666666;
    font-size: 15px;
    line-height: 1.8;
    margin-bottom: 18px;
}

/* ABOUT VISUAL */

.about-visual {
    position: relative;
    min-height: 430px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.about-circle {
    width: 350px;
    height: 350px;
    background: #ffd400;
    border-radius: 50%;
    position: absolute;
}

.about-card {
    width: 300px;
    height: 350px;
    background: #111111;
    color: #ffffff;
    position: relative;
    z-index: 2;
    padding: 45px 35px;
    transform: rotate(5deg);
    box-shadow: 20px 20px 0 #eeeeee;
}

.about-card-label {
    color: #ffd400;
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: bold;
}

.about-card h3 {
    font-size: 38px;
    margin: 25px 0 10px;
    line-height: 1;
}

.about-card h3 span {
    color: #ffd400;
}

.about-line {
    width: 100%;
    height: 7px;
    background: #ffd400;
    margin: 30px 0;
}

.about-card p {
    color: #aaaaaa;
    font-size: 11px;
    line-height: 1.7;
    letter-spacing: 1px;
}

/* =========================
VALUES
========================= */

.values {
    background: #f6f6f6;
    padding: 100px 0;
}

.section-heading {
    max-width: 700px;
    margin-bottom: 50px;
}

.section-heading span {
    color: #d1ad00;
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: bold;
}

.section-heading h2 {
    font-size: 42px;
    line-height: 1.1;
    margin: 15px 0;
}

.section-heading p {
    color: #777777;
    line-height: 1.7;
}

.value-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.value-card {
    background: #ffffff;
    padding: 35px;
    min-height: 260px;
    transition: 0.3s;
}

.value-card:hover {
    transform: translateY(-8px);
}

.value-number {
    font-size: 12px;
    color: #999999;
    font-weight: bold;
}

.value-card h3 {
    font-size: 22px;
    margin-top: 65px;
}

.value-card p {
    color: #666666;
    font-size: 13px;
    line-height: 1.7;
}

.value-card.dark {
    background: #111111;
    color: #ffffff;
}

.value-card.dark p {
    color: #aaaaaa;
}

.value-card.dark h3 {
    color: #ffd400;
}

.value-card.yellow {
    background: #ffd400;
}

/* =========================
CONTACT
========================= */

.contact {
    background: #111111;
    color: #ffffff;
    padding: 90px 0;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 70px;
    align-items: center;
}

.contact-label {
    color: #ffd400;
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: bold;
}

.contact h2 {
    font-size: 42px;
    line-height: 1.1;
    margin: 15px 0;
}

.contact h2 strong {
    color: #ffd400;
}

.contact-description {
    color: #aaaaaa;
    line-height: 1.8;
    font-size: 14px;
}

.contact-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.contact-item {
    background: #1b1b1b;
    border-left: 3px solid #ffd400;
    padding: 20px 22px;
}

.contact-item small {
    display: block;
    color: #888888;
    font-size: 10px;
    letter-spacing: 2px;
    margin-bottom: 7px;
}

.contact-item strong {
    color: #ffffff;
    font-size: 14px;
}

/* =========================
CTA
========================= */

.cta {
    background: #ffd400;
    color: #111111;
    padding: 70px 0;
}

.cta-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.cta span {
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: bold;
}

.cta h2 {
    font-size: 38px;
    line-height: 1.1;
    margin: 12px 0 0;
}

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 15px;
    padding: 15px 24px;
    background: #111111;
    color: #ffd400;
    font-weight: bold;
    font-size: 14px;
    border-radius: 4px;
    transition: 0.3s;
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
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
RESPONSIVE
========================= */

@media(max-width: 950px) {

    .nav-menu {
        gap: 15px;
    }

    .about-grid {
        gap: 40px;
    }

}

@media(max-width: 768px) {

   

    .about {
        padding: 70px 0;
    }

    .about-grid {
        grid-template-columns: 1fr;
    }

    .about-visual {
        min-height: 400px;
        order: -1;
    }

    .value-grid {
        grid-template-columns: 1fr 1fr;
    }

    .contact-grid {
        grid-template-columns: 1fr;
        gap: 40px;
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

    .page-header h1 {
        font-size: 36px;
    }

    .about-content h2,
    .section-heading h2 {
        font-size: 34px;
    }

    .about-circle {
        width: 280px;
        height: 280px;
    }

    .about-card {
        width: 250px;
        height: 300px;
        padding: 35px 28px;
    }

    .about-card h3 {
        font-size: 32px;
    }

    .value-grid {
        grid-template-columns: 1fr;
    }

    .contact h2 {
        font-size: 34px;
    }

    .cta h2 {
        font-size: 32px;
    }

    

    .copyright {
        margin-left: 0;
    }

}

</style>

</head>

<body>

<!-- NAVBAR -->

<?php include "includes/header.php"; ?>


<!-- PAGE HEADER -->

<section class="page-header">

    <div class="page-pattern"></div>

    <div class="container page-header-content reveal">

        <span class="page-label">
            TENTANG MAHIRA PRINTING
        </span>

        <h1>
            Lebih dari Sekadar
            <span>Percetakan.</span>
        </h1>

        <p>
            Mengenal Mahira Printing dan layanan yang kami hadirkan
            untuk membantu memenuhi berbagai kebutuhan cetak,
            desain, dan custom.
        </p>

    </div>

</section>


<!-- ABOUT -->

<section class="about">

    <div class="container about-grid">

        <div class="about-content reveal">

            <span class="about-label">
                SIAPA KAMI
            </span>

            <h2>
                Solusi Cetak untuk
                <span>Berbagai Kebutuhan.</span>
            </h2>

            <p>
                Mahira Printing merupakan usaha yang bergerak
                di bidang percetakan dan digital printing dengan
                menyediakan berbagai kebutuhan cetak, desain,
                custom, dan produk promosi.
            </p>

            <p>
                Kami melayani kebutuhan untuk bisnis, acara,
                promosi, organisasi, maupun kebutuhan personal.
                Berbagai produk dapat disesuaikan dengan kebutuhan
                pelanggan, mulai dari produk berbahan kertas,
                textile, signage, hingga souvenir dan custom.
            </p>

            <p>
                Mahira Printing berkomitmen untuk memberikan
                pelayanan yang mudah dan membantu pelanggan
                menemukan solusi yang sesuai dengan kebutuhan
                cetaknya.
            </p>

        </div>


        <div class="about-visual reveal">

            <div class="about-circle"></div>

            <div class="about-card">

                <div class="about-card-label">
                    MAHIRA
                </div>

                <h3>
                    PRINTING
                    <span>.</span>
                </h3>

                <div class="about-line"></div>

                <p>
                    PRINT<br>
                    DESIGN<br>
                    CUSTOM<br>
                    CREATIVE
                </p>

            </div>

        </div>

    </div>

</section>


<!-- VALUES -->

<section class="values">

    <div class="container">

        <div class="section-heading reveal">

            <span>
                NILAI KAMI
            </span>

            <h2>
                Yang Kami Utamakan
                <br>
                dalam Melayani.
            </h2>

            <p>
                Setiap kebutuhan pelanggan menjadi bagian dari
                proses kami dalam memberikan layanan percetakan.
            </p>

        </div>


        <div class="value-grid">

            <div class="value-card reveal">

                <div class="value-number">
                    01
                </div>

                <h3>
                    Kualitas
                </h3>

                <p>
                    Mengutamakan hasil cetak yang rapi dan sesuai
                    dengan kebutuhan pelanggan.
                </p>

            </div>


            <div class="value-card dark reveal">

                <div class="value-number">
                    02
                </div>

                <h3>
                    Solusi
                </h3>

                <p>
                    Membantu pelanggan menentukan pilihan produk
                    dan kebutuhan cetak yang sesuai.
                </p>

            </div>


            <div class="value-card yellow reveal">

                <div class="value-number">
                    03
                </div>

                <h3>
                    Pelayanan
                </h3>

                <p>
                    Memberikan proses pemesanan yang mudah dan
                    komunikasi yang jelas dengan pelanggan.
                </p>

            </div>

        </div>

    </div>

</section>


<!-- CONTACT -->

<section class="contact">

    <div class="container contact-grid">

        <div class="reveal">

            <span class="contact-label">
                HUBUNGI KAMI
            </span>

            <h2>
                Ada kebutuhan
                <strong>cetak?</strong>
            </h2>

            <p class="contact-description">
                Konsultasikan kebutuhan cetak, desain, atau custom
                kamu bersama Mahira Printing.
            </p>

        </div>


        <div class="contact-list reveal">

            <div class="contact-item">

                <small>
                    WHATSAPP
                </small>

                <strong>
                    088291614900
                </strong>

            </div>


            <div class="contact-item">

                <small>
                    INSTAGRAM
                </small>

                <strong>
                    @mahiraprinting
                </strong>

            </div>


            <div class="contact-item">

                <small>
                    LAYANAN
                </small>

                <strong>
                    Printing • Design • Custom
                </strong>

            </div>

        </div>

    </div>

</section>


<!-- CTA -->

<section class="cta">

    <div class="container cta-content reveal">

        <div>

            <span>
                SIAP CETAK?
            </span>

            <h2>
                Punya kebutuhan?
                <br>
                Mari kita kerjakan.
            </h2>

        </div>

        <a
            href="https://wa.me/6288291614900"
            target="_blank"
            class="cta-button"
        >
            Hubungi Mahira
            <span>→</span>
        </a>

    </div>

</section>


<!-- FOOTER -->

<?php include "includes/footer.php"; ?>


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
```
