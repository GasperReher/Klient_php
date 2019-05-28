<!DOCTYPE html>
<html lang="en">


<style>
<?php  include'css/style.css'; ?>
</style>

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


$_SERVER['REQUEST_METHOD'];
$id=$_GET["id"];

$fields = array("method" => "mymethod", "email" => "myemail");
//echo $isci." ".$cat;ž

$url = "http://localhost:8880/projekt/rest/knjige/knjiga/$id";
  $fields = json_encode($fields);
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Content-Length: ' . strlen($fields))
  );
  $result= curl_exec($ch);

  curl_close($ch);
  $obj = json_decode($result,true);
  $zanr=$obj['vrsta'];



  $fields = array("method" => "mymethod", "email" => "myemail");
  //echo $isci." ".$cat;ž

  $url = "http://localhost:8880/projekt/rest/knjige/iskanje/vrsta&$zanr";
    $fields = json_encode($fields);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($fields))
    );
    $result= curl_exec($ch);

    curl_close($ch);
    $obje = json_decode($result,true);

?>




  <!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top nav">
    <div class="container">
      <a class="navbar-brand" href="knjiznica.php">Knjigomat</a>
        <a class="navbar-brand" href="index.php">Odjava</a>

    </div>
  </nav>

  <!-- Masthead -->


  <!-- Icons Grid -->
  <section class="slike "  >

      <div class="row scrolling-wrapper" style="width:100%">

        <?php
        if(isset($obje)){
        foreach($obje as $i) { //foreach element in $arr

          ?>


            <div class="scroll-item">
              <a href="knjiga.php?id=<?php echo $i['id'] ?>">
              <img class="male" src="<?php echo $i['naslovnica'] ?>">
              </a>
            </div>



    <?php } } ?>


    </div>

  </section>

  <!-- Image Showcases -->
  <section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img" >
          <img class="cela" src="<?php echo $obj['naslovnica'] ?>">
        </div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2><?php echo $obj['naslov'] ?></h2>
          <p class="lead mb-0">Avtor: <?php echo $obj['avtor'] ?></p>
          <p class="lead mb-0">Žanr: <?php echo $obj['vrsta'] ?></p>
          <?php if( $obj['stanje']==1){ ?>
          <br />
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
              <div class="form-group">
                <select name="masina" class="form-control">
                  <?php
                  $fields = array("method" => "mymethod", "email" => "myemail");
                  //echo $isci." ".$cat;ž

                  $url = "http://localhost:8880/projekt/rest/masina/vsi/";
                    $fields = json_encode($fields);
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);
                    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($fields))
                    );
                    $result= curl_exec($ch);

                    curl_close($ch);
                    $knjigomati = json_decode($result,true);



                      foreach($knjigomati as $i) {

                   ?>
                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php } ?>

                </select>

              </div>


              <button type="submit" name="naroci" class="btn btn-block btn-lg btn-primary">Naroči</button>
            </form>

        </div>
      </div>

  </section>
<?php } ?>
<?php
if(array_key_exists('naroci',$_POST)){
  $idUpo=$_SESSION['id'];
  $idKnjiga=$_GET["id"];
  $masina=$_POST['masina'];


  $fields = array("method" => "mymethod", "email" => "myemail");
  //echo $isci." ".$cat;ž

  $url = "http://localhost:8880/projekt/rest/narocilo/dodaj/$idUpo&$idKnjiga&$masina";
    $fields = json_encode($fields);
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($fields))
    );
    $result= curl_exec($ch);

    curl_close($ch);




    if($result=='Uspesno'){
    }
     ?>
     <div class="alert" style="padding: 20px; background-color: green; color: white; margin-bottom: 15px;">
       <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
       Naročilo uspešno oddano!
     </div>
    <?php } ?>




  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
              <a href="#">About</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contact</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
          </ul>
          <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2019. All Rights Reserved.</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-twitter-square fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-instagram fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
