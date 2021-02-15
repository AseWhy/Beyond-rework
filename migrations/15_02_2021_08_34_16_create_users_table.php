<?php

/*
	YOUR MIGRATION HERE
*/

return function($client){
	$client -> query("
		CREATE TABLE `users` (
			`id` INT(64) NOT NULL AUTO_INCREMENT,
			`name` VARCHAR(255) NOT NULL,
			`created_at` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`updated_at` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		) ENGINE = InnoDB
	");

	return true;
};