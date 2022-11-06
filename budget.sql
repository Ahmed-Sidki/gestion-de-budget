
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `categorie` varchar(30),
  `name` varchar(100) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `date_budget` date
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

