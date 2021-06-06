<?php

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get general functions 
require_once 'library/functions.php';

$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = dynamicMenu($classifications);




$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
   case 'login':
    include 'view/login.php';
    break;

    case 'registration':
      include 'view/registration.php';
      break;
   
   default:
    include 'view/home.php';
  }

?>