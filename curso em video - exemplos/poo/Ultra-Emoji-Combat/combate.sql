create database if not exists combate 
	default charset utf8 
	default collate utf8_general_ci;
    
use combate;

create table if not exists lutador(id int unsigned not null auto_increment,
								   nome varchar(30) not null,
                                   nascimento date,
                                   sexo enum('M', 'F') not null,
                                   peso decimal(5, 2) not null,
                                   altura decimal(3, 2),
                                   categoria varchar(20) not null,
                                   nacionalidade varchar(20),
                                   vitorias smallint unsigned,
                                   empates tinyint unsigned,
                                   derrotas tinyint unsigned,
                                   primary key(id)) default charset = utf8;
                                   
create table if not exists luta(id int unsigned not null auto_increment,
								id_lutador1 int unsigned,
								id_lutador2 int unsigned,
								total_rounds tinyint unsigned default 5,
                                qtd_rouds tinyint unsigned,
                                vencedor int default 0, /*id do lutador vencedor. Se empate valor -1*/
                                primary key(id),
                                foreign key(id_lutador1) references lutador(id),
								foreign key(id_lutador2) references lutador(id)) default charset = utf8;
                                
create table if not exists evento(id int unsigned not null auto_increment,
								  id_lutador int unsigned,
                                  id_luta int unsigned,
                                  nome varchar(30),
								  data_evento date not null,
                                  num_evento int unsigned,
                                  primary key(id),
                                  foreign key(id_lutador) references lutador(id),
                                  foreign key(id_luta) references luta(id)) default charset = utf8;
                                  			
/*(id, nome, nascimento, sexo, peso, altura, categoria, nacionalidade, vitorias, empates, derrotas)*/
insert into lutador values(default, 'Pretty Boy', '1987-10-30', 'M', '68.9', '1.75', 'Leve', 'França', '11', '1', '3');
insert into lutador values(default, 'Putscript', '1989-06-28', 'M', '57.8', '1.68', 'Leve', 'Brasil', '14', '3', '2');
insert into lutador values(default, 'Snapshadow', '1982-04-10', 'M', '80.9', '1.65', 'Medio', 'EUA', '12', '1', '2');
insert into lutador values(default, 'Dead Code', '1990-01-15', 'M', '81.6', '1.93', 'Medio', 'Austrália', '13', '2', '0');
insert into lutador values(default, 'UFOCobol', '1981-08-04', 'M', '119.3', '1.70', 'Pesado', 'Brasil', '5', '3', '4');
insert into lutador values(default, 'Nerdaart', '1988-09-11', 'M', '105.7', '1.81', 'Pesado', 'EUA', '12', '4', '2');

insert into luta values(default, '2', '1', default, '3', '2');
insert into luta values(default, '3', '4', default, '2', '4');
insert into luta values(default, '5', '6', default, '5', default);

drop table if exists luta;
drop table if exists lutador;

select * from lutador;
select * from luta;

select nome as 'Nome', categoria as 'Categoria' from lutador order by nome;
select categoria as 'Categoria', count(*) from lutador group by categoria;

select categoria as 'Categoria', count(*) as 'Quantidade' 
from lutador 
where categoria = 'Leve'
group by categoria;

select categoria as 'Categoria', count(*) as 'Quantidade' 
from lutador 
group by categoria
having categoria = 'Medio';

select * from lutador 
where categoria = 'Medio'
order by nome;

select lutador.nome as 'Lutador1'
from lutador inner join luta
on luta.id_lutador1 = lutador.id;

select lutador.nome as 'Lutador2', lutador.categoria
from lutador inner join luta
on luta.id_lutador2 = lutador.id;

select id, nome, nascimento, peso, altura, 
                     nacionalidade, vitorias, empates, derrotas from lutador;
                     


