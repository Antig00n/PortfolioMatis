<?php
  
  require_once("include/dbconn.inc.php");
    $qrySelectBril = "SELECT ArtikelD, art.artikel, art.prijs, kl.kleur, art.afbeelding FROM tblartikel as art LEFT JOIN tblkleur as kl ON kl.kleurID=art.kleurID ORDER BY art.artikel";
  
  //we gaan werken met mysqli (=mysql improved) 
   
  //stap 1: testen of de opgegeven query uitvoerbaar is op de gekozen databank
     if ($stmtSelectBril=mysqli_prepare($dbconn, $qrySelectBril)){
       //stap 2: onze query uitvoeren
	   mysqli_stmt_execute($stmtSelectBril);
	   //stap 3: onze verkregen resultaten binden aan variabelen om te gebruiken in onze code
	   mysqli_stmt_bind_result($stmtSelectBril, $ArtikelID, $artikel, $prijs, $kleur, $afbeelding);
	   //stap 4: onze verkregen resultaten opslaan 
       mysqli_stmt_store_result($stmtSelectBril);
	   //stap 5: ons aantal verkregen resultaten opvragen
	   $aantal = mysqli_stmt_num_rows($stmtSelectBril);
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
<title>OverzichtProduct</title>
 
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <script src="https://kit.fontawesome.com/bd172f1b32.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
<h1>Overzicht Product in ons assortiment</h1>
<p>Ons assortiment telt <?php echo $aantal; ?> Product. </p> 
<p><a href="voegtoemok.php"><i class="fas fa-plus-circle"></i> ToevoegeProduct</a></p>
<table class="table table-bordered">
  <tr>
   <th>#</th>
   <th>artikel</th>
   <th>prijs</th>
   <th>kleur</th>
   <th>afbeelding</th>
   <th>detail</th>
   <th>verwijder</th>	  
  </tr>
	
<?php
  //maak een teller aan
  $teller=1; 
  //doorloop een lus zolang er waarden teruggegeven worden (fetching)
  while (mysqli_stmt_fetch($stmtSelectBril)) { ?>
     <tr> 
	    <td><?php echo $teller; ?></td>
	    <td><?php echo $artikel; ?></td>
		<td><?php echo $prijs; ?> &euro;</td>
		<td><?php echo $kleur; ?></td>
    <td><?php echo $afbeelding; ?></td>
	    <td><a href="detailmok.php?artikelID=<?php echo $artikelID; ?>"><i class="fas fa-info-circle"></i></a></td>
	    <td><a href="verwijdermok.php?artikelID=<?php echo $artikelID; ?>"><i class="far fa-trash-alt"></i></a></td></tr> 
	<?php 
	$teller++;
    }
?>
</table>
</div>
</body>
</html>