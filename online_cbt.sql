-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2020 at 10:11 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_cbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_questions`
--

CREATE TABLE `all_questions` (
  `q_id` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `opt_a` varchar(255) NOT NULL,
  `opt_b` varchar(255) NOT NULL,
  `opt_c` varchar(255) NOT NULL,
  `opt_d` varchar(255) NOT NULL,
  `ans` varchar(255) NOT NULL,
  `mark` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='All database questions';

--
-- Dumping data for table `all_questions`
--

INSERT INTO `all_questions` (`q_id`, `question`, `opt_a`, `opt_b`, `opt_c`, `opt_d`, `ans`, `mark`, `course_code`) VALUES
(1, 'Which of the following is correct?', 'Mysql is a website', 'Microsoft word is used for word processing', 'Java is database', 'Oracle is the smallest database management system.', 'Microsoft word is used for word processing', 25, 'CSC111'),
(2, 'Which is the most popular server side language', 'Php', 'Node.js', 'Java', 'Ruby', 'Php', 25, 'CSC111'),
(3, 'Which tag defines the biggest heading in HTML', '<h3>', '<h5>', '<h1>', '<h2>', '<h1>', 25, 'CSC111'),
(4, 'What is the full meaning of HTML', 'Hypertext Mark Language', 'Hypartext Markin Language', 'Hypertext Markup Language', 'Hypertext Mark Languages', 'Hypertext Markup Language', 10, 'CSC111'),
(5, 'What is the full meaning of COREN', 'Council for Regulations of Engineering in Nigeria', 'Councils for Regulations of Engineering in Nigeria', 'Council of Regulations of Engineering in Nigeria', 'Council for the Regulation of Engineering in Nigeria', 'Council for the Regulation of Engineering in Nigeria', 10, 'ABE501'),
(6, 'What is the chemical formular for Methane ?', 'CH3', 'CH4', 'CH5', 'CH6', 'CH4', 25, 'CHM101'),
(8, 'Which is the correct chemical formula for Limestone?', 'CaCo3', 'Ca2CO3', 'CaSO4', 'CaC3', 'CaCo3', 25, 'CHM101'),
(9, 'Which of the following is not a Constraint to development practice of Engineering in Nigeria.', 'Dearth of skilled man power at all levels of our development including lecturers', 'lack of fund for long term investment ', 'lack of protection for the locally manufactured goods.', 'Wealth creation through equitable distribution of income ', 'Wealth creation through equitable distribution of income ', 25, 'ABE501'),
(10, 'How many bytes makes a Kilobyte', '1020', '1024', '100000', '10000', '1024', 14, 'CSC111'),
(11, 'The voulme of a given mass of gas is inversly proportional to the pressure,provided temperature is Constant', 'Gay Lussac Law', 'Charles Law', 'Boyles Law', 'Ideal gas Law', 'Boyles Law', 10, 'CHM101'),
(12, 'A Computer system can be divided into 3 main parts namely', 'Software,Hardware and Humanware', 'Hardware,Software and Partware', 'Software,Darkware and Mailware', 'Humanware, Whitware and Software', 'A', 5, ''),
(13, 'A Computer system can be divided into 3 main parts namely', 'Software,Hardware and Humanware', 'Hardware,Software and Partware', 'Software,Darkware and Mailware', 'Humanware, Whitware and Software', 'Software,Hardware and Humanware', 5, 'GNS312'),
(14, 'Which of the following is an example of application Software ?', 'Operating system', 'Language translators', 'Microsoft Office', 'Drivers', 'Microsoft Office', 5, 'GNS312'),
(15, 'Which of the following is a relational database Management System', 'Oracle database', 'Mysql database', 'Microsoft access database', 'All of the above', 'All of the above', 5, 'GNS312'),
(16, 'What is the full meaning of RDBMS', 'Relation Database Managements System', 'Relational Database Management System', 'Relational Database Main System', 'Relational Database Management Systems', 'Relational Database Management System', 10, 'GNS312'),
(17, '______________ is about maintaining consistency, accuracy and trustworthiness of data or information.', 'Integrity', 'Accountability', 'Confidentiality', 'Avalability', 'Integrity', 2, 'GNS312'),
(18, 'Which is the general formula for Alkanes?', 'CnH2n+1', 'CH2n', 'CnH2n+2', 'CnH2n', 'CnH2n+2', 5, 'CHM101'),
(19, 'Which is the general formular for Arithmetic Progression', 'a+(n-1)d', 'a+(d-1)n', 'a+(n+1)d', 'a+(n*1)d', 'a+(n-1)d', 25, 'MAT111'),
(20, '5+5-(2*2)', '14', '6', '16', '4', '14', 25, 'MAT111'),
(21, 'What is the formular for the nth term of a Gp.', 'ar^n', 'ar^n+1', 'ar^n-1', 'ar^n*1', 'ar^n', 50, 'MAT111'),
(26, 'Which is the smallest HTML heading ?', '<h1>', '<h2>', '<h3>', '<h5>', '<h2>', 5, 'CSC111'),
(28, 'What is the full meaning of RAT ?', 'Remote adfin tool', 'Remote administrator Tool', 'Relative Admin Tool', 'Remove Admin Tool', 'Remote adfin tool', 20, 'CSC111'),
(29, 'Which is the correct short cut for save ?', 'cntrl + A', 'cntrl+S', 'alt+S', 'esc+S', 'cntrl + A', 2, 'GNS312'),
(30, 'What is the formula for Tetrachloromethane ?', 'CH2CL2', 'CH3CL', 'CCL4', 'CCL3', 'CCL4', 25, 'CHM101'),
(31, 'How many bytes make a kilobyte', '1000bytes', '1024bytes', '1222bytes', '1002bytes', '1024bytes', 25, 'CSC111'),
(32, 'Hierarchy of court in Nigeria is not', 'supreme court â€“court of appeal-federal high court', 'national individual court- magistrate court â€“ customary court of appeal', 'court of appeal â€“ state high court â€“ upper area court', 'None of the above', 'national individual court- magistrate court â€“ customary court of appeal', 1, 'BUL506'),
(33, 'In other to make an offer to become capable of binding upon acceptance, it must be.........', 'clear and final', 'flexible and final', 'Legit', 'None', 'clear and final', 1, 'BUL506'),
(34, 'Promise of Estopien means â€¦â€¦â€¦â€¦â€¦â€¦â€¦â€¦â€¦â€¦â€¦..', 'promise must not go back on his word', 'promisor must not go back on his word', 'promisee must not go back on his word', 'promis must not go back on his word', 'promisee must not go back on his word', 1, 'BUL506'),
(35, 'If parties have expressly or implied indicated that they do not wish that their agreement\r\nshould be legally binding on them for the court not to interfere is -----', 'MEMORANDUM OF ASSOCIATION', 'MEMORANDUM OF UNDERSTANDING', 'ARTICLE OF ASSOCIATION', 'MEMORANDUM OF ALL', 'MEMORANDUM OF UNDERSTANDING', 2, 'BUL506'),
(36, 'Damage suffered by a victim in law of tort may be', 'physical injury to person, property, reputation and economic interest', 'injury to person and reputation', 'injury to reputation and property', 'physical injury to person and property', 'physical injury to person, property, reputation and economic interest', 2, 'BUL506'),
(37, '................... ensures that computer related assets are accessed only by authorized persons.', 'Integrity', 'Avalability', 'Confidentiality', 'Trust', 'Confidentiality', 5, 'GNS312'),
(38, 'What does CIA mean ?', 'Confident,Intelect and Availability', 'Confidentiality, Integrity and Avalability', 'Comfort ,Integrity and Avalability', 'Clearity, Intelect and Avalability', 'Confidentiality, Integrity and Avalability', 2, 'GNS312'),
(39, 'What is the major component that characterize the Third generation computer', 'Vacum tubes', 'Transistors', 'Integrated Circuit', 'Microprocessors', 'Integrated Circuit', 2, 'GNS312'),
(40, 'What is the major component that characterize the First generation computer', 'Vacum tubes', 'Transistors', 'Integrated Circuit', 'Microprocessors', 'Vacum tubes', 2, 'GNS312'),
(41, 'The act of making data and information available to only authorized persons only at appropriate time is known as', 'Confidentiality', 'Intelect', 'Avalability', 'Integrity', 'Avalability', 2, 'GNS312'),
(42, '................... is the process of verifying or testing that the claimed identity is valid.', 'Accountability', 'Auditing', 'Non repudiation', 'Authentication', 'Authentication', 2, 'GNS312'),
(43, '....................... ensures that requested activity or access to an object is possible given the rights and privileges assigned to the authenticated identity.', 'Authentication', 'Authorization', 'Auditing', 'Accountability', 'Authorization', 2, 'GNS312'),
(44, '............................. is the programmatic means by which subjects are held accountable for their actions while authenticated on a system.', 'Monitoring', 'Accountability', 'Accessibility', 'Avalability', 'Monitoring', 2, 'GNS312'),
(45, '................... ensures that the subject of an activity or event cannot deny that the event occurred.', 'Accountability', 'Non-repudiation', 'Auditing', 'Authentication', 'Non-repudiation', 2, 'GNS312'),
(46, '............................ is a process where similar elements are put into groups, classes or roles that are assigned security controls,restrictions, or permissions as a collective.', 'Layering', 'Abstraction', 'Encryption', 'Decryption', 'Abstraction', 2, 'GNS312'),
(47, '.................. is the science and art of hiding the meaning or intent of a communication from unintended recipients.', 'Decryption', 'Layering', 'Encryption', 'Abstraction', 'Abstraction', 2, 'GNS312'),
(48, 'What is the full meaning of DoS', 'Distribution of service', 'Denial of server', 'Denial of service', 'Distribution of server', 'Denial of service', 2, 'GNS312'),
(49, '.......................... is the art of pretending to be something other than what you are', 'Spoofing', 'Abstraction', 'Encapsulation', 'Authentication', 'Spoofing', 2, 'GNS312'),
(50, '..................... is someone who develops changes or attempts to circumvent computer security hardware or software.', 'L33T', 'COMPUTER HACKER', 'MIMA', 'PROGRAMMER', 'COMPUTER HACKER', 2, 'GNS312'),
(51, '..................... is the general name for unanticipated or undesired effects in programs or parts of a program caused by an agent with the intent to harm the computer system.', 'Hackers', 'Malicious code', 'Encryption', 'Icon', 'Malicious code', 2, 'GNS312'),
(52, '________________ is an electronic device that accepts data as input, processes the data and generates result as output.', 'Computer', 'Printer', 'Telephone', 'email', 'Computer', 2, 'GNS312'),
(53, 'Classification of computer by nature of data could be', 'Analogue and digital only', 'Analogue and Hybrid only', 'Analogue,Digital and Hybrid', 'Digital and hybrid only', 'Analogue,Digital and Hybrid', 2, 'GNS312'),
(54, 'Which of the following is not an example of Analogue computer', 'Electric meter', 'Thermometer', 'None of the above', 'Speedometer', 'None of the above', 2, 'GNS312'),
(55, 'Which of the following is an output device', 'Plotter', 'Microphone', 'Digital camera', 'Mouse', 'Plotter', 2, 'GNS312'),
(56, 'Which of the following is an Input device', 'Plotter', 'VDU', 'Speaker', 'Bluetooth', 'Bluetooth', 2, 'GNS312'),
(57, 'Which of the following is not a type of computer network', 'Metropolitan area network', 'Main area network', 'Wide area network', 'Local area network', 'Main area network', 2, 'GNS312'),
(58, '_________________ is a system software that manages the computer hardware and software resources and provide common services for computer program', 'Antivirus', 'Malware', 'Operating system (O.S)', 'Compiler', 'Operating system (O.S)', 2, 'GNS312'),
(59, 'Which of the following is a hardware', 'Cursor', 'Visual display Unit', 'Microsoft word', 'OS', 'Visual display Unit', 5, 'GNS312');

-- --------------------------------------------------------

--
-- Table structure for table `exam_settings`
--

CREATE TABLE `exam_settings` (
  `set_id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `time_assigned` int(11) NOT NULL,
  `no_quest_ans` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ocbt_admin_tbl`
--

CREATE TABLE `ocbt_admin_tbl` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ocbt_admin_tbl`
--

INSERT INTO `ocbt_admin_tbl` (`user_id`, `user_name`, `password`, `email`, `level`, `last_login`) VALUES
(1, 'administrator', '$2y$10$FTvDLAp/0np8N4NwM8Is2eHcCoRXgg7GMbX9GNO4W0gW/65mLrrhe', 'administrator_email@yahoo.co.uk', 1, '2018-09-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `std_courses`
--

CREATE TABLE `std_courses` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `no_quest_ans` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store all courses to be taken';

--
-- Dumping data for table `std_courses`
--

INSERT INTO `std_courses` (`course_id`, `course_code`, `course_title`, `unit`, `time`, `no_quest_ans`, `status`) VALUES
(1, 'CHM101', 'Introduction To Inorganic Chemistry.', 3, 2, 3, 0),
(2, 'CSC111', 'Introduction to Computing', 2, 3, 5, 1),
(5, 'CHM112', 'Organic Chemistry', 2, 0, 0, 0),
(7, 'BUL506', 'Engineering Law', 3, 2, 4, 0),
(8, 'GNS312', 'Digital Skill Aquisition', 1, 4, 15, 1),
(9, 'ALI435', 'INTRO TO ALI', 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `std_details`
--

CREATE TABLE `std_details` (
  `std_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pix` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `level` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stores student record';

-- --------------------------------------------------------

--
-- Table structure for table `std_results`
--

CREATE TABLE `std_results` (
  `result_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `score` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Result table';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_questions`
--
ALTER TABLE `all_questions`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `exam_settings`
--
ALTER TABLE `exam_settings`
  ADD PRIMARY KEY (`set_id`);

--
-- Indexes for table `ocbt_admin_tbl`
--
ALTER TABLE `ocbt_admin_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `std_courses`
--
ALTER TABLE `std_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `std_details`
--
ALTER TABLE `std_details`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `std_results`
--
ALTER TABLE `std_results`
  ADD PRIMARY KEY (`result_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_questions`
--
ALTER TABLE `all_questions`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `exam_settings`
--
ALTER TABLE `exam_settings`
  MODIFY `set_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ocbt_admin_tbl`
--
ALTER TABLE `ocbt_admin_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `std_courses`
--
ALTER TABLE `std_courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `std_details`
--
ALTER TABLE `std_details`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `std_results`
--
ALTER TABLE `std_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
