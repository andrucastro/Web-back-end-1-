<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
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
            <div id="vehicle-detail-container"> 
                 <div id="thumbnails-large-view">
                    <?php
                    echo $displayThumbnails;
                    ?>
                 </div>
                <?php 
                    echo $vehiclesDisplayInfo;
                ?>
                <div id="thumbnails-small-view">
                    <?php
                    echo $displayThumbnails;
                    ?>
                </div>
            </div>
            <hr>
            <div id= reviews-container>
            <?php
             if (!isset($_SESSION['loggedin'])){

             echo "<h2>Customer review</h2>
                  <p>You must <a href='/phpmotors/accounts/?action=login'>login</a> to wirte a review.</p>";
              }else{  

             echo '<h3>Review The Vehicle name</h3>'; 
             // Get customer First letter from first Name and full Last name
             $clientName = substr($_SESSION['clientData']['clientFirstname'], 0,1);
             $clientName = strtoupper($clientName);
             $clientLasname = ucfirst($_SESSION['clientData']['clientLastname']);
             $clientId = $_SESSION['clientData']['clientId'];
            
             //Client Alert Message in case success or fail
            if (isset($message)) { 
                echo $message; 
                }

             echo " <form action='/phpmotors/reviews/index.php' method='post' id='review-form'>
                    <label for='screenName'>Screen Name:</label>
                    <input type='text' name='screenName' id='screenName' readonly value='$clientName$clientLasname'>
                    <label for='reviewTexts'>Review</label>
                    <textarea required id='reviewTexts' name='reviewText' rows='6'></textarea>
                    <input type='submit' name='submit' value='Submit Review'> 
                    <input type='hidden' name='action' value='submitReview'>
                    <input type='hidden' name='invId' value='$invId'>
                    <input type='hidden' name='clientId' value='$clientId'>  
                   </form>";
              }
            ?>
            </div>
            <div>
                <?php
                    //count the number of reviews brought from the DB
                    if(isset($reviews)){
                     $reviewsCount = count($reviews);
                    if($reviewsCount == 0){
                          echo "<p>Be the first to write a review</p>";
                    }else{
                        echo $displayReviews;
                    }            
                }
                ?>
            </div>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
        </footer>
    </div>
</body>
</html>