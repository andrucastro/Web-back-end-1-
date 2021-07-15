<?php if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }?><!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1.0>">
        <title>My First PHP Page</title>
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
                <h1>Update review</h1>
                <?php
                    if (isset($message)) {
                    echo $message;
                    }
                ?>
                <form action="/phpmotors/reviews/index.php" method="post" class="formTextarea">
                <label for="reviewDate">Date</label>
                <input type="text" name="reviewDate" id="reviewDate" readonly <?php echo "value='$reviewsdetails[reviewDate]'"?>>
                <label for="reviewText">Update Review</label>
                <textarea name="reviewText" id="reviewText" rows="5" required><?php if(isset($reviewsdetails['reviewText'])){echo "$reviewsdetails[reviewText]";} elseif(isset($reviewsdetails['reviewText'])) {echo "$reviewsdetails[reviewText]";}?></textarea>
                <input type="submit" name="submit" value="Update Reviews"> 
                <input type="hidden" name="action" value="submit-update">
                <input type="hidden" name="reviewId" <?php if(isset($reviewsdetails['reviewId'])){echo "value='$reviewsdetails[reviewId]'";} elseif(isset($reviewsdetails['reviewId'])) {echo "value='$reviewsdetails[reviewId]'";}?>>
                </form>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
            </footer>
        </div>
    </body>
</html>