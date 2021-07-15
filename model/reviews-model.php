<?php
/****************************
        Reviews Model 
***************************/

// Add a new review 
function addReview($reviewText, $invId, $clientId){
$db = phpmotorsConnect();
$sql = 'INSERT INTO reviews (reviewText, invId, clientId)
VALUES (:reviewText,:invId, :clientId)';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
$stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
} 

// Get the reviews from the DB for an specific vehicle
function getReviewsById($invId){
$db = phpmotorsConnect();
$sql = "SELECT * FROM reviews JOIN clients ON reviews.clientId = clients.clientId WHERE reviews.invId = :invId";
$stmt = $db->prepare($sql);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->execute();
$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $invInfo;
}

// Get the reviews from the DB for an specific client 
function getReviewsByCleintId($clientId){
$db = phpmotorsConnect();
$sql = "SELECT * FROM reviews JOIN inventory ON reviews.invId = inventory.invId WHERE reviews.clientId = :clientId";
$stmt = $db->prepare($sql);
$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
$stmt->execute();
$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $invInfo;
}


// Get the reviews by review ID
function getReviewsByReviewId($reviewId){
$db = phpmotorsConnect();
$sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
$stmt->execute();
$invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $invInfo;
}


// update a review 
function updateReveiwbyReviewId($reviewId,$reviewDate,$reviewText){
$db = phpmotorsConnect();
$sql = 'UPDATE reviews SET reviewText = :reviewText, reviewDate = :reviewDate WHERE reviewId =:reviewId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
$stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_STR);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

// Delete a review 
function deleteReview($reviewId){
$db = phpmotorsConnect();
$sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}


?>