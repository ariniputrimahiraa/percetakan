
<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

session_start();

header("Content-Type: application/json; charset=UTF-8");

$aksi = isset($_POST['aksi']) ? $_POST['aksi'] : '';

/*
|--------------------------------------------------------------------------
| FUNGSI RESPONSE
|--------------------------------------------------------------------------
*/

function response_json($status, $message)
{
    echo json_encode(
        array(
            "status" => $status,
            "message" => $message
        )
    );

    exit;
}

/*
|--------------------------------------------------------------------------
| CEK AKSI
|--------------------------------------------------------------------------
*/

if ($aksi == '') {

    response_json(
        "error",
        "Aksi tidak ditemukan."
    );
}

/*
|--------------------------------------------------------------------------
| TAMBAH PRODUK
|--------------------------------------------------------------------------
*/

if ($aksi == 'tambah') {

    $nama = isset($_POST['nama'])
        ? trim($_POST['nama'])
        : '';

    $kategori = isset($_POST['kategori'])
        ? trim($_POST['kategori'])
        : '';

    $deskripsi = isset($_POST['deskripsi'])
        ? trim($_POST['deskripsi'])
        : '';

    $harga = isset($_POST['harga'])
        ? $_POST['harga']
        : '';

    $stok = isset($_POST['stok'])
        ? $_POST['stok']
        : '';

    /*
    |--------------------------------------------------------------------------
    | VALIDASI DATA
    |--------------------------------------------------------------------------
    */

    if (
        $nama == '' ||
        $kategori == '' ||
        $deskripsi == '' ||
        $harga == '' ||
        $stok == ''
    ) {

        response_json(
            "error",
            "Semua data wajib diisi."
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI HARGA
    |--------------------------------------------------------------------------
    */

    if (!is_numeric($harga)) {

        response_json(
            "error",
            "Harga harus berupa angka."
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI STOK
    |--------------------------------------------------------------------------
    */

    if (!is_numeric($stok)) {

        response_json(
            "error",
            "Stok harus berupa angka."
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ESCAPE DATA
    |--------------------------------------------------------------------------
    */

    $nama_db = mysqli_real_escape_string(
        $conn,
        $nama
    );

    $kategori_db = mysqli_real_escape_string(
        $conn,
        $kategori
    );

    $deskripsi_db = mysqli_real_escape_string(
        $conn,
        $deskripsi
    );

    /*
    |--------------------------------------------------------------------------
    | CEK PRODUK DUPLIKAT
    |--------------------------------------------------------------------------
    |
    | Nama produk yang sama dalam kategori yang sama
    | tidak boleh disimpan.
    |
    */

    $cek_query = mysqli_query(
        $conn,
        "SELECT id
         FROM produk
         WHERE nama = '$nama_db'
         AND kategori = '$kategori_db'
         LIMIT 1"
    );

    if (!$cek_query) {

        response_json(
            "error",
            "Gagal memeriksa data produk."
        );
    }

    if (mysqli_num_rows($cek_query) > 0) {

        response_json(
            "error",
            "Produk dengan nama dan kategori tersebut sudah ada."
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD GAMBAR
    |--------------------------------------------------------------------------
    */

    $nama_file = null;

    if (
        isset($_FILES['gambar']) &&
        $_FILES['gambar']['error'] != 4
    ) {

        if ($_FILES['gambar']['error'] != 0) {

            response_json(
                "error",
                "Gambar gagal diupload."
            );
        }

        $file = $_FILES['gambar'];

        $extension = strtolower(
            pathinfo(
                $file['name'],
                PATHINFO_EXTENSION
            )
        );

        $allowed = array(
            'jpg',
            'jpeg',
            'png',
            'webp'
        );

        if (!in_array($extension, $allowed)) {

            response_json(
                "error",
                "Format gambar tidak diperbolehkan. Gunakan JPG, JPEG, PNG, atau WEBP."
            );
        }

        if ($file['size'] > 2 * 1024 * 1024) {

            response_json(
                "error",
                "Ukuran gambar maksimal 2 MB."
            );
        }

        $nama_file =
            uniqid() . "." . $extension;

        $lokasi_upload =
            "../uploads/produk/" . $nama_file;

        if (!move_uploaded_file(
            $file['tmp_name'],
            $lokasi_upload
        )) {

            response_json(
                "error",
                "Gambar gagal disimpan."
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | INSERT DATA
    |--------------------------------------------------------------------------
    */

    $query = mysqli_query(
        $conn,
        "INSERT INTO produk
        (
            nama,
            kategori,
            deskripsi,
            harga,
            stok,
            gambar
        )
        VALUES
        (
            '$nama_db',
            '$kategori_db',
            '$deskripsi_db',
            '$harga',
            '$stok',
            '$nama_file'
        )"
    );

    /*
    |--------------------------------------------------------------------------
    | HASIL INSERT
    |--------------------------------------------------------------------------
    */

    if ($query) {

        response_json(
            "success",
            "Produk berhasil ditambahkan."
        );

    } else {

        /*
        |----------------------------------------------------------------------
        | HAPUS GAMBAR JIKA INSERT GAGAL
        |----------------------------------------------------------------------
        */

        if (
            $nama_file != null &&
            file_exists(
                "../uploads/produk/" . $nama_file
            )
        ) {

            unlink(
                "../uploads/produk/" . $nama_file
            );
        }

        response_json(
            "error",
            "Produk gagal ditambahkan."
        );
    }
}


/*
|--------------------------------------------------------------------------
| EDIT PRODUK
|--------------------------------------------------------------------------
*/

if ($aksi == 'edit') {

    $id = isset($_POST['id'])
        ? (int)$_POST['id']
        : 0;

    $nama = isset($_POST['nama'])
        ? trim($_POST['nama'])
        : '';

    $kategori = isset($_POST['kategori'])
        ? trim($_POST['kategori'])
        : '';

    $deskripsi = isset($_POST['deskripsi'])
        ? trim($_POST['deskripsi'])
        : '';

    $harga = isset($_POST['harga'])
        ? $_POST['harga']
        : '';

    $stok = isset($_POST['stok'])
        ? $_POST['stok']
        : '';

    /*
    |--------------------------------------------------------------------------
    | VALIDASI ID
    |--------------------------------------------------------------------------
    */

    if ($id <= 0) {

        response_json(
            "error",
            "ID produk tidak valid."
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI DATA
    |--------------------------------------------------------------------------
    */

    if (
        $nama == '' ||
        $kategori == '' ||
        $deskripsi == '' ||
        $harga == '' ||
        $stok == ''
    ) {

        response_json(
            "error",
            "Semua data wajib diisi."
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI HARGA
    |--------------------------------------------------------------------------
    */

    if (!is_numeric($harga)) {

        response_json(
            "error",
            "Harga harus berupa angka."
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDASI STOK
    |--------------------------------------------------------------------------
    */

    if (!is_numeric($stok)) {

        response_json(
            "error",
            "Stok harus berupa angka."
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ESCAPE DATA
    |--------------------------------------------------------------------------
    */

    $nama_db = mysqli_real_escape_string(
        $conn,
        $nama
    );

    $kategori_db = mysqli_real_escape_string(
        $conn,
        $kategori
    );

    $deskripsi_db = mysqli_real_escape_string(
        $conn,
        $deskripsi
    );

    /*
    |--------------------------------------------------------------------------
    | CEK PRODUK DUPLIKAT SAAT EDIT
    |--------------------------------------------------------------------------
    |
    | Produk yang sedang diedit tidak ikut dihitung.
    |
    */

    $cek_query = mysqli_query(
        $conn,
        "SELECT id
         FROM produk
         WHERE nama = '$nama_db'
         AND kategori = '$kategori_db'
         AND id != $id
         LIMIT 1"
    );

    if (!$cek_query) {

        response_json(
            "error",
            "Gagal memeriksa data produk."
        );
    }

    if (mysqli_num_rows($cek_query) > 0) {

        response_json(
            "error",
            "Produk dengan nama dan kategori tersebut sudah digunakan oleh produk lain."
        );
    }

    /*
    |--------------------------------------------------------------------------
    | AMBIL DATA LAMA
    |--------------------------------------------------------------------------
    */

    $old_query = mysqli_query(
        $conn,
        "SELECT gambar
         FROM produk
         WHERE id = $id
         LIMIT 1"
    );

    if (!$old_query) {

        response_json(
            "error",
            "Gagal mengambil data produk."
        );
    }

    if (mysqli_num_rows($old_query) == 0) {

        response_json(
            "error",
            "Produk tidak ditemukan."
        );
    }

    $old_data = mysqli_fetch_assoc(
        $old_query
    );

    $nama_file = $old_data['gambar'];

    /*
    |--------------------------------------------------------------------------
    | GAMBAR BARU
    |--------------------------------------------------------------------------
    */

    $gambar_baru = false;

    if (
        isset($_FILES['gambar']) &&
        $_FILES['gambar']['error'] != 4
    ) {

        if ($_FILES['gambar']['error'] != 0) {

            response_json(
                "error",
                "Gambar gagal diupload."
            );
        }

        $file = $_FILES['gambar'];

        $extension = strtolower(
            pathinfo(
                $file['name'],
                PATHINFO_EXTENSION
            )
        );

        $allowed = array(
            'jpg',
            'jpeg',
            'png',
            'webp'
        );

        if (!in_array($extension, $allowed)) {

            response_json(
                "error",
                "Format gambar tidak diperbolehkan. Gunakan JPG, JPEG, PNG, atau WEBP."
            );
        }

        if ($file['size'] > 2 * 1024 * 1024) {

            response_json(
                "error",
                "Ukuran gambar maksimal 2 MB."
            );
        }

        $nama_file =
            uniqid() . "." . $extension;

        $lokasi_upload =
            "../uploads/produk/" . $nama_file;

        if (!move_uploaded_file(
            $file['tmp_name'],
            $lokasi_upload
        )) {

            response_json(
                "error",
                "Gambar baru gagal disimpan."
            );
        }

        $gambar_baru = true;
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

    $query = mysqli_query(
        $conn,
        "UPDATE produk SET

        nama = '$nama_db',
        kategori = '$kategori_db',
        deskripsi = '$deskripsi_db',
        harga = '$harga',
        stok = '$stok',
        gambar = '$nama_file'

        WHERE id = $id"
    );

    /*
    |--------------------------------------------------------------------------
    | HASIL UPDATE
    |--------------------------------------------------------------------------
    */

    if ($query) {

        /*
        |----------------------------------------------------------------------
        | HAPUS GAMBAR LAMA JIKA GAMBAR BARU BERHASIL
        |----------------------------------------------------------------------
        */

        if (
            $gambar_baru &&
            $old_data['gambar'] &&
            file_exists(
                "../uploads/produk/" .
                $old_data['gambar']
            )
        ) {

            unlink(
                "../uploads/produk/" .
                $old_data['gambar']
            );
        }

        response_json(
            "success",
            "Produk berhasil diperbarui."
        );

    } else {

        /*
        |----------------------------------------------------------------------
        | JIKA UPDATE GAGAL, HAPUS GAMBAR BARU
        |----------------------------------------------------------------------
        */

        if (
            $gambar_baru &&
            file_exists(
                "../uploads/produk/" .
                $nama_file
            )
        ) {

            unlink(
                "../uploads/produk/" .
                $nama_file
            );
        }

        response_json(
            "error",
            "Produk gagal diperbarui."
        );
    }
}


/*
|--------------------------------------------------------------------------
| AKSI TIDAK DIKENAL
|--------------------------------------------------------------------------
*/

response_json(
    "error",
    "Aksi tidak dikenali."
);

?>

