<?php   
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
   }
   if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1.0>">
        <title>Vehicle</title>
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/style.css?1.0">
        <link rel="stylesheet" type="text/css" href="/phpmotors/css/large_view.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;1,400;1,500&family=Montserrat:wght@100&family=Zen+Dots&display=swap" rel="stylesheet">
</head>
<body>
    <div class="blue_border_Main_container">
        <header>
        <?php 
            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/header.php'; 
            ?>
            <nav>
                <?php 
                echo $navList;
                ?>
            </nav>
        </header>
        <main>
        <h1>Vehicle Data Management</h1>
            <ul class="veicle_man_ul">
                <li><a href="/phpmotors/vehicles/?action=add-classification">Add Classification</a></li>
                <li><a href="/phpmotors/vehicles/?action=add-vehicle">Add Vehicle</a></li>
            </ul>

            <?php
                if (isset($message)) { 
                echo $message; 
                } 
                if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
                }
            ?><noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>