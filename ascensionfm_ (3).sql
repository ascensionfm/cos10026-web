-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2025 at 05:11 PM
-- Server version: 8.0.37
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ascensionfm_`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `job_reference` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `street_address` varchar(100) DEFAULT NULL,
  `suburb` varchar(50) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `other_skills` text,
  `photo_path` varchar(255) DEFAULT NULL,
  `application_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'Submitted',
  `position_name` varchar(100) DEFAULT 'Not specified',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `job_reference`, `first_name`, `last_name`, `date_of_birth`, `gender`, `street_address`, `suburb`, `state`, `postcode`, `email`, `phone`, `skills`, `other_skills`, `photo_path`, `application_date`, `status`, `position_name`) VALUES
(1, 0, '08703', 'Mathilda', 'Duns', '1999-02-10', 'Female', '1957 Upham Alley', 'Western Australia', 'WA', '6843', 'mduns0@wired.com', '+61 (801) 924-6146', 'Management', 'Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.', 'https://robohash.org/rerumnameligendi.png?size=50x50&set=set1', '2025-01-31 02:49:42', 'Rejected', 'Civil Engineer'),
(2, 4384, '82092', 'Pasquale', 'Greally', '2002-06-12', 'Non-binary', '6747 Dakota Place', 'Western Australia', 'WA', '6817', 'pgreally1@bloomberg.com', '+61 (511) 953-5469', 'Chinese', 'Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.', 'https://robohash.org/temporeducimusasperiores.png?size=50x50&set=set1', '2025-02-05 23:24:39', 'Approved', 'Chemical Engineer'),
(3, 97153352, '03153', 'Algernon', 'Allam', '1994-09-30', 'Male', '6 Sherman Parkway', 'South Australia', 'SA', '5869', 'aallam2@quantcast.com', '+61 (478) 211-4026', 'Chinese', 'Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.', 'https://robohash.org/ipsamvoluptatemmolestias.png?size=50x50&set=set1', '2025-03-19 12:09:49', 'Pending', 'Account Coordinator'),
(4, 6, '67459', 'Janos', 'Kurt', '1998-09-29', 'Male', '5212 Goodland Drive', 'South Australia', 'SA', '5889', 'jkurt3@free.fr', '+61 (627) 200-0322', 'Design', 'Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.', 'https://robohash.org/sitconsequunturtenetur.png?size=50x50&set=set1', '2024-09-16 23:27:52', 'Rejected', 'Technical Writer'),
(5, 0, '87613', 'Mervin', 'Anton', '2003-03-25', 'Agender', '797 Artisan Center', 'South Australia', 'SA', '5899', 'manton4@cloudflare.com', '+61 (911) 409-6630', 'Japanese', 'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', 'https://robohash.org/accusamusvoluptatemnatus.png?size=50x50&set=set1', '2025-02-24 15:51:05', 'Rejected', 'Automation Specialist I'),
(6, 153, '82314', 'Wilmette', 'Willicott', '2001-10-18', 'Female', '4 Goodland Plaza', 'South Australia', 'SA', '5899', 'wwillicott5@purevolume.com', '+61 (989) 180-9696', 'Management', 'Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 'https://robohash.org/aspernaturminusrem.png?size=50x50&set=set1', '2024-05-26 07:01:56', 'Approved', 'VP Sales'),
(7, 45220, '36368', 'Simona', 'Tumber', '2004-11-18', 'Female', '46 Brentwood Junction', 'Western Australia', 'WA', '6843', 'stumber6@bing.com', '+61 (696) 245-2877', 'Chinese', 'Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.', 'https://robohash.org/sintquiasperiores.png?size=50x50&set=set1', '2024-11-07 22:30:26', 'Approved', 'Assistant Professor'),
(8, 1, '65861', 'Kenyon', 'Filintsev', '1990-11-13', 'Male', '4 Boyd Trail', 'South Australia', 'SA', '5874', 'kfilintsev7@tuttocitta.it', '+61 (233) 598-1986', 'Japanese', 'Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.', 'https://robohash.org/molestiaequiquam.png?size=50x50&set=set1', '2024-04-17 06:06:10', 'Approved', 'Director of Sales'),
(9, 0, '54738', 'Karly', 'Readitt', '1997-01-08', 'Female', '49 Chive Circle', 'South Australia', 'SA', '5869', 'kreaditt8@naver.com', '+61 (266) 798-5188', 'Design', 'Sed ante. Vivamus tortor. Duis mattis egestas metus.\n\nAenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.', 'https://robohash.org/quositrerum.png?size=50x50&set=set1', '2024-07-16 00:04:03', 'Rejected', 'Environmental Tech'),
(10, 0, '11081', 'Brian', 'Di Biagi', '2001-12-18', 'Male', '595 Oak Terrace', 'South Australia', 'SA', '5869', 'bdibiagi9@amazonaws.com', '+61 (649) 720-4211', 'Marketing', 'In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.', 'https://robohash.org/odioquoda.png?size=50x50&set=set1', '2024-08-20 23:55:35', 'Rejected', 'VP Accounting');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `salary` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `tags` TEXT DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `tag`, `salary`, `type`, `level`, `location`, `tags`, `link`, `description`) VALUES
(1, 'Senior AI Engineer', 'Hot', '50.000.000', 'Full Time', 'Senior', 'Ha Noi', '[\"AI\", \"Machine Learning\", \"Deep Learning\"]', 'SAE.html', 'We are looking for a highly skilled AI Engineer to develop and implement artificial intelligence solutions for various applications.\n\n\r\n        Responsibilities:\n\r\n        - Design and implement AI models for automation and analytics.\n\r\n        - Work with large datasets to train and optimize machine learning models.\n\r\n        - Collaborate with data scientists and engineers to deploy AI solutions.\n\r\n        - Optimize AI algorithms for performance and scalability.\n\n\r\n        Requirements:\n\r\n        - Strong expertise in Python, TensorFlow, and PyTorch.\n\r\n        - Experience with NLP, computer vision, or reinforcement learning.\n\r\n        - At least 5 years of experience in AI development.\n\n\r\n        Benefits:\n\r\n        - Competitive salary and performance bonuses.\n\r\n        - Flexible work hours and remote work options.\n\r\n        - Annual professional development stipend.'),
(2, 'Frontend Developer', 'New', '30.000.000', 'Full Time', 'Mid', 'Ho Chi Minh City', '[\"JavaScript\", \"React\", \"TypeScript\"]', 'FrontendDev.html', 'We are looking for a talented Frontend Developer to create amazing user experiences with modern web technologies.\n\n\r\n        Responsibilities:\n\r\n        - Develop user-friendly interfaces using React and TypeScript.\n\r\n        - Collaborate with backend developers to integrate APIs.\n\r\n        - Optimize applications for performance and responsiveness.\n\r\n        - Maintain and improve existing frontend codebases.\n\n\r\n        Requirements:\n\r\n        - Strong proficiency in JavaScript, React.js, and TypeScript.\n\r\n        - Experience with UI/UX best practices and responsive design.\n\r\n        - 2+ years of experience in frontend development.\n\n\r\n        Benefits:\n\r\n        - Monthly team outings and company-sponsored workshops.\n\r\n        - MacBook Pro and other high-end development tools.\n\r\n        - Remote work options available.'),
(3, 'Backend Developer', 'Urgent', '40.000.000', 'Full Time', 'Senior', 'Hanoi', '[\"Node.js\", \"Express\", \"MongoDB\"]', 'BackendDev.html', 'Join our backend engineering team to develop scalable and high-performance APIs.\n\n\r\n        Responsibilities:\n\r\n        - Build RESTful APIs and backend services using Node.js and Express.\n\r\n        - Design database schemas and optimize queries for MongoDB.\n\r\n        - Implement authentication, authorization, and security best practices.\n\r\n        - Troubleshoot and optimize backend performance.\n\n\r\n        Requirements:\n\r\n        - Proficiency in Node.js, Express.js, and database management.\n\r\n        - Experience with cloud platforms such as AWS or GCP.\n\r\n        - 4+ years of experience in backend development.\n\n\r\n        Benefits:\n\r\n- Competitive salary with annual raises.\n\r\n        - Paid courses and certifications.\n\r\n        - Hybrid working model (office + remote).'),
(4, 'Data Scientist', 'Hot', '45.000.000', 'Full Time', 'Senior', 'Hanoi', '[\"Python\", \"Machine Learning\", \"Data Analytics\"]', 'DataScientist.html', 'We are seeking a Data Scientist to analyze data and build predictive models for business applications.\n\n\r\n        Responsibilities:\n\r\n        - Analyze large datasets and extract meaningful insights.\n\r\n        - Develop machine learning models for classification and regression tasks.\n\r\n        - Work with stakeholders to translate data findings into business strategies.\n\r\n        - Maintain data pipelines and deploy AI models in production.\n\n\r\n        Requirements:\n\r\n        - Strong knowledge of Python, SQL, and data visualization tools.\n\r\n        - Hands-on experience with Scikit-learn, Pandas, and TensorFlow.\n\r\n        - Minimum 3 years of experience in data science roles.\n\n\r\n        Benefits:\n\r\n        - Stock options and profit-sharing plan.\n\r\n        - Work with cutting-edge AI technologies.\n\r\n        - Generous vacation and paid time off.'),
(5, 'DevOps Engineer', 'Urgent', '55.000.000', 'Full Time', 'Senior', 'Da Nang', '[\"Docker\", \"Kubernetes\", \"CI/CD\"]', 'DevOpsEngineer.html', 'We are looking for an experienced DevOps Engineer to improve our cloud infrastructure and CI/CD pipelines.\n\n\r\n        Responsibilities:\n\r\n        - Design, implement, and maintain CI/CD pipelines.\n\r\n        - Automate infrastructure management using Terraform and Ansible.\n\r\n        - Monitor and troubleshoot production environments.\n\r\n        - Improve system reliability and deployment speed.\n\n\r\n        Requirements:\n\r\n        - Experience with AWS, Docker, Kubernetes, and Jenkins.\n\r\n        - Strong scripting skills in Bash or Python.\n\r\n        - 5+ years in DevOps or cloud engineering.\n\n\r\n        Benefits:\n\r\n        - Fully remote option with flexible hours.\n\r\n        - Annual tech conference sponsorship.\n\r\n        - Health and wellness stipend.'),
(6, 'Software Engineer', 'New', '35.000.000', 'Full Time', 'Mid', 'Ho Chi Minh City', '[\"Java\", \"Spring Boot\", \"Microservices\"]', 'SoftwareEngineer.html', 'We are hiring a Software Engineer to develop and maintain high-quality software solutions.\n\n\r\n        Responsibilities:\n\r\n        - Design, develop, and test software applications.\n\r\n        - Work with cross-functional teams to define software requirements.\n\r\n        - Maintain and optimize legacy codebases.\n\r\n        - Write unit tests and participate in code reviews.\n\n\r\n        Requirements:\n\r\n        - Proficiency in Java, Spring Boot, and microservices architecture.\n\r\n        - Experience with relational databases like MySQL or PostgreSQL.\n\r\n        - 3+ years of experience in software engineering.\n\n\r\n        Benefits:\n\r\n        - Free gym membership and wellness programs.\n');

-- --------------------------------------------------------

--
-- Table structure for table `management_users`
--

CREATE TABLE IF NOT EXISTS `management_users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `management_users`
--

INSERT INTO `management_users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$8T/8duMpKzePqLfIAnkawurGG7Xsk.kncxViJmW5faeIxg1uvCuM2', '2025-03-17 16:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'vuongveo998@gmail.com', '$2y$10$OZLxjj5kuPXUFVkW929H7.R8tveptlvE4I8NbAsID.048NY09smXW');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
