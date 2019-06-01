<!DOCTYPE html>
<html lang="en">
<?php
session_start();
 ?>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Knjigomat</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">

</head>

<body>
<?php
$_SERVER['REQUEST_METHOD']
?>




  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Knjigomat</a>

    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Prikaz profila</h1>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <h4>Ime: </h4><h3><?php echo $_SESSION['ime'] ?></h3><br />
          <h4>Priimek: </h4><h3><?php echo $_SESSION['priimek'] ?></h3><br />
          <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $_SESSION['qr'] ?>&choe=UTF-8" />
        </div>
      </div>
    </div>
  </header>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>