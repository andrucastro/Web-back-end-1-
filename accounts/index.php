<?php
// This is the account controller


// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get validation functions
require_once '../library/functions.php';

$classifications = getClassifications();

// Display the Menu
$navList= dynamicMenu($classifications);
 

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action){

  case 'register':
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname',  FILTER_SANITIZE_STRING));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname',  FILTER_SANITIZE_STRING));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail',  FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword',  FILTER_SANITIZE_STRING));
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);
  
  
  // Check for missing data
  if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
    $message = '<p class="empty_field_alert">Please provide information for all empty form fields.</p>';
    include '../view/registration.php';
    exit; 
 }

  // Hash the checked password
  $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

  // Send the data to the model
  $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

  // Check and report the result
  if($regOutcome === 1){
    $message = "<p id='success_field_alert'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
    include '../view/login.php';
    exit;
  } else {
    $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
    include '../view/registration.php';
    exit;
  }  
    break;

// Log-in page validation 
    case 'Login':
      $clientEmail = filter_input(INPUT_POST, 'clientEmail',  FILTER_SANITIZE_EMAIL);
      $clientPassword = filter_input(INPUT_POST, 'clientPassword',  FILTER_SANITIZE_STRING);
      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);

  
  // Check for missing data
  if (empty($clientEmail) || empty($checkPassword)){
    $message = '<p class="empty_field_alert">Please provide information for all empty form fields.</p>';
    include '../view/login.php';
    exit; 
 }


      break;

// los-ing page view 
   case 'login':
    include '../view/login.php';
    break;

    case 'registration':
      include '../view/registration.php';
      break;
   
   default:
    include '../view/login.php';
  }
?>