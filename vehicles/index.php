<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles 
require_once '../model/vehicles-model.php';

// Get the array of classifications
$classifications = getClassifications();


// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/?action=' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
$navList .= "<li><a href='/phpmotors/vehicles/?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}

$navList .= '</ul>';


// Build a dropdown Menu for car clasifications

$dropdownClasification ='<select id="classificationId" name="classificationId">';
$dropdownClasification.="<option value='1'>SUV</option>";
foreach ($classifications as $classification) {
$dropdownClasification .= "<option value='$classification[classificationId]'> $classification[classificationName]</option>";
} 

$dropdownClasification.= '</select>';


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
        include '../view/vehicle-man.php';
        exit;

      } else {
        $message = "<p>Sorry $classificationName, but the process failed. Please try again.</p>";
        include '../view/add-classification.php';
        exit;
      } 
       break;

    //---------------------------------------------------- ADD A NEW VEHICLE -------------------------------------------
    case'addvehicle':
      $invMake = filter_input(INPUT_POST,'invMake');
      $invModel = filter_input(INPUT_POST, 'invModel');
      $invDescription = filter_input(INPUT_POST, 'invDescription');
      $invImage = filter_input(INPUT_POST, 'invImage');
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
      $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_VALIDATE_INT);
      $invStock = filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_INT);
      $invColor = filter_input(INPUT_POST, 'invColor');
      $classificationId = filter_input(INPUT_POST,'classificationId', FILTER_VALIDATE_INT);

      // Check for missing data
  if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
    $message = '<p class="empty_field_alert">Please provide information for all empty form fields.</p>';
    include '../view/add-vehicle.php';
    exit; 
 }

  $regOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

  if($regOutcome === 1){
    $message = "<p>New vehicle $invMake $invModel was added.</p>";
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
