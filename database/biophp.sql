-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 01:16 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biophp`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `c_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `t_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `u_id` int(11) NOT NULL,
  `directory` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`t_id`, `name`, `u_id`, `directory`, `date`) VALUES
(1, 'Sequence manipulation and data', 1, 'tools/sequence_manipulation_and_data', '2022-06-02 19:07:52'),
(2, 'Melting Temperature (Tm) Calculator', 1, 'tools/melting_temperature', '2022-06-02 19:09:26'),
(3, 'PCR Amplification', 1, 'tools/pcr_amplification', '2022-06-02 19:09:49'),
(4, 'Microsatellite Repeats Finder', 1, 'tools/microsatellite_repeats_finder', '2022-06-02 19:10:11'),
(5, 'Find Palindromic Sequences', 1, 'tools/find_palindromes', '2022-06-02 19:10:24'),
(6, 'Alignment of DNA/Protein sequences', 1, 'tools/seq_alignment', '2022-06-02 19:10:54'),
(7, 'Restriction digest of DNA', 1, 'tools/restriction_digest', '2022-06-02 19:11:10'),
(8, 'DNA to protein', 1, 'tools/dna_to_protein', '2022-06-02 19:11:26'),
(9, 'Protein to DNA', 1, 'tools/protein_to_dna', '2022-06-02 19:11:56'),
(10, 'Microarray analysis: adaptive quantification', 1, 'tools/microarray_analysis_adaptive_quantification', '2022-06-02 19:12:11'),
(11, 'Protein sequence information', 1, 'tools/protein_properties', '2022-06-02 19:31:33'),
(12, 'Reduced alphabets for proteins', 1, 'tools/reduce_protein_alphabet', '2022-06-02 19:31:59'),
(15, 'Oligonucleotide Frequency', 1, 'tools/oligonucleotide_frequency', '2022-06-02 19:33:03'),
(16, 'Oligonucleotides for distance among sequences', 1, 'tools/distance_among_sequences', '2022-06-02 19:33:25'),
(17, 'Random sequences', 1, 'tools/random_seqs', '2022-06-02 19:34:27'),
(18, 'Useful formulas', 1, 'tools/useful_formulas', '2022-06-02 19:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'PK_User',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(5) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `date`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$XxNLGFQF89wXmyIy/oaQ4OQtFzqj.bPjrssPpc5.HkhXywcjAH6Zi', 'admin', '2022-06-02 12:21:38'),
(20, 'ANAS', 'abc@xyz.com', '$2y$10$GGZP8M/CKdPRP9VPGcvsGO1hiNEuJ75ZA93U2XlDT9cWA1CvIPmoW', 'user', '2022-06-02 13:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_tools`
--

CREATE TABLE `user_tools` (
  `ut_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tools`
--

INSERT INTO `user_tools` (`ut_id`, `u_id`, `name`, `filename`, `status`, `date`) VALUES
(1, 20, 'Tool 1', '', 1, '2022-06-02 23:51:31'),
(2, 20, 'Tool 2', 'file_16542067496292.zip', 0, '2022-06-02 23:52:29'),
(3, 20, 'Tool 3', 'file_16542068037201.zip', 2, '2022-06-02 23:53:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_tools`
--
ALTER TABLE `user_tools`
  ADD PRIMARY KEY (`ut_id`),
  ADD KEY `u_id` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK_User', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_tools`
--
ALTER TABLE `user_tools`
  MODIFY `ut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tools`
--
ALTER TABLE `tools`
  ADD CONSTRAINT `tools_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_tools`
--
ALTER TABLE `user_tools`
  ADD CONSTRAINT `user_tools_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
