<?php   
if (isset($_SESSION['loggedin'])){
    $clientLevel =  $_SESSION['clientData']['clientLevel'];
    if($clientLevel <= 1){
    header('Location: /phpmotors/index.php');
    }
}
?>
<?php

// Build a dropdown Menu for car clasifications 
$dropdownClasification ='<select id="classificationId" name="classificationId">';
foreach ($classifications as $classification) {
$dropdownClasification .= "<option value='$classification[classificationId]'";

if(isset($classificationId)){
    if($classification['classificationId'] === $classificationId){
        $dropdownClasification .='selected';
    }
}elseif(isset($invInfo['classificationId'])){
    if($classification['classificationId'] === $invInfo['classificationId']){
    $dropdownClasification .= ' selected ';
 }
}

$dropdownClasification .= ">$classification[classificationName]</option>";
} 

$dropdownClasification.= '</select>';

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1.0>">
        <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
            <h1>
            <?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
            echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
            echo "Modify$invMake $invModel"; }
            ?></h1>
            <!-- Alert message error update -->
            <p>*Note all the fields are required</?php>
            <form action="/phpmotors/vehicles/index.php" method="post">      
            <?php 
                echo $dropdownClasification;
            ?>
            <label for="invMake">Make</label>
            <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

            <label for="invModel">Model</label>
            <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

            <label for="invDescription">Description</label>
            <input type="text" id="invDescription" name="invDescription" required <?php if(isset($invDescription)){echo "value='$invDescription'";} elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'";} ?>>

            <label for="invImage">Image Path</label>
            <input type="text" id="invImage"  name="invImage" value="/images/no-image.png" required <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'";} ?>>

            <label for="invThumbnail">Thumbnail Path</label>
            <input type="text" id="invThumbnail" name="invThumbnail" value="/images/no-image.png" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'";} ?>>

            <label for="invPrice">Price</label>
            <input type="number" id="invPrice" name="invPrice" required <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'";} ?>>

            <label for="invStock">Stock</label>
            <input type="number" id="invStock" name="invStock" required <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'";} ?>>

            <label for="invColor">Color</label>
            <input type="text" id="invColor" name="invColor" required <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'";} ?>>

            <input type="submit" name="submit" value="Update Vehicle"> 
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="
            <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">

            </form>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
        </footer>
    </div>
</body>
</html>