<?php

require_once "config/database.php";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($produk['nama']); ?> | Mahira Printing</title>

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include "includes/header.php"; ?>


<!-- DETAIL HEADER -->

<section class="detail-header">

    <div class="detail-pattern"></div>

    <div class="container">

        <div class="breadcrumb">

            <a href="index.php">Beranda</a>

            <span> / </span>

            <a href="produk.php">Produk</a>

            <span> / </span>

            Detail Produk

        </div>

    </div>

</section>


<!-- DETAIL PRODUCT -->

<section class="detail-section">

    <div class="container">

        <div class="detail-grid">

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


            <div class="detail-info">

                <span class="detail-category">

                    <?php

                    if (!empty($produk['kategori'])) {

                        echo htmlspecialchars($produk['kategori']);

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

                    <span>Stok</span>

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


<?php include "includes/footer.php"; ?>

</body>

</html>