
    <?php
require_once("include/dbconn.inc.php");
$qrySelectKlant = "SELECT klantID, voornaam, achternaam, geslacht, geboortedatum, email, straat, bus, huisnummer, telefoonnummer FROM tblklant ";
if ($stmtSelectKlant = mysqli_prepare($dbconn, $qrySelectKlant)){
    mysqli_stmt_execute($stmtSelectKlant);
    mysqli_stmt_bind_result($stmtSelectKlant, $klantlD, $voornaam, $achternaam, $geslacht, $geboortedatum, $email, $straat, $bus, $huisnummer, $telefoonnummer);
    mysqli_stmt_store_result($stmtSelectKlant);
    


}
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terra Scope</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
<header>
      <div id="shopblok2"> 
       
         
        <a href="index1.html">  <img id="Logo" src="img/logo2.png"> </a>
        <a href="aanmelden.php"> <img id="login"  src="img/Login.png"></a>
        <div>
        <ul >
            <a href="index1.html" ><li>Home</li></a>
            <a href="admin.html" ><li>Back</li></a>
          </ul>
        </div>
        
       
       </div> </header> 
    <div id="shopblok4">
    <p id="Titels"> Overzicht Klanten</p>
    <table  class="table bg-dark text-light table-bordered">
        <tr>
        <th><?php echo $klantlD; ?></th>
            <th> voornaam</th>
            <th> achternaam</th>
            <th> geslacht</th>
            <th> geboortedatum</th>
            <th> email</th>
            <th> straat</th>
            <th> bus</th>
            <th> huisnummer</th>
            <th> telefoonnummer</th>
        </tr>
        <?php
         ?>
            
        <tr>
            <td><?php echo $klantlD; ?></td>
            <td><?php echo $voornaam; ?></td>
            <td><?php echo $achternaam; ?></td>
            <td><?php echo $geslacht; ?></td>
            <td><?php echo $geboortedatum; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $straat; ?></td>
            <td><?php echo $bus; ?></td>
            <td><?php echo $huisnummer; ?></td>
            <td><?php echo $telefoonnummer; ?></td>
            

           
            <td><a href="verwijder.php?artikelID=<?php echo $artikelID; ?>"><i class="fas fa-trash"></i></td>
        </tr>
        <?php 
        ?>
    </div>
</body>
</html>