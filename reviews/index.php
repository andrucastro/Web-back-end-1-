<?php

// Create or access a Session
session_start();

require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the reviews
require_once '../model/reviews-model.php';
// Get the vehicles 
require_once '../model/vehicles-model.php';
// Get img Uploads
require_once '../model/uploads-model.php';
// Get External functions
require_once '../library/functions.php';


$classifications = getClassifications();

//Display classification menu
$navList = dynamicMenu($classifications);

// Display reviews in the management view
if(isset($_SESSION['clientData'])){
    $clientId = $_SESSION['clientData']['clientId'];
    $userReviews = getReviewsByCleintId($clientId);
    
    $managementReview = reviewsMangment($userReviews);
    }
    
 

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}


switch ($action){

    case'submitReview':
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $screenName = filter_input(INPUT_POST, 'screenName', FILTER_SANITIZE_STRING);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        
        // Build behicles detailed view again    
        $vehicleInfo = getVehiclesInfoDetail($invId);
        $vehicleThumbnails = getVehiclesImgThumbnails($invId);
        $displayThumbnails= buildThumbnails($vehicleThumbnails);
        $vehiclesDisplayInfo = vehiclesDisplayInfo($vehicleInfo);
    
        if (empty($invId) || empty($clientId) || empty($screenName) || empty($reviewText)) {
        $message = '<p class="empty_field_alert">Please complete all information for the item! Double check the classification of the item.</p>';
         //get the views by ID 
         $reviews = getReviewsById($invId);
        $displayReviews = displayReviews($reviews);  
        include '../view/vehicle-detail.php';
        exit;
        }
        //Send information to the model and submit the info to the DB
        $reviewResutl = addReview($reviewText, $invId, $clientId);

        //Check Submission based on number of rows changed
        if ($reviewResutl) {
            $message = "<p id='success_field_alert'>Congratulations, the review was successfully submited.</p>";
            
            //get the views by ID 
            $reviews = getReviewsById($invId);
            //Display the veiws on screen when a new view is added 
            $displayReviews = displayReviews($reviews);    

            include '../view/vehicle-detail.php';
            exit;

        }else {
            $message = "<p class='notice'>Error. Please try to enter your review again.</p>";
            include '../view/vehicle-detail.php';
            exit;
        }
    break;

    case'update-review': 

        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewsdetails = getReviewsByReviewId($reviewId);
        if(count( $reviewsdetails)<1){
            $message = 'Sorry, no vehicle information could be found.';
            }
        include '../view/update-review.php';
    break;

    case'submit-update':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewDate = filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING);

        if(empty($reviewId) || empty($reviewText) || empty($reviewDate)) {
        $message = '<p class="empty_field_alert">Please complete all information for the item! Double check the classification of the item.</p>';
        $_SESSION['message'] = $message;

        //rebuild the view
        $reviewsdetails = getReviewsByReviewId($reviewId);

        header("location: /phpmotors/reviews/?action=update-review&reviewId=$reviewsdetails[reviewId]");
        exit;
       }
       // send information to the model (update review)
       $updateResult = updateReveiwbyReviewId($reviewId,$reviewDate,$reviewText);

       if ($updateResult) {
        $message = "<p id='success_field_alert'>Congratulations, the review was successfully updated.</p>";
         $_SESSION['message'] = $message;
         header('location: /phpmotors/reviews/');
         exit;
       } else {
         $message = "<p class='notice'>Error. the review was not updated.</p>";
        include '../view/admin.php';
          exit;
         }
    break;

    case'delete-review':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewsdetails = getReviewsByReviewId($reviewId);
        if(count( $reviewsdetails)<1){
            $message = 'Sorry, no vehicle information could be found.';
            }
        include '../view/delete-review.php';
    break;

    case'submit-delete':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $deleteResult = deleteReview($reviewId);

        if($deleteResult){
            $message = "<p id='success_field_alert'>Congratulations the, review was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews/');
            exit;
            }else{
            $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
            header('location: /phpmotors/reviews/');
              exit;
            }
    break;    
    default:
  
     include '../view/admin.php';


}
?>