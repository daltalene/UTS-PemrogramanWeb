<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $cek   = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['admin'] = $data['username'];
        $_SESSION['nama']  = $data['nama_lengkap'];
        
        header("Location: admin.php");
        exit();
    } else {
        $error = "Username atau Password yang Anda masukkan salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login - Carbook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.php">Car<span>Book</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="car.php" class="nav-link">Katalog</a></li>
            <?php if (isset($_SESSION['admin'])): ?>
                <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
            <?php else: ?>
                <li class="nav-item active"><a href="login.php" class="nav-link">Login</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <section class="ftco-section contact-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 block-9 mb-md-5">
            <h2 class="text-center mb-4">Login Admin</h2>
            
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger text-center mb-4" role="alert">
                <?php echo $error; ?>
              </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="bg-light p-5 contact-form rounded shadow-sm">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
              </div>
              <div class="form-group mt-4">
                <input type="submit" name="login" value="Login" class="btn btn-primary py-3 px-5 w-100">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>