<!DOCTYPE html>
<html lang="en">
<style>
<?php  include'css/style.css'; ?>
</style>
<?php
session_start();
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
  <?php include 'head.php';?>
</head>

<body>
<?php
$_SERVER['REQUEST_METHOD']
?>




  <!-- Navigation -->
<?php include 'navbar.php';?>
  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto well profil">
            <h1 class="mb-5">Profil:</h1>
            <hr>
            <h3>Ime: </h3><h3><?php echo $_SESSION['ime'] ?></h3><br />
            <h3>Priimek: </h3><h3><?php echo $_SESSION['priimek'] ?></h3>
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
  <script src="javascript/basicjs.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
