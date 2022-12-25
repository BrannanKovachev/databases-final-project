-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2022-04-22 02:23:43.005

-- foreign keys
ALTER TABLE Litter
    DROP FOREIGN KEY Adult_Dogs_Litter;

ALTER TABLE Litter
    DROP FOREIGN KEY Litter_Adult_Dogs;

ALTER TABLE Puppies
    DROP FOREIGN KEY Pricing_Puppies;

ALTER TABLE Puppies
    DROP FOREIGN KEY Puppies_Litter;

ALTER TABLE Puppies
    DROP FOREIGN KEY Puppies_Locations;

ALTER TABLE Puppies
    DROP FOREIGN KEY Puppies_Users;

-- tables
DROP TABLE Adult_Dogs;

DROP TABLE Litter;

DROP TABLE Locations;

DROP TABLE Pricing;

DROP TABLE Puppies;

DROP TABLE Users;

-- End of file.-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2022-04-22 04:05:01.978

-- tables
-- Table: Adult_Dogs
CREATE TABLE Adult_Dogs (
    DogID int NOT NULL AUTO_INCREMENT,
    Name varchar(20) NOT NULL,
    PersonallyOwned bool NOT NULL,
    Gender varchar(6) NOT NULL,
    CONSTRAINT Adult_Dogs_pk PRIMARY KEY (DogID)
);

-- Table: Litter
CREATE TABLE Litter (
    LitterID int NOT NULL AUTO_INCREMENT,
    MotherID int NOT NULL,
    FatherID int NOT NULL,
    CONSTRAINT Litter_pk PRIMARY KEY (LitterID)
);

-- Table: Locations
CREATE TABLE Locations (
    LocationID int NOT NULL AUTO_INCREMENT,
    Street varchar(30) NOT NULL,
    Zip int NOT NULL,
    State varchar(10) NOT NULL,
    City varchar(25) NOT NULL,
    CONSTRAINT Locations_pk PRIMARY KEY (LocationID)
);

-- Table: Pricing
CREATE TABLE Pricing (
    Licensed bool NOT NULL,
    Gender varchar(6) NOT NULL,
    Ichthyosis varchar(10) NOT NULL,
    Price int NOT NULL,
    CONSTRAINT Licensed PRIMARY KEY (Licensed,Gender,Ichthyosis)
);

-- Table: Puppies
CREATE TABLE Puppies (
    LitterID int NOT NULL,
    CollarColor varchar(10) NOT NULL,
    Gender varchar(6) NULL,
    UserReservingID int NULL,
    Delivered bool NOT NULL,
    Heart varchar(10) NULL,
    Eyes varchar(10) NULL,
    Ichthyosis varchar(10) NULL,
    LocationID int NOT NULL,
    Licensed bool NULL,
    CONSTRAINT Puppies_pk PRIMARY KEY (LitterID,CollarColor,Gender)
);

-- Table: Users
CREATE TABLE Users (
    UserID int NOT NULL AUTO_INCREMENT,
    UserType int NOT NULL,
    Name varchar(20) NOT NULL,
    Email varchar(30) NOT NULL,
    Phone varchar(15) NOT NULL,
    CONSTRAINT UserID PRIMARY KEY (UserID)
);

-- foreign keys
-- Reference: Adult_Dogs_Litter (table: Litter)
ALTER TABLE Litter ADD CONSTRAINT Adult_Dogs_Litter FOREIGN KEY Adult_Dogs_Litter (FatherID)
    REFERENCES Adult_Dogs (DogID);

-- Reference: Litter_Adult_Dogs (table: Litter)
ALTER TABLE Litter ADD CONSTRAINT Litter_Adult_Dogs FOREIGN KEY Litter_Adult_Dogs (MotherID)
    REFERENCES Adult_Dogs (DogID);

-- Reference: Pricing_Puppies (table: Puppies)
ALTER TABLE Puppies ADD CONSTRAINT Pricing_Puppies FOREIGN KEY Pricing_Puppies (Licensed,Gender,Ichthyosis)
    REFERENCES Pricing (Licensed,Gender,Ichthyosis);

-- Reference: Puppies_Litter (table: Puppies)
ALTER TABLE Puppies ADD CONSTRAINT Puppies_Litter FOREIGN KEY Puppies_Litter (LitterID)
    REFERENCES Litter (LitterID);

-- Reference: Puppies_Locations (table: Puppies)
ALTER TABLE Puppies ADD CONSTRAINT Puppies_Locations FOREIGN KEY Puppies_Locations (LocationID)
    REFERENCES Locations (LocationID);

-- Reference: Puppies_Users (table: Puppies)
ALTER TABLE Puppies ADD CONSTRAINT Puppies_Users FOREIGN KEY Puppies_Users (UserReservingID)
    REFERENCES Users (UserID);

-- End of file.

