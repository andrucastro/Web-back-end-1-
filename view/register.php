<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sacale=1.0>">
    <title>register</title>
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
        <h1>Register</h1> 
        <form>
            <label for="clientFirstname">First Name</label>
            <input type="text" name="clientFirstname" id="clientFirstname" placeholder="First name">
            <label for="clientLastname">Last Name</label>
            <input type="text" name="clientLastname" id="clientLastname" placeholder="Last Name">
            <label for="clientEmail">Email</label>
            <input type="email" name="clientEmail" id="clientEmail" placeholder="Email">
            <label for="clientPassword">Password must at least 8 characters and contain at least 1 number. 1 capital letter and 1 speacial chareacter</label>
            <input type="email" name="clientPassword" id="clientPassword" placeholder="Show Password">
            <button class="btn_show_password">Show Password</button>
            <button class="btn_register">Resgister</button>
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/Snippets/footer.php'; ?> 
    </footer>
</div>
</body>
</html>