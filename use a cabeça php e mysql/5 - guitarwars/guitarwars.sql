create database if not exists gwdb
default charset utf8
default collate utf8_general_ci;

use gwdb;

create table if not exists guitarwars (
	`id` int not null auto_increment,
    `date` timestamp default current_timestamp,
    `name` varchar(32),
    `score` int,
    `screenshot` varchar(64),
    primary key(id),
    key `name` (`name`)
);

insert into guitarwars values (0, now(), 'alisson', '7894562', '');

describe guitarwars;

drop table guitarwars;

select * from guitarwars;