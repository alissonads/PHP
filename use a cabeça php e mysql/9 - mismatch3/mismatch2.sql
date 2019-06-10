use mismatch;

create table if not exists mismatch_category (
	category_id int auto_increment,
    name varchar(32),
    primary key(category_id)
) default charset = utf8;

create table if not exists mismatch_topic (
	topic_id int auto_increment,
    category_id int not null,
    name varchar(52),
    primary key(topic_id),
    foreign key(category_id) references mismatch_category(category_id)
) default charset = utf8;

create table if not exists mismatch_response(
	response_id int auto_increment,
    user_id int,
    topic_id int,
    response tinyint default 0,
    primary key(response_id),
    foreign key(user_id) references mismatch_user(user_id),
    foreign key(topic_id) references mismatch_topic(topic_id)
) default charset = utf8;

drop table mismatch_response;
drop table mismatch_topic;

describe mismatch_topic;

describe mismatch_response;

insert into mismatch_category 
value (default, 'Aparencia'),
	  (default, 'Entretenimento'),
	  (default, 'Comida'),
	  (default, 'Pessoas'),
	  (default, 'Atividades');

insert into mismatch_topic values (1, 1, 'Tatuagens');
insert into mismatch_topic values (2, 1, 'Corrente de ouro');
insert into mismatch_topic values (3, 1, 'Piercings');
insert into mismatch_topic values (4, 1, 'Botas de vaqueiro');
insert into mismatch_topic values (5, 1, 'Cabelos longo');
insert into mismatch_topic values (6, 2, 'Reality show');
insert into mismatch_topic values (7, 2, 'Luta profissional');
insert into mismatch_topic values (8, 2, 'Filmes de terror');
insert into mismatch_topic values (9, 2, 'Rap');
insert into mismatch_topic values (10, 2, 'Ópera');
insert into mismatch_topic values (11, 3, 'Sushi');
insert into mismatch_topic values (12, 3, 'Macarrão');
insert into mismatch_topic values (13, 3, 'Comida picante');
insert into mismatch_topic values (14, 3, 'Manteiga de amendoim & sanduíches de banana');
insert into mismatch_topic values (15, 3, 'Martinis');
insert into mismatch_topic values (16, 4, 'Robert Downey JR.');
insert into mismatch_topic values (17, 4, 'Bill Gates');
insert into mismatch_topic values (18, 4, 'Chris Evans');
insert into mismatch_topic values (19, 4, 'Scarlett Johansson');
insert into mismatch_topic values (20, 4, 'Elizabeth Olsen');
insert into mismatch_topic values (21, 5, 'Yoga');
insert into mismatch_topic values (22, 5, 'Musculação');
insert into mismatch_topic values (23, 5, 'Quebra-cabeças');
insert into mismatch_topic values (24, 5, 'Karaoke');
insert into mismatch_topic values (25, 5, 'Caminhando');

select * from mismatch_category;

select * from mismatch_topic;

select * from mismatch_response;

