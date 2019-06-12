<?php
session_start();
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
         $_SESSION["timer"]=time();
           header("Location: http://$streznik$pot/knjiznica.php");

           }


          }
         }

if($preveri==false){
 ?>

<h3>Neuspešna prijava!</h3>

<?php }} ?>
