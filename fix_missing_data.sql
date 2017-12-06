
create table laporjogjadb.tmp_pengguna  
as select * from test_laporjogjadb.pengguna where id not in (select id from laporjogjadb.pengguna);

insert into pengguna select * from tmp_pengguna; 

create table laporjogjadb.tmp_m_pekerjaan
as select * from test_laporjogjadb.m_pekerjaan where id_pekerjaan not in (select id_pekerjaan from laporjogjadb.m_pekerjaan);

insert into m_pekerjaan select * from tmp_m_pekerjaan; 


-- lap b section 

drop table if exists laporjogjadb.tmp_lap_b ; 
drop table if exists laporjogjadb.tmp_lap_b_korban ; 
drop table if exists laporjogjadb.tmp_lap_b_saksi ; 
drop table if exists laporjogjadb.tmp_lap_b_perkembangan ; 
drop table if exists laporjogjadb.tmp_lap_b_barbuk ; 
drop table if exists laporjogjadb.tmp_lap_b_tersangka ; 


create table laporjogjadb.tmp_lap_b 
as select * from test_laporjogjadb.lap_b where lap_b_id not in (select lap_b_id from laporjogjadb.lap_b) ; 

create table laporjogjadb.tmp_lap_b_korban 
as select * from test_laporjogjadb.lap_b_korban where id not in (select id from laporjogjadb.lap_b_korban) ; 

create table laporjogjadb.tmp_lap_b_saksi 
as select * from test_laporjogjadb.lap_b_saksi where id not in (select id from laporjogjadb.lap_b_saksi) ; 

create table laporjogjadb.tmp_lap_b_perkembangan 
as select * from test_laporjogjadb.lap_b_perkembangan where id not in (select id from laporjogjadb.lap_b_perkembangan);

create table laporjogjadb.tmp_lap_b_barbuk 
as select * from test_laporjogjadb.lap_b_barbuk where id not in (select id from laporjogjadb.lap_b_barbuk);

create table laporjogjadb.tmp_lap_b_tersangka 
as select * from test_laporjogjadb.lap_b_tersangka where id not in (select id from laporjogjadb.lap_b_tersangka);


insert into lap_b select * from tmp_lap_b; 
insert into lap_b_korban select * from tmp_lap_b_korban; 
insert into lap_b_saksi select * from tmp_lap_b_saksi; 
insert into lap_b_perkembangan select * from tmp_lap_b_perkembangan; 
insert into lap_b_barbuk select * from tmp_lap_b_barbuk; 
insert into lap_b_tersangka select * from tmp_lap_b_tersangka; 



 -- lap a section 
drop table if exists laporjogjadb.tmp_lap_a ; 
drop table if exists laporjogjadb.tmp_lap_a_korban ; 
drop table if exists laporjogjadb.tmp_lap_a_saksi ; 
drop table if exists laporjogjadb.tmp_lap_a_perkembangan ; 
drop table if exists laporjogjadb.tmp_lap_a_barbuk ; 
drop table if exists laporjogjadb.tmp_lap_a_tersangka ; 


create table laporjogjadb.tmp_lap_a 
as select * from test_laporjogjadb.lap_a where lap_a_id not in (select lap_a_id from laporjogjadb.lap_a) ; 

create table laporjogjadb.tmp_lap_a_korban 
as select * from test_laporjogjadb.lap_a_korban where id not in (select id from laporjogjadb.lap_a_korban) ; 

create table laporjogjadb.tmp_lap_a_saksi 
as select * from test_laporjogjadb.lap_a_saksi where id not in (select id from laporjogjadb.lap_a_saksi) ; 

create table laporjogjadb.tmp_lap_a_perkembangan 
as select * from test_laporjogjadb.lap_a_perkembangan where id not in (select id from laporjogjadb.lap_a_perkembangan);

create table laporjogjadb.tmp_lap_a_barbuk 
as select * from test_laporjogjadb.lap_a_barbuk where id not in (select id from laporjogjadb.lap_a_barbuk);

create table laporjogjadb.tmp_lap_a_tersangka 
as select * from test_laporjogjadb.lap_a_tersangka where id not in (select id from laporjogjadb.lap_a_tersangka);


insert into lap_a select * from tmp_lap_a; 
insert into lap_a_korban select * from tmp_lap_a_korban; 
insert into lap_a_saksi select * from tmp_lap_a_saksi; 
insert into lap_a_perkembangan select * from tmp_lap_a_perkembangan; 
insert into lap_a_barbuk select * from tmp_lap_a_barbuk; 
insert into lap_a_tersangka select * from tmp_lap_a_tersangka; 





 
 

