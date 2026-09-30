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

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Mahira Printing | Percetakan & Digital Printing
    </title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>


<?php require_once "includes/header.php"; ?>


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

                <div class="mini-icon">
                    A
                </div>

                <strong>
                    Design
                </strong>

                <small>
                    Creative
                </small>

            </div>


            <div class="print-card card-two">

                <div class="mini-icon">
                    P
                </div>

                <strong>
                    Printing
                </strong>

                <small>
                    Quality Print
                </small>

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

            <strong>
                01
            </strong>

            <span>
                Solusi Percetakan
            </span>

        </div>


        <div class="stat-item reveal">

            <strong>
                02
            </strong>

            <span>
                Desain & Custom
            </span>

        </div>


        <div class="stat-item reveal">

            <strong>
                03
            </strong>

            <span>
                Untuk Bisnis & Personal
            </span>

        </div>


        <div class="stat-item reveal">

            <strong>
                04
            </strong>

            <span>
                Pesan via WhatsApp
            </span>

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


<?php require_once "includes/footer.php"; ?>