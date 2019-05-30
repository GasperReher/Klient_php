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
      <a class="navbar-brand" href="knjiznica.php">Knjigomat</a>
        <a class="navbar-brand" href="index.php">Odjava</a>

    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Pozdravljen/a <?php echo str_replace('"', '',  $_SESSION["ime"])." ".str_replace('"', '',  $_SESSION["priimek"]);   ?>.</h1>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
              <div class="form-group">
                <select name="kategorija" class="form-control">
                  <option value="vrsta">Žanr</option>
                  <option value="naslov">Naslov</option>
                  <option value="avtor">Avtor</option>

                </select>

              </div>
              <div class="form-group">

                <input type="text" class="form-control" placeholder="Ključna beseda ..." name="kljucnaBeseda" id="pwd">
              </div>

              <button type="submit" name="isciKnj" class="btn btn-block btn-lg btn-primary">Išči</button>
            </form>
        </div>
      </div>
    </div>
  </header>
  <?php


  $fields = array("method" => "mymethod", "email" => "myemail");
  //echo $isci." ".$cat;ž
  $url1="http://localhost:8880/projekt/rest/knjige/iskanje/vrsta&knjiga";
  $url = "http://localhost:8880/projekt/rest/knjige/iskanje/";
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




?>
  <?php

    $url="http://localhost:8880/projekt/rest/knjige/iskanje/vrsta&knjiga";
    if(array_key_exists('isciKnj',$_POST)){
      if(($_POST["kljucnaBeseda"]!="")&&isset($_POST["kategorija"])!=""){

        $isci=$_POST["kljucnaBeseda"];
        $cat=$_POST["kategorija"];

        $url = "http://localhost:8880/projekt/rest/knjige/iskanje/".$cat."&".$isci;

      }
      else{
        $url = "http://localhost:8880/projekt/rest/knjige/iskanje/";
      }
      $fields = array("method" => "mymethod", "email" => "myemail");

      //echo $isci." ".$cat;ž


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


}

?>
  <!-- Icons Grid -->


  <?php  ?>
  <section class="features-icons bg-light text-center" >
    <div class="container">
      <div class="row" style="width:100%">
        <?php

        if(isset($obj)){

        foreach($obj as $i) { //foreach element in $arr
          if(!isset($i['slika'])) continue;
          $bytes=$i['slika'];
          //echo '<img src="data:image/jpeg;base64,'.base64_encode($str->load()) .'" />';
          $string = implode(array_map("chr", $bytes)); //Convert it to string

          $base64 = base64_encode($string); //Encode to base64
          $img = "<img src= 'data:image/jpeg;base64, $base64' style='height:250px'/>"; //Create the image


          //$stra=implode(" ",$i['slika']);

          //$j=base64_encode($stra);

          //echo $str;

          ?>
        <div style="disply:inline-block" class="col-lg-4">
        <div class="features-icons-icon " style="height:300px; display:inline-block">

            <div>
              <a href="knjiga.php?id=<?php echo $i['id'] ?>">

              <?php echo $img ?>

              </a>
            </div>


        </div>
        <h3> <?php echo $i["naslov"] ?></h3>
      </div>
    <?php } } ?>


      </div>
    </div>
  </section>

  <!-- Image Showcases -->
  <section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-1.jpg');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Fully Responsive Design</h2>
          <p class="lead mb-0">When you use a theme created by Start Bootstrap, you know that the theme will look great on any device, whether it's a phone, tablet, or desktop the page will behave responsively!</p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-showcase-2.jpg');"></div>
        <div class="col-lg-6 my-auto showcase-text">
          <h2>Updated For Bootstrap 4</h2>
          <p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 4 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 4!</p>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-3.jpg');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2>Easy to Use &amp; Customize</h2>
          <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="testimonials text-center bg-light">
    <div class="container">
      <h2 class="mb-5">What people are saying...</h2>
      <div class="row">
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
            <h5>Margaret E.</h5>
            <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-2.jpg" alt="">
            <h5>Fred S.</h5>
            <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-3.jpg" alt="">
            <h5>Sarah W.</h5>
            <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="call-to-action text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h2 class="mb-4">Ready to get started? Sign up now!</h2>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <form>
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
                <input type="email" class="form-control form-control-lg" placeholder="Enter your email...">
              </div>
              <div class="col-12 col-md-3">
                <button type="submit" class="btn btn-block btn-lg btn-primary">Sign up!</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

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
