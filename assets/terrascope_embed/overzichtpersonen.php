<?php
  
  //connectie code databank eenmalig insluiten
  require_once("include/dbconn.inc.php");
  
  //query maken om alle mokken op te halen
  $qrySelectKlanten = "SELECT KlantID,Voornaam,Achternaam,Geslacht,Geboortedatum
  FROM tblklant
  ORDER BY Achternaam, Voornaam";
  
  //we gaan werken met mysqli (=mysql improved) 
   
  //stap 1: testen of de opgegeven query uitvoerbaar is op de gekozen databank
     if ($stmtSelectKlanten=mysqli_prepare($dbconn, $qrySelectKlanten)){
       //stap 2: onze query uitvoeren
	   mysqli_stmt_execute($stmtSelectKlanten);
	   //stap 3: onze verkregen resultaten binden aan variabelen om te gebruiken in onze code
	   mysqli_stmt_bind_result($stmtSelectKlanten, $KlantID, $voornaam, $achternaam, $geslacht, $geboortedatum);
	   //stap 4: onze verkregen resultaten opslaan 
       mysqli_stmt_store_result($stmtSelectKlanten);
	   //stap 5: ons aantal verkregen resultaten opvragen
	   $aantal = mysqli_stmt_num_rows($stmtSelectKlanten);
	   //stap 6: connectie met de databank sluiten
	   mysqli_close($dbconn); 
     } else {
  	   $aantal = 0;  
     }
?>

<!DOCTYPE>
<html>
<head>
<meta charset="UTF-8">
<title>Overzicht Klanten</title>
 
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <script src="https://kit.fontawesome.com/bd172f1b32.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
<h1>Overzicht klanten</h1>
<p>Ons bestand telt <?php echo $aantal; ?> klanten. </p> 
<p><a href="voegtoeklant.php"><i class="fas fa-plus-circle"></i> Toevoegen Klanten</a></p>
<table class="table table-bordered">
  <tr>
   <th>#</th>
   
   <th>achternaam</th>
   <th>voornaam</th>
   <th>geslacht</th>
   <th>Geboortedatum</th>
   <th>detail</th>
   <th>verwijder</th>	  
  </tr>
	
<?php
  //maak een teller aan
  $teller=1; 
  //doorloop een lus zolang er waarden teruggegeven worden (fetching)
  while (mysqli_stmt_fetch($stmtSelectKlanten)) { ?>
     <tr> 
	    <td><?php echo $teller; ?></td>
	    <td><?php echo $achternaam; ?></td>
		<td><?php echo $voornaam; ?> </td>
		<td><?php echo $geslacht; ?></td>
    <td><?php echo $geboortedatum; ?></td>
	    <td><a href="detailklant.php?KlantID=<?php echo $KlantID; ?>"><i class="fas fa-info-circle"></i></a></td>
	    <td><a href="verwijderklant.php?KlantID=<?php echo $KlantID; ?>"><i class="far fa-trash-alt"></i></a></td></tr> 
	<?php 
	$teller++;
    }
?>
</table>
</div>
</body>
</html>