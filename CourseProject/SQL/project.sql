-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: music
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums` (
  `albumID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(45) NOT NULL,
  `genre` varchar(45) NOT NULL,
  `releaseDate` datetime NOT NULL,
  `fact` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`albumID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` VALUES (1,'Higher Truth','UME','Alternative','2015-09-18 00:00:00','positive album'),(2,'No One Sings Like You Anymore, Vol. 1','UME','Alternative','2020-12-11 00:00:00','released after death'),(3,'The Wild, the Innocent, & the E Street Shuffle','Columbia','Rock and Roll','1973-11-05 00:00:00','Second album by Mr. Bruce'),(4,'Mr. Bad Guy','Columbia','Synth-Pop','1985-04-29 00:00:00','Was supposed to have duets with Michael Jackson'),(5,'Ride This Train','Columbia','Country','1960-08-01 00:00:00','First concept album'),(6,'Blood, Sweat, and Tears','Legacy','Country','1963-01-07 00:00:00','About the american working man'),(7,'Infest','DreamWorks','Alternative','2000-04-25 00:00:00','Nasty cover photo'),(8,'Death of an Optimist','Fueled by Ramen','Alternative','2020-12-04 00:00:00','Third album from the dude'),(9,'The Voice of Frank Sinatra','Columbia','Traditional Pop','1946-05-04 00:00:00',NULL),(10,'Colors','Capitol','Pop','2017-10-13 00:00:00','The thirteenth Beck album'),(11,'Five Feet High and Rising','Columbia','Country','1974-01-01 00:00:00','Release date month and day is a little ambiguous'),(12,'Mellow Gold','DGC','Alternative','1994-03-01 00:00:00','\"Like a satanic K-tel record that\'s been found in a trash dumpster\"');
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `albums_artists`
--

DROP TABLE IF EXISTS `albums_artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums_artists` (
  `albumID` int(11) NOT NULL,
  `artistID` int(11) NOT NULL,
  PRIMARY KEY (`albumID`,`artistID`),
  KEY `artistID_fk` (`artistID`),
  CONSTRAINT `albumID_fk` FOREIGN KEY (`albumID`) REFERENCES `albums` (`albumID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `artistID_fk` FOREIGN KEY (`artistID`) REFERENCES `artists` (`artistID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums_artists`
--

LOCK TABLES `albums_artists` WRITE;
/*!40000 ALTER TABLE `albums_artists` DISABLE KEYS */;
INSERT INTO `albums_artists` VALUES (1,1),(2,1),(3,2),(4,3),(5,4),(6,4),(7,5),(8,6),(9,7),(10,8),(11,4),(12,8);
/*!40000 ALTER TABLE `albums_artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artists` (
  `artistID` int(11) NOT NULL AUTO_INCREMENT,
  `stageName` varchar(45) DEFAULT NULL,
  `birthName` varchar(45) NOT NULL,
  `hometown` varchar(45) DEFAULT NULL,
  `birth` datetime NOT NULL,
  `death` datetime DEFAULT NULL,
  `fact` varchar(45) NOT NULL,
  PRIMARY KEY (`artistID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (1,NULL,'Chris Cornell','Seattle','1964-07-18 00:00:00','2017-05-18 00:00:00','Lead Singer in Soundgarden'),(2,NULL,'Bruce Springsteen','New Jersey','1949-09-23 00:00:00',NULL,'Dedicated an album to 9/11 victims'),(3,'Freddie Mercury','Farrokh Bulsara','Sultanate','1946-09-05 00:00:00','1991-11-24 00:00:00','Born in Zanzibar'),(4,'The Man in Black','Johnny Cash','Kingsland','1932-02-26 00:00:00','2003-09-12 00:00:00','Covered a Nine-Inch Nails Song'),(5,'Papa Roach','Jacoby Shaddix','Vacaville','1976-07-28 00:00:00',NULL,'Host of Scarred'),(6,'Grandson','Jordan Benjamin','Toronto','1993-10-25 00:00:00',NULL,'Canadian dude'),(7,NULL,'Frank Sinatra','Hoboken','1915-12-12 00:00:00','1998-05-14 00:00:00','Best selling music artist of all time ever'),(8,'Beck','Bek Cambell','Los Angelas','1970-07-08 00:00:00',NULL,'Lived in a rat-infested shed');
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artists_songs`
--

DROP TABLE IF EXISTS `artists_songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artists_songs` (
  `artistID` int(11) NOT NULL,
  `songID` int(11) NOT NULL,
  PRIMARY KEY (`artistID`,`songID`),
  KEY `songID` (`songID`),
  CONSTRAINT `artistID` FOREIGN KEY (`artistID`) REFERENCES `artists` (`artistID`) ON UPDATE CASCADE,
  CONSTRAINT `songID` FOREIGN KEY (`songID`) REFERENCES `songs` (`songID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists_songs`
--

LOCK TABLES `artists_songs` WRITE;
/*!40000 ALTER TABLE `artists_songs` DISABLE KEYS */;
INSERT INTO `artists_songs` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(2,23),(2,24),(2,25),(2,26),(2,27),(2,28),(2,29),(3,30),(3,31),(3,32),(3,33),(3,34),(3,35),(3,36),(3,37),(3,38),(3,39),(3,40),(4,41),(4,42),(4,43),(4,44),(4,45),(4,46),(4,47),(4,48),(4,49),(4,50),(4,51),(4,52),(4,53),(4,54),(4,55),(4,56),(4,57),(4,99),(4,100),(4,101),(4,102),(4,103),(4,104),(4,105),(4,106),(4,107),(5,58),(5,59),(5,60),(5,61),(5,62),(5,63),(5,64),(5,65),(5,66),(5,67),(5,68),(6,69),(6,70),(6,71),(6,72),(6,73),(6,74),(6,75),(6,76),(6,77),(6,78),(6,79),(6,80),(7,81),(7,82),(7,83),(7,84),(7,85),(7,86),(7,87),(7,88),(8,89),(8,90),(8,91),(8,92),(8,93),(8,94),(8,95),(8,96),(8,97),(8,98),(8,108),(8,109),(8,110),(8,111),(8,112),(8,113),(8,114),(8,115),(8,116),(8,117),(8,118),(8,119);
/*!40000 ALTER TABLE `artists_songs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `songs` (
  `songID` int(11) NOT NULL AUTO_INCREMENT,
  `songName` varchar(75) NOT NULL,
  `length` time NOT NULL,
  `comments` varchar(45) DEFAULT NULL,
  `bbRank` int(11) DEFAULT NULL,
  `bbDate` datetime DEFAULT NULL,
  `writer` varchar(45) NOT NULL,
  `albumID` int(11) DEFAULT NULL,
  PRIMARY KEY (`songID`),
  KEY `albumID` (`albumID`),
  CONSTRAINT `albumID` FOREIGN KEY (`albumID`) REFERENCES `albums` (`albumID`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `songs`
--

LOCK TABLES `songs` WRITE;
/*!40000 ALTER TABLE `songs` DISABLE KEYS */;
INSERT INTO `songs` VALUES (1,'Nearly Forgot My Broken Heart','00:03:54','Good Song',18,'2015-12-26 00:00:00','Chris Cornell',1),(2,'Dead Wishes','00:04:55','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(3,'Worried Moon','00:04:32','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(4,'Before We Disappear','00:03:51','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(5,'Through the Window','00:04:41','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(6,'Josephine','00:03:38','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(7,'Murderer of Blue Skies','00:03:42','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(8,'Higher Truth','00:05:06','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(9,'Let Your Eyes Wander','00:03:42','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(10,'Only These Words','00:03:29','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(11,'Circling','00:03:28','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(12,'Our Time in the Universe','00:04:19','Haven\'t Heard',NULL,NULL,'Chris Cornell',1),(13,'Get It While You Can','00:03:22','Haven\'t Heard',NULL,NULL,'Jerry Ragovoy',2),(14,'Jump into the Fire','00:03:35','Haven\'t Heard',NULL,NULL,'Harry Nilsson',2),(15,'Sad Sad City','00:03:49','Haven\'t Heard',NULL,NULL,'Aaron Behrens',2),(16,'Patience','00:04:13','Haven\'t Heard',25,'2020-11-14 00:00:00','Guns N\' Roses',2),(17,'Nothing Compares 2 U','00:04:12','Haven\'t Heard',NULL,NULL,'Prince',2),(18,'Watching the Wheels','00:03:14','Haven\'t Heard',NULL,NULL,'John Lennon',2),(19,'You Don\'t Know Nothing About Love','00:03:04','Haven\'t Heard',NULL,NULL,'Jerry Ragovoy',2),(20,'Showdown','00:03:23','Haven\'t Heard',NULL,NULL,'Jeff Lynne',2),(21,'To Be Treated Rite','00:03:14','Haven\'t Heard',NULL,NULL,'Terry Reid',2),(22,'Stay with Me Baby','00:04:15','Haven\'t Heard',NULL,NULL,'Jerry Ragovoy',2),(23,'The E Street Shuffle','00:04:31','',NULL,NULL,'Bruce Springsteen',3),(24,'4th of July, Asbury Park(Sandy)','00:05:36',NULL,NULL,NULL,'Bruce Springsteen',3),(25,'Kitty\'s Back','00:07:09',NULL,NULL,NULL,'Bruce Springsteen',3),(26,'Wild Billy\'s Circus Story','00:04:47',NULL,NULL,NULL,'Bruce Springsteen',3),(27,'Incident on 57th Street','00:07:45',NULL,NULL,NULL,'Bruce Springsteen',3),(28,'Rosalita (Come Out Tonight)','00:07:04',NULL,NULL,NULL,'Bruce Springsteen',3),(29,'New York City Seranade','00:09:55',NULL,NULL,NULL,'Bruce Springsteen',3),(30,'Let\'s Turn It On','00:03:42',NULL,NULL,NULL,'Freddie Mercury',4),(31,'Made in Heaven','00:04:05',NULL,NULL,NULL,'Freddie Mercury',4),(32,'I Was Born to Love You','00:03:38',NULL,NULL,NULL,'Freddie Mercury',4),(33,'Foolin\' Around','00:03:29',NULL,NULL,NULL,'Freddie Mercury',4),(34,'Your Kind of Lover','00:03:32',NULL,NULL,NULL,'Freddie Mercury',4),(35,'Mr. Bad Guy','00:04:09',NULL,159,'1985-06-15 00:00:00','Freddie Mercury',4),(36,'Man Made Paradise','00:04:08',NULL,NULL,NULL,'Freddie Mercury',4),(37,'There Must Be More to Life Than This','00:03:00',NULL,NULL,NULL,'Freddie Mercury',4),(38,'My Love is Dangerous','00:03:42',NULL,NULL,NULL,'Freddie Mercury',4),(39,'Love Me Like There\'s No Tomorrow','00:03:46',NULL,NULL,NULL,'Freddie Mercury',4),(40,'Living on My Own','00:03:42',NULL,NULL,NULL,'Freddie Mercury',4),(41,'Loading Coal','00:04:58',NULL,NULL,NULL,'Merle Travis',5),(42,'Slow Rider','00:04:12',NULL,NULL,NULL,'Johnny Cash',5),(43,'Lumberjack','00:03:02',NULL,NULL,NULL,'Leon Payne',5),(44,'Dorraine of Ponchartrain','00:04:47',NULL,NULL,NULL,'Cash',5),(45,'Going to Memphis','00:04:26',NULL,NULL,NULL,'Hollie Dew',5),(46,'When Papa Played the Dobro','00:02:55',NULL,NULL,NULL,'Cash',5),(47,'Boss Jack','00:03:50',NULL,NULL,NULL,'Tex Ritter',5),(48,'Old Doc Brown','00:04:10',NULL,NULL,NULL,'Red Foley',5),(49,'The Legend of John Henry\'s Hammer','00:09:03',NULL,NULL,NULL,'Johnny Cash',6),(50,'Tell Him I\'m Gone','00:03:03',NULL,NULL,NULL,'Cash',6),(51,'Another Man Done Gone','00:02:35',NULL,NULL,NULL,'Vera Hall',6),(52,'Busted','00:02:17',NULL,13,'1963-01-01 00:00:00','Harlan Howard',6),(53,'Casey Jones','00:03:02',NULL,NULL,NULL,'Cash',6),(54,'Nine Pound Hammer','00:03:15',NULL,NULL,NULL,'Merle Travis',6),(55,'Chain Gang','00:02:40',NULL,NULL,NULL,'Howard',6),(56,'Waiting for a Train','00:02:06',NULL,NULL,NULL,'Jimmie Rogers',6),(57,'Roughneck','00:02:11',NULL,NULL,NULL,'Sheb Wooley',6),(58,'Infest','00:04:09',NULL,NULL,NULL,'Papa Roach',7),(59,'Last Resort','00:03:19',NULL,1,'2000-08-12 00:00:00','Papa Roach',7),(60,'Broken Home','00:03:41',NULL,NULL,NULL,'Papa Roach',7),(61,'Dead Cell','00:03:06',NULL,NULL,NULL,'Papa Roach',7),(62,'Between Angels and Insects','00:03:54',NULL,NULL,NULL,'Papa Roach',7),(63,'Blood Brothers','00:03:34',NULL,NULL,NULL,'Papa Roach',7),(64,'Revenge','00:03:42',NULL,NULL,NULL,'Papa Roach',7),(65,'Snakes','00:03:29',NULL,NULL,NULL,'Papa Roach',7),(66,'Never Enough','00:03:35',NULL,NULL,NULL,'Papa Roach',7),(67,'Binge','00:03:47',NULL,NULL,NULL,'Papa Roach',7),(68,'Thrown Away','00:09:36',NULL,NULL,NULL,'Papa Roach',7),(69,'Death of an Optimist // Intro','00:02:31',NULL,NULL,NULL,'Grandson',8),(70,'In Over My Head','00:03:18',NULL,NULL,NULL,'Grandson',8),(71,'Identity','00:03:36',NULL,NULL,NULL,'Grandson',8),(72,'Left Behind','00:03:25',NULL,NULL,NULL,'Grandson',8),(73,'Dirty','00:03:28',NULL,10,'2021-02-27 00:00:00','Grandson',8),(74,'The Ballad of G and X // Interlude','00:02:22',NULL,NULL,NULL,'Grandson',8),(75,'We Did It!!!','00:02:49',NULL,NULL,NULL,'Grandson',8),(76,'WWIII','00:03:22',NULL,NULL,NULL,'Grandson',8),(77,'Riptide','00:03:12',NULL,NULL,NULL,'Grandson',8),(78,'Pain Shopping','00:03:17',NULL,NULL,NULL,'Grandson',8),(79,'Drop Dead','00:03:09',NULL,NULL,NULL,'Grandson',8),(80,'Welcome to Paradise // Outro','00:03:31',NULL,NULL,NULL,'Grandson',8),(81,'You Go to My Head','00:03:00',NULL,NULL,NULL,'Axel Stordahl',9),(82,'Someone to Watch Over Me','00:03:18',NULL,NULL,NULL,'Axel Stordahl',9),(83,'These Foolish Things','00:03:08',NULL,NULL,NULL,'Axel Stordahl',9),(84,'Why Shouldn\'t I?','00:02:53',NULL,NULL,NULL,'Axel Stordahl',9),(85,'I Don\'t Know Why','00:02:46',NULL,NULL,NULL,'Axel Stordahl',9),(86,'Try a Little Tenderness','00:03:08',NULL,NULL,NULL,'Axel Stordahl',9),(87,'I Don\'t Stand a Ghost of a Chance with You','00:03:11',NULL,NULL,NULL,'Axel Stordahl',9),(88,'Paradise','00:02:37',NULL,NULL,NULL,'Axel Stordahl',9),(89,'Colors','00:04:21',NULL,3,'2018-06-23 00:00:00','Beck Hansen',10),(90,'Seventh Heaven','00:05:00',NULL,NULL,NULL,'Beck Hansen',10),(91,'I\'m So Free','00:04:07',NULL,NULL,NULL,'Beck Hansen',10),(92,'Dear Life','00:03:44',NULL,NULL,NULL,'Beck Hansen',10),(93,'No Distraction','00:04:32',NULL,NULL,NULL,'Beck Hansen',10),(94,'Dreams','00:04:57',NULL,1,'2015-07-11 00:00:00','Beck Hansen',10),(95,'Wow','00:03:40',NULL,10,'2016-08-20 00:00:00','Beck Hansen',10),(96,'Up All Night','00:03:10',NULL,30,'2018-03-03 00:00:00','Beck Hansen',10),(97,'Square One','02:55:00',NULL,NULL,NULL,'Beck Hansen',10),(98,'Fix Me','00:03:13',NULL,NULL,NULL,'Beck Hansen',10),(99,'In Them Old Cottonfields Back Home','00:02:33',NULL,NULL,NULL,'Lead Belly',11),(100,'I\'m So Lonesome I Could Cry','00:02:38',NULL,NULL,NULL,'Hank Williams',11),(101,'Frankie\'s Man Johnny','00:02:17',NULL,NULL,NULL,'Johnny Cash',11),(102,'In the Jailhouse Now','00:02:22',NULL,NULL,NULL,'Jimmie Rodgers',11),(103,'My Shoes Keep Walking Back to You','00:02:23',NULL,NULL,NULL,'Lee Ross',11),(104,'Don\'t Take Your Guns to Town','00:03:04',NULL,NULL,NULL,'Cash',11),(105,'Great Speckled Bird','00:02:04',NULL,NULL,NULL,'Roy Carter',11),(106,'Five Feet High and Rising','00:01:49',NULL,NULL,NULL,'Cash ',11),(107,'I Forgot More Than You\'ll Ever Know','00:02:29',NULL,NULL,NULL,'Cecil. A Null',11),(108,'Loser','00:03:55',NULL,1,'1994-02-05 00:00:00','Hansen',12),(109,'Pay No Mind(Snoozer)','00:03:15',NULL,NULL,NULL,'Beck',12),(110,'F*cking with My Head(Mountain Dew Rock)','00:03:41',NULL,NULL,NULL,'Beck',12),(111,'Whickeyclone, Hotel City 1997','00:03:28',NULL,NULL,NULL,'Beck',12),(112,'Soul Sucking\' Jerk','00:03:57',NULL,NULL,NULL,'Hansen',12),(113,'Truckdrivin Neighbors Downstairs(Yellow Sweat)','00:02:55',NULL,NULL,NULL,'Beck',12),(114,'Sweet Sunshine','04:14:00',NULL,NULL,NULL,'Hansen',12),(115,'Beercan','00:04:00',NULL,NULL,NULL,'Hansen',12),(116,'Steal My Body Home','00:05:34',NULL,NULL,NULL,'Beck',12),(117,'Nitemare Hippy Girl','00:02:55',NULL,NULL,NULL,'Beck',12),(118,'Mutherf*ker','00:02:04',NULL,NULL,NULL,'Beck',12),(119,'Blackhole','00:07:33',NULL,NULL,NULL,'Beck',12);
/*!40000 ALTER TABLE `songs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-01 21:07:43
