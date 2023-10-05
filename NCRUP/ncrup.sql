-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 05:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ncrup`
--

-- --------------------------------------------------------

--
-- Table structure for table `frsc_db`
--

CREATE TABLE `frsc_db` (
  `id` int(11) NOT NULL,
  `ucrNumber` varchar(20) NOT NULL,
  `license_number` varchar(20) NOT NULL,
  `validity` date NOT NULL,
  `restrictions` varchar(100) DEFAULT NULL,
  `owner_name` varchar(100) NOT NULL,
  `vehicle_identification_number` varchar(50) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `violation_details` varchar(200) DEFAULT NULL,
  `accident_details` varchar(200) DEFAULT NULL,
  `penalties` varchar(200) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `fingerprints` blob DEFAULT NULL,
  `photograph` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `frsc_db`
--

INSERT INTO `frsc_db` (`id`, `ucrNumber`, `license_number`, `validity`, `restrictions`, `owner_name`, `vehicle_identification_number`, `license_plate`, `violation_details`, `accident_details`, `penalties`, `gender`, `fingerprints`, `photograph`) VALUES
(1, 'UCR001', 'DRV1234567890', '2022-12-31', 'None', 'John Oduma Akpan', 'VIN001', 'ABC123', 'No violations', 'No accidents', 'No penalties', 'Male', NULL, NULL),
(2, 'UCR002', 'DRV0987654321', '2023-06-30', 'None', 'William Smith', 'VIN002', 'XYZ789', 'Speeding', 'No accidents', 'Fine imposed', NULL, NULL, NULL),
(3, 'UCR003', 'DRV2468135790', '2023-09-15', 'Glasses', 'Mike Johnson', 'VIN003', 'PQR456', 'No violations', 'Minor collision', 'Warning issued', NULL, NULL, NULL),
(4, 'UCR004', 'DRV1357924680', '2023-07-31', 'None', 'Ada Okon', 'VIN004', 'MNO987', 'Expired registration', 'No accidents', 'License suspension', 'Female', NULL, NULL),
(5, 'UCR005', 'DRV5678901234', '2023-04-30', 'None', 'Chinedu Eze King', 'VIN005', 'DEF456', 'No violations', 'No accidents', 'No penalties', NULL, NULL, NULL),
(6, 'UCR006', 'DRV4321098765', '2023-11-30', 'None', 'Aisha Abdullahi', 'VIN006', 'JKL321', 'No violations', 'No accidents', 'No penalties', NULL, NULL, NULL),
(7, 'UCR007', 'DRV9876543210', '2023-10-15', 'None', 'Emeka Okafor', 'VIN007', 'GHI654', 'Speeding', 'No accidents', 'Fine imposed', NULL, NULL, NULL),
(8, 'UCR008', 'DRV6789012345', '2023-08-31', 'None', 'Fatima Ibrahim', 'VIN008', 'STU987', 'No violations', 'No accidents', 'No penalties', NULL, NULL, NULL),
(9, 'UCR009', 'DRV3210987654', '2023-05-31', 'Seatbelt', 'Abdul Ahmed', 'VIN009', 'VWX321', 'No violations', 'No accidents', 'No penalties', NULL, NULL, NULL),
(10, 'UCR010', 'DRV8901234567', '2023-07-15', 'None', 'Blessing Okoro', 'VIN010', 'RST654', 'Expired insurance', 'No accidents', 'Fine imposed', NULL, NULL, NULL),
(14, 'UCR0290', 'DRV0310', '2023-07-04', 'None', 'Dennis Johnson', 'VIN8901', 'DRV0580657321', 'None', 'None', 'None', 'male', NULL, NULL);

--
-- Triggers `frsc_db`
--
DELIMITER $$
CREATE TRIGGER `frsc_delete_trigger` AFTER DELETE ON `frsc_db` FOR EACH ROW BEGIN
DELETE FROM unified_db WHERE ucrNumber = OLD.ucrNumber;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `frsc_insert_trigger` AFTER INSERT ON `frsc_db` FOR EACH ROW BEGIN
  IF EXISTS (SELECT * FROM unified_db WHERE ucrNumber = NEW.ucrNumber) THEN
    UPDATE unified_db
    SET license_number = NEW.license_number,
        validity = NEW.validity,
        restrictions = NEW.restrictions,
        owner_name = NEW.owner_name,
        vehicle_identification_number = NEW.vehicle_identification_number,
        license_plate = NEW.license_plate,
        gender = NEW.gender,
        violation_details = NEW.violation_details,
        accident_details = NEW.accident_details,
        penalties = NEW.penalties
    WHERE ucrNumber = NEW.ucrNumber;
  ELSE
    INSERT INTO unified_db (ucrNumber, license_number, validity, restrictions, owner_name, vehicle_identification_number, license_plate, gender, violation_details, accident_details, penalties)
    VALUES (NEW.ucrNumber, NEW.license_number, NEW.validity, NEW.restrictions, NEW.owner_name, NEW.vehicle_identification_number, NEW.license_plate, NEW.gender, NEW.violation_details, NEW.accident_details, NEW.penalties);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `frsc_update_trigger` AFTER UPDATE ON `frsc_db` FOR EACH ROW BEGIN
IF EXISTS (SELECT * FROM unified_db WHERE ucrNumber = OLD.ucrNumber) THEN
UPDATE unified_db
SET license_number = NEW.license_number,
validity = NEW.validity,
restrictions = NEW.restrictions,
owner_name = NEW.owner_name,
vehicle_identification_number = NEW.vehicle_identification_number,
license_plate = NEW.license_plate,
gender = NEW.gender,
violation_details = NEW.violation_details,
accident_details = NEW.accident_details,
penalties = NEW.penalties
WHERE ucrNumber = OLD.ucrNumber;
ELSE
INSERT INTO unified_db (ucrNumber, license_number, validity, restrictions, owner_name, vehicle_identification_number, license_plate, gender, violation_details, accident_details, penalties)
VALUES (NEW.ucrNumber, NEW.license_number, NEW.validity, NEW.restrictions, NEW.owner_name, NEW.vehicle_identification_number, NEW.license_plate, NEW.gender, NEW.violation_details, NEW.accident_details, NEW.penalties);
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `immigration_db`
--

CREATE TABLE `immigration_db` (
  `id` int(11) NOT NULL,
  `ucrNumber` varchar(10) DEFAULT NULL,
  `passportNumber` varchar(50) DEFAULT NULL,
  `passportIssueDate` date DEFAULT NULL,
  `passportExpiryDate` date DEFAULT NULL,
  `visaInformation` varchar(255) DEFAULT NULL,
  `travelHistory` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `photograph` blob DEFAULT NULL,
  `fingerprints` blob DEFAULT NULL,
  `entryExitStamps` varchar(255) DEFAULT NULL,
  `permits` varchar(255) DEFAULT NULL,
  `permanentResidencyInfo` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immigration_db`
--

INSERT INTO `immigration_db` (`id`, `ucrNumber`, `passportNumber`, `passportIssueDate`, `passportExpiryDate`, `visaInformation`, `travelHistory`, `name`, `dateOfBirth`, `nationality`, `photograph`, `fingerprints`, `entryExitStamps`, `permits`, `permanentResidencyInfo`, `gender`) VALUES
(1, 'UCR001', 'P123456', '2022-01-01', '2027-01-01', 'Tourist Visa', 'USA, Canada', 'John Oduma Akpan', '1990-01-01', 'Nigerian', NULL, NULL, 'Stamped', 'Work Permit', 'Permanent Resident', NULL),
(2, 'UCR002', 'P234567', '2023-02-01', '2028-02-01', 'Business Visa', 'UK, France', 'William Smith', '1992-05-15', 'Nigerian', NULL, NULL, 'Stamped', 'Visitor Visa', 'Not Applicable', NULL),
(3, 'UCR003', 'P345678', '2024-03-01', '2029-03-01', 'Student Visa', 'Germany, Netherlands', 'Mike Johnson', '1985-12-10', 'Nigerian', NULL, NULL, 'Stamped', 'Study Permit', 'Not Applicable', NULL),
(4, 'UCR004', 'P456789', '2025-04-01', '2030-04-01', 'Work Visa', 'Australia, New Zealand', 'Ada Okon', '1998-07-20', 'Nigerian', NULL, NULL, 'Stamped', 'Work Permit', 'Not Applicable', NULL),
(5, 'UCR005', 'P567890', '2026-05-01', '2031-05-01', 'Tourist Visa', 'Brazil, Argentina', 'Chinedu Eze King', '1994-04-05', 'Nigerian', NULL, NULL, 'Stamped', 'Visitor Visa', 'Not Applicable', NULL),
(6, 'UCR006', 'P678901', '2027-06-01', '2032-06-01', 'Business Visa', 'China, Japan', 'Aisha Abdullahi', '1991-11-27', 'Nigerian', NULL, NULL, 'Stamped', 'Work Permit', 'Not Applicable', NULL),
(7, 'UCR007', 'P789012', '2028-07-01', '2033-07-01', 'Work Visa', 'Saudi Arabia, UAE', 'Emeka Okafor', '1982-09-15', 'Nigerian', NULL, NULL, 'Stamped', 'Work Permit', 'Not Applicable', NULL),
(8, 'UCR008', 'P890123', '2029-08-01', '2034-08-01', 'Student Visa', 'Sweden, Norway', 'Fatima Ibrahim', '1996-03-10', 'Nigerian', NULL, NULL, 'Stamped', 'Study Permit', 'Not Applicable', NULL),
(9, 'UCR009', 'P901234', '2030-09-01', '2035-09-01', 'Tourist Visa', 'Spain, Italy', 'Abdul Ahmed', '1993-08-25', 'Nigerian', NULL, NULL, 'Stamped', 'Visitor Visa', 'Not Applicable', NULL),
(10, 'UCR010', 'P012345', '2031-10-01', '2036-10-01', 'Business Visa', 'South Africa, Egypt', 'Blessing Okoro', '1997-06-12', 'Nigerian', NULL, NULL, 'Stamped', 'Work Permit', 'Not Applicable', NULL),
(13, 'UCR0290', 'P290413', '2021-05-12', '2023-07-28', 'Student Visa', 'None', 'Dennis Johnson', '2000-06-01', 'Nigerian', '', '', 'Stamped', 'Study Permit', 'Not Applicable', 'male');

--
-- Triggers `immigration_db`
--
DELIMITER $$
CREATE TRIGGER `immigration_delete_trigger` AFTER DELETE ON `immigration_db` FOR EACH ROW BEGIN
DELETE FROM unified_db WHERE ucrNumber = OLD.ucrNumber;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `immigration_insert_trigger` AFTER INSERT ON `immigration_db` FOR EACH ROW BEGIN
  IF EXISTS (SELECT * FROM unified_db WHERE ucrNumber = NEW.ucrNumber) THEN
    UPDATE unified_db
    SET passportNumber = NEW.passportNumber,
        passportIssueDate = NEW.passportIssueDate,
        passportExpiryDate = NEW.passportExpiryDate,
        visaInformation = NEW.visaInformation,
        travelHistory = NEW.travelHistory,
        name = NEW.name,
        gender = NEW.gender,
        dateOfBirth = NEW.dateOfBirth,
        nationality = NEW.nationality,
        photograph = NEW.photograph,
        fingerprints = NEW.fingerprints,
        entryExitStamps = NEW.entryExitStamps,
        permits = NEW.permits,
        permanentResidencyInfo = NEW.permanentResidencyInfo
    WHERE ucrNumber = NEW.ucrNumber;
  ELSE
    INSERT INTO unified_db (ucrNumber, passportNumber, passportIssueDate, passportExpiryDate, visaInformation, travelHistory, name, gender, dateOfBirth, nationality, photograph, fingerprints, entryExitStamps, permits, permanentResidencyInfo)
    VALUES (NEW.ucrNumber, NEW.passportNumber, NEW.passportIssueDate, NEW.passportExpiryDate, NEW.visaInformation, NEW.travelHistory, NEW.name, NEW.gender, NEW.dateOfBirth, NEW.nationality, NEW.photograph, NEW.fingerprints, NEW.entryExitStamps, NEW.permits, NEW.permanentResidencyInfo);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `immigration_update_trigger` AFTER UPDATE ON `immigration_db` FOR EACH ROW BEGIN
IF EXISTS (SELECT * FROM unified_db WHERE ucrNumber = OLD.ucrNumber) THEN
UPDATE unified_db
SET passportNumber = NEW.passportNumber,
passportIssueDate = NEW.passportIssueDate,
passportExpiryDate = NEW.passportExpiryDate,
visaInformation = NEW.visaInformation,
travelHistory = NEW.travelHistory,
name = NEW.name,
gender = NEW.gender,
dateOfBirth = NEW.dateOfBirth,
nationality = NEW.nationality,
photograph = NEW.photograph,
fingerprints = NEW.fingerprints,
entryExitStamps = NEW.entryExitStamps,
permits = NEW.permits,
permanentResidencyInfo = NEW.permanentResidencyInfo
WHERE ucrNumber = OLD.ucrNumber;
ELSE
INSERT INTO unified_db (ucrNumber, passportNumber, passportIssueDate, passportExpiryDate, visaInformation, travelHistory, name, gender, dateOfBirth, nationality, photograph, fingerprints, entryExitStamps, permits, permanentResidencyInfo)
VALUES (NEW.ucrNumber, NEW.passportNumber, NEW.passportIssueDate, NEW.passportExpiryDate, NEW.visaInformation, NEW.travelHistory, NEW.name, NEW.gender, NEW.dateOfBirth, NEW.nationality, NEW.photograph, NEW.fingerprints, NEW.entryExitStamps, NEW.permits, NEW.permanentResidencyInfo);
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inec_db`
--

CREATE TABLE `inec_db` (
  `id` int(11) NOT NULL,
  `ucrNumber` varchar(20) NOT NULL,
  `voterRegistrationInfo` varchar(255) DEFAULT NULL,
  `voterIdentificationNumber` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `votingHistory` varchar(255) DEFAULT NULL,
  `pollingUnitDetails` varchar(255) DEFAULT NULL,
  `politicalPartyAffiliation` varchar(100) DEFAULT NULL,
  `fingerprints` blob DEFAULT NULL,
  `photograph` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inec_db`
--

INSERT INTO `inec_db` (`id`, `ucrNumber`, `voterRegistrationInfo`, `voterIdentificationNumber`, `name`, `dateOfBirth`, `gender`, `nationality`, `address`, `phoneNumber`, `email`, `votingHistory`, `pollingUnitDetails`, `politicalPartyAffiliation`, `fingerprints`, `photograph`) VALUES
(1, 'UCR001', 'Registered at Lagos INEC office', 'PVC001', 'John Oduma Akpan', '1990-01-01', 'Male', 'Nigerian', 'Lagos, Nigeria', '+234123456789', 'johnoduma@example.com', 'Voted in 2019, 2021', 'Polling Unit A', 'Party A', NULL, NULL),
(2, 'UCR002', 'Registered at Abuja INEC office', 'PVC002', 'William Smith', '1992-05-15', 'Female', 'Nigerian', 'Abuja, Nigeria', '+234987654321', 'williamsmith@example.com', 'Voted in 2021', 'Polling Unit B', 'Party B', NULL, NULL),
(3, 'UCR003', 'Registered at Kano INEC office', 'PVC003', 'Mike Johnson', '1985-12-10', 'Male', 'Nigerian', 'Kano, Nigeria', '+234555555555', 'mikejohnson@example.com', 'No voting history', 'Polling Unit C', 'Party C', NULL, NULL),
(4, 'UCR004', 'Registered at Port Harcourt INEC office', 'PVC004', 'Ada Okon', '1998-07-20', 'Female', 'Nigerian', 'Port Harcourt, Nigeria', '+234777777777', 'adaokon@example.com', 'Voted in 2019, 2023', 'Polling Unit D', 'Party A', NULL, NULL),
(5, 'UCR005', 'Registered at Enugu INEC office', 'PVC005', 'Chinedu Eze king', '1994-04-05', 'Male', 'Nigerian', 'Enugu, Nigeria', '+234888888888', 'chinedueze@example.com', 'Voted in 2019, 2021, 2023', 'Polling Unit E', 'Party B', NULL, NULL),
(6, 'UCR006', 'Registered at Kaduna INEC office', 'PVC006', 'Aisha Abdullahi', '1991-11-27', 'Female', 'Nigerian', 'Kaduna, Nigeria', '+234999999999', 'aishaabdullahi@example.com', 'Voted in 2023', 'Polling Unit F', 'Party C', NULL, NULL),
(7, 'UCR007', 'Registered at Owerri INEC office', 'PVC007', 'Emeka Okafor', '1982-09-15', 'Male', 'Nigerian', 'Owerri, Nigeria', '+234111111111', 'emekaokafor@example.com', 'No voting history', 'Polling Unit G', 'Party A', NULL, NULL),
(8, 'UCR008', 'Registered at Katsina INEC office', 'PVC008', 'Fatima Ibrahim', '1996-03-10', 'Female', 'Nigerian', 'Katsina, Nigeria', '+234222222222', 'fatimahibrahim@example.com', 'Voted in 2021', 'Polling Unit H', 'Party B', NULL, NULL),
(9, 'UCR009', 'Registered at Ibadan INEC office', 'PVC009', 'Abdul Ahmed', '1993-08-25', 'Male', 'Nigerian', 'Ibadan, Nigeria', '+234333333333', 'abdulahmed@example.com', 'No voting history', 'Polling Unit I', 'Party C', NULL, NULL),
(10, 'UCR010', 'Registered at Benin City INEC office', 'PVC010', 'Blessing Okoro', '1997-06-12', 'Female', 'Nigerian', 'Benin City, Nigeria', '+234444444444', 'blessingokoro@example.com', 'No voting history', 'Polling Unit J', 'Party A', NULL, NULL),
(17, 'UCR0290', 'Registered at Abuja INEC office', 'PVC912', 'Dennis Johnson', '2000-06-01', 'Male', 'Nigerian', 'Bwari, abuja', '08098078909', 'dennisjohnson@gmail.com	', 'None', 'Polling Unit C', 'Party D', NULL, NULL);

--
-- Triggers `inec_db`
--
DELIMITER $$
CREATE TRIGGER `inec_delete_trigger` AFTER DELETE ON `inec_db` FOR EACH ROW BEGIN
DELETE FROM unified_db WHERE ucrNumber = OLD.ucrNumber;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inec_insert_trigger` AFTER INSERT ON `inec_db` FOR EACH ROW BEGIN
  IF EXISTS (SELECT * FROM unified_db WHERE ucrNumber = NEW.ucrNumber) THEN
    UPDATE unified_db
    SET voterRegistrationInfo = NEW.voterRegistrationInfo,
        voterIdentificationNumber = NEW.voterIdentificationNumber,
        name = NEW.name,
        dateOfBirth = NEW.dateOfBirth,
        gender = NEW.gender,
        nationality = NEW.nationality,
        address = NEW.address,
        phoneNumber = NEW.phoneNumber,
        email = NEW.email,
        votingHistory = NEW.votingHistory,
        pollingUnitDetails = NEW.pollingUnitDetails,
        politicalPartyAffiliation = NEW.politicalPartyAffiliation
    WHERE ucrNumber = NEW.ucrNumber;
  ELSE
    INSERT INTO unified_db (ucrNumber, voterRegistrationInfo, voterIdentificationNumber, name, dateOfBirth, gender, nationality, address, phoneNumber, email, votingHistory, pollingUnitDetails, politicalPartyAffiliation)
    VALUES (NEW.ucrNumber, NEW.voterRegistrationInfo, NEW.voterIdentificationNumber, NEW.name, NEW.dateOfBirth, NEW.gender, NEW.nationality, NEW.address, NEW.phoneNumber, NEW.email, NEW.votingHistory, NEW.pollingUnitDetails, NEW.politicalPartyAffiliation);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inec_update_trigger` AFTER UPDATE ON `inec_db` FOR EACH ROW BEGIN
IF EXISTS (SELECT * FROM unified_db WHERE ucrNumber = OLD.ucrNumber) THEN
UPDATE unified_db
SET voterRegistrationInfo = NEW.voterRegistrationInfo,
voterIdentificationNumber = NEW.voterIdentificationNumber,
name = NEW.name,
dateOfBirth = NEW.dateOfBirth,
gender = NEW.gender,
nationality = NEW.nationality,
address = NEW.address,
phoneNumber = NEW.phoneNumber,
email = NEW.email,
votingHistory = NEW.votingHistory,
pollingUnitDetails = NEW.pollingUnitDetails,
politicalPartyAffiliation = NEW.politicalPartyAffiliation
WHERE ucrNumber = OLD.ucrNumber;
ELSE
INSERT INTO unified_db (ucrNumber, voterRegistrationInfo, voterIdentificationNumber, name, dateOfBirth, gender, nationality, address, phoneNumber, email, votingHistory, pollingUnitDetails, politicalPartyAffiliation)
VALUES (NEW.ucrNumber, NEW.voterRegistrationInfo, NEW.voterIdentificationNumber, NEW.name, NEW.dateOfBirth, NEW.gender, NEW.nationality, NEW.address, NEW.phoneNumber, NEW.email, NEW.votingHistory, NEW.pollingUnitDetails, NEW.politicalPartyAffiliation);
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `nimc_db`
--

CREATE TABLE `nimc_db` (
  `id` int(11) NOT NULL,
  `ucrNumber` varchar(20) DEFAULT NULL,
  `nin` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `fingerprints` blob DEFAULT NULL,
  `photograph` blob DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `citizenshipStatus` varchar(50) DEFAULT NULL,
  `maritalStatus` varchar(20) DEFAULT NULL,
  `employmentDetails` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nimc_db`
--

INSERT INTO `nimc_db` (`id`, `ucrNumber`, `nin`, `name`, `dateOfBirth`, `gender`, `nationality`, `fingerprints`, `photograph`, `address`, `phoneNumber`, `email`, `citizenshipStatus`, `maritalStatus`, `employmentDetails`) VALUES
(1, 'UCR001', 'NIN001', 'John oduma akpan', '1990-01-01', '', 'Nigerian', NULL, NULL, 'Lagos, Nigeria', '+234123456789', 'johnoduma@example.com', 'Citizen', 'Single', 'Software Engineer'),
(2, 'UCR002', 'NIN002', 'William Smith', '1992-05-15', 'Female', 'Nigerian', NULL, NULL, 'Abuja, Nigeria', '+234987654321', 'williamsmith@example.com', 'Citizen', 'Married', 'Teacher'),
(3, 'UCR003', 'NIN003', 'Mike Johnson', '1985-12-10', 'Male', 'Nigerian', NULL, NULL, 'Kano, Nigeria', '+234555555555', 'mikejohnson@example.com', 'Citizen', 'Married', 'Accountant'),
(4, 'UCR004', 'NIN004', 'Ada Okon', '1998-07-20', 'Female', 'Nigerian', NULL, NULL, 'Port Harcourt, Nigeria', '+234777777777', 'adaokon@example.com', 'Citizen', 'Single', 'Nurse'),
(5, 'UCR005', 'NIN005', 'Chinedu Eze king', '1994-04-05', 'Male', 'Nigerian', NULL, NULL, 'Enugu, Nigeria', '+234888888888', 'chinedueze@example.com', 'Citizen', 'Single', 'Business Owner'),
(6, 'UCR006', 'NIN006', 'Aisha Abdullahi', '1991-11-27', 'Female', 'Nigerian', NULL, NULL, 'Kaduna, Nigeria', '+234999999999', 'aishaabdullahi@example.com', 'Citizen', 'Married', 'Doctor'),
(7, 'UCR007', 'NIN007', 'Emeka Okafor', '1982-09-15', 'Male', 'Nigerian', NULL, NULL, 'Owerri, Nigeria', '+234111111111', 'emekaokafor@example.com', 'Citizen', 'Married', 'Architect'),
(8, 'UCR008', 'NIN008', 'Fatima Ibrahim', '1996-03-10', 'Female', 'Nigerian', NULL, NULL, 'Katsina, Nigeria', '+234222222222', 'fatimahibrahim@example.com', 'Citizen', 'Single', 'Graphic Designer'),
(9, 'UCR009', 'NIN009', 'Abdul Ahmed', '1993-08-25', 'Male', 'Nigerian', NULL, NULL, 'Ibadan, Nigeria', '+234333333333', 'abdulahmed@example.com', 'Citizen', 'Single', 'Engineer'),
(10, 'UCR010', 'NIN010', 'Blessing Okoro', '1997-06-12', 'Female', 'Nigerian', NULL, NULL, 'Benin City, Nigeria', '+234444444444', 'blessingokoro@example.com', 'Citizen', 'Single', 'Student'),
(22, 'UCR0290', 'NIN1021', 'Dennis Johnson', '2000-06-01', 'male', NULL, NULL, NULL, 'Bwari, abuja', '08098078909', 'dennisjohnson@gmail.com', 'Citizen', 'Single', 'Student');

--
-- Triggers `nimc_db`
--
DELIMITER $$
CREATE TRIGGER `nimc_delete_trigger` AFTER DELETE ON `nimc_db` FOR EACH ROW BEGIN
DELETE FROM unified_db WHERE ucrNumber = OLD.ucrNumber;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nimc_insert_trigger` AFTER INSERT ON `nimc_db` FOR EACH ROW BEGIN
  IF EXISTS (SELECT * FROM unified_db WHERE ucrNumber = NEW.ucrNumber) THEN
    UPDATE unified_db
    SET nin = NEW.nin,
        name = NEW.name,
        dateOfBirth = NEW.dateOfBirth,
        gender = NEW.gender,
        nationality = NEW.nationality,
        address = NEW.address,
        phoneNumber = NEW.phoneNumber,
        email = NEW.email,
        citizenshipStatus = NEW.citizenshipStatus,
        maritalStatus = NEW.maritalStatus,
        employmentDetails = NEW.employmentDetails
    WHERE ucrNumber = NEW.ucrNumber;
  ELSE
    INSERT INTO unified_db (ucrNumber, nin, name, dateOfBirth, gender, nationality, address, phoneNumber, email, citizenshipStatus, maritalStatus, employmentDetails)
    VALUES (NEW.ucrNumber, NEW.nin, NEW.name, NEW.dateOfBirth, NEW.gender, NEW.nationality, NEW.address, NEW.phoneNumber, NEW.email, NEW.citizenshipStatus, NEW.maritalStatus, NEW.employmentDetails);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nimc_update_trigger` AFTER UPDATE ON `nimc_db` FOR EACH ROW BEGIN
IF EXISTS (SELECT * FROM unified_db WHERE ucrNumber = OLD.ucrNumber) THEN
UPDATE unified_db
SET nin = NEW.nin,
name = NEW.name,
dateOfBirth = NEW.dateOfBirth,
gender = NEW.gender,
nationality = NEW.nationality,
address = NEW.address,
phoneNumber = NEW.phoneNumber,
email = NEW.email,
citizenshipStatus = NEW.citizenshipStatus,
maritalStatus = NEW.maritalStatus,
employmentDetails = NEW.employmentDetails
WHERE ucrNumber = OLD.ucrNumber;
ELSE
INSERT INTO unified_db (ucrNumber, nin, name, dateOfBirth, gender, nationality, address, phoneNumber, email, citizenshipStatus, maritalStatus, employmentDetails)
VALUES (NEW.ucrNumber, NEW.nin, NEW.name, NEW.dateOfBirth, NEW.gender, NEW.nationality, NEW.address, NEW.phoneNumber, NEW.email, NEW.citizenshipStatus, NEW.maritalStatus, NEW.employmentDetails);
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `unified_db`
--

CREATE TABLE `unified_db` (
  `id` int(11) NOT NULL,
  `ucrNumber` varchar(255) DEFAULT NULL,
  `nin` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `citizenshipStatus` varchar(255) DEFAULT NULL,
  `maritalStatus` varchar(255) DEFAULT NULL,
  `employmentDetails` varchar(255) DEFAULT NULL,
  `voterRegistrationInfo` varchar(255) DEFAULT NULL,
  `voterIdentificationNumber` varchar(255) DEFAULT NULL,
  `votingHistory` varchar(255) DEFAULT NULL,
  `pollingUnitDetails` varchar(255) DEFAULT NULL,
  `politicalPartyAffiliation` varchar(255) DEFAULT NULL,
  `passportNumber` varchar(255) DEFAULT NULL,
  `passportIssueDate` date DEFAULT NULL,
  `passportExpiryDate` date DEFAULT NULL,
  `visaInformation` varchar(255) DEFAULT NULL,
  `travelHistory` varchar(255) DEFAULT NULL,
  `photograph` varchar(255) DEFAULT NULL,
  `fingerprints` varchar(255) DEFAULT NULL,
  `entryExitStamps` varchar(255) DEFAULT NULL,
  `permits` varchar(255) DEFAULT NULL,
  `permanentResidencyInfo` varchar(255) DEFAULT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `validity` varchar(255) DEFAULT NULL,
  `restrictions` varchar(255) DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `vehicle_identification_number` varchar(255) DEFAULT NULL,
  `license_plate` varchar(255) DEFAULT NULL,
  `violation_details` varchar(255) DEFAULT NULL,
  `accident_details` varchar(255) DEFAULT NULL,
  `penalties` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unified_db`
--

INSERT INTO `unified_db` (`id`, `ucrNumber`, `nin`, `name`, `dateOfBirth`, `gender`, `nationality`, `address`, `phoneNumber`, `email`, `citizenshipStatus`, `maritalStatus`, `employmentDetails`, `voterRegistrationInfo`, `voterIdentificationNumber`, `votingHistory`, `pollingUnitDetails`, `politicalPartyAffiliation`, `passportNumber`, `passportIssueDate`, `passportExpiryDate`, `visaInformation`, `travelHistory`, `photograph`, `fingerprints`, `entryExitStamps`, `permits`, `permanentResidencyInfo`, `license_number`, `validity`, `restrictions`, `owner_name`, `vehicle_identification_number`, `license_plate`, `violation_details`, `accident_details`, `penalties`) VALUES
(368, 'UCR001', 'NIN001', 'John oduma akpan', '1990-01-01', 'Male', 'Nigerian', 'Lagos, Nigeria', '+234123456789', 'johnoduma@example.com', 'Citizen', 'Single', 'Software Engineer', 'Registered at Lagos INEC office', 'PVC001', 'Voted in 2019, 2021', 'Polling Unit A', 'Party A', 'P123456', '2022-01-01', '2027-01-01', 'Tourist Visa', 'USA, Canada', NULL, NULL, 'Stamped', 'Work Permit', 'Permanent Resident', 'DRV1234567890', '2022-12-31', 'None', 'John Oduma Akpan', 'VIN001', 'ABC123', 'No violations', 'No accidents', 'No penalties'),
(369, 'UCR002', 'NIN002', 'William Smith', '1992-05-15', 'Female', 'Nigerian', 'Abuja, Nigeria', '+234987654321', 'williamsmith@example.com', 'Citizen', 'Married', 'Teacher', 'Registered at Abuja INEC office', 'PVC002', 'Voted in 2021', 'Polling Unit B', 'Party B', 'P234567', '2023-02-01', '2028-02-01', 'Business Visa', 'UK, France', NULL, NULL, 'Stamped', 'Visitor Visa', 'Not Applicable', 'DRV0987654321', '2023-06-30', 'None', 'William Smith', 'VIN002', 'XYZ789', 'Speeding', 'No accidents', 'Fine imposed'),
(370, 'UCR003', 'NIN003', 'Mike Johnson', '1985-12-10', 'Male', 'Nigerian', 'Kano, Nigeria', '+234555555555', 'mikejohnson@example.com', 'Citizen', 'Married', 'Accountant', 'Registered at Kano INEC office', 'PVC003', 'No voting history', 'Polling Unit C', 'Party C', 'P345678', '2024-03-01', '2029-03-01', 'Student Visa', 'Germany, Netherlands', NULL, NULL, 'Stamped', 'Study Permit', 'Not Applicable', 'DRV2468135790', '2023-09-15', 'Glasses', 'Mike Johnson', 'VIN003', 'PQR456', 'No violations', 'Minor collision', 'Warning issued'),
(372, 'UCR005', 'NIN005', 'Chinedu Eze king', '1994-04-05', 'Male', 'Nigerian', 'Enugu, Nigeria', '+234888888888', 'chinedueze@example.com', 'Citizen', 'Single', 'Business Owner', 'Registered at Enugu INEC office', 'PVC005', 'Voted in 2019, 2021, 2023', 'Polling Unit E', 'Party B', 'P567890', '2026-05-01', '2031-05-01', 'Tourist Visa', 'Brazil, Argentina', NULL, NULL, 'Stamped', 'Visitor Visa', 'Not Applicable', 'DRV5678901234', '2023-04-30', 'None', 'Chinedu Eze King', 'VIN005', 'DEF456', 'No violations', 'No accidents', 'No penalties'),
(373, 'UCR006', 'NIN006', 'Aisha Abdullahi', '1991-11-27', 'Female', 'Nigerian', 'Kaduna, Nigeria', '+234999999999', 'aishaabdullahi@example.com', 'Citizen', 'Married', 'Doctor', 'Registered at Kaduna INEC office', 'PVC006', 'Voted in 2023', 'Polling Unit F', 'Party C', 'P678901', '2027-06-01', '2032-06-01', 'Business Visa', 'China, Japan', NULL, NULL, 'Stamped', 'Work Permit', 'Not Applicable', 'DRV4321098765', '2023-11-30', 'None', 'Aisha Abdullahi', 'VIN006', 'JKL321', 'No violations', 'No accidents', 'No penalties'),
(374, 'UCR007', 'NIN007', 'Emeka Okafor', '1982-09-15', 'Male', 'Nigerian', 'Owerri, Nigeria', '+234111111111', 'emekaokafor@example.com', 'Citizen', 'Married', 'Architect', 'Registered at Owerri INEC office', 'PVC007', 'No voting history', 'Polling Unit G', 'Party A', 'P789012', '2028-07-01', '2033-07-01', 'Work Visa', 'Saudi Arabia, UAE', NULL, NULL, 'Stamped', 'Work Permit', 'Not Applicable', 'DRV9876543210', '2023-10-15', 'None', 'Emeka Okafor', 'VIN007', 'GHI654', 'Speeding', 'No accidents', 'Fine imposed'),
(375, 'UCR008', 'NIN008', 'Fatima Ibrahim', '1996-03-10', 'Female', 'Nigerian', 'Katsina, Nigeria', '+234222222222', 'fatimahibrahim@example.com', 'Citizen', 'Single', 'Graphic Designer', 'Registered at Katsina INEC office', 'PVC008', 'Voted in 2021', 'Polling Unit H', 'Party B', 'P890123', '2029-08-01', '2034-08-01', 'Student Visa', 'Sweden, Norway', NULL, NULL, 'Stamped', 'Study Permit', 'Not Applicable', 'DRV6789012345', '2023-08-31', 'None', 'Fatima Ibrahim', 'VIN008', 'STU987', 'No violations', 'No accidents', 'No penalties'),
(376, 'UCR009', 'NIN009', 'Abdul Ahmed', '1993-08-25', 'Male', 'Nigerian', 'Ibadan, Nigeria', '+234333333333', 'abdulahmed@example.com', 'Citizen', 'Single', 'Engineer', 'Registered at Ibadan INEC office', 'PVC009', 'No voting history', 'Polling Unit I', 'Party C', 'P901234', '2030-09-01', '2035-09-01', 'Tourist Visa', 'Spain, Italy', NULL, NULL, 'Stamped', 'Visitor Visa', 'Not Applicable', 'DRV3210987654', '2023-05-31', 'Seatbelt', 'Abdul Ahmed', 'VIN009', 'VWX321', 'No violations', 'No accidents', 'No penalties'),
(377, 'UCR010', 'NIN010', 'Blessing Okoro', '1997-06-12', 'Female', 'Nigerian', 'Benin City, Nigeria', '+234444444444', 'blessingokoro@example.com', 'Citizen', 'Single', 'Student', 'Registered at Benin City INEC office', 'PVC010', 'No voting history', 'Polling Unit J', 'Party A', 'P012345', '2031-10-01', '2036-10-01', 'Business Visa', 'South Africa, Egypt', NULL, NULL, 'Stamped', 'Work Permit', 'Not Applicable', 'DRV8901234567', '2023-07-15', 'None', 'Blessing Okoro', 'VIN010', 'RST654', 'Expired insurance', 'No accidents', 'Fine imposed'),
(392, 'UCR0290', 'NIN1021', 'Dennis Johnson', '2000-06-01', 'Male', 'Nigerian', 'Bwari, abuja', '08098078909', 'dennisjohnson@gmail.com	', 'Citizen', 'Single', 'Student', 'Registered at Abuja INEC office', 'PVC912', 'None', 'Polling Unit C', 'Party D', 'P290413', '2021-05-12', '2023-07-28', 'Student Visa', 'None', '', '', 'Stamped', 'Study Permit', 'Not Applicable', 'DRV0310', '2023-07-04', 'None', 'Dennis Johnson', 'VIN8901', 'DRV0580657321', 'None', 'None', 'None');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `frsc_db`
--
ALTER TABLE `frsc_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immigration_db`
--
ALTER TABLE `immigration_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inec_db`
--
ALTER TABLE `inec_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nimc_db`
--
ALTER TABLE `nimc_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unified_db`
--
ALTER TABLE `unified_db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `frsc_db`
--
ALTER TABLE `frsc_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `immigration_db`
--
ALTER TABLE `immigration_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `inec_db`
--
ALTER TABLE `inec_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nimc_db`
--
ALTER TABLE `nimc_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `unified_db`
--
ALTER TABLE `unified_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
