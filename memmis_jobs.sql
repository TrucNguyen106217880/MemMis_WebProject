-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 01:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memmis_jobs`
--
CREATE DATABASE IF NOT EXISTS `memmis_jobs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `memmis_jobs`;

DROP TABLE IF EXISTS `eoi_skills`;
DROP TABLE IF EXISTS `skills`;
DROP TABLE IF EXISTS `eoi`;
DROP TABLE IF EXISTS `jobs`;

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE IF NOT EXISTS `eoi` (
  `eoi_number` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `date_of_birth` date NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `suburb_town` varchar(50) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `other_skills` text DEFAULT NULL,
  `eoi_status` enum('New','Current','Final') DEFAULT 'New',
  PRIMARY KEY (`eoi_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eoi_skills`
--

CREATE TABLE IF NOT EXISTS `eoi_skills` (
  `eoi_number` int(11) NOT NULL,
  `skills_id` int(11) NOT NULL,
  KEY `eoi_number` (`eoi_number`),
  KEY `skills_id` (`skills_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `reference_number` varchar(255) NOT NULL,
  `job_name` varchar(255) NOT NULL,
  `aside_info` text NOT NULL,
  `about_the_role` text NOT NULL,
  `responsibility` text NOT NULL,
  `required_qualifications` text NOT NULL,
  `nice_to_have_qualifications` text NOT NULL,
  `salary_and_benefits` text NOT NULL,
  PRIMARY KEY (`reference_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`reference_number`, `job_name`, `aside_info`, `about_the_role`, `responsibility`, `required_qualifications`, `nice_to_have_qualifications`, `salary_and_benefits`) VALUES
('AI313', 'AI Engineer', 'AI will do tedious works for you.', 'As an AI Engineer, you will be responsible for designing, developing, and deploying intelligent systems that leverage machine learning, deep learning, and data science to solve complex problems and drive innovation across the organization. Your work will focus on building models that enhance products, automate decision-making, and extract meaningful insights from large and diverse datasets. You will collaborate with data scientists, software engineers, and business stakeholders to identify opportunities for AI integration, define project goals, and deliver scalable solutions. Key responsibilities include data preprocessing, model selection and training, performance evaluation, and deployment into production environments. You will also be involved in monitoring model behavior, retraining as needed, and ensuring long-term reliability and fairness. Proficiency in Python and frameworks such as TensorFlow, PyTorch, or Scikit-learn is essential, along with a solid foundation in statistics, linear algebra, and optimization. Experience with cloud platforms (e.g., AWS, Azure, GCP), containerization tools, and MLOps practices is highly valued. Beyond technical skills, you should be analytical, curious, and committed to staying current with advancements in AI research. You will also be expected to uphold ethical standards in AI development, ensuring transparency, accountability, and responsible use of data. Your contributions will play a vital role in shaping intelligent systems that improve user experiences, streamline operations, and support strategic decision-making.', 'Design and implement machine learning models and AI algorithms for classification, prediction, recommendation, and optimization tasks.\r\nEvaluate model performance using appropriate metrics and improve accuracy through tuning and experimentation.\r\nDocument processes, models, and systems for reproducibility and knowledge sharing.\r\nCollaborate with cross-functional team members to define and implement new features.\r\nReporting to the AI Manager on activity and results.', 'Bachelor\'s or Master\'s degree in Computer Science, Artificial Intelligence, Data Science, or related field.\r\n1+ years of experience as an AI engineer.\r\nStrong programming skills in Python and experience with ML libraries such as TensorFlow, PyTorch, Scikit-learn.\r\nFamiliarity with cloud platforms (e.g., AWS, Azure, GCP) and containerization tools (e.g., Docker, Kubernetes).\r\nExperience with data preprocessing, feature engineering, and model evaluation.\r\nFamilarity with Agile development methodology.\r\nAttention to details.\r\nKeep up to date with new technology.', 'Experience with NLP, computer vision, or reinforcement learning.\r\nFamiliarity with MLOps tools and frameworks.\r\nUnderstanding of ethical AI principles and data privacy regulations.', 'Salary range: $10,000 to 45,000 per month\r\nHealth and job loss insurance\r\nRemote or in-office available\r\n3 weeks of pay leave per year\r\nFlexible working hours'),
('CY296', 'Cybersecurity Specialist', 'Protect our systems and users.', 'As a Cybersecurity Specialist, you are responsible for protecting the organization\'s digital infrastructure, systems, and sensitive data from cyber threats. Your role involves designing and implementing security protocols, monitoring systems for vulnerabilities, and responding swiftly to incidents to ensure the confidentiality, integrity, and availability of information assets. You will collaborate with IT teams, developers, and business units to assess risks, enforce security policies, and integrate cybersecurity best practices into network and software architecture. Key responsibilities include conducting regular security audits, penetration testing, vulnerability assessments, and managing tools such as firewalls, intrusion detection systems, and endpoint protection platforms. A strong understanding of cybersecurity frameworks (e.g., NIST, ISO 27001), encryption standards, and regulatory compliance (e.g., GDPR, HIPAA) is essential. You should be proficient in using SIEM tools, scripting languages like Python or PowerShell, and cloud security platforms such as AWS or Azure. Beyond technical expertise, you must demonstrate strong analytical thinking, attention to detail, and the ability to communicate security risks and solutions to both technical and non-technical stakeholders. You will also contribute to employee training and awareness programs to foster a security-conscious culture. Your work is vital to maintaining operational continuity, protecting customer trust, and defending against evolving cyber threats in a dynamic digital landscape.', 'Monitor networks and systems for security breaches, anomalies, and threats.\r\nConduct vulnerability assessments and penetration testing.\r\nImplement and maintain firewalls, intrusion detection/prevention systems (IDS/IPS), and endpoint protection.\r\nStay current with emerging cybersecurity trends, threats, and technologies.\r\nReporting to the Chief Information Security Officer (CISO) on activity and results.', 'Bachelor\'s or Master\'s degree in cybersecurity or related field.\r\n2+ years of experience in cybersecurity or IT security roles.\r\nKnowledge of security frameworks and standards (e.g., NIST, ISO 27001, CIS).\r\nStrong understanding of network protocols, operating systems, and security tools.\r\nAble to work both independently and on a team.', 'Professional certifications such as CISSP, CEH, CompTIA Security+, or CISM.\r\nExperience with cloud security (AWS, Azure, GCP).\r\nKnowledge of regulatory compliance (e.g., GDPR, HIPAA, PCI-DSS).', 'Salary range: $15,000 to 50,000 per month\r\nHealth and job loss insurance\r\nRemote or in-office available\r\n3 weeks of pay leave per year'),
('SO145', 'Software Developer', 'Software is an quite an integral part of life nowadays.', 'As a Software Developer, you will be responsible for designing, developing, and maintaining software applications that support business operations, improve user experiences, and drive digital innovation. You will work collaboratively with cross-functional teams—including product managers, designers, and fellow engineers—to understand requirements and translate them into reliable, scalable, and maintainable solutions. Your core responsibilities include writing clean and efficient code using modern programming languages and frameworks, participating in code reviews, and contributing to architectural decisions. You will be involved in the full software development lifecycle, from planning and implementation to testing, deployment, and ongoing maintenance. Familiarity with agile methodologies, version control systems (e.g., Git), and CI/CD pipelines is essential. You will also be expected to troubleshoot and resolve technical issues, optimize application performance, and continuously improve existing systems. A strong grasp of data structures, algorithms, and design patterns is required, along with proficiency in languages such as Python, Java, C#, or JavaScript. Beyond technical skills, you should demonstrate strong problem-solving abilities, attention to detail, and a proactive mindset. You\'ll be encouraged to explore new technologies, contribute to innovation, and share knowledge within the team. Your contributions will directly impact the quality, reliability, and success of the software products delivered to users and stakeholders, making you a key player in the organization\'s growth and digital transformation.', 'Design, develop, and maintain scalable software applications.\r\nContribute to the continuous improvement of development processes and tools.\r\nTroubleshoot, debug, and upgrade existing software.\r\nCollaborate with cross-functional team members to define and implement new features.\r\nReporting to the Director of Software on activity and results.', 'Bachelor\'s Degree in Software Engineering or related field.\n1+ years of software developing experience.\nFamiliarity with Agile development methodology.\nAbility to define and solve logical problems for highly technical applications.\nProven experience in software development (e.g., internships, projects, or professional roles).\nProficiency in one or more programming languages (e.g., Java, Python, C#, JavaScript).\nAttention to details.\nExcellent communication skill.\nKeep up to date with new technology.', 'Knowledge of databases (SQL and NoSQL).\r\nExperience with cloud platforms (e.g., AWS, Azure, Google Cloud).\r\nExperience with version control system like Git.', 'Salary range: $10,000 to 35,000 per month\r\nHealth and job loss insurance\r\nRemote or in-office available\r\n3 weeks of pay leave per year\r\nFlexible working hours');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `skills_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(255) NOT NULL,
  `skills` text NOT NULL,
  PRIMARY KEY (`skills_id`),
  KEY `reference_number` (`reference_number`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skills_id`, `reference_number`, `skills`) VALUES
(1, 'SO145', 'Bachelor\'s Degree in Software Engineering or related field'),
(2, 'SO145', '1+ years of software developing experience'),
(3, 'SO145', 'Familiarity with Agile development methodology'),
(4, 'SO145', 'Ability to define and solve logical problems for highly technical applications'),
(5, 'SO145', 'Proven experience in software development (e.g., internships, projects, or professional roles)'),
(6, 'SO145', 'Proficiency in one or more programming languages (e.g., Java, Python, C#, JavaScript)'),
(7, 'SO145', 'Attention to details'),
(8, 'SO145', 'Excellent communication skill'),
(9, 'SO145', 'Keep up to date with new technology'),
(10, 'AI313', 'Bachelor\'s or Master\'s degree in Computer Science, Artificial Intelligence, Data Science, or related field'),
(11, 'AI313', '1+ years of experience as an AI engineer'),
(12, 'AI313', 'Strong programming skills in Python and experience with ML libraries such as TensorFlow, PyTorch, Scikit-learn'),
(13, 'AI313', 'Familiarity with cloud platforms (e.g., AWS, Azure, GCP) and containerization tools (e.g., Docker, Kubernetes)'),
(14, 'AI313', 'Experience with data preprocessing, feature engineering, and model evaluation'),
(15, 'AI313', 'Familarity with Agile development method'),
(16, 'AI313', 'Attention to details'),
(17, 'AI313', 'Keep up to date with new technology'),
(18, 'CY296', 'Bachelor\'s or Master\'s degree in cybersecurity or related field'),
(19, 'CY296', '2+ years of experience in cybersecurity or IT security roles'),
(20, 'CY296', 'Knowledge of security frameworks and standards (e.g., NIST, ISO 27001, CIS)'),
(21, 'CY296', 'Strong understanding of network protocols, operating systems, and security tools'),
(22, 'CY296', 'Able to work both independently and on a team');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eoi_skills`
--
ALTER TABLE `eoi_skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`eoi_number`) REFERENCES `eoi` (`eoi_number`),
  ADD CONSTRAINT `skills_ibfk_2` FOREIGN KEY (`skills_id`) REFERENCES `skills` (`skills_id`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_3` FOREIGN KEY (`reference_number`) REFERENCES `jobs` (`reference_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
