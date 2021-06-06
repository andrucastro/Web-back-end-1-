<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles 
require_once '../model/vehicles-model.php';
// Get validation functions
require_once '../library/functions.php';

$classifications = getClassifications();

//Display classification menu
$navList = dynamicMenu($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action){

     //---------------------------------------------------- ADD A NEW CAR CLASSIFICATION-------------------------------------------
  case'addClassification':
    $classificationName = filter_input(INPUT_POST, 'classificationName');
    
    // Check for missing data
    if(empty($classificationName)){
      $message = '<p class="empty_field_alert">Please add a car classification in the empty form fields.</p>';
      include '../view/add-classification.php';
      exit; 
    }

      //Send the data to the model
      $regOutcome = newclassification($classificationName);

    
      if($regOutcome === 1){
        $message = "<p>New Classification $classificationName. added.</p>";
        header("Location: /phpmotors/vehicles/");;
        exit;

      } else {
        $message = "<p>Sorry $classificationName, but the process failed. Please try again.</p>";
        include '../view/add-classification.php';
        exit;
      } 
       break;

    //---------------------------------------------------- ADD A NEW VEHICLE -------------------------------------------
    case'addvehicle':
      $invMake = trim(filter_input(INPUT_POST,'invMake', FILTER_SANITIZE_STRING));
      $invModel = trim(filter_input(INPUT_POST, 'invModel',  FILTER_SANITIZE_STRING));
      $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
      $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
      $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail',  FILTER_SANITIZE_STRING));
      $invPrice = trim(filter_input(INPUT_POST, 'invPrice',  FILTER_SANITIZE_NUMBER_INT));
      $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
      $invColor = trim(filter_input(INPUT_POST, 'invColor',  FILTER_SANITIZE_STRING ));
      $classificationId = trim(filter_input(INPUT_POST,'classificationId', FILTER_SANITIZE_NUMBER_INT));

      // Check for missing data
  if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
    $message = '<p class="empty_field_alert">Please provide information for all empty form fields.</p>';
    include '../view/add-vehicle.php';
    exit; 
 }

  $regOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

  if($regOutcome === 1){
    $message = "<p id='success_field_alert'>New vehicle $invMake $invModel was added.</p>";
    include '../view/vehicle-man.php';
    exit;

  } else {
    $message = "<p>Sorry, the process failed. Please try again.</p>";
    include '../view/add-vehicle.php';
    exit;
  } 
  break;

    case'add-classification':
      include '../view/add-classification.php';
      break;

    case'add-vehicle':
      include '../view/add-vehicle.php';
      break;
    
   default:
    include '../view/vehicle-man.php';
  }
 
?>
