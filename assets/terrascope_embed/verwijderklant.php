<?php
    ob_start();
   //we krijgen klantID binnen
   $KlantID = $_GET["KlantID"];

   //connectie maken met databank
   require_once("include/dbconn.inc.php");
   
   //query verwijder artikel
   $qryDeleteKlanten = "DELETE FROM tblklant WHERE KlantID=?"; //? = onbekend gegeven 
   //stap1: prepared statement => test query op databank
   if ($stmtDeleteKlanten = mysqli_prepare($dbconn, $qryDeleteKlanten)) {
	  //stap2: onbekend gegeven ? in query vervangen door gekende lidID 
	  mysqli_stmt_bind_param($stmtDeleteKlanten, "i", $KlantID);
	  //stap3: uitvoeren query in statement
	  mysqli_stmt_execute($stmtDeleteKlanten);
	  //stap 4: statement sluiten
	  mysqli_stmt_close($stmtDeleteKlanten);
	  //stap 5: databank sluiten
	  mysqli_close($dbconn);
	  //redirecten naar overzicht
	  header("Location: overzichtpersonen.php"); 
   }


?>