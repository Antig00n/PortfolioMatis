<?php

//variabelen declaratie
$melding = "";
$uploadok = 0;

//connectie databank
require_once("include/dbconn.inc.php");
$qrySelectKlant = "SELECT klantID, voornaam, achternaam, geslacht, geboortedatum, email, straat, bus, huisnummer, telefoonnummer FROM tblklant ";
if ($stmtSelectKlant = mysqli_prepare($dbconn, $qrySelectKlant)){
    mysqli_stmt_execute($stmtSelectKlant);
    mysqli_stmt_bind_result($stmtSelectKlant, $klantlD, $voornaam, $achternaam, $geslacht, $geboortedatum, $email, $straat, $bus, $huisnummer, $telefoonnummer);
    mysqli_stmt_store_result($stmtSelectKlant);
    


}
   

 if (isset($_POST["button_toevoegen_Klanten"])){
	  //er werd op de knop gedrukt
	  $voornaam = $_POST["voornaam"];
	  $achternaam = $_POST["achternaam"];
	  $geslacht = $_POST["geslacht"];
	  $geboortedatum = $_POST["geboortedatum"];
	  $email = $_POST["email"];
	  $straat = $_POST["straat"];
	  $bus = $_POST["bus"];
	  $huisnummer = $_POST["huisnummer"];
	  $telefoonnummer = $_POST["telefoonnummer"];
	  
	  $melding = "";
	  $uploadOk = 0;
	 
		      //voeg een nieuw record toe aan de tabel tblArtikel
		      $qryInsertKlanten ="INSERT INTO tblklant (voornaam, achternaam, geslacht, geboortedatum, email, straat, bus, huisnummer, telefoonnummer, klantID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, )";
	          if ($stmtInsertKlanten = mysqli_prepare($dbconn, $qryInsertKlanten)){
		         mysqli_stmt_bind_param($stmtInsertKlanten, "ssisi", $voornaam, $achternaam, $geslacht, $geboortedatum, $email, $straat, $klantID);
		         mysqli_stmt_execute($stmtInsertKlanten);
			     $uploadok = 1;
			     $melding = "klant werd succesvol toegevoegd.";
		      } else {
			     $uploadok = 0;
				 $melding = "klant kon niet worden toegevoegd.";
		      }
		   } else {
		     $uploadOk = 0;
		     $melding = "Afbeelding kon niet worden opgeladen.";
           }
	  
  
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Toevoegen Klanten</title>
<link href="../css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container">

<h1>Toevoegen Klant</h1>

<form name="form_toevoegen_Klanten" method="post" action="" enctype="multipart/form-data">
	
    <div class="form-group">
            <label for="voornaam">Naam Klanten</label>
            <input type="text" class="form-control" name="voornaam" id="voornaam">
	</div>
    <div class="form-group">
            <label for="achternaam">achternaam</label>
			<input type="text" class="form-control" name="achternaam" id="achternaam">
     </div>
	 <div class="form-group">
            <label for="geslacht">geslacht</label>
            <input type="text" class="form-control" name=" geslacht" id="geslacht">
     </div>
     <div class="form-group">
            <label for="geboortedatum">geboortedatum</label>
            <input type="date" class="form-control" name=" geboortedatum" id="geboortedatum">
     </div>
	 <div class="form-group">
            <label for="email">email</label>
            <input type="text" class="form-control" name=" email" id="email">
     </div>
	 <div class="form-group">
            <label for="straat">straat</label>
            <input type="text" class="form-control" name=" straat" id="straat">
     </div>
	 <div class="form-group">
            <label for="bus">bus</label>
            <input type="text" class="form-control" name=" bus" id="bus">
     </div>
	 <div class="form-group">
            <label for="huisnummer">huisnummer</label>
            <input type="text" class="form-control" name=" huisnummer" id="huisnummer">
     </div>
	 <div class="form-group">
            <label for="telefoonnummer">telefoonnummer</label>
            <input type="text" class="form-control" name=" telefoonnummer" id="telefoonnummer">
     </div>
     <input type="submit" name="button_toevoegen_Klanten" class="btn btn-primary" value="toevoegen">
</form>

<?php if ($melding != "") { ?>	
<br>
<div class="alert alert-primary" role="alert">
  <?php echo $melding; ?>
</div>
<?php } ?>
<br>	
<p><a href="overzichtpersonen.php">terug naar overzicht</a></p>

	
</div>
</body>
</html>