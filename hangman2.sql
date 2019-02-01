-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`id`, `name`) VALUES
(1,	'Database'),
(2,	'Canada'),
(3,	'Automobile');

DROP TABLE IF EXISTS `game_history`;
CREATE TABLE `game_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `word_bank_id` int(10) unsigned DEFAULT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `session_id` (`user_id`),
  CONSTRAINT `game_history_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned DEFAULT NULL,
  `music` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `word_bank`;
CREATE TABLE `word_bank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `word_bank` (`id`, `category_id`, `hint`, `answer`) VALUES
(1,	1,	'Process of organizing data into tables ',	'Normalization'),
(3,	1,	'Helping people keep track of things is the purpose of a(n)  ',	'Database'),
(4,	1,	'Add new Row in database table',	'Insert'),
(5,	1,	'A functional dependency is a relationship between or among',	'Attributes'),
(6,	1,	'SQL statement is used to extract data from a database? ',	'Select'),
(7,	1,	'SQL statement is used to update data in a database? ',	'Update'),
(8,	1,	'SQL statement is used to delete data from a database? ',	'Delete'),
(9,	1,	'SQL statement is used to return only different values? ',	'Distinct'),
(10,	1,	'Which normal form is that every determinant in a table must be a candidate key ',	'Boyce Codd '),
(11,	1,	'Keyword used to remove all rows from table',	'Truncate'),
(12,	1,	'When an update occurs to a database, either all or none of the update becomes available to anyone\" ',	'Atomicity'),
(13,	1,	' In___________ a record or page is locked immediately when the lock is requested ',	'Pessimistic Locking '),
(14,	1,	'SERIALIZABLE, REPEATABLE READ, READ COMMITTED etc are all types of ',	'Isolation Level'),
(15,	1,	'CREATE, ALTER are ___________ category of statements ',	'DDL'),
(16,	1,	' In which approach of data warehousing, the transaction data is partitioned into facts? ',	'Dimensional Approach '),
(17,	1,	'Attempt to find a function which models the data with the least error is known as ',	'Regression '),
(18,	1,	'In ACID properties A stands for',	'Atomicity'),
(19,	1,	'In ACID properties C stands for',	'Consistency '),
(20,	1,	'In ACID properties I stands for',	'Integrity'),
(21,	1,	'In ACID properties D stands for',	'Durability'),
(22,	1,	' an Open source DBMS? ',	'Mysql'),
(23,	1,	'Prev LSN in database log is constructed using________ data structure ',	'Link List'),
(24,	1,	'Stores metadata about the structure of the database',	'Data Dictionary '),
(25,	1,	'Partial dependency is removed in ______ normal form ',	'Second'),
(26,	1,	'Keyword used to select data from multiple tables',	'Join'),
(27,	1,	'A key which is reference to column of another table',	'Foreign'),
(28,	1,	'A Key which can be used only once in table',	'Primary'),
(29,	1,	'A key which restricts duplicate values but allows one null',	'Unique'),
(30,	1,	'Which SQL keyword is used to sort the result-set? ',	'Order By'),
(31,	1,	'What is the most common type of join? ',	'INNER JOIN'),
(32,	1,	'Which operator is used to select values within a range? ',	'Between'),
(33,	1,	'A keyword which restrict user to enter null value',	'NOT NULL'),
(34,	1,	'Operator used to search for a specified pattern in a column? ',	'Like'),
(35,	1,	'Keyword used to create a table in a database?',	'Create'),
(36,	1,	'Keyword used to Sort by Descending order',	'DESC'),
(37,	1,	'Keyword Used to Delete table from Database',	'DROP'),
(38,	1,	'If you join a table to itself, what kind of join are you using? ',	'Self Join'),
(39,	1,	'Table columns are also known as',	'Attributes'),
(40,	1,	' SQL function used to count the number of rows in a SQL query? ',	'Sum'),
(41,	1,	'',	''),
(42,	2,	'First Prime minister of canada',	'John A Macdonald '),
(43,	2,	'Current prime minister of canada',	'Justin Trudeau '),
(44,	2,	'Longest river in canada',	'Mackenzie'),
(45,	2,	'Biggest state in canada by area',	'Quebec'),
(46,	2,	'National animal of canada',	'Beaver '),
(47,	2,	'Canada\'s birthday month',	'July'),
(48,	2,	'Capital of canada is',	'Ottawa '),
(49,	2,	'The smallest province in Canada is',	'Nova Scotia '),
(50,	2,	'The leader of Canada is known as the',	'Prime Minister'),
(51,	2,	'The first inhabitants of Canada were the',	'Vikings'),
(52,	2,	'Canada was first colonized from Europe by the ',	'French '),
(53,	2,	'The third most commonly spoken language in Canada is ',	'Punjabi'),
(54,	2,	'Canada is famous for',	'Niagara Falls '),
(55,	2,	'The plant which is a symbol of Canada is',	'The Maple Leaf '),
(56,	2,	'The Canadian city with the lowest annual snowfall is',	'Victoria '),
(57,	2,	'Canada\'s largest trading partner is',	'United States'),
(58,	2,	'Wayne Gretzky is Canada and the world\'s greatest',	'Gretzky'),
(59,	2,	'The people of Canada are mostly of ____ origin - around 68% of the population. ',	'British '),
(60,	2,	'Which ocean does not touch Canada\'s borders?',	'Antarctic'),
(61,	2,	'Which is the second most populated province?',	'Quebec '),
(62,	2,	'Aside from our official languages what is the most spoken language in Canada?',	'Punjabi'),
(63,	2,	'What is Canada\'s largest island?',	'Baffin Island '),
(64,	2,	'Canada is the largest producer in the world of which item?',	'Uranium'),
(65,	2,	'Which is Canada\'s largest Mountain?',	'Mount Logan'),
(66,	2,	'What is Canada\'s oldest National Park?',	'Banff National Park'),
(67,	2,	'Biggest city in canada',	'Toronto '),
(68,	2,	'2nd largest city in canada',	'Montreal'),
(69,	2,	'WHICH CANADIAN CITY IS CONSIDERED \"HOLLYWOOD NORTH\"?',	'Vancouver '),
(70,	2,	'WHICH CITY IS HOME TO NORTH AMERICA\'S LARGEST MALL?',	'West Edmonton Mall '),
(71,	2,	'WHICH CANADIAN CHAIN FIRST OPENED IN HAMILTON IN 1964',	'Tim Hortons'),
(72,	2,	'WHERE IS CANADA\'S MOST VISITED NATIONAL HISTORIC SITE?',	'Halifax '),
(73,	2,	'WHAT IS CANADA\'S NATIONAL SPORT?',	'Hockey'),
(74,	2,	'WHICH CITY HAS THE MOST RESTAURANTS PER CAPITA IN CANADA?',	'Montreal '),
(75,	2,	'WHICH CITY WAS HOME TO THE FIRST NORTH AMERICAN YMCA?',	'Montreal'),
(76,	2,	'CANADA IS THE LARGEST EXPORTER OF WHAT SWEET LITTLE FRUIT?',	'Blueberries '),
(77,	2,	'WHAT IS CANADA\'S OLDEST CITY?',	'Quebec'),
(78,	2,	'WHICH CANADIAN CITY HAS THE MOST TOURISTS?',	'Toronto '),
(79,	2,	'WHICH PROVINCE IS HOME TO CANADA\'S TALLEST MOUNTAIN?',	'Mount Logan'),
(80,	2,	'What is the status of Canada? ',	'Dominion '),
(81,	2,	'What is in the centre of Canada\'s flag? ',	'Maple Leaf '),
(82,	2,	'Who said “The medium is the message.”? ',	'Marshall McLuhan '),
(83,	2,	'',	''),
(84,	3,	'Tata Motors now owns which foreign car company? ',	'Jaguar'),
(85,	3,	'Which Engine is made by Maruti Suzuki? ',	'K Series'),
(86,	3,	'What is the second stroke in a Petrol engine? ',	'Power Stroke'),
(87,	3,	'First car launched by Hyundai in India ',	'Santro'),
(88,	3,	'First fully indigenous passenger car? ',	'Tata Indica'),
(89,	3,	'Largest passenger car maker in India in terms of sales? ',	'Maruti Suzuki'),
(90,	3,	'Which company owns the following brands: Bentley, Buggati, Lamborghini & Audi? ',	'Volkswagen '),
(91,	3,	'South Korean car maker? ',	'Kia'),
(92,	3,	'Astra sedan was launched by which car maker in India? ',	'Opel'),
(93,	3,	'With which company does Mitsubishi have a tie-up in India? ',	'Hindustan Motors '),
(94,	3,	'Bike Which is named after Japanese bird aPeregrine Falcona ',	'Hayabusa'),
(95,	3,	'Name the parent company which owns the following brands: Pontiac, Buick, Cadillac, Vauxhall ',	'General Motors'),
(96,	3,	'Lexus is the luxury vehicle division of Japanese automaker? ',	'Toyota '),
(97,	3,	'Double Wishbone is a type of  ',	'Suspension'),
(98,	3,	'What is the unit to measure Torque? ',	'Newton'),
(99,	3,	' Identify the company from the tag line Vorsprung Durch Technik?',	'Audi'),
(100,	3,	' Identify the company from the tag line Vorsprung Durch Technik?',	'Bajaj'),
(101,	3,	'Indian two wheeler maufacturer offers ABS as a optoin?',	'TVS'),
(102,	3,	'Power for car/bike can measured as ',	'Horse Power'),
(103,	3,	'Which is the largest truck maker in India in terms of sales? ',	'Tata Motors'),
(104,	3,	'What Is the 2 wheeler division of BMW known as? ',	'Motorrad'),
(105,	3,	'Vespa, Motoguzzi & Aprilia are a part of which brand?',	'Piaggio'),
(106,	3,	'Which device helps to supply the air-fuel mixture to the engine? ',	'Carburetor  '),
(107,	3,	'Clutch, gear,Wheels,Axle, Shaft put together form the? ',	'Transmission System '),
(108,	3,	'Maserati, Alfa Romeo, Lancia are subsidiaries of which car maker ',	'Fiat'),
(109,	3,	'Name the car brand which is quite popular in James Bond movies ',	'Aston Martin'),
(110,	3,	'Which is the largest two-wheeler company in the World in terms sales? ',	'Hero MotoCorp '),
(111,	3,	'Who the first Formula One motor racing driver from India ',	'Narain Karthikeyan '),
(112,	3,	'Who won the 2011 Formula One  Drivers\' Championship in 2011 ',	'\nSebastian Vettel'),
(113,	3,	'Name the machine portion of the automobile which carries the carriage portion? ',	'Chassis'),
(114,	3,	'Who described the first International Combustion Engine? ',	'Christiaan Huygens'),
(115,	3,	'Who built the first American self-propelled steam vehicle? ',	'Oliver Evans'),
(116,	3,	'Who built England\'s first full-sized steam carriage built? ',	'Richard Trevithick'),
(117,	3,	'Who introduced the first brake in carriages? ',	'Walter Hancock'),
(118,	3,	'What was the fuel used in the first four-stroke vehicle? ',	'Gas'),
(119,	3,	'The first four wheeler powered by an I.C engine was built by whom? ',	'Siegfried Marcus. '),
(120,	3,	'What part or device is used to control the speed of a vehicle? ',	'Accelerator'),
(121,	3,	'Steel bar which functions by twisting within a vehicle machine? ',	'Torsion Bar '),
(122,	3,	'Mercedes cars belong to which country? ',	'Germany'),
(123,	3,	'Year of manufacture of an automobile is referred to as what? ',	'Model');

-- 2018-08-11 18:39:24
