create database if not exists [[DBNAME]];
use [[DBNAME]];
--
-- Table structure for table `user`
--
DROP TABLE IF EXISTS `[[TABLENAME]]`;
CREATE TABLE IF NOT EXISTS `[[TABLENAME]]` ( `websiteID` int(11) NOT NULL AUTO_INCREMENT, `websiteText` varchar(255) NOT NULL, `websiteURL` varchar(255) NOT NULL, `websiteSort` int(11) DEFAULT '0', PRIMARY KEY (`websiteID`)) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;
--
-- Dumping data for table `sites`
--
INSERT INTO `[[TABLENAME]]` (`websiteText`, `websiteURL`, `websiteSort`) VALUES ('Google CA', 'https%3A%2F%2Fwww.google.ca%2F', 100);
--
-- Table structure for table `user`
--
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` ( `id` int(10) NOT NULL AUTO_INCREMENT, `emailaddress` varchar(255) NOT NULL, `password` varchar(255) NOT NULL, `firstname` varchar(128) NOT NULL, `lastname` varchar(128) NOT NULL, `adminuser` tinyint(1) NOT NULL DEFAULT '0', PRIMARY KEY (`id`), UNIQUE KEY `emailaddress` (`emailaddress`) ) ENGINE=InnoDB AUTO_INCREMENT=12010 DEFAULT CHARSET=latin1;
COMMIT;
