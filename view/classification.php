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
}


$dropdownClasification .= ">$classification[classificationName]</option>";
} 

$dropdownClasification.= '</select>';

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1.0>">
        <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
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
        <h1><?php echo $classificationName; ?> vehicles</h1>
            <?php if(isset($message)){
                echo $message; }
            ?>
            <?php if(isset($vehicleDisplay)){
                echo $vehicleDisplay;
            } ?>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
        </footer>
    </div>
</body>
</html>