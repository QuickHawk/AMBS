-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema AMBS
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `AMBS` ;

-- -----------------------------------------------------
-- Schema AMBS
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `AMBS` DEFAULT CHARACTER SET utf8 ;
USE `AMBS` ;

-- -----------------------------------------------------
-- Table `AMBS`.`Admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AMBS`.`Admin` ;

CREATE TABLE IF NOT EXISTS `AMBS`.`Admin` (
  `user` VARCHAR(20) NOT NULL,
  `pass` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMBS`.`Hospital`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AMBS`.`Hospital` ;

CREATE TABLE IF NOT EXISTS `AMBS`.`Hospital` (
  `Hospital_ID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `Longitude` FLOAT NOT NULL,
  `Latitude` FLOAT NOT NULL,
  PRIMARY KEY (`Hospital_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMBS`.`Person`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AMBS`.`Person` ;

CREATE TABLE IF NOT EXISTS `AMBS`.`Person` (
  `PID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(10) NOT NULL,
  `blood_type` VARCHAR(5) NOT NULL,
  `Address` VARCHAR(300) NOT NULL,
  `DOB` DATE NOT NULL,
  `Status` INT NOT NULL,
  `OTP` INT NOT NULL,
  PRIMARY KEY (`PID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMBS`.`Patient`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AMBS`.`Patient` ;

CREATE TABLE IF NOT EXISTS `AMBS`.`Patient` (
  `PID` INT NOT NULL,
  `Patient_ID` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Patient_ID`),
  INDEX `Person_ID_idx` (`PID` ASC) VISIBLE,
  CONSTRAINT `Patient_Person_FK`
    FOREIGN KEY (`PID`)
    REFERENCES `AMBS`.`Person` (`PID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMBS`.`Driver`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AMBS`.`Driver` ;

CREATE TABLE IF NOT EXISTS `AMBS`.`Driver` (
  `Driver_ID` INT NOT NULL AUTO_INCREMENT,
  `PID` INT NOT NULL,
  `LicenseNumber` VARCHAR(45) NOT NULL,
  `Image` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Driver_ID`),
  INDEX `Person_ID_idx` (`PID` ASC) VISIBLE,
  CONSTRAINT `Driver_Person_FK`
    FOREIGN KEY (`PID`)
    REFERENCES `AMBS`.`Person` (`PID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMBS`.`Ambulance`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AMBS`.`Ambulance` ;

CREATE TABLE IF NOT EXISTS `AMBS`.`Ambulance` (
  `AID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  `Bill` INT NOT NULL,
  `Image` VARCHAR(45) NOT NULL,
  `Description` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`AID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMBS`.`Transport`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AMBS`.`Transport` ;

CREATE TABLE IF NOT EXISTS `AMBS`.`Transport` (
  `Transport_ID` INT NOT NULL AUTO_INCREMENT,
  `AID` INT NOT NULL,
  `Driver_ID` INT NOT NULL,
  `NumberPlate` VARCHAR(10) NOT NULL,
  `Status` INT NOT NULL,
  `Latitude` FLOAT NOT NULL,
  `Longitude` FLOAT NOT NULL,
  PRIMARY KEY (`Transport_ID`),
  INDEX `Driver_ID_idx` (`Driver_ID` ASC) VISIBLE,
  CONSTRAINT `Ambulance_Transport_FK`
    FOREIGN KEY (`AID`)
    REFERENCES `AMBS`.`Ambulance` (`AID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Transport_Driver_FK`
    FOREIGN KEY (`Driver_ID`)
    REFERENCES `AMBS`.`Driver` (`Driver_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMBS`.`Booking`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AMBS`.`Booking` ;

CREATE TABLE IF NOT EXISTS `AMBS`.`Booking` (
  `Booking_ID` INT NOT NULL AUTO_INCREMENT,
  `Transport_ID` INT NOT NULL,
  `Patient_ID` INT NOT NULL,
  `Hospital_ID` INT NOT NULL,
  `Illness` VARCHAR(100) NOT NULL,
  `LocationFromLat` FLOAT NOT NULL,
  `LocationFromLong` FLOAT NOT NULL,
  `LocationToLat` FLOAT NOT NULL,
  `LocationToLong` FLOAT NOT NULL,
  `Date` DATE NOT NULL,
  `PickUpTime` TIME NOT NULL,
  `Status` INT NOT NULL,
  PRIMARY KEY (`Booking_ID`),
  INDEX `Transport_ID_idx` (`Transport_ID` ASC) VISIBLE,
  INDEX `Patient_ID_idx` (`Patient_ID` ASC) VISIBLE,
  INDEX `Transport_Hospital_FK_idx` (`Hospital_ID` ASC) VISIBLE,
  CONSTRAINT `Transport_Booking_FK`
    FOREIGN KEY (`Transport_ID`)
    REFERENCES `AMBS`.`Transport` (`Transport_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Transport_Patient_FK`
    FOREIGN KEY (`Patient_ID`)
    REFERENCES `AMBS`.`Patient` (`Patient_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Transport_Hospital_FK`
    FOREIGN KEY (`Hospital_ID`)
    REFERENCES `AMBS`.`Hospital` (`Hospital_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `AMBS`.`Admin`
-- -----------------------------------------------------
START TRANSACTION;
USE `AMBS`;
INSERT INTO `AMBS`.`Admin` (`user`, `pass`) VALUES ('admin', 'admin');

COMMIT;


-- -----------------------------------------------------
-- Data for table `AMBS`.`Hospital`
-- -----------------------------------------------------
START TRANSACTION;
USE `AMBS`;
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (1, 'Rainbow Hospitals', 17.4148145, 78.4475692);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (2, 'Guru Nanak CARE Hospitals', 17.4152254, 78.497772);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (3, 'Global Hospital', 17.40527335, 78.4631442);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (4, 'Nizam\'s Institute of Medical Sciences', 17.42217535, 78.451821493652);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (5, 'Princess Durru-e-Shehwar hospital', 17.3671571, 78.4821313786953);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (6, 'Star Hospital', 17.415613, 78.4455414);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (7, 'The crescent hospital', 17.3985187, 78.4458137);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (8, 'Fever Hospital', 17.396402, 78.5010518018791);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (9, 'sri narmada hospital', 17.41354365, 78.4905332974709);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (10, 'Kirloskar Hospital', 17.4036074, 78.4753627);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (11, 'Mediciti Hospital', 17.40654765, 78.4716109431654);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (12, 'Osmania Hospital', 17.372954, 78.4742803480098);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (13, 'Yashoda Hospital', 17.3745622, 78.4998562);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (14, 'Appolo Emergency Hospital', 17.3996329, 78.4791984);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (15, 'sridevi hospital', 17.41019805, 78.4893998610991);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (16, 'Hyderabad Nursing Home', 17.4069043, 78.4761141576334);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (17, 'Tapadia medical centre\'s eashwar lakshmi hospital', 17.411943, 78.4888816);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (18, 'Care Clinic', 17.4206569, 78.4481619);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (19, 'RELIEF HOSPITAL', 17.3983822, 78.4161649);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (20, 'HEALTH CARE CLINIC', 17.3448605, 78.4599543);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (21, 'Olive Hospital', 17.3935487, 78.4273248509208);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (22, 'Mahavir Hospital', 17.4036641, 78.4570626);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (23, 'Tilak Nagar Main Road', 17.3940456, 78.5104248);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (24, 'Care hospital', 17.412491, 78.450315);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (25, 'Care Hospital', 17.4151837, 78.4979585);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (26, 'Rahmat Ali hospital', 17.3672265, 78.4859878);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (27, 'Tanvir Hospital', 17.4297764, 78.4340161);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (28, 'Omega Hospital', 17.4136981, 78.4240311);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (29, 'Old Apollo Hospital', 17.3985586, 78.4814113);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (30, 'Indo US Cancer Hospital', 17.41712885, 78.4305299772386);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (31, 'Woodlands Hospital', 17.3930742, 78.4978226881603);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (32, 'Government General Hospital', 17.3603622, 78.4750407409798);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (33, 'Yashodha Hospital', 17.4244856, 78.4572379);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (34, 'Century hospital', 17.4072675, 78.4442572);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (35, 'Vasavi ENT Hospital', 17.40681, 78.4645023);
INSERT INTO `AMBS`.`Hospital` (`Hospital_ID`, `name`, `Longitude`, `Latitude`) VALUES (36, 'Gandhi Hospitals', 17.4231228, 78.5034538697033);

COMMIT;


-- -----------------------------------------------------
-- Data for table `AMBS`.`Person`
-- -----------------------------------------------------
START TRANSACTION;
USE `AMBS`;
INSERT INTO `AMBS`.`Person` (`PID`, `name`, `email`, `password`, `phone`, `blood_type`, `Address`, `DOB`, `Status`, `OTP`) VALUES (1, 'Aarya', 'a@gmail.com', 'aarya', '1309', 'O+', 'Haveli mein', '2000-04-29', 0, 4269);
INSERT INTO `AMBS`.`Person` (`PID`, `name`, `email`, `password`, `phone`, `blood_type`, `Address`, `DOB`, `Status`, `OTP`) VALUES (2, 'Devarla', 'd@gmail.com', 'devarla', '3902', 'O+', 'Dusre Haveli mein', '2000-04-29', 1, 6548);

COMMIT;


-- -----------------------------------------------------
-- Data for table `AMBS`.`Patient`
-- -----------------------------------------------------
START TRANSACTION;
USE `AMBS`;
INSERT INTO `AMBS`.`Patient` (`PID`, `Patient_ID`) VALUES (2, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `AMBS`.`Driver`
-- -----------------------------------------------------
START TRANSACTION;
USE `AMBS`;
INSERT INTO `AMBS`.`Driver` (`Driver_ID`, `PID`, `LicenseNumber`, `Image`) VALUES (1, 1, 'DJ48924', 'Ek Picture');

COMMIT;


-- -----------------------------------------------------
-- Data for table `AMBS`.`Ambulance`
-- -----------------------------------------------------
START TRANSACTION;
USE `AMBS`;
INSERT INTO `AMBS`.`Ambulance` (`AID`, `Name`, `Bill`, `Image`, `Description`) VALUES (1, 'General', 100, 'ASKD', 'Genera Purpose');

COMMIT;


-- -----------------------------------------------------
-- Data for table `AMBS`.`Transport`
-- -----------------------------------------------------
START TRANSACTION;
USE `AMBS`;
INSERT INTO `AMBS`.`Transport` (`Transport_ID`, `AID`, `Driver_ID`, `NumberPlate`, `Status`, `Latitude`, `Longitude`) VALUES (1, 1, 1, 'TS12F3442', 0, 78.4990208, 17.3768703);

COMMIT;

