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

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #111111;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            color: #111111;
        }

        .login-wrapper {
            width: 100%;
            max-width: 950px;
            min-height: 560px;
            background: #ffffff;
            display: grid;
            grid-template-columns: 45% 55%;
            overflow: hidden;
            border-radius: 18px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        /* =========================
           LEFT SIDE
        ========================= */

        .login-brand {
            background: #ffd400;
            padding: 55px 45px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .login-brand::before {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            background: #111111;
            border-radius: 50%;
            right: -100px;
            top: -80px;
            opacity: 0.08;
        }

        .login-brand::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border: 25px solid #111111;
            border-radius: 50%;
            left: -90px;
            bottom: -80px;
            opacity: 0.08;
        }

        .brand-content {
            position: relative;
            z-index: 2;
        }

        .brand-logo {
            margin-bottom: 80px;
        }

        .brand-logo span {
            display: block;
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 4px;
            margin-bottom: 5px;
        }

        .brand-logo h1 {
            font-size: 38px;
            line-height: 1;
            font-weight: 900;
            letter-spacing: -1px;
        }

        .brand-title {
            font-size: 38px;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .brand-description {
            font-size: 15px;
            line-height: 1.7;
            max-width: 320px;
        }

        .brand-footer {
            position: relative;
            z-index: 2;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* =========================
           RIGHT SIDE
        ========================= */

        .login-form-area {
            padding: 60px 65px;
            display: flex;
            align-items: center;
        }

        .login-content {
            width: 100%;
            max-width: 390px;
            margin: auto;
        }

        .login-heading {
            margin-bottom: 35px;
        }

        .login-heading .small-title {
            color: #d2ae00;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .login-heading h2 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 800;
        }

        .login-heading p {
            color: #777777;
            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================
           ALERT
        ========================= */

        .alert {
            background: #fff3f3;
            border-left: 4px solid #d93025;
            color: #b42318;
            padding: 13px 15px;
            font-size: 13px;
            margin-bottom: 22px;
            border-radius: 5px;
        }

        /* =========================
           FORM
        ========================= */

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            height: 50px;
            border: 1px solid #dddddd;
            border-radius: 8px;
            padding: 0 15px;
            font-size: 14px;
            outline: none;
            background: #fafafa;
            transition: 0.3s;
        }

        .input-wrapper input:focus {
            border-color: #ffd400;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(255, 212, 0, 0.15);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            color: #666666;
        }

        .password-toggle:hover {
            color: #111111;
        }

        /* =========================
           BUTTON
        ========================= */

        .login-button {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 8px;
            background: #111111;
            color: #ffffff;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 5px;
        }

        .login-button:hover {
            background: #ffd400;
            color: #111111;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 212, 0, 0.25);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #666666;
            text-decoration: none;
            font-size: 13px;
            transition: 0.2s;
        }

        .back-link:hover {
            color: #111111;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            .login-wrapper {
                max-width: 500px;
                grid-template-columns: 1fr;
            }

            .login-brand {
                min-height: 260px;
                padding: 35px;
            }

            .brand-logo {
                margin-bottom: 35px;
            }

            .brand-logo h1 {
                font-size: 30px;
            }

            .brand-title {
                font-size: 28px;
            }

            .brand-description {
                display: none;
            }

            .brand-footer {
                margin-top: 30px;
            }

            .login-form-area {
                padding: 45px 35px;
            }

        }

        @media (max-width: 500px) {

            body {
                padding: 15px;
            }

            .login-wrapper {
                border-radius: 12px;
            }

            .login-brand {
                padding: 30px 25px;
            }

            .brand-logo {
                margin-bottom: 25px;
            }

            .brand-logo h1 {
                font-size: 27px;
            }

            .brand-title {
                font-size: 24px;
            }

            .login-form-area {
                padding: 35px 25px;
            }

            .login-heading h2 {
                font-size: 27px;
            }

        }

    </style>

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