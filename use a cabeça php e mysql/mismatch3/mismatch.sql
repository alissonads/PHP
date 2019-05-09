create database if not exists mismatch
default charset utf8
default collate utf8_general_ci;

use mismatch;

create table if not exists mismatch_user(
	user_id int auto_increment,
	join_date datetime,
    first_name varchar(30),
    last_name varchar(30),
    gender enum('M', 'F'),
    birthdate date,
    city varchar(30),
    state char(2),
    picture varchar(32),
    primary key(user_id)
) default charset = utf8;

drop table mismatch_user;

alter table mismatch_user
add column username varchar(32) not null after user_id,
add column password varchar(16) not null after username;

alter table mismatch_user
change password password varchar(40) not null;

insert into mismatch_user
values(1, 'sidneypic', sha('sidneypic1234'), '2019-04-28 14:32:40', 'Sidney', 'Kelsow', 'F', '1984-07-19', 'Tempe', 'AZ', 'sidneypic.jpg');

delete from mismatch_user
where user_id = 1;

select * from mismatch_user;