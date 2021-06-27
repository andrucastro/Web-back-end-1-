<?php   
if($_SESSION['clientData']['clientLevel'] < 2){
 header('location: /phpmotors/');
 exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1.0>">
        <title><?php if(isset($invInfo['invMake'])){ echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css?1.0">
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/large_view.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;1,400;1,500&family=Montserrat:wght@100&family=Zen+Dots&display=swap" rel="stylesheet">
</head>
<body>
    <div class="blue_border_Main_container">
        <header>
            <nav>
                <?php 
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/header.php'; 
                    echo $navList;
                ?>
            </nav>    
        </header>
        <main>
        <h1><?php if(isset($invInfo['invMake'])){ echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>

             <p>Confirm Vehicle Deletion. The delete is permanent.</p>
            <form action="/phpmotors/vehicles/index.php" method="post">      
            <label for="invMake">Make</label>
            <input type="text" readonly name="invMake" id="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>


            <label for="invModel">Model</label>
            <input type="text" readonly name="invModel" id="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>


            <label for="invDescription">Description</label>
            <input type="text" id="invDescription" readonly name="invDescription" <?php if(isset($invDescription['invDescription'])) {echo "value='$invInfo[invDescription]'";} ?>>

            <input type="submit" name="submit" value="Delete Vehicle"> 
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){echo $invInfo['invId'];} ?>">

            </form>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
        </footer>
    </div>
</body>
</html>