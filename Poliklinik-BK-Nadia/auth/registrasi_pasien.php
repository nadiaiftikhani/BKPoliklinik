<?php
session_start();

require '../functions/connect_database.php';
require '../functions/pasien_functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        $username = $_POST["username"];

        $_SESSION["login"] = "true";
        $_SESSION["username"] = $username;

        echo "<script>
        alert('User baru berhasil ditambahkan!');
        </script>";
        header("Location: ../pages/pasien/dashboard_pasien.php?username=$username");
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-[100vh] bg-gradient-to-r from-blue-200 to-blue-500">
    <form action="" method="post" class="bg-white w-[450px] px-6 py-10 rounded-lg shadow-lg">
        <h1 class="text-center text-3xl font-semibold text-blue-600">Register Pasien</h1>
        <div class="flex flex-col gap-5 mt-7">
            <div class="flex gap-3">
                <input type="text" name="username" id="" required placeholder="Username"
                    class="bg-blue-50 w-full px-5 py-3 outline-none rounded-lg border-2 border-blue-300 focus:ring-2 focus:ring-blue-400">

                <input type="password" name="password" id="" required placeholder="Password"
                    class="bg-blue-50 w-full px-5 py-3 outline-none rounded-lg border-2 border-blue-300 focus:ring-2 focus:ring-blue-400">
            </div>

            <input type="text" name="nama" id="" required placeholder="Nama"
                class="bg-blue-50 px-5 py-3 outline-none rounded-lg border-2 border-blue-300 focus:ring-2 focus:ring-blue-400">

            <input type="text" name="alamat" id="" required placeholder="Alamat"
                class="bg-blue-50 px-5 py-3 outline-none rounded-lg border-2 border-blue-300 focus:ring-2 focus:ring-blue-400">

            <input type="number" name="no_ktp" id="" required placeholder="Nomor KTP"
                class="bg-blue-50 px-5 py-3 outline-none rounded-lg border-2 border-blue-300 focus:ring-2 focus:ring-blue-400">

            <input type="number" name="no_hp" id="" required placeholder="Nomor HP"
                class="bg-blue-50 px-5 py-3 outline-none rounded-lg border-2 border-blue-300 focus:ring-2 focus:ring-blue-400">
            <input type="hidden" name="role" value="pasien">

            <select id="id_dokter" name="id_dokter" class="bg-blue-50 px-5 py-3 outline-none rounded-lg border-2 border-blue-300 focus:ring-2 focus:ring-blue-400">
                <?php
                $query = "SELECT * FROM dokter";
                $result = mysqli_query($conn, $query);
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $id_dokter = $row["id"];
                    $dokter = $row["username"];
                    echo "<option value='$id_dokter'>$dokter</option>";
                }
                ?>
            </select>

            <button type="submit" name="register"
                class=" bg-gradient-to-r from-blue-400 to-blue-600 text-white py-3 font-medium rounded-lg hover:bg-blue-700 transition-all duration-300">Register</button>

            <div class="flex justify-center gap-2 mt-4">
                <h1 class="text-blue-600">Sudah punya akun?</h1>
                <a href="login_pasien.php" class="font-medium underline text-blue-600">Login</a>
            </div>
        </div>
    </form>
</body>

</html>