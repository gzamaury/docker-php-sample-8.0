SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `example`
--

CREATE DATABASE IF NOT EXISTS `example` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `example`;

--
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE `animals` (
  `id` int(11) UNSIGNED NOT NULL,
  `common_name` varchar(255) NOT NULL DEFAULT '',
  `scientific_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `common_name`, `scientific_name`) VALUES
(1, 'Bison', 'Bos gaurus'),
(2, 'Black buck', 'Antelope cervicapra'),
(3, 'Chinkara', 'Gazella bennettii'),
(4, 'Nilgai', 'Boselaphus tragocamelus'),
(5, 'Wolf', 'Canis lupus'),
(6, 'Lion', 'Panthera leo'),
(7, 'Elephant', 'Elephas maximus'),
(8, 'Wild Ass', 'Equus africanus asinus'),
(9, 'Panther', 'Panthera pardus'),
(10, 'Kashmir stag', 'Cervus canadensis hanglu'),
(11, 'Peacock', 'Pavo cristatus'),
(12, 'Siberian crane', 'Grus leucogeranus'),
(13, 'Fox', 'Vulpes vulpes'),
(14, 'Rhinoceros', 'Rhinoceros unicornis'),
(15, 'Tiger', 'Panthera Tigris'),
(16, 'Crocodile', 'Crocodylus palustris'),
(17, 'Gavial or Gharial', 'Gavialis gangeticus'),
(18, 'Horse', 'Equus caballus'),
(19, 'Zebra', 'Equus quagga'),
(20, 'Buffalow', 'Babalus bubalis'),
(21, 'Wild boar', 'Sus scrofa'),
(22, 'Arabian camel', 'Camelus dromedaries'),
(23, 'Giraffe', 'GiraffaÊcamelopardalis'),
(24, 'House wall Lizard', 'Hemidactylus flaviviridis'),
(25, 'Hippopotamus', 'Hippopotamus amphibius'),
(26, 'Rhesus monkey', 'Macaca mulatta'),
(27, 'Dog', 'Canis lupus familiaris'),
(28, 'Cat', 'Felis domesticus'),
(29, 'Cheetah', 'Acinonyx jubatus'),
(30, 'Black rat', 'Rattus rattus'),
(31, 'House mouse', 'Mus musculus'),
(32, 'Rabbit', 'Oryctolagus cuniculus'),
(33, 'Great horned owl', 'Bubo virginianus'),
(34, 'House sparrow', 'Passer domesticus'),
(35, 'House crow', 'Corvus splendens'),
(36, 'Common myna', 'Acridotheres tristis'),
(37, 'Indian parrot', 'Psittacula eupatria'),
(38, 'Bulbul', 'Molpastes cafer'),
(39, 'Koel', 'Eudynamis scolopaccus'),
(40, 'Pigeon', 'Columba livia'),
(41, 'Indian Cobra', 'Naja naja'),
(42, 'King cobra', 'Ophiophagus hannah'),
(43, 'Sea snake', 'Hydrophiinae'),
(44, 'Indian python', 'Python molurus'),
(45, 'Rat snake', 'Rat snake');

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;
