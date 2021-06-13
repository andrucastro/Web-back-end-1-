<?php   
if(!$_SESSION['loggedin']){
    header('Location: /phpmotors/index.php');
}


?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1.0>">
        <title>Classic</title>
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
        <h1><?php echo $_SESSION['clientData']['clientFirstname']; ?></h1>
        <p>You Are logged in</p>
        <ul class="admin_page_client_info">
            <li> Frist Name: <?php echo $_SESSION['clientData']['clientFirstname'];?> </li>
            <li> Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
            <li> Email: <?php echo $_SESSION['clientData']['clientEmail']; ?> </li>
            <li> CLient Level: <?php echo  $_SESSION['clientData']['clientLevel']; ?> </li>
        </ul>
        <?php
        $clientLevel =  $_SESSION['clientData']['clientLevel'];
        if ($clientLevel>1){
       echo "<a href='/phpmotors/vehicles/'> You have access to the Vehicles controler</a>";   
        }
        ?>
    
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
        </footer>
    </div>
</body>
</html>