--
-- Database: `fly`
CREATE DATABASE fly;

USE fly;

-- --------------------------------------------------------
--
-- Table structure for table `admin`
--
CREATE TABLE IF NOT EXISTS `admin` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(50) NOT NULL
) ENGINE = InnoDB;

-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `firstName` VARCHAR(255) NOT NULL,
  `lastName` VARCHAR(255) NOT NULL
) ENGINE = InnoDB;

-- --------------------------------------------------------
--
-- Table structure for table `flight`
--
CREATE TABLE IF NOT EXISTS `flight` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `type` VARCHAR(255) NOT NULL,
  `origin` VARCHAR(255) NOT NULL,
  `destination` VARCHAR(255) NOT NULL,
  `departing` VARCHAR(50) NOT NULL,
  `returning` VARCHAR(50) DEFAULT 'null',
  `seats` INT NOT NULL DEFAULT '0',
  `price` DECIMAL(10, 2) NOT NULL,
  `iat` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- --------------------------------------------------------
--
-- Table structure for table `reservation`
--
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `uid` INT NOT NULL,
  `fid` INT NOT NULL,
  FOREIGN KEY (`uid`) REFERENCES `users` (`id`),
  FOREIGN KEY (`fid`) REFERENCES `flight` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;

-- --------------------------------------------------------
--
-- Table structure for table `passenger`
--
CREATE TABLE IF NOT EXISTS `passenger` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `rid` INT DEFAULT NULL,
  `name` VARCHAR(100) NOT NULL,
  `birth` VARCHAR(50) NOT NULL,
  FOREIGN KEY (`rid`) REFERENCES `reservation` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;

-- --------------------------------------------------------
--
-- Dumping data for table `admin`
--
-- !! email is : admin@gmail.com
-- !! Password is : admin
INSERT INTO admin(email, password, name)
VALUES('admin@gmail.com', '$2y$10$7SwVUNDe1mLeOAJKSK4D6OLMooil6Vyu4C7HGjWqojUzlaAePF3IW', '__Admin__');

-- --------------------------------------------------------
--
-- Dumping data for table `flight`
--
INSERT INTO flight(TYPE, origin, destination, departing, RETURNING, seats, price)
VALUES('Round trip', 'Seville', 'Dublin', '2021-06-09', '2021-05-11', 50, 868),
      ('One way', 'Prague', 'Prague', '2021-09-15', 'null', 166, 2570),
      ('Round trip', 'Copenhagen', 'istanbul', '2021-03-09', '2021-05-11', 3, 1089),
      ('Round trip', 'Porto', 'Dubrovnik', '2021-05-11', '2021-06-09', 41, 1316),
      ('Round trip', 'Saint Petersburg', 'Malta', '2021-05-16', '2021-03-11', 86, 2338),
      ('Round trip', 'Frankfurt', 'Brussels', '2021-09-21', '2021-02-11', 128, 655),
      ('One way', 'Madrid', 'Milan', '2021-03-23', 'null', 82, 1125),
      ('One way', 'Jerusalem', 'Granada', '2021-12-12', 'null', 19, 2354),
      ('One way', 'Prague', 'London', '2021-12-21', 'null', 141, 2338),
      ('One way', 'Granada', 'Rome', '2021-03-28', 'null', 101, 3477),
      ('Round trip', 'Granada', 'Saint Petersburg', '2021-04-11', '2021-02-15', 62, 2991),
      ('One way', 'Naples', 'Munich', '2021-09-15', 'null', 155, 949),
      ('One way', 'Dublin', 'Salzburg', '2021-05-16', 'null', 170, 1553),
      ('Round trip', 'Amsterdam', 'Salzburg', '2021-12-12', '2021-05-20', 115, 1715),
      ('One way', 'Seville', 'Paris', '2021-03-19', 'null', 44, 655),
      ('Round trip', 'Granada', 'istanbul', '2021-05-16', '2021-08-28', 117, 2108),
      ('Round trip', 'Seville', 'Jerusalem', '2021-03-13', '2021-01-15', 64, 828),
      ('Round trip', 'Madrid', 'Jerusalem', '2021-09-26', '2021-05-20', 34, 1833),
      ('Round trip', 'Brussels', 'Santorini', '2021-07-14', '2021-03-21', 8, 962),
      ('Round trip', 'London', 'Frankfurt', '2021-03-21', '2021-04-11', 139, 368),
      ('Round trip', 'Salzburg', 'Malta', '2021-02-15', '2021-10-28', 130, 1553),
      ('Round trip', 'Copenhagen', 'London', '2021-07-14', '2021-06-13', 6, 1050),
      ('Round trip', 'Naples', 'Dublin', '2021-06-13', '2021-04-03', 151, 330),
      ('One way', 'Cairo', 'Rome', '2021-05-25', 'null', 23, 278),
      ('One way', 'Santorini', 'Vienna', '2021-03-13', 'null', 85, 913),
      ('One way', 'Edinburgh', 'Vienna', '2021-08-16', 'null', 147, 1077),
      ('One way', 'Prague', 'Santorini', '2021-03-09', 'null', 18, 591),
      ('One way', 'Milan', 'Porto', '2021-03-15', 'null', 56, 868),
      ('Round trip', 'Jerusalem', 'Lisbon', '2021-12-30', '2021-09-26', 33, 1732),
      ('Round trip', 'Saint Petersburg', 'Zagreb', '2021-03-11', '2021-08-28', 130, 2991),
      ('One way', 'Zagreb', 'Dubrovnik', '2021-03-19', 'null', 142, 911),
      ('One way', 'Mykonos', 'Malta', '2021-06-09', 'null', 98, 972),
      ('Round trip', 'Granada', 'Nice', '2021-07-30', '2021-03-19', 36, 1156),
      ('Round trip', 'Santorini', 'Bruges', '2021-05-25', '2021-06-07', 33, 2338),
      ('One way', 'Paris', 'Moscow', '2021-10-28', 'null', 91, 868),
      ('Round trip', 'istanbul', 'Edinburgh', '2021-04-20', '2021-08-28', 29, 962),
      ('Round trip', 'Paris', 'Santorini', '2021-12-30', '2021-04-11', 125, 570),
      ('One way', 'Florence', 'Krakow', '2021-05-30', 'null', 117, 729),
      ('Round trip', 'Seville', 'istanbul', '2021-04-20', '2021-12-30', 151, 1089),
      ('One way', 'Lisbon', 'Cairo', '2021-12-12', 'null', 109, 3914);