<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1.0>">
        <title>Image Management</title>
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
                <h1>Image management</h1>
                <h2>Add New Vehicle Image</h2>
                <?php
                if (isset($message)) {
                echo $message;
                }?>
                <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                <label for="invItem">Vehicle</label>
                    <?php echo $prodSelect; ?>
                    <fieldset>
                        <label>Is this the main image for the vehicle?</label>
                        <label for="priYes" class="pImage">Yes</label>
                        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                        <label for="priNo" class="pImage">No</label>
                        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                    </fieldset>
                <label>Upload Image:</label>
                <input type="file" name="file1">
                <input type="submit" class="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
                </form> 
                <hr>
                <h2>Existing Images</h2>
                <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
                <?php
                if (isset($imageDisplay)) {
                echo $imageDisplay;
                } ?> 
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
            </footer>
        </div>
    </body>
</html>
<?php unset($_SESSION['message']); ?>
