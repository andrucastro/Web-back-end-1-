<?php

function dynamicMenu($classifications){
   
// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
   $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';
  return $navList;

}

// Email Validation 
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
   }

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
   }  

// Build the classifications select list 
function buildClassificationList($classifications){ 
   $classificationList = '<select name="classificationId" id="classificationList">'; 
   $classificationList .= "<option>Choose a Classification</option>"; 
   foreach ($classifications as $classification) { 
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
   } 
   $classificationList .= '</select>'; 
   return $classificationList; 
  }
  
//Build tamble of vehicles by classification
function buildVehiclesDisplay($vehicles){
   $dv = '<ul id="inv-display">';
   foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<a href='/phpmotors/vehicles/?action=vehicle-detail&invId=".urlencode($vehicle['invId'])."'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
    $dv .= '<hr>';
    $dv .= "<a href='/phpmotors/vehicles/?action=vehicle-detail&invId=".urlencode($vehicle['invId'])."'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
    $dv .= "<span>$vehicle[invPrice]</span>";
    $dv .= '</li>';
   }
   $dv .= '</ul>';
   return $dv;
  }

  //Build tamble of vehicles by ID 
function vehiclesDisplayInfo($vehicleInfo){
   $detail = "<div id='imageDetail'>";
   $detail .= "<img src='$vehicleInfo[invImage]' alt='Image of $vehicleInfo[invMake] $vehicleInfo[invModel]'>";
   $detail .= '</div>';
   $detail .= '<div>';
   $detail .= "<h2>$vehicleInfo[invMake] $vehicleInfo[invModel]</h2>";
   $detail .="<p><span>Model</span>: $vehicleInfo[invModel]</p>";
   $detail .="<p><span>Make</span>: $vehicleInfo[invMake]</p>";
   $detail .="<hr>";
   $detail .="<h3>Description</h3>";
   $detail .="<p> $vehicleInfo[invDescription]</p>";
   $detail .="<p><span>Color</span>: $vehicleInfo[invColor]</p>";
   $detail .="<p><span>Stock:</span>: $vehicleInfo[invStock]</p>";
   $price= number_format($vehicleInfo['invPrice'], 2,',','.');
   $detail .="<p id='price'><span>Price</span>: $$price</p>";
   $detail .= '</div>';
   return $detail;
  }

?>