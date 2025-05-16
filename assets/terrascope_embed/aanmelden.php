<div class="blok1"><?php 
require_once("include/dbconn.inc.php");
ob_start();
session_start();
$foutmelding = "";

if (isset($_POST['knop_aanmelden'])){
$email = $_POST['email'];
$ww = $_POST['wachtwoord'];

$qrySelectKlant = "SELECT klantID, achternaam, voornaam
FROM tblklant
WHERE email=? AND wachtwoord=?";
if ($stmtSelectKlant = mysqli_prepare($dbconn, $qrySelectKlant))
{mysqli_stmt_bind_param($stmtSelectKlant, 'ss', $email, $ww);
mysqli_stmt_execute($stmtSelectKlant);
mysqli_stmt_bind_result($stmtSelectKlant, $klantID, $achternaam, $voornaam);
mysqli_stmt_store_result($stmtSelectKlant);
mysqli_stmt_fetch($stmtSelectKlant);
$aantal = mysqli_stmt_num_rows($stmtSelectKlant);

if($aantal > 0) {
$_SESSION['klantID'] = $klantID;
$_SESSION['achternaam'] = $achternaam;
$_SESSION['voornaam'] = $voornaam;
header("location:index.html");
} else { $foutmelding = "Email en of wachtwoordd zit niet in ons systeem.";}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aanmelden</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/styles.css">
</head>
<script>
 
        $(document).ready(function(){
            $("#blok1").fadeIn(3000);
        });
        $(document).ready(function(){
            $("#blok3").fadeIn(6000);
        });
        $(document).ready(function(){
            $("#blok2").fadeIn(1000);
        });

</script>
<body>
<div id="blok5"> 
        <a href="index1.html">  <img id="Logo" src="img/logo2.png"> </a>
</div> 


<div id="blok5">

  <form name="form_Aanmelden" method="post" action="">
<div>
<label for="email" class="">E-Mail</label> <br>
<input name="email" class="invullen" id="email" type="email">
</div>
<div>
<label for="wachtwoord" class="">Wachtwoord</label> <br>
<input name="wachtwoord" class="invullen" id="wachtwoord" type="password">
</div>
<input type="submit" id="button1" class="loginbutton" value="aanmelden" name="knop_aanmelden">
  </form>  
  <?php echo $foutmelding; ?>
</div>    


</body>
</html>