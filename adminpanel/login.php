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
            $_SESSION['username'] = $row['username'];
            $_SESSION['login'] = true;
            header('location: index.php');
        } else {
            $message = "Username atau password salah!";
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-box {
            border-radius: 15px;
            background-color: #ffffff;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>
    <div class="main d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-box p-5 shadow-lg">
            <h3 class="text-center mb-4">Login</h3>
            <form action="" method="post" style="width: 300px;">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div>
                    <button class="btn btn-success form-control" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
            <?php if (!empty($message)): ?>
                <div class="mt-3 text-center alert alert-danger" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
