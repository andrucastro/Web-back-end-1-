

/* Insert the following new client to the clients table (Note: The clientId and clientLevel fields should handle their own values and do not need to be part of this query.):
Tony, Stark, tony@starkent.com, Iam1ronM@n, "I am the real Ironman"*/

INSERT INTO clients (clientFirstname,clientLastname,clientEmail,clientPassword,comment) 
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');

/*Modify the Tony Stark record to change the clientLevel to 3. The previous insert query will have to have been stored in the database for the update query to work.*/
UPDATE clients SET clientLevel =3 WHERE clientFirstname = 'Tony';

/*Modify the Tony Stark record to change the clientLevel to 3. The previous insert query will have to have been stored in the database for the update query to work.*/
UPDATE inventory SET invDescription = REPLACE('Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation', 'GM Hummer', 'small interior') WHERE invModel ='Hummer';

/* Use an inner join to select the invModel field from the inventory table and the classificationName field from the carclassification table for inventory items that belong to the "SUV" category. (These resources may help you: https://www.w3schools.com/sql/sql_join.asp and https://www.youtube.com/watch?v=0FEjw2HnfDs) Four records should be returned as a result of the query.*/

SELECT invModel, classificationName FROM inventory INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId WHERE classificationName = 'SUV'

/*Delete the Jeep Wrangler from the database. [Note: You can restore the Inventory table by importing the SQL file that was used to create it again].*/

DELETE from inventory WHERE invMake = 'jeep';

/* Update all records in the Inventory table to add "/phpmotors" to the beginning of the file path in the invImage and invThumbnail columns using a single query. These references may prove helpful - SQL Update, SQL Concat().*/ 
UPDATE inventory SET invImage = CONCAT('/phpmotors', invImage), invThumbnail = CONCAT('/phpmotors', invThumbnail);  