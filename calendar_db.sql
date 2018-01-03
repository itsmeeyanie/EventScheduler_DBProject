-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2018 at 11:25 AM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calendar_db`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `addEvent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addEvent` (IN `param_id` INT(11), IN `param_event` VARCHAR(100), IN `param_fname` VARCHAR(100), IN `param_org` VARCHAR(100), IN `param_cnum` TEXT, IN `param_rdate` DATE, IN `param_stime` TIME, IN `param_etime` TIME)  BEGIN
INSERT INTO tbl_event(event, fname, org, cnum, rdate, stime, etime)
values
(param_event, param_fname, param_org, 
param_cnum, param_rdate, param_stime,
param_etime);
END$$

DROP PROCEDURE IF EXISTS `add_event`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_event` (IN `event` VARCHAR(100), IN `fname` VARCHAR(100), IN `org` VARCHAR(100), IN `cnum` TEXT, IN `rdate` DATE, IN `stime` TIME, IN `etime` TIME)  BEGIN
insert into tbl_event(event, fname, org, cnum, rdate, stime, etime) values
(event, fname, org, cnum, rdate, stime, etime);
END$$

DROP PROCEDURE IF EXISTS `selectByDate`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectByDate` (INOUT `byDate` DATE)  BEGIN
SELECT rdate from tbl_event where rdate=byDate;
END$$

DROP PROCEDURE IF EXISTS `viewDataByDate`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewDataByDate` (IN `byDate` DATE)  SELECT * FROM tbl_event WHERE rdate = byDate$$

DROP PROCEDURE IF EXISTS `viewDataById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `viewDataById` (IN `num` INT)  BEGIN
SELECT * FROM tbl_event WHERE id=num;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `pword` varchar(50) DEFAULT NULL,
  `flname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pword`, `flname`) VALUES
(1, 'admin', 'admin', 'admin'),
(3, 'admindiana', 'a916d306333e689f72113502789fc15d', 'Diana Kev'),
(6, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Triggers `admin`
--
DROP TRIGGER IF EXISTS `after_admin_insert`;
DELIMITER $$
CREATE TRIGGER `after_admin_insert` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'added',
id = NEW.id,
data = NEW.username,
tbl_name = 'admin',
on_date = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_admin_delete`;
DELIMITER $$
CREATE TRIGGER `before_admin_delete` BEFORE DELETE ON `admin` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'deleted',
id = OLD.id,
data = OLD.username,
tbl_name = 'admin',
on_date = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_admin_update`;
DELIMITER $$
CREATE TRIGGER `before_admin_update` BEFORE UPDATE ON `admin` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'updated',
id = OLD.id,
data = OLD.username,
tbl_name = 'admin',
on_date = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) DEFAULT NULL,
  `email` text,
  `cnum` text,
  `stat` varchar(50) DEFAULT NULL,
  `org` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `fname`, `email`, `cnum`, `stat`, `org`) VALUES
(1, 'Daien Carev', 'daiencarev@gmail.com', '09266994458', 'OCSC Representative', 'OCSC'),
(2, 'Shawn Mendes', 'shawn@gmail.com', '09786574167', 'Class Mayor', 'BSIT-3A'),
(3, 'Jimmy McArthur', 'jimmy@gmail.com', '09897890757', 'Manager', 'McDo'),
(4, 'Finland Freng', 'fin@gmail.com', '09123456789', 'Student', 'KKB 2018'),
(5, 'Gary Valencia', 'valencia@gmail.com', '09897867564', 'Instructor', 'IT Department Faculty'),
(6, 'Divina Hoe', 'div@gmail.com', '09785679285', 'LC Governor', 'Local Council');

--
-- Triggers `client`
--
DROP TRIGGER IF EXISTS `after_client_insert`;
DELIMITER $$
CREATE TRIGGER `after_client_insert` AFTER INSERT ON `client` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'added',
id = NEW.id,
data = NEW.fname,
tbl_name = 'client',
on_date = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_client_delete`;
DELIMITER $$
CREATE TRIGGER `before_client_delete` BEFORE DELETE ON `client` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'deleted',
id = OLD.id,
data = OLD.fname,
tbl_name = 'client',
on_date = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_client_update`;
DELIMITER $$
CREATE TRIGGER `before_client_update` BEFORE UPDATE ON `client` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'updated',
id = OLD.id,
data = OLD.fname,
tbl_name = 'client',
on_date = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `eventlist`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `eventlist`;
CREATE TABLE IF NOT EXISTS `eventlist` (
);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org` varchar(50) DEFAULT NULL,
  `ad` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `org`, `ad`, `description`) VALUES
(1, 'OCSC', 'Obrero, Davao City', 'Student Council'),
(2, 'BSIT-3B', 'USEP Main Campus', 'IT Class from Institute of Computing'),
(3, 'McDonalds', 'Bolton, Davao City', 'Fast Food'),
(4, 'KKB 2018', 'Bisag Asa St. Ambot, Wakokabalo City', 'Youth For The Future Organization'),
(5, 'IT Department Faculty', 'Usep Main Campus', 'Faculty/Staff'),
(6, 'Local Council', 'USEP Main Campus', 'USEP LC');

--
-- Triggers `organization`
--
DROP TRIGGER IF EXISTS `after_organization_insert`;
DELIMITER $$
CREATE TRIGGER `after_organization_insert` AFTER INSERT ON `organization` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'added',
id = NEW.id,
data = NEW.org,
tbl_name = 'organization',
on_date = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_organization_delete`;
DELIMITER $$
CREATE TRIGGER `before_organization_delete` BEFORE DELETE ON `organization` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'deleted',
id = OLD.id,
data = OLD.org,
tbl_name = 'organization',
on_date = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_organization_update`;
DELIMITER $$
CREATE TRIGGER `before_organization_update` BEFORE UPDATE ON `organization` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'updated',
id = OLD.id,
data = OLD.org,
tbl_name = 'organization',
on_date = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

DROP TABLE IF EXISTS `tbl_event`;
CREATE TABLE IF NOT EXISTS `tbl_event` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `o_id` int(11) DEFAULT NULL,
  `org` varchar(100) DEFAULT NULL,
  `rdate` date DEFAULT NULL,
  `stime` time DEFAULT NULL,
  `etime` time DEFAULT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`eid`, `event`, `fname`, `o_id`, `org`, `rdate`, `stime`, `etime`) VALUES
(1, 'General Meeting', 'Daien Carev', 1, 'OCSC', '2018-01-03', '08:15:00', '11:30:00'),
(2, '2018 Election', 'Shawn Mendes', 2, 'BSIT-3B', '2018-01-08', '11:00:00', '11:59:00'),
(3, 'McDo Anniversary', 'Jimmy McArthur', 3, 'McDo', '2018-01-09', '08:00:00', '12:00:00'),
(4, 'Meeting', 'Daien Carev', 1, 'OCSC', '2018-01-09', '13:00:00', '17:00:00'),
(5, '10th Years KKB Anniversary', 'Finland Freng', 4, 'KKB 2018', '2018-01-10', '08:00:00', '20:00:00'),
(6, 'Team Building', 'Gary Valencia', 5, 'IT Department Faculty', '2018-01-17', '07:00:00', '20:00:00'),
(8, 'Chikahan ni Tita', 'Gary Valencia', 5, 'IT', '2018-01-26', '09:30:00', '11:45:00'),
(9, 'Forum', 'Divina Hoe', 6, 'Local Council', '2018-01-25', '09:15:00', '11:00:00');

--
-- Triggers `tbl_event`
--
DROP TRIGGER IF EXISTS `after_event_insert`;
DELIMITER $$
CREATE TRIGGER `after_event_insert` AFTER INSERT ON `tbl_event` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'added',
id = NEW.eid,
data = NEW.event,
tbl_name = 'tbl_event',
on_date = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_event_delete`;
DELIMITER $$
CREATE TRIGGER `before_event_delete` BEFORE DELETE ON `tbl_event` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'deleted',
id = OLD.eid,
data = OLD.event,
tbl_name = 'tbl_event',
on_date = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_event_update`;
DELIMITER $$
CREATE TRIGGER `before_event_update` BEFORE UPDATE ON `tbl_event` FOR EACH ROW BEGIN
INSERT INTO tbl_logs
set action = 'updated',
id = OLD.eid,
data = OLD.event,
tbl_name = 'tbl_event',
on_date = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

DROP TABLE IF EXISTS `tbl_logs`;
CREATE TABLE IF NOT EXISTS `tbl_logs` (
  `action` varchar(20) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `data` varchar(50) DEFAULT NULL,
  `tbl_name` varchar(20) DEFAULT NULL,
  `on_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`action`, `id`, `data`, `tbl_name`, `on_date`) VALUES
('added', 5, 'Gary Valencia', 'client', '2018-01-03'),
('added', 5, 'IT Faculty', 'organization', '2018-01-03'),
('updated', 5, 'Gary Valencia', 'client', '2018-01-03'),
('updated', 5, 'Gary Valencia', 'client', '2018-01-03'),
('updated', 5, 'IT Faculty', 'organization', '2018-01-03'),
('added', 6, 'Team Building', 'tbl_event', '2018-01-03'),
('updated', 6, 'Team Building', 'tbl_event', '2018-01-03'),
('added', 7, 'fdhd', 'tbl_event', '2018-01-03'),
('deleted', 7, 'fdhd', 'tbl_event', '2018-01-03'),
('added', 8, 'Chikahan ni Tita', 'tbl_event', '2018-01-03'),
('added', 2, 'admindiana', 'admin', '2018-01-03'),
('deleted', 2, 'admindiana', 'admin', '2018-01-03'),
('added', 3, 'admindiana', 'admin', '2018-01-03'),
('added', 4, 'admin', 'admin', '2018-01-03'),
('deleted', 4, 'admin', 'admin', '2018-01-03'),
('added', 5, 'admindiana', 'admin', '2018-01-03'),
('added', 6, 'admin', 'admin', '2018-01-03'),
('deleted', 5, 'admindiana', 'admin', '2018-01-03'),
('added', 6, 'Divina Hoe', 'client', '2018-01-03'),
('added', 6, 'Local Council', 'organization', '2018-01-03'),
('added', 9, 'Forum', 'tbl_event', '2018-01-03');

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewdate`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `viewdate`;
CREATE TABLE IF NOT EXISTS `viewdate` (
`rdate` date
);

-- --------------------------------------------------------

--
-- Structure for view `eventlist`
--
DROP TABLE IF EXISTS `eventlist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eventlist`  AS  select `tbl_event`.`id` AS `id`,`tbl_event`.`event` AS `event`,`tbl_event`.`fname` AS `fname`,`tbl_event`.`org` AS `org`,`tbl_event`.`cnum` AS `cnum`,`tbl_event`.`rdate` AS `rdate`,`tbl_event`.`stime` AS `stime`,`tbl_event`.`etime` AS `etime` from `tbl_event` ;

-- --------------------------------------------------------

--
-- Structure for view `viewdate`
--
DROP TABLE IF EXISTS `viewdate`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewdate`  AS  select `tbl_event`.`rdate` AS `rdate` from `tbl_event` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
