CREATE TABLE IF NOT EXISTS ft_table (
    `id` int NOT NULL AUTO_INCREMENT,
    `login` varchar(8) DEFAULT 'toto' NOT NULL,
    `group` ENUM('staff', 'student', 'other') NOT NULL,
    `creation_date` DATE NOT NULL,
    PRIMARY KEY(`id`)
);
