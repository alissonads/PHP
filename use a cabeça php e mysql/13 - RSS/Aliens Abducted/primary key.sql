use aliendatabase;

alter table aliens_abduction 
add abduction_id int auto_increment first,
add primary key(abduction_id);

select * from aliens_abduction;