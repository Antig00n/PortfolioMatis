<?php
    require_once("include/dbconn.inc.php");
    $qrySelectBril = "SELECT ArtikelD, art.artikel, art.prijs, kl.kleur, art.afbeelding FROM tblartikel as art LEFT JOIN tblkleur as kl ON kl.kleurID=art.kleurID ORDER BY art.artikel";
    if ($stmtSelectBril = mysqli_prepare($dbconn, $qrySelectBril)){
        mysqli_stmt_execute($stmtSelectBril);
        mysqli_stmt_bind_result($stmtSelectBril, $ArtikelID, $artikel, $prijs, $kleur, $afbeelding);
        mysqli_stmt_store_result($stmtSelectBril);
        $aantal = mysqli_stmt_num_rows($stmtSelectBril);
        


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
<div id="shopblok3">
    <p id="Titels"> Overzicht assortiment brillen</p>
    <p>Wij hebben <?php echo $aantal; ?> TerraScope artikelen in ons assortiment.</p>
    <table  class="table bg-dark text-light table-bordered">
        <tr>
            <th>#</th>
            <th>artikel</th>
            <th>prijs</th>
            <th>kleur</th>
            <th>afbeelding</th>
        </tr>
        <?php
        $teller = 1; 
            while (mysqli_stmt_fetch($stmtSelectBril)) { ?>
            
        <tr>
            <td><?php echo $teller; ?></td>
            <td><?php echo $artikel; ?></td>
            <td><?php echo $prijs; ?> &euro;</td>
            <td><?php echo $kleur; ?></td>
            <td><?php echo $afbeelding; ?></td>
            <td><a href="verwijder.php?artikelID=<?php echo $artikelID; ?>"><i class="fas fa-trash"></i></td>
        </tr>
        <?php $teller++;
        } 
        ?>
    </div>
    
</body>
</html>