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

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include "includes/header.php"; ?>


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

                                    echo htmlspecialchars(
                                        $row['kategori']
                                    );

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


<?php include "includes/footer.php"; ?>


<script>

var navbar = document.getElementById("navbar");
var backTop = document.getElementById("backTop");
var menuToggle = document.getElementById("menuToggle");
var navMenu = document.querySelector(".nav-menu");


window.addEventListener("scroll", function() {

    if (navbar && window.scrollY > 50) {

        navbar.classList.add("scrolled");

    }


    if (backTop && window.scrollY > 400) {

        backTop.classList.add("show");

    } else if (backTop) {

        backTop.classList.remove("show");

    }

});


if (backTop) {

    backTop.addEventListener("click", function() {

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

    });

}


if (menuToggle && navMenu) {

    menuToggle.addEventListener("click", function() {

        navMenu.classList.toggle("show");

    });

}


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