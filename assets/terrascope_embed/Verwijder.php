<?php
   
    ob_start();

    $ArtikelID = $_GET["ArtikelID"];
    require_once("include/dbconn.inc.php");

    $qryDeleteBoom = "DELETE FROM tblArtikel WHERE ArtikelID = ?";

    if ($stmtDeleteBril = mysqli_prepare($dbconn, $qryDeleteBril)){
        mysqli_stmt_bind_param($stmtDeleteBril, "i", $ArtikelID);
        mysqli_stmt_execute($stmtDeleteBril);
        header("Location: overzicht.php");
    }
?>