<?php   
if (!isset($_SESSION['loggedin'])){  
   header('Location: /phpmotors/index.php');  
}
?><!DOCTYPE html>
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
            <h1>Manage Account</h1>
            <h3>Update account</h3>
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
            <form action="/phpmotors/accounts/index.php" method="post">
                <label for="fName">First Name</label>
                <input type="text" name="clientFirstname" id="fName" placeholder="First name" required <?php if(isset($clientFirstname)){ echo "value='$clientFirstname'";} elseif(isset($_SESSION['loggedin'])) { $fName = $_SESSION['clientData']['clientFirstname']; echo "value=$fName";}?>>
                <label for="lName">Last Name</label>
                <input type="text" name="clientLastname" id="lName" placeholder="Last Name" required <?php if(isset($clientLastname)){ echo "value='$clientLastname'";} elseif(isset($_SESSION['loggedin'])) { $lName = $_SESSION['clientData']['clientLastname']; echo "value=$lName";}?>>
                <label for="email">Email</label>
                <input type="email" name="clientEmail" id="email" placeholder="Email" required <?php if(isset($clientEmail)){ echo "value='$clientEmail'";} elseif(isset($_SESSION['loggedin'])) { $email = $_SESSION['clientData']['clientEmail']; echo "value=$email";} ?>>
                <input type="submit" name="submit" value="Update info" class="btn_register">
                <input type="hidden" name="action" value="updateAccount">
                <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['loggedin'])) {$id = $_SESSION['clientData']['clientId']; echo "value=$id";}?>">
            </form>
            <h3>Update Password</h3>
            <form action="/phpmotors/accounts/index.php" method="post">
            <label for="password">Password</label>
                <p>Your original password will be changed</p>
                <span class="password_insturctions"> Password must at least 8 characters and contain at least 1 number. 1 capital letter and 1 speacial chareacter</span> 
                <input type="password" name="clientPassword" id="password" placeholder="Show Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                <input type="submit" name="submit" value="Update info" class="btn_register">
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['loggedin'])) {$id = $_SESSION['clientData']['clientId']; echo "value=$id";}?>">
            </form>


        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
        </footer>
    </div>
</body>
</html>