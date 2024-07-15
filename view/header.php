<?php
  session_start();

  if (!isset($_SESSION['logged_in'])) 
  {
    $_SESSION['logged_in'] = false;
  }
  if (!isset($_SESSION['user'])) 
  {
    $_SESSION['user'] = array();
  }
  if (!isset($_SESSION['cart'])) 
  {
    $_SESSION['cart'] = array();
  }


  $timeout_duration = 15 * 60; // 15 minutes
  if (isset($_SESSION['logged_in']) && isset($_SESSION['last_activity'])) 
  {
      $elapsed_time = time() - $_SESSION['last_activity'];
      if ($elapsed_time > $timeout_duration)
          header("Location: https://www2.scptuj.si/~branda.luka/sptrg3a1-24/controler/logout.php");
  }
  $_SESSION['last_activity'] = time();

  ini_set("display_startup_errors", 1);
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trgovina Branda</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/css/style_main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="icon" type="image/png" href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/slike/titleimg.png"/>
</head>

<body>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <button id="navbar-toggler" class="btn btn-outline-secondary">
              <span class="navbar-toggler-icon"></span>
            </button>
          </li>
          <li class="nav-item">
            <h3><a href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/index.php" id = "main-page-text">Spletna Trgovina</a></h3>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <div class="d-flex justify-content-center align-items-center">
              <a href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/cart.php"><i class="fas fa-shopping-cart" id="cart-icon"></i></a>
              <span class="badge bg-primary rounded-pill position-absolute translate-middle" id="shopping-cart-badge"><?php echo count($_SESSION['cart'])?></span>
            </div>
          </li>
          <?php 
            if (!$_SESSION['logged_in']) {
          ?>
            <li class="nav-item">
              <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">Login</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" data-toggle="modal" data-target="#registerModal">Register</a>
            </li>
        <?php 
          } else {
         ?>
              <li class="nav-item">
                <a href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/controler/user.php" class="nav-link">
        <?php 
          echo $_SESSION['user']['username']; 
        ?>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal">Logout</a>
              </li>
        <?php 
          }
        ?>
        </ul>
        <div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <form action="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/controler/login.php" method="post">

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                  </div>
                  <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
              </div>
            </div>
          </div>
        </div>


        <div class="modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/controler/register.php" method="post" id="registerForm">

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                  </div>
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Enter Password again">
                  </div>
                  <button type="submit" class="btn btn-success" name="register">Register</button>

                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Are you sure you want to log out?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>User: <?php echo $_SESSION['user']['username']?></p>
                <form action="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/controler/logout.php" method="post" id="logoutForm">
                  <button type="submit" class="btn btn-success" name="log_out">Logout</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <div class="sidebar" id="sidebar">
      <ul>
        <li><a href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/index.php">Home</a></li>
        <li><a href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/artikli.php">Artikli</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <?php 
        if($_SESSION['role'] == 'admin')
        {
      ?>
          <ul>
            <li><a href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/vnos_artikla.php">Vnos artikla</a></li>
            <li><a href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/vnos_proizvajalca.php">Vnos proizvajalca</a></li>
            <li><a href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/error.php">Error page</a></li>
          </ul>
      <?php 
        } 
      ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/script/script_main.js"></script> 