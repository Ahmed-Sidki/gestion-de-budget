SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `date_revenu` date
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

