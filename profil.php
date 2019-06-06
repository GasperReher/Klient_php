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
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
          <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $_SESSION['qr'] ?>&choe=UTF-8" >
        </div>
      </div>
    </div>
  </header>
  <?php

$idUpo=$_SESSION['id'];

        $url = "http://localhost:8880/projekt/rest/izposoja/izpis/$idUpo";

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
?>

<h2>Izposojene knjige</h2>
<table class="table table-hover">
   <thead>
     <tr>
       <th>Avtor</th>
       <th>Naslov</th>
         <th>Datum vrnitve</th>
        <th>QR koda knjige</th>

     </tr>
   </thead>
   <tbody>


<?php
        foreach($obj as $i) {

          if($i['stanje']==true){
            ?>
              <tr>
                  <td> <?php  echo $i['knjiga']['avtor'];  ?> </td>
                    <td> <?php  echo $i['knjiga']['naslov'];  ?> </td>
                    <?php
                    $idK=$i['knjiga']['id'];
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
          <td> <?php echo $datum;  ?> </td>




                      <td>  <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo  $i['knjiga']['qrKoda']; ?>&choe=UTF-8" /> </td>
              </tr>
            <?php
          }

}


?>
</tbody>
</table>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
