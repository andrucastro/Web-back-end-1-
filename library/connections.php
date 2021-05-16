 <?php

/*
 * Proxi Connections to the phpmotors dabtabase
 */

function phpmotorsConnect(){
    $server = 'localhost';
    $dbname= 'phpmotors';
    $username = 'iClient';
    $password = '!ubLho33)Y]JOTa!'; 
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  // Create the actual connection object and assign it to a variable
  try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } 
    catch(PDOException $e) {
        header('Location: phpmotors/view/error.php');
        exit;
   }
}
 
