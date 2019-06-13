<!DOCTYPE html>
<html lang="en">

<?php
session_start();
 ?>
 <?php if(isset($_SESSION["id"])){
     header("Location: knjiznica.php");
 } ?>
<head>
  <style>
  <?php  include'css/style.css'; ?>
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Knjigomat</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css">
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">

  <link href="css/bard.css" rel="stylesheet">

</head>

<body>

<?php
$_SERVER['REQUEST_METHOD']
?>





  <!-- Navigation -->
  <nav class="navbar navbar-light static-top">
    <div class="container" id="navbar">
      <a class="navbar-brand" href="index.php">Knjigomat</a>

    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Prijava</h1>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form  action="login.php" method="post">
  <div class="form-group">
    <label for="email">Vnesite E-pošto:</label>
    <input type="email" class="form-control" name="email" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Vnesite Geslo:</label>
    <input type="password" class="form-control" name="geslo" id="pwd">
  </div>
  <button type="submit" name="prijava" class="btn btn-primary">Prijava</button>
</form>

        </div>
      </div>
    </div>
  </header>

  <?php
    if(array_key_exists('prijava',$_POST)){
      $fields = array("method" => "mymethod", "email" => "myemail");
      //echo $isci." ".$cat;ž
      $email=$_POST['email'];
      $geslo=$_POST['geslo'];

      $url = "http://localhost:8880/projekt/rest/upoti/upot/";
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
        $res= curl_exec($ch);
    //  print_r($result);
        curl_close($ch);
        $obja= json_decode($res,true);
        print_r($obja);
  $preveri=false;
  echo $obja;
              if(isset($obja)){
              foreach($obja as $i) { //foreach element in $arr

                echo $i["email"]." ".$i["password"];
                $valid1=strcmp($i["email"],$email);
                $valid2=strcmp($i["password"],$geslo);
                echo $valid1." ".$valid2;
             if($i["email"]==$email &&$i["password"]==$geslo ){
               $pot = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
               $streznik = $_SERVER["HTTP_HOST"];
               $preveri=true;
           $_SESSION["id"] =$i["id"];
           $_SESSION["ime"] =$i["ime"];
           $_SESSION["priimek"] =$i["priimek"];;
           $_SESSION["qr"] =$i["qrUporabnik"];;
             header("Location: http://$streznik$pot/knjiznica.php");

             }


            }
           }

  if($preveri==false){
   ?>

<h3>Neuspešna prijava!</h3>

<?php }} ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>



</html>
