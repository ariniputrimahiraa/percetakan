<header class="navbar" id="navbar">

    <div class="container nav-content">

        <a href="index.php" class="logo">
            <img src="assets/img/logo1.png" alt="Mahira Printing">
        </a>

        <nav class="nav-menu">

            <a href="index.php">
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
<script>

    document.addEventListener("DOMContentLoaded", function () {

    var menuToggle = document.getElementById("menuToggle");
    var navMenu = document.querySelector(".nav-menu");
    var navbar = document.getElementById("navbar");

    /* =========================
       NAVBAR ACTIVE
    ========================= */

    var currentPage = window.location.pathname.split("/").pop();

    if (currentPage == "") {
        currentPage = "index.php";
    }

    var navLinks = navMenu.querySelectorAll("a");

    navLinks.forEach(function (link) {

        var linkPage = link.getAttribute("href").split("/").pop();

        if (linkPage == currentPage) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }

    });


    /* =========================
       MOBILE MENU
    ========================= */

    if (menuToggle && navMenu) {

        menuToggle.addEventListener("click", function () {

            navMenu.classList.toggle("active");

            if (navMenu.classList.contains("active")) {
                menuToggle.innerHTML = "✕";
            } else {
                menuToggle.innerHTML = "☰";
            }

        });


        /* Tutup menu setelah klik link */

        navLinks.forEach(function (link) {

            link.addEventListener("click", function () {

                navMenu.classList.remove("active");
                menuToggle.innerHTML = "☰";

            });

        });


        /* Tutup menu ketika klik di luar */

        document.addEventListener("click", function (event) {

            if (
                navbar &&
                !navbar.contains(event.target) &&
                navMenu.classList.contains("active")
            ) {

                navMenu.classList.remove("active");
                menuToggle.innerHTML = "☰";

            }

        });

    }

});
</script>