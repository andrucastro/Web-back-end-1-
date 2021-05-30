<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1.0>">
        <title>>Add Vehicl</title>
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
            <h1>Add Vehicle</h1>
            <?php
            if (isset($message)) {
            echo $message;
            }
            ?>
            <p>*Note all the fields are required</p>
            <form action="/phpmotors/vehicles/index.php" method="post">      
            <?php 
                echo $dropdownClasification;
            ?>
            <label for="invMake">Make</label>
            <input type="text" id="invMake" name="invMake">

            <label for="invModel">Model</label>
            <input type="text" id="invModel" name="invModel">

            <label for="invDescription">Description</label>
            <input type="text" id="invDescription" name="invDescription">

            <label for="invImage">Image Path</label>
            <input type="text" id="invImage"  name="invImage" value="/images/no-image.png">

            <label for="invThumbnail">Thumbnail Path</label>
            <input type="text" id="invThumbnail" name="invThumbnail" value="/images/no-image.png">

            <label for="invPrice">Price</label>
            <input type="number" id="invPrice" name="invPrice">

            <label for="invStock">Stock</label>
            <input type="number" id="invStock" name="invStock">

            <label for="invColor">Color</label>
            <input type="text" id="invColor" name="invColor">

            <input type="submit" name="submit" id="addCarClassification" value="Add Vehicle"> 
            <input type="hidden" name="action" value="addvehicle">

            </form>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
        </footer>
    </div>
</body>
</html>