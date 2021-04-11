-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 02:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_description` text NOT NULL,
  `job_salary` double NOT NULL,
  `company` varchar(255) NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `job_title`, `job_description`, `job_salary`, `company`, `approved`, `date_created`, `date_deleted`) VALUES
(1, 'PHP Junior Developer', 'Just a job creation to test', 12500, 'CecoDev', 1, '2021-04-05 12:46:26', NULL),
(2, 'Testing feature', 'Just now', 120000, 'CecoDev', NULL, '2021-04-05 13:59:15', '2021-04-05 14:12:58'),
(3, 'PHP Senior Developer', 'You will develop advanced applications written in PHP 7', 1800.99, 'DevriX', 1, '2021-04-05 14:21:40', NULL),
(4, 'Test Job 2', 'Test Job 2 Description', 1500.99, 'CecoDev', NULL, '2021-04-05 15:03:00', '2021-04-05 15:06:06'),
(5, 'Java Junior Developer', 'You will develop desktop and mobile java applications.', 25000, 'JMasters', 1, '2021-04-06 16:41:41', NULL),
(6, 'Java Senior Developer', 'You will develop advanced Java desktop and mobile applications.', 150000, 'JMasters', 1, '2021-04-06 16:51:57', NULL),
(7, 'Senior Java developer', 'Senior Java Developer\r\n\r\nNote: We offer flexible working models for all open positions. You can choose from three options: a combination of work from home and office, work only from home, or work from anywhere in the world.\r\n\r\nWe are looking to hire a Senior Java Developer who will work in a team of uniquely intelligent technologists to implement and extend groundbreaking web applications that make the world a better place!\r\n\r\nYou will participate in the creation of enterprise-class applications using proven design patterns on the latest technology platforms. This position requires a strong hands-on developer that will fully participate in the software development process – design, development, unit testing, and technical documentation. You will use the Scrum development methodology to create 21st-century software solutions that set standards.\r\n\r\nAs a fast-growing company, MentorMate provides challenging careers in a friendly, team-oriented environment. We value our employees and share our success through competitive pay, recognition, advancement opportunities, and a great working environment.', 2800, 'MentorMate Bulgaria Ltd.', 1, '2021-04-06 17:32:07', NULL),
(8, 'JavaScript Game Developer', 'JavaScript Game Developer\r\n\r\nAbout us\r\nDopamine is literally the world’s most innovative gaming studio and casino software developer\r\nWe are one of the fastest-growing players internationally, making award-winning products\r\nBringing fun to millions of people worldwide is not a job, but a life mission\r\n\r\nWhat you’ll do:\r\nBuild complex, graphics-intensive online games\r\nChoose the tech stack for new features or projects\r\nHave fun at work and do what you do best\r\n\r\nWhat you won’t do:\r\nWork directly with annoying clients\r\nSupport redundant browsers and platforms\r\nWork on old legacy spaghetti code\r\nSpend your whole day in boring meetings\r\n\r\nMust-haves:\r\nExperience with PIXI.js or Easel.js or just vanilla JS\r\nExperience in building online games\r\nExperience with Browserify or Webpack\r\nExperience with git\r\n\r\nBonus skills:\r\nBuilding complex multiplayer online games\r\nYou know what 16ms is\r\nAutomated testing (Mocha, Selenium)\r\nYou write neat and tidy and use JSDoc', 15000, 'Dopamine Ltd.', 1, '2021-04-06 17:33:17', NULL),
(9, 'JavaScript / TypeScript Developer', 'THE ROLE:\r\n\r\nWe are looking for JavaScript ES6 and TypeScript developer who wants to have a voice in the future of our WEB based Poker platform. On regular basis, we explore new techniques, plugins, tools, software architecture patterns, best practices, UI / UX design approaches and we need another team member to join us.\r\n\r\nDevelop functional modules for a WEB based platform using TypeScript, React, Redux\r\nStyle UI components with CSS3 techniques using preprocessor programs like SASS\r\nBuild responsive design solutions\r\nWork with package managers like NPM\r\nWork with module bundlers like Webpack\r\nRecognize when research is needed, performing research and investigations\r\nShares knowledge with the other team members\r\nWorks closely with the other team members according to our agile workflow\r\nPerform initial testing of the solutions\r\nEnjoy the work :)\r\n\r\nWHAT YOU NEED TO SUCCEED:\r\nAdvanced knowledge in OOP principles\r\nExperience in JavaScript (4+ years) and/or TypeScript\r\nExperience in React, Redux and/or Angular\r\nExperience writing semantic HTML5 markup and CSS3 with preprocessors such as SASS / LESS\r\nExperience developing web/mobile apps with responsive/adaptive design and progressive enhancement\r\nUnderstanding module bundlers like Webpack\r\nUnderstanding of all major browsers and the special considerations required for various quirks\r\nExperience with Git in particular\r\nKnowledge about cross browser / device testing possibilities\r\nMotivated, assertive, responsible, proactive and strong team player\r\nGood command of English language (spoken and written)\r\n\r\nADVANTAGES:\r\nMore years of experience in TypeScript\r\nPrevious experience in building cross browser &amp; device WEB based platforms\r\nKnowledge about Agile/Scrum development process\r\nAdaptability to work environment changes\r\nSelf-organization skills\r\nMotivation to learn new things', 8500, 'Playtech Bulgaria Ltd.', 1, '2021-04-06 17:34:58', NULL),
(10, 'Mid/Senior PHP Developer', 'Develop the core systems that will allow customers to take advantage of our client’s services based on a Linux/UNIX based architecture.\r\n\r\nContribute ideas to enhance the specification and systems during and post development.\r\nRequired to work in an environment where the data being input into the developed system is highly confidential and will have experience in developing code that supports strong security.\r\n\r\nAs a result of the PCI DSS compliance obligation the person we are looking for will have had some experience in documenting and recording processes and conforming to guidelines set my external “governing” organisations.\r\n\r\nA well-structured and project driven individual that is able to plan and set accurate delivery expectations and is used to providing regular updates to their line manager on their progress.\r\n\r\nWorking with other development colleagues and Systems Administration to agree particular server based software/applications required to operate the software.\r\n\r\nKeep abreast of technology/software enhancements and how they would apply and would be used within the company.\r\n\r\nParticipate in daily team meetings to discuss progress with other team members using a SCRUM methodology.\r\n\r\nPreferable ambition to progress in the business as it grows.', 15000, 'MegaSource Bulgaria', 1, '2021-04-06 17:37:16', NULL),
(11, 'Web &amp; Digital Designer', 'Strings IT Recruitment is helping IT/tech professionals discover more exciting career opportunities. Free of charge, of course.\r\n\r\nOur client is a Belgium-based, global software company specialized in web and mobile solutions in the field of social networks.\r\n\r\nAt the moment, they are looking to boost the creative powers of their Sofia tech team (around 30 people) by bringing in an experienced Web and Digital designer.', 4500, 'Strings IT Ltd.', 1, '2021-04-06 17:40:05', NULL),
(12, 'Software Development Engineer (Mid-Range)', 'Hostway Corporation is seeking experienced (Mid-Range) Software Developers to work directly with a local Sofia team in an Agile Scrum Environment. Applicant will also be working alongside remote teams in Canada and the United States. Work schedule is flexible and is definitely challenging, requiring a candidate with proven experience and the confidence in their skill. We prefer people who are passionate about software development that show it by always learning at work and their own time. You will be working alongside extremely talented senior level architects and developers, so it is important to be okay with making mistakes and learning together as a team.', 8500, 'Hostway Bulgaria EAD', 1, '2021-04-06 17:41:42', NULL),
(13, 'Machine Learning Developer', 'Understand and translate business and functional needs into machine learning problem statements\r\n\r\nDesign and develop scalable solutions that leverage machine learning to meet enterprise requirements\r\n\r\nEnsure the highest quality and ongoing evaluation of the ML models\r\n\r\nWork closely with the development teams to successfully test and deploy machine learning models\r\n\r\nIdentify opportunities and drive new initiatives for applying machine learning\r\n\r\nKeeps abreast with new tools, algorithms, and techniques in machine learning and continuously work to implement those in the organization', 12500, 'BigBrother', NULL, '2021-04-06 17:43:26', NULL),
(14, 'C++ Senior Developer', 'Testing', 15000, 'CodeMasters', 1, '2021-04-06 21:41:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`) VALUES
(1, 'admin@abv.bg', '$2y$10$c3XiAP.ui0Ds9UyT28nNjebCch2HPyHTif0aw0Y5U9ujhtC/ulLJK', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
