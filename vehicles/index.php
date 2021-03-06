<?php

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the reviews
require_once '../model/reviews-model.php';
// Get the vehicles 
require_once '../model/vehicles-model.php';
// Get img Uploads
require_once '../model/uploads-model.php';
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

      /* * ********************************** 
      * Get vehicles by classificationId 
      * Used for starting Update & Delete process 
      * ********************************** */ 
  case 'getInventoryItems': 
      // Get the classificationId 
      $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
      // Fetch the vehicles by classificationId from the DB 
      $inventoryArray = getInventoryByClassification($classificationId); 
      // Convert the array to a JSON object and send it back 
      echo json_encode($inventoryArray); 
  break;

  case 'mod':
      $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1){
      $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-update.php';
      exit;
  break;

  case 'updateVehicle':
      $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
      $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
      $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
      $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
      $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
      
      if (empty($classificationId) || empty($invMake) || empty($invModel) 
      || empty($invDescription) || empty($invImage) || empty($invThumbnail)
      || empty($invPrice) || empty($invStock) || empty($invColor)) {
      $message = '<p>Please complete all information for the item! Double check the classification of the item.</p>';
	    include '../view/vehicle-update.php';
      exit;
     }

      $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);

     if ($updateResult) {
      $message = "<p id='success_field_alert'>Congratulations, the $invMake $invModel was successfully updated.</p>";
       $_SESSION['message'] = $message;
       header('location: /phpmotors/vehicles/');
       exit;
     } else {
       $message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
        include '../view/vehicle-update.php';
        exit;
       }
  break;

  // link in the vehicle management that take me to the delete window      
  case 'del':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if(count($invInfo)<1){
    $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-delete.php';
    exit;
  break;

  // Delete a vehicle function       
  case 'deleteVehicle':
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

      $deleteResult = deleteVehicle($invId);

    if($deleteResult){
      $message = "<p id='success_field_alert'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
      }else{
      $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
      header('location: /phpmotors/vehicles/');
        exit;
      }
  break;

  case 'classification':
      $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
      $vehicles = getVehiclesByClassification($classificationName);
      if(!count($vehicles)){
        $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
      } else {
        $vehicleDisplay = buildVehiclesDisplay($vehicles);
      }
      include '../view/classification.php';
  break;

  //build vechile deteiled view 
  case 'vehicle-detail':
    $invId = filter_input(INPUT_GET, 'invId',  FILTER_VALIDATE_INT);
    $vehicleInfo = getVehiclesInfoDetail($invId);
    $vehicleThumbnails = getVehiclesImgThumbnails($invId);
    //get reviews by id
    $reviews = getReviewsById($invId);
   
    if(!count($vehicleInfo)){
      $message = 'Sorry, no vehicle information could be found.';
    }else{

    // add thumnails in the vehicle detail page   
    $displayThumbnails= buildThumbnails($vehicleThumbnails);
    // add car mode detiles info
    $vehiclesDisplayInfo = vehiclesDisplayInfo($vehicleInfo);
    // add all the reviews in the vehicle detail page 
    $displayReviews = displayReviews($reviews);    

    }

    include '../view/vehicle-detail.php';
  break;  
                                                                                                                                                                                                                                                                 
  case'add-classification':
      include '../view/add-classification.php';
  break;

  case'add-vehicle':
      include '../view/add-vehicle.php';
  break;  
    
   default:
   $classificationList = buildClassificationList($classifications);
    include '../view/vehicle-man.php';
  }
 
?>
