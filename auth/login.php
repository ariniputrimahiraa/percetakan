<?php

session_start();

if (isset($_SESSION['admin_id'])) {
    header("Location: ../admin/index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - Mahira Printing</title>
 <link rel="stylesheet" href="../assets/css/style.css">
    

</head>

<body>

<div class="login-wrapper">

    <div class="login-brand">

        <div class="brand-content">

            <div class="brand-logo">
                <span>MAHIRA</span>
                <h1>PRINTING</h1>
            </div>

            <div class="brand-title">
                Kelola Percetakan<br>
                Lebih Mudah.
            </div>

            <p class="brand-description">
                Kelola produk, katalog, portfolio, dan informasi Mahira Printing melalui dashboard admin.
            </p>

        </div>

        <div class="brand-footer">
            ADMIN PANEL • MAHIRA PRINTING
        </div>

    </div>


    <div class="login-form-area">

        <div class="login-content">

            <div class="login-heading">

                <div class="small-title">
                    Admin Panel
                </div>

                <h2>Selamat Datang</h2>

                <p>
                    Silakan masuk untuk mengakses dashboard Mahira Printing.
                </p>

            </div>


            <?php

            if (isset($_SESSION['error'])) {

                echo '<div class="alert">'
                    . htmlspecialchars($_SESSION['error']) .
                    '</div>';

                unset($_SESSION['error']);

            }

            ?>


            <form
                action="proses_login.php"
                method="POST"
            >

                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <div class="input-wrapper">

                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Masukkan username"
                            autocomplete="username"
                            required
                        >

                    </div>

                </div>


                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword()"
                            id="toggleButton"
                        >
                            LIHAT
                        </button>

                    </div>

                </div>


                <button
                    type="submit"
                    class="login-button"
                >
                    MASUK KE DASHBOARD
                </button>

            </form>


            <a
                href="../index.php"
                class="back-link"
            >
                ← Kembali ke Website
            </a>

        </div>

    </div>

</div>


<script>

function togglePassword() {

    var password = document.getElementById("password");
    var button = document.getElementById("toggleButton");

    if (password.type === "password") {

        password.type = "text";
        button.innerHTML = "SEMBUNYIKAN";

    } else {

        password.type = "password";
        button.innerHTML = "LIHAT";

    }

}

</script>

</body>

</html>