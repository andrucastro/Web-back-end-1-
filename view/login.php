<!DOCTYPE html>
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
            <h1>Sing in</h1>
            <?php
               if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
               }
               if (isset($message)) {
                echo $message;
                }
            ?> 
            <form method="post" action="/phpmotors/accounts/">
                <label for="clientEmail">Email</label>
                <input type="email" name="clientEmail" id="email" placeholder="Email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
                <label for="password">Password</label>
                <input type="password" name="clientPassword" id="password" placeholder="Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                <span class="password_insturctions"> Password must at least 8 characters and contain at least 1 number. 1 capital letter and 1 speacial chareacter</span> 
                <input type="submit" name="submit"  value="Sing-in" class="sing-in_btn">
                <input type="hidden" name="action" value="Login">
            </form>
            <a href="/phpmotors/accounts/?action=registration">Not a member yet?</a>
        </main>
        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
        </footer>
    </div>
</body>
</html>
