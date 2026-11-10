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
    <link rel="stylesheet" href="css/dark-theme.css">
  </head>
  <body>
    
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
            <li class="nav-item active"><a href="login.php" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="admin.php" class="nav-link">Login Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="ftco-section contact-section py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 block-9 mb-md-5">
            <h2 class="text-center mb-4 font-weight-bold">Login Admin / User</h2>
            
            <form action="login.php" method="POST" class="p-5 contact-form rounded shadow-sm border">
              <div class="form-group">
                <label for="username" class="font-weight-bold">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
              </div>
              <div class="form-group">
                <label for="password" class="font-weight-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
              </div>
              <div class="form-group mb-0">
                <input type="submit" value="Masuk Ke Akun" class="btn btn-primary py-3 px-5 btn-block font-weight-bold">
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