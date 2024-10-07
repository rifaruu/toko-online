<?php
    session_start();
    require "../koneksi.php";

    $message = '';

    if (isset($_POST['loginbtn'])) {
        $username = mysqli_real_escape_string($con, htmlspecialchars($_POST['username']));
        $password = mysqli_real_escape_string($con, htmlspecialchars($_POST['password']));

        $query = mysqli_query($con, "SELECT * FROM pengguna WHERE username='$username'");
        $row = mysqli_fetch_assoc($query);

        if ($row && password_verify($password, $row['password'])) {
            $message = "Login berhasil!";
            $_SESSION['username'] = $data['username'];
            $_SESSION['login'] = true;
            header('location: index.php');
            // Sesuaikan tindakan setelah login berhasil, seperti redirect ke halaman lain
        } else {
            $message = "Username atau password salah!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="main d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-box p-5 shadow">
            <form action="" method="post" style="width: 300px;">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <button class="btn btn-success form-control" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
            <?php if (!empty($message)): ?>
                <div class="mt-3 text-center">
                    <p><?php echo $message; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
