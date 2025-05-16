<?php
    ob_start();
   //we krijgen artikelID binnen
   $artikelID = $_GET["artikelID"];

   //connectie maken met databank
   require_once("includes/dbconn.inc.php");
   
   //query verwijder artikel
   $qryDeleteArtikel = "DELETE FROM tblArtikel WHERE artikelID=?"; //? = onbekend gegeven 
   //stap1: prepared statement => test query op databank
   if ($stmtDeleteArtikel = mysqli_prepare($dbconn, $qryDeleteArtikel)) {
	  //stap2: onbekend gegeven ? in query vervangen door gekende lidID 
	  mysqli_stmt_bind_param($stmtDeleteArtikel, "i", $artikelID);
	  //stap3: uitvoeren query in statement
	  mysqli_stmt_execute($stmtDeleteArtikel);
	  //stap 4: statement sluiten
	  mysqli_stmt_close($stmtDeleteArtikel);
	  //stap 5: databank sluiten
	  mysqli_close($dbconn);
	  //redirecten naar overzicht
	  header("Location: overzichtmokken.php"); 
   }


?>