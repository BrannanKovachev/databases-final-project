INSERT INTO Users VALUES (1, 1, 'Robert Hughes', 'robertb01@gmail.com', '2283271685');
INSERT INTO Users VALUES (2, 1, 'John Smith', 'john@gmail.com', '2283324521');
INSERT INTO Users VALUES (3, 1, 'Mikhala Young', 'mkyoung@gmail.com', '2289430192');
INSERT INTO Users VALUES (4, 1, 'Josh Lingo', 'jklimp@gmail.com', '3557159823');
INSERT INTO Users VALUES (5, 1, 'Matthew Ronald', 'mattr8@gmail.com', '8293847281');
INSERT INTO Users VALUES (6, 1, 'Sheldon Birk', 'bshell15@gmail.com', '2283277135');
INSERT INTO Users VALUES (7, 1, 'Gryphon Winkley', 'gwinkley@gmail.com', '9566788846');


INSERT INTO Locations VALUES (1, '2453 Briarwood Drive', 38655, 'MS', 'Oxford');
INSERT INTO Locations VALUES (2, '253 Sunnyvalle St', 94089, 'CA', 'San Francisco');
INSERT INTO Locations VALUES (3, '5786 Martin Luther Avenue', 30305, 'GA', 'Atlanta');

INSERT INTO Adult_Dogs VALUES (1, 'Rufus', 0, 'Male');
INSERT INTO Adult_Dogs VALUES (2, 'Angie', 1, 'Female');
INSERT INTO Adult_Dogs VALUES (3, 'Jasper', 1, 'Female');
INSERT INTO Adult_Dogs VALUES (4, 'Milo', 0, 'Male');
INSERT INTO Adult_Dogs VALUES (5, 'Oscar', 1, 'Male');
INSERT INTO Adult_Dogs VALUES (6, 'Coco', 0, 'Female');
INSERT INTO Adult_Dogs VALUES (7, 'Bella', 0, 'Female');
INSERT INTO Adult_Dogs VALUES (8, 'Rosie', 0, 'Female');
INSERT INTO Adult_Dogs VALUES (9, 'Duke', 0, 'Male');


INSERT INTO Litter VALUES (1, 3, 1); --Jasper Rufus
INSERT INTO Litter VALUES (2, 2, 4); --Angie Milo
INSERT INTO Litter VALUES (3, 6, 5); --Coco Oscar
INSERT INTO Litter VALUES (4, 3, 5); --Jasper Oscar
INSERT INTO Litter VALUES (5, 7, 4); --Bella Milo
INSERT INTO Litter VALUES (6, 8, 1); --Rosie Rufus
INSERT INTO Litter VALUES (7, 6, 9); --Coco Duke

INSERT INTO Pricing VALUES (0, 'Male', 'Positive', 300);
INSERT INTO Pricing VALUES (1, 'Male', 'Positive', 350);
INSERT INTO Pricing VALUES (0, 'Female', 'Positive', 350);
INSERT INTO Pricing VALUES (1, 'Female', 'Positive', 400);
INSERT INTO Pricing VALUES (0, 'Male', 'Negative', 450);
INSERT INTO Pricing VALUES (1, 'Male', 'Negative', 500);
INSERT INTO Pricing VALUES (0, 'Female', 'Negative', 500);
INSERT INTO Pricing VALUES (1, 'Female', 'Negative', 550);

INSERT INTO Puppies VALUES (1, 'Red', 'Male', 3, 0, 'Good', 'Good', 'Negative', 1, 0);
INSERT INTO Puppies VALUES (1, 'Green', 'Male', 4, 0, 'Good', 'Good', 'Positive', 1, 1);
INSERT INTO Puppies VALUES (1, 'Orange', 'Male', 5, 0, 'Good', 'Good', 'Negative', 2, 1);
INSERT INTO Puppies VALUES (1, 'Red', 'Female', 6, 0, 'Good', 'Good', NULL, 1, 1);
INSERT INTO Puppies VALUES (1, 'Pink', 'Female', NULL, 0, 'Good', 'Good', 'Positive', 1, NULL);
INSERT INTO Puppies VALUES (1, 'Brown', 'Male', NULL, 0, 'Good', 'Monitor', 'Positive', 1, NULL);
INSERT INTO Puppies VALUES (2, 'Blue', 'Male', 3, 1, 'Good', 'Good', 'Positive', 2, 0);
INSERT INTO Puppies VALUES (2, 'White', 'Male', 2, 0, 'Good', 'Good', 'Negative', 1, 0);
INSERT INTO Puppies VALUES (2, 'Purple', 'Male', 1, 0, 'Good', 'Good', 'Negative', 1, 1);
INSERT INTO Puppies VALUES (2, 'Yellow', 'Female', 6, 1, 'Good', 'Good', NULL, 2, 0);
INSERT INTO Puppies VALUES (2, 'Sky Blue', 'Female', NULL, 0, 'Good', 'Good', NULL, 2, NULL);
INSERT INTO Puppies VALUES (3, 'Red', 'Male', 1, 1, 'Good', 'Good', 'Positive', 3, 1);
INSERT INTO Puppies VALUES (3, 'Blue', 'Male', NULL, 0, 'Good', 'Good', 'Positive', 3, 0);
INSERT INTO Puppies VALUES (3, 'Green', 'Male', 4, 0, 'Good', 'Good', 'Negative', 3, 1);
INSERT INTO Puppies VALUES (3, 'Yellow', 'Female', NULL, 0, 'Good', 'Good', NULL, 2, NULL);
INSERT INTO Puppies VALUES (3, 'Black', 'Female', NULL, 0, 'Good', 'Good', 'Positive', 3, NULL);
INSERT INTO Puppies VALUES (4, 'Yellow', 'Female', NULL, 0, 'Good', 'Monitor', 'Positive', 3, NULL);
INSERT INTO Puppies VALUES (4, 'Green', 'Male', NULL, 0, 'Monitor', 'Good', 'Positive', 3, NULL);
INSERT INTO Puppies VALUES (4, 'Brown', 'Male', NULL, 0, 'Monitor', 'Monitor', 'Negative', 3, NULL);
INSERT INTO Puppies VALUES (4, 'Black', 'Male', 1, 0, 'Good', 'Monitor', 'Positive', 3, 0);
INSERT INTO Puppies VALUES (4, 'Pink', 'Male', 2, 0, 'Good', 'Bad', 'Positive', 3, 0);
INSERT INTO Puppies VALUES (4, 'Sky Blue', 'Male', 4, 0, 'Monitor', 'Good', 'Positive', 3, 0);
INSERT INTO Puppies VALUES (5, 'Yellow', 'Male', 3, 0, 'Good', 'Good', 'Negative', 2, 0);
INSERT INTO Puppies VALUES (5, 'Black', 'Male', 2, 0, 'Good', 'Bad', 'Negative', 2, 0);
INSERT INTO Puppies VALUES (5, 'Blue', 'Female', 5, 0, 'Bad', 'Good', 'Negative', 2, 1);
INSERT INTO Puppies VALUES (5, 'Orange', 'Female', 4, 0, 'Bad', 'Good', 'Positive', 2, 1);
INSERT INTO Puppies VALUES (5, 'Grey', 'Male', 2, 0, 'Monitor', 'Good', 'Negative', 2, 1);
INSERT INTO Puppies VALUES (5, 'Purple', 'Female', 3, 1, 'Monitor', 'Good', 'Negative', 2, 1);
INSERT INTO Puppies VALUES (5, 'Yellow', 'Female', 6, 0, 'Bad', 'Good', 'Negative', 2, 1);
INSERT INTO Puppies VALUES (6, 'Sky Blue', 'Male', 3, 0, 'Bad', 'Good', 'Positive', 3, 1);
INSERT INTO Puppies VALUES (6, 'Pink', 'Female', 5, 1, 'Good', 'Monitor', 'Positive', 3, 1);
INSERT INTO Puppies VALUES (6, 'Green', 'Female', 4, 0, 'Good', 'Bad', 'Negative', 3, 1);
INSERT INTO Puppies VALUES (6, 'Yellow', 'Female', 1, 0, 'Monitor', 'Good', 'Positive', 3, 1);
INSERT INTO Puppies VALUES (6, 'White', 'Female', NULL, 0, 'Good', 'Good', 'Positive', 3, NULL);
INSERT INTO Puppies VALUES (7, 'Red', 'Female', 5, 0, 'Good', 'Good', 'Positive', 2, 1);
INSERT INTO Puppies VALUES (7, 'Purple', 'Female', 3, 1, 'Monitor', 'Monitor', 'Positive', 2, 0);
INSERT INTO Puppies VALUES (7, 'White', 'Female', 7, 0, 'Good', 'Monitor', 'Positive', 2, 0);
INSERT INTO Puppies VALUES (7, 'Orange', 'Female', 7, 1, 'Monitor', 'Monitor', 'Positive', 2, 1);
INSERT INTO Puppies VALUES (7, 'Yellow', 'Male', 7, 0, 'Good', 'Good', 'Negative', 2, 0);
INSERT INTO Puppies VALUES (7, 'Pink', 'Male', 6, 1, 'Monitor', 'Bad', 'Negative', 2, 0);