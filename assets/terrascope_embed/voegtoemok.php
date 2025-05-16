<?php

//variabelen declaratie
$melding = "";
$uploadok = 0;

//connectie databank
require_once("include/dbconn.inc.php");

//alle mogelijke categorieen ophalen
$qrySelectartikel = "SELECT artikelID, artikel
                        FROM tblartikel
						ORDER BY artikel";
  
//we gaan werken met mysqli (=mysql improved) 
   
//stap 1: testen of de opgegeven query uitvoerbaar is op de gekozen databank
if ($stmtSelectartikel=mysqli_prepare($dbconn, $qrySelectartikel)){
      //stap 2: onze query uitvoeren
	  mysqli_stmt_execute($stmtSelectartikel);
	  //stap 3: onze verkregen resultaten binden aan variabelen om te gebruiken in onze code
	  mysqli_stmt_bind_result($stmtSelectartikel, $artikelID, $artikel, $kleurID);
	  //stap 4: onze verkregen resultaten opslaan 
      mysqli_stmt_store_result($stmtSelectartikel);
     } 

 if (isset($_POST["button_toevoegen_product"])){
	  //er werd op de knop gedrukt
	  $artikel = $_POST["artikel"];
	  $omschrijving = $_POST["omschrijving"];
	  $prijs = $_POST["prijs"];
	  $prijs = $_POST["kleurID"];
	  
	  $doel_dir = "uploads/";
      $doel_bestand = $doel_dir . basename($_FILES["afbeelding"]["name"]);
      $imageFileType = strtolower(pathinfo($doel_bestand,PATHINFO_EXTENSION));
	  
	  $melding = "";
	  $uploadOk = 0;
	 
	  //testen of afbeelding wel een jpg, png, jpeg of gif is
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
       && $imageFileType != "gif" ) {
           $melding =  "Sorry, enkel JPG, JPEG, PNG & GIF bestanden zijn toegestaan.";
           $uploadOk = 0;
      } else {
	       //plaats afbeelding in de uploadmap
	       if (move_uploaded_file($_FILES["afbeelding"]["tmp_name"], $doel_bestand)) {
		      //voeg een nieuw record toe aan de tabel tblArtikel
		      $qryInsertCapaciteit ="INSERT INTO tblArtikel (artikel, omschrijving, prijs, afbeelding, categorieID) VALUES (?, ?, ?, ?, ?)";
	          if ($stmtInsertCapaciteit = mysqli_prepare($dbconn, $qryInsertCapaciteit)){
		         mysqli_stmt_bind_param($stmtInsertCapaciteit, "ssisi", $artikel, $omschrijving, $prijs, $doel_bestand, $categorieID);
		         mysqli_stmt_execute($stmtInsertCapaciteit);
			     $uploadok = 1;
			     $melding = "product werd succesvol toegevoegd.";
		      } else {
			     $uploadok = 0;
				 $melding = "product kon niet worden toegevoegd.";
		      }
		   } else {
		     $uploadOk = 0;
		     $melding = "Afbeelding kon niet worden opgeladen.";
           }
	  }
  }
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Toevoegen Artikels</title>
<link href="../css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container">

<h1>Toevoegen product</h1>

<form name="form_toevoegen_product" method="post" action="" enctype="multipart/form-data">
	
    <div class="form-group">
            <label for="artikel">Naam Product</label>
            <input type="text" class="form-control" name="artikel" id="artikel">
	</div>
    <div class="form-group">
            <label for="omschrijving">Omschrijving</label>
            <textarea class="form-control" name="omschrijving" id="omschrijving" rows="4"></textarea>
     </div>
	 <div class="form-group">
            <label for="prijs">Prijs</label>
            <input type="text" class="form-control" name=" prijs" id="prijs">
     </div>
     <div class="form-group">
            <label for="afbeelding">Afbeelding</label>
            <input type="file" class="form-control" name="afbeelding" id="afbeelding">
     </div>
	 <div class="form-group">
            <label for="kleur">kleur</label>
            <input type="text" class="form-control" name="kleur" id="kleurID">
     </div>
	 
	 
     <input type="submit" name="button_toevoegen_product" class="btn btn-primary" value="toevoegen">
</form>

<?php if ($melding != "") { ?>	
<br>
<div class="alert alert-primary" role="alert">
  <?php echo $melding; ?>
</div>
<?php } ?>
<br>	
<p><a href="overzichtmokken.php">terug naar overzicht</a></p>

	
</div>
</body>
</html>