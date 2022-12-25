-- SELECTS and Concatenates Mother and Father of a Litter
SELECT GROUP_CONCAT(Adult_Dogs.Name) as Parents, Litter.LitterID 
FROM Litter JOIN Adult_Dogs ON Litter.MotherID = Adult_Dogs.DogID OR Litter.FatherID = Adult_Dogs.DogID 
GROUP BY(Litter.LitterID);

-- SELECTS Price based on primary keys, looking for only distinct values, and it accounts for possible null keys
SELECT DISTINCT Price, Puppies.Licensed AS PL, Puppies.Gender AS PG, Puppies.Ichthyosis AS PICH
FROM Puppies LEFT JOIN Pricing ON Puppies.Licensed = Pricing.Licensed and Puppies.Ichthyosis = Pricing.Ichthyosis and Puppies.Gender = Pricing.Gender;
-- 

-- READ QUERY: Combines above as well as Selecting values from Puppies table and Puppies' location values and User Reserving
SELECT Puppies.LitterID, Parents, Puppies.CollarColor, Puppies.Gender, CONCAT(Users.Name,': ',Users.Email)as UserReserving, Puppies.Licensed, Puppies.Heart, Puppies.Eyes, Puppies.Ichthyosis, CONCAT(Locations.Street,', ',Locations.City,', ',Locations.State,' ',Locations.Zip) AS Address, Price
FROM Puppies JOIN (
    SELECT GROUP_CONCAT(Adult_Dogs.Name SEPARATOR ', ') as Parents, Litter.LitterID 
    FROM Litter JOIN Adult_Dogs ON Litter.MotherID = Adult_Dogs.DogID OR Litter.FatherID = Adult_Dogs.DogID 
    GROUP BY(Litter.LitterID)) AS T      
    ON Puppies.LitterID = T.LitterID JOIN Locations ON Puppies.LocationID = Locations.LocationID
LEFT JOIN (
    SELECT DISTINCT Price, Puppies.Licensed AS PL, Puppies.Gender AS PG, Puppies.Ichthyosis AS PICH
    FROM Puppies LEFT JOIN Pricing ON Puppies.Licensed = Pricing.Licensed and Puppies.Ichthyosis = Pricing.Ichthyosis and Puppies.Gender = Pricing.Gender) AS Q 
    ON Puppies.Licensed = PL and Puppies.Ichthyosis = PICH and Puppies.Gender = PG
LEFT JOIN Users ON Puppies.UserReservingID = Users.UserID
WHERE Delivered = false
ORDER BY Address;

-- Query to get all Female Adult Dogs and their IDs
SELECT DogID, Name FROM Adult_Dogs WHERE Gender='Female';

-- Query to get all Addresses on one Line
SELECT LocationID, CONCAT(Locations.Street,', ',Locations.City,', ',Locations.State,' ',Locations.Zip) AS Address FROM Locations;

-- Selects all Litters of input Father/Mother pair
SELECT LitterID FROM Litter where MotherID = 3 and FatherID = 1;

-- Insert Litter Pair
INSERT INTO Litter (MotherID, FatherID) VALUES (2, 1);

-- Insert Into Puppies
INSERT INTO Puppies VALUES (4, 'Pink', 'Female', 5, 0, 'Bad', 'Monitor', 'Negative', 3, NULL);

-- Aggregate Query: Select Mother/Father of a Litter and count of available puppies in that litter sorting by that count
SELECT Parents, COUNT(CASE WHEN UserReservingID IS NULL THEN 1 END) AS 'Number of Available Puppies'
From Puppies JOIN (
    SELECT GROUP_CONCAT(Adult_Dogs.Name SEPARATOR ', ') as Parents, Litter.LitterID 
    FROM Litter JOIN Adult_Dogs ON Litter.MotherID = Adult_Dogs.DogID OR Litter.FatherID = Adult_Dogs.DogID 
    GROUP BY(Litter.LitterID)) AS T
    ON Puppies.LitterID = T.LitterID
GROUP BY(Puppies.LitterID) 
ORDER BY COUNT(CASE WHEN UserReservingID IS NULL THEN 1 END) DESC;

-- Query 3: For each female adult dog name, list all user's names 
-- who bought her puppies on one line - Use group_concat
SELECT Adult_Dogs.Name, GROUP_CONCAT(DISTINCT Users.Name SEPARATOR ', ') AS Names
FROM Users JOIN Puppies on Puppies.UserReservingID = Users.UserID NATURAL JOIN Litter 
join Adult_Dogs on Litter.MotherID = Adult_Dogs.DogID
Group BY(Adult_Dogs.DogID);

-- Query 2: List all puppies from a litter that was fathered by the dog 'Oscar'
SELECT Parents, Puppies.LitterID, Puppies.CollarColor, Puppies.Gender
    FROM Puppies JOIN(SELECT GROUP_CONCAT(Adult_Dogs.Name SEPARATOR ', ') as Parents, Litter.LitterID 
    FROM Litter JOIN Adult_Dogs ON Litter.MotherID = Adult_Dogs.DogID OR Litter.FatherID = Adult_Dogs.DogID 
    GROUP BY(Litter.LitterID)) AS P ON Puppies.LitterID = P.LitterID
WHERE Puppies.LitterID IN (
    SELECT Litter.LitterID 
    FROM Litter JOIN Adult_Dogs ON Litter.FatherID = Adult_Dogs.DogID 
    WHERE Adult_Dogs.Name = 'Oscar');

-- Query 3: For each Price, list all User names who purchased a puppy for that price, use group_concat
SELECT Pricing.Price, GROUP_CONCAT(Users.Name SEPARATOR ', ') AS Names
FROM Pricing NATURAL JOIN Puppies JOIN Users ON Puppies.UserReservingID = Users.UserID
GROUP BY(Pricing.Price);