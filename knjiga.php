<!DOCTYPE html>
<html lang="en">


<style>
<?php  include'css/style.css'; ?>
</style>

<?php

session_start();
ini_set('memory_limit', '-1');
 ?>
 <?php
if(!isset($_SESSION["id"])){
  header("Location: index.php");
}
if(time()-$_SESSION["timer"]>300){
  header("Location: odjava.php");
}
else{
  $_SESSION["timer"]=time();
}

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

<body onload="load(); setimg();">
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


  if(isset($obj['slika'])) {

  $bytes=$obj['slika'];
  //echo '<img src="data:image/jpeg;base64,'.base64_encode($str->load()) .'" />';
  $string = implode(array_map("chr", $bytes)); //Convert it to string

  $base64 = base64_encode($string); //Encode to base64
  $img = "<img src= 'data:image/jpeg;base64, $base64' style='height:350px'/>"; //Create the image
  }
  else{
    $img = "<img src= 'img/noimg.jpg' style='height:350px'/>";
  }



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
  <nav class="navbar navbar-light  static-top" >
    <div class="container" id="navbar">
      <a class="navbar-brand" href="knjiznica.php">Knjigomat</a>
        <a class="navbar-brand" href="profil.php">Profil</a>
        <a class="navbar-brand" href="odjava.php">Odjava</a>

    </div>
  </nav>

  <!-- Masthead -->


  <!-- Icons Grid -->
  <section class="slike content-to-hide"  >

      <div class="row scrolling-wrapper content-to-hide" style="width:100%">

        <?php
        if(isset($obje)){
        foreach($obje as $i) { //foreach element in $arr
          if(isset($i['slika'])) {

          $bytes=$i['slika'];
          //echo '<img src="data:image/jpeg;base64,'.base64_encode($str->load()) .'" />';
          $string = implode(array_map("chr", $bytes)); //Convert it to string

          $base64 = base64_encode($string); //Encode to base64
          $imga = "<img class='male' src= 'data:image/jpeg;base64, $base64' />"; //Create the image

          }

          else{
            $imga = "<img src= 'img/noimg.jpg' style='height:250px'/>";
          }
          ?>


            <div class="scroll-item male">
              <a href="knjiga.php?id=<?php echo $i['id'] ?>">
              <?php echo $imga ?>
              </a>
            </div>



    <?php } } ?>


    </div>

  </section>

  <!-- Image Showcases -->
  <section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img prikaz" >
          <?php echo $img ?>



        </div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2><?php echo $obj['naslov'] ?></h2>
          <p class="lead mb-0">Avtor: <?php echo $obj['avtor'] ?></p>
          <p class="lead mb-0">Žanr: <?php echo $obj['vrsta'] ?></p>
          <?php if( $obj['stanje']=='navoljo'){ ?>
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
<?php }
else if( $obj['stanje']=='narocena'){
 ?>

 <div class="alert" style="padding: 20px; background-color: red; color: white; margin-bottom: 15px;">
   <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  Knjiga je žal rezervirana!
 </div>

<?php
}
else if( $obj['stanje']=='izposojena'){

  $idK=$obj['id'];
  $ur = "http://localhost:8880/projekt/rest/izposoja/vrniDatum/$idK";

$field = array("method" => "mymethod", "email" => "myemail");

//echo $isci." ".$cat;ž


  $field = json_encode($field);
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $ur);
  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Content-Length: ' . strlen($fields))
);
  $res= curl_exec($ch);

  curl_close($ch);
//  echo $res;
  $dat = json_decode($res,true);
$datum=  substr( $dat[0],0,10);

 ?>

 <div class="alert" style="padding: 20px; background-color: red; color: white; margin-bottom: 15px;">
   <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  Knjiga je žal izpsojena. Predviden datum vrnitve je <b><?php echo $datum  ?></b>!
 </div>
<?php }else if( $obj['stanje']=='vmasini'){

  $idK=$obj['id'];
  $url3 = "http://localhost:8880/projekt/rest/vmesna/vrniLokacijo/$id";

$field = array("method" => "mymethod", "email" => "myemail");

//echo $isci." ".$cat;ž


  $field = json_encode($field);
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url3);
  //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Content-Length: ' . strlen($fields))
);
  $res3= curl_exec($ch);

  curl_close($ch);
//  echo $res;

echo $res3;

 ?>

 <div class="alert" style="padding: 20px; background-color: red; color: white; margin-bottom: 15px;">
   <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  Knjiga se najaha na knjigomatu <b><?php echo $res3  ?></b>!
 </div>

<?php
}
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

     ?>
     <div class="alert" style="padding: 20px; background-color: green; color: white; margin-bottom: 15px;">
       <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
       Naročilo uspešno oddano!
     </div>
    <?php

  }
else{
   ?>
   <div class="alert" style="padding: 20px; background-color: red; color: white; margin-bottom: 15px;">
     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
     Knjigomat je žal poln!
   </div>

<?php }} ?>




  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>





</body>

</html>
