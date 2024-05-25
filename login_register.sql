SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `login_register`
--

-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `login_register` ;
--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) unique NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','customer','service_provider') default 'customer' NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` ( `full_name`, `email`, `password`, `user_type`) VALUES
('Aktar', 'aktar@gmail.com', md5('12345'), 'admin');
COMMIT;