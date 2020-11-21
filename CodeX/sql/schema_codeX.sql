CREATE TABLE `participant` (
	`username` varchar(20) NOT NULL,
	`password` varchar(20) NOT NULL,
	`first_name` varchar(20) NOT NULL,
	`last_name` varchar(20) NOT NULL,
	`email` varchar(20) NOT NULL UNIQUE CHECK (`email` LIKE '%@%'),
	`date_of_birth` DATE NOT NULL,
	`gender` varchar(1) CHECK (`gender` IN ('M', 'F', 'N')),
	PRIMARY KEY (`username`)
);

CREATE TABLE `admin` (
	`username` varchar(20) NOT NULL,
	`password` varchar(20) NOT NULL,
	`first_name` varchar(20) NOT NULL,
	`last_name` varchar(20) NOT NULL,
	`organization` varchar(30),
	`email` varchar(20) NOT NULL UNIQUE CHECK (`email` LIKE '%@%'),
	`date_of_birth` DATE NOT NULL,
	`gender` varchar(1) CHECK (`gender` IN ('M', 'F', 'N')),
	PRIMARY KEY (`username`)
);

CREATE TABLE `rating` (
	`admin_username` varchar(20) NOT NULL,
	`participant_username` varchar(20) NOT NULL,
	`rating_score` INT NOT NULL,
	PRIMARY KEY (`admin_username`,`participant_username`),
    FOREIGN KEY (`admin_username`) REFERENCES `admin`(`username`) ON DELETE CASCADE,
    FOREIGN KEY (`participant_username`) REFERENCES `participant`(`username`) ON DELETE CASCADE
);

CREATE TABLE `contest` (
	`contest_ID` int NOT NULL AUTO_INCREMENT,
	`name` varchar(40) NOT NULL,
	`admin_username` varchar(20) NOT NULL,
	`time_created` DATETIME NOT NULL,
	`start_time` DATETIME NOT NULL,
	`duration` int NOT NULL,
	PRIMARY KEY (`contest_ID`),
    FOREIGN KEY (`admin_username`) REFERENCES `admin`(`username`) ON DELETE CASCADE
);

CREATE TABLE `participations` (
	`username` varchar(20) NOT NULL,
	`contest_ID` int NOT NULL,
	PRIMARY KEY (`username`,`contest_ID`),
    FOREIGN KEY (`username`) REFERENCES `participant`(`username`) ON DELETE CASCADE,
    FOREIGN KEY (`contest_ID`) REFERENCES `contest`(`contest_ID`) ON DELETE CASCADE
);

CREATE TABLE `round` (
	`round_number` int NOT NULL,
	`contest_ID` int NOT NULL,
	`title` varchar(40) NOT NULL,
	`problem_statement` longtext NOT NULL,
	`test_input` longtext NOT NULL,
	`expected_output` longtext NOT NULL,
	`total_marks` int NOT NULL,
	PRIMARY KEY (`round_number`,`contest_ID`),
    FOREIGN KEY (`contest_ID`) REFERENCES `contest`(`contest_ID`) ON DELETE CASCADE
);

CREATE TABLE `submission` (
	`contest_ID` int NOT NULL,
	`round_number` int NOT NULL,
	`time_stamp` DATETIME NOT NULL,
	`participant_username` varchar(20) NOT NULL,
	`submitted_code` blob NOT NULL,
	`interpretor_result` varchar(1) NOT NULL CHECK (`interpretor_result` IN ('P', 'F', 'E')),
	`marks_awarded` int NOT NULL,
    PRIMARY KEY (`contest_ID`,`round_number`,`time_stamp`,`participant_username`),
    FOREIGN KEY (`contest_ID`) REFERENCES `round`(`contest_ID`) ON DELETE CASCADE,
    FOREIGN KEY (`round_number`) REFERENCES `round`(`round_number`) ON DELETE CASCADE,
    FOREIGN KEY (`participant_username`) REFERENCES `participant`(`username`) ON DELETE CASCADE
);


