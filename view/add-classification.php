<?php   
if (isset($_SESSION['loggedin'])){
    $clientLevel =  $_SESSION['clientData']['clientLevel'];
    if($clientLevel <= 1){
    header('Location: /phpmotors/index.php');
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1.0>">
        <title>>Add Classification</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css?">
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/large_view.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;1,400;1,500&family=Montserrat:wght@100&family=Zen+Dots&display=swap" rel="stylesheet">
</head>
<body>
    <div class="blue_border_Main_container">
        <header>
            <nav>
                <?php 
                    require_once $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/Snippets/header.php'; 
                    echo $navList;
                ?>
            </nav>   
        </header>
        <main>
            <h1>Add Car Classification</h1>
            <?php
            if (isset($message)) {
            echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="POST">
            <label for="addClassField"> Classification Name</label>
            <input type="text" id="addClassField" name="classificationName" required>
            <input type="submit" name="submit" id="addCarClassification" value="Add Classification" >
            <input type="hidden" name="action" value="addClassification">
            </form>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
        </footer>
    </div>
</body>
</html>