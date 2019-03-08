<?php
echo "hello </br>";
$mag = 23;
echo "stock de magasin : " .$mag. " zbilouzbil";

//ceci est un commentaire
$semaine = array('Slip', 'Bachibouzouk', 'Pignouf', 'Raclette', 'Hongrie','Pastaquouetch','Pipistrelle');
echo '<br>';

$stock = 20;
if ($stock < 2) $ortho = 'carton';
else $ortho ='cartons';
echo ' <br> le stock est de : ' .$stock. ' '.$ortho. '<br>';
echo '<br>';

for( $i = 0 ; $i < count($semaine) ; $i ++){
  echo $semaine[$i];
  echo '<br>';
}

echo '<select name="" id="kk">';
for($i = 0 ; $i < count($semaine) ; $i++ ){
      echo '<option value="mois'.$i.'">'.$semaine[$i].'</option>';
    }
      echo '</select>';

      echo '<p style="text-align:center; color:rgb(0,60,200); font-weight:bold; font-size:2em;"> Vous avez  ' .itemsnb(count($semaine)). ' objets dans votre inventaire.</p>';
      echo '<p style="text-align:center; color:rgb(0,60,200); font-weight:bold; font-size:2em;"> plus concrètement :</p>';
      echo '<p style="text-align:center; color:rgb(0,60,200); font-weight:bold; font-size:2em;"> '.ceil(itemsnb(count($semaine))). " pour l'arrondi sup</p>";
      echo '<p style="text-align:center; color:rgb(0,60,200); font-weight:bold; font-size:2em;"> '.floor(itemsnb(count($semaine))). " pour l'arrondi inf</p>";
      echo '<p style="text-align:center; color:rgb(0,60,200); font-weight:bold; font-size:2em;">'.round(itemsnb(count($semaine)), 3). " pour l'arrondi sup</p>";

      $dateactu = date('Y-m-d');
echo 'date US : ' .$dateactu. '<br>';
echo 'date francaise : ' .datefr($dateactu);



echo '<form action="" method="post">
<p>
<label >nombre</label>
<input type="text" name="nombre" value=""> 
</p>

<p>
<label >name</label>
<input type="text" name="name" value=""> 
</p>

<p>
<label >mail</label>
<input type="text" name="email" value=""> 
</p>

<p>
<label >object</label>
<input type="text" name="object" value=""> 
</p>

<p>
<label >message</label>
<input type="text" name="message" value=""> 
</p>

<input type="submit" name="submit" value="Submit">  
</form>
';

 
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

$j = $_POST['nombre'];

for ($p = 0 ; $p < $j ; $p++){

if(isset($_POST['submit'])){
    $to = "mail@mail.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
    $subject = $_POST["object"];
    $message = $name . " wrote the following:" . "\n\n" . $_POST['message'];
    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    echo "Mail Sent. Thank you " . $name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    };
};

?>