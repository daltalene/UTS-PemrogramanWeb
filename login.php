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
  <body class="bg-light">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ftco-navbar-light awake" id="ftco-navbar" style="background: #1089ff !important; top: 0; position: relative;">
      <div class="container">
        <a class="navbar-brand text-white" href="index.php">Car<span style="color: #01d28e;">Book</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
            <li class="nav-item"><a href="car.php" class="nav-link text-white">Katalog</a></li>
            <li class="nav-item active"><a href="login.php" class="nav-link" style="color: #01d28e !important;">Login</a></li>
            <li class="nav-item"><a href="admin.php" class="nav-link text-white">Login Admin</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="ftco-section contact-section py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 block-9 mb-md-5">
            <h2 class="text-center mb-4 font-weight-bold">Login Admin / User</h2>
            
            <form action="login.php" method="POST" class="bg-white p-5 contact-form rounded shadow-sm border">
              <div class="form-group">
                <label for="username" class="font-weight-bold text-dark">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
              </div>
              <div class="form-group">
                <label for="password" class="font-weight-bold text-dark">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
              </div>
              <div class="form-group mb-0">
                <input type="