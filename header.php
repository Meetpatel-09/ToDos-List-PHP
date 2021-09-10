<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">

  <title><?php echo $title; ?></title>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">To-Dos List</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="signup.php">Sign Up</a>
            </li>
          </ul>
          <form class="d-flex">
          <?php
                session_start();
                if(isset($_SESSION['loggedin'])) { // means user is logged in
            ?>
            <a class="btn btn-outline-danger btn-sm" href="signout.php">Sign Out</a>
            <?php   
                } else { 
            ?>
              <a class="btn btn-outline-success  btn-sm" href="signin.php">Sign In</a>
            <?php
                }
            ?>
          </form>
        </div>
      </div>
    </nav>
  </header>