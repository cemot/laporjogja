ALTER TABLE `pengguna` ADD `id_unit` CHAR(32) NULL AFTER `jabatan`; 

delete from lap_a_penyidik where id='4388362b282b6e75f580cc9b9d584237' ;

delete from lap_a_penyidik where id ='0dde89ba71f2e2ed9524f9ca260393ce' ;

-- benerkan inputnya. jangan sampai kecolongan 


a4013dc662d9b0945645cc889c5ac2e6



ALTER TABLE `lap_b_penyidik` ADD `koordinator` INT NULL DEFAULT '0' AFTER `lap_b_id`; 

ALTER TABLE `lap_a_penyidik` ADD `koordinator` INT NULL DEFAULT '0' AFTER `lap_a_id`; 



update lap_b_penyidik set koordinator = 1 
where lap_b_id in ( 


select lap_b_id from ( select lap_b_id, count(*) as total from lap_b_penyidik group by lap_b_id ) x where x.total = 1 ) 



update lap_a_penyidik set koordinator = 1 
where lap_a_id in ( 	


select lap_a_id from ( select lap_a_id, count(*) as total from lap_a_penyidik group by lap_a_id ) x where x.total = 1 ) 



8 November 2017

ALTER TABLE `lap_b_saksi` ADD `saksi_umur` INT NULL AFTER `saksi_tgl_lahir`;


update lap_b_saksi set saksi_umur = year(current_date) - year(saksi_tgl_lahir); 



ALTER TABLE `lap_b_saksi` ADD `tersangka_umur` INT NULL AFTER `tersangka_tgl_lahir`;

update lap_b_tersangka set tersangka_umur = year(current_date) - year(tersangka_tgl_lahir); 





ALTER TABLE `lap_a_saksi` ADD `saksi_umur` INT NULL AFTER `saksi_tgl_lahir`;


update lap_a_saksi set saksi_umur = year(current_date) - year(saksi_tgl_lahir); 






ALTER TABLE `lap_a_tersangka` ADD `tersangka_umur` INT NULL AFTER `tersangka_tgl_lahir`;

update lap_a_tersangka set tersangka_umur = year(current_date) - year(tersangka_tgl_lahir); 


-- update 23 nov 2017 


ALTER TABLE `lap_a` ADD `jenis` VARCHAR(20)  , ADD `id_polres` CHAR(32)  , ADD `id_polsek` CHAR(32)   ;


ALTER TABLE `lap_b` ADD `jenis` VARCHAR(20)  , ADD `id_polres` CHAR(32)  , ADD `id_polsek` CHAR(32)   ;


ALTER TABLE `lap_c` ADD `jenis` VARCHAR(20)  , ADD `id_polres` CHAR(32)  , ADD `id_polsek` CHAR(32)   ;


ALTER TABLE `lap_d` ADD `jenis` VARCHAR(20)  , ADD `id_polres` CHAR(32)  , ADD `id_polsek` CHAR(32)   ;


ALTER TABLE `lap_laka_lantas` ADD `jenis` VARCHAR(20)  , ADD `id_polres` CHAR(32)  , ADD `id_polsek` CHAR(32)   ;


 


update lap_a p 

set jenis = ( select jenis from pengguna where id = p.user_id ) , 
id_polres =  ( select id_polres from pengguna where id = p.user_id ) , 

id_polsek =  ( select id_polsek from pengguna where id = p.user_id ) ; 


update lap_b p 

set jenis = ( select jenis from pengguna where id = p.user_id ) , 
id_polres =  ( select id_polres from pengguna where id = p.user_id ) , 

id_polsek =  ( select id_polsek from pengguna where id = p.user_id ) ; 


update lap_c p 

set jenis = ( select jenis from pengguna where id = p.user_id ) , 
id_polres =  ( select id_polres from pengguna where id = p.user_id ) , 

id_polsek =  ( select id_polsek from pengguna where id = p.user_id ) ; 


update lap_d p 

set jenis = ( select jenis from pengguna where id = p.user_id ) , 
id_polres =  ( select id_polres from pengguna where id = p.user_id ) , 

id_polsek =  ( select id_polsek from pengguna where id = p.user_id ) ; 

update lap_laka_lantas p 

set jenis = ( select jenis from pengguna where id = p.user_id ) , 
id_polres =  ( select id_polres from pengguna where id = p.user_id ) , 

id_polsek =  ( select id_polsek from pengguna where id = p.user_id ) ; 



ALTER TABLE `lap_a` CHANGE `id_polres` `id_polres` CHAR(32); 
ALTER TABLE `lap_a` CHANGE `id_polsek` `id_polsek` CHAR(32); 

ALTER TABLE `lap_b` CHANGE `id_polres` `id_polres` CHAR(32); 
ALTER TABLE `lap_b` CHANGE `id_polsek` `id_polsek` CHAR(32); 

ALTER TABLE `lap_c` CHANGE `id_polres` `id_polres` CHAR(32); 
ALTER TABLE `lap_c` CHANGE `id_polsek` `id_polsek` CHAR(32); 


ALTER TABLE `lap_d` CHANGE `id_polres` `id_polres` CHAR(32); 
ALTER TABLE `lap_d` CHANGE `id_polsek` `id_polsek` CHAR(32); 


ALTER TABLE `lap_laka_lantas` CHANGE `id_polres` `id_polres` CHAR(32); 
ALTER TABLE `lap_laka_lantas` CHANGE `id_polsek` `id_polsek` CHAR(32); 



drop view v_lap_bb; 
create view v_lap_bb as 
select 
	`a`.`lap_b_id` AS `lap_b_id`, 
	`a`.`nomor` AS `nomor`, 
	`a`.`tanggal` AS `tanggal`, 
	`a`.`pelapor_nama` AS `pelapor_nama`, 
	group_concat(
		`tr`.`tersangka_nama` separator ','
	) AS `terlapor`, 
	`a`.`tindak_pidana` AS `tindak_pidana`, 
	group_concat(distinct `u`.`nama` separator ',') AS `penyidik_nama`, 
	`a`.`user_id` AS `user_id`, 
	`op`.`nama` AS `operator`, 
	`a`.`penyelesaian` AS `penyelesaian`, 
	`a`.`id_fungsi` AS `id_fungsi`, 
    a.jenis, 
    a.id_polres, 
    a.id_polsek
from 
	(
		(
			(
				(
					`lap_b` `a` 
					left join `lap_b_tersangka` `tr` on(
						(`a`.`lap_b_id` = `tr`.`lap_b_id`)
					)
				) 
				left join `lap_b_penyidik` `p` on(
					(`p`.`lap_b_id` = `a`.`lap_b_id`)
				)
			) 
			left join `pengguna` `u` on(
				(`u`.`id` = `p`.`id_penyidik`)
			)
		) 
		left join `pengguna` `op` on(
			(`op`.`id` = `a`.`user_id`)
		)
	) 
group by 
	`a`.`lap_b_id`; 


drop view v_lap_aa; 

create view v_lap_aa as 

select 
	`a`.`lap_a_id` AS `lap_a_id`, 
	`a`.`nomor` AS `nomor`, 
	`a`.`tanggal` AS `tanggal`, 
	`a`.`pelapor_nama` AS `pelapor_nama`, 
	group_concat(
		`tr`.`tersangka_nama` separator ','
	) AS `terlapor`, 
	`a`.`tindak_pidana` AS `tindak_pidana`, 
	group_concat(distinct `u`.`nama` separator ',') AS `penyidik_nama`, 
	`a`.`user_id` AS `user_id`, 
	`op`.`nama` AS `operator`, 
	`a`.`penyelesaian` AS `penyelesaian`, 
	`a`.`id_fungsi` AS `id_fungsi` , 
	a.jenis, 
    a.id_polres, 
    a.id_polsek
from 
	(
		(
			(
				(
					`lap_a` `a` 
					left join `lap_a_tersangka` `tr` on(
						(`a`.`lap_a_id` = `tr`.`lap_a_id`)
					)
				) 
				left join `lap_a_penyidik` `p` on(
					(`p`.`lap_a_id` = `a`.`lap_a_id`)
				)
			) 
			left join `pengguna` `u` on(
				(`u`.`id` = `p`.`id_penyidik`)
			)
		) 
		left join `pengguna` `op` on(
			(`op`.`id` = `a`.`user_id`)
		)
	) 
group by 
	`a`.`lap_a_id`; 


-- above applied 


-- update tanggal 27 NOV 2017 

ALTER TABLE `lap_b_korban` ADD `korban_umur` INT NULL AFTER `korban_tmp_lahir`;

ALTER TABLE `lap_a_korban` ADD `korban_umur` INT NULL AFTER `korban_tmp_lahir`;


-- update 28 NOV 2017

CREATE TABLE `ci_sessions` (
  `session_id` text,
  `user_agent` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `last_activity` int(20) DEFAULT NULL,
  `user_data` text
);




-- history 

data sempat hilang. 
belum tau penyebabanya. 

lalu saya restore dari database backup. 

database backup ada di test_laporjogjadb. database ini lengkap 

tapi ternyata ada selisih 101 record 


yang selisih 101 record ada di database zjogja. 


-- update terbaru migrasi 



update lap_a p 

set jenis = ( select jenis from pengguna where id = p.user_id ) , 
id_polres =  ( select id_polres from pengguna where id = p.user_id ) , 

id_polsek =  ( select id_polsek from pengguna where id = p.user_id ) ; 


update lap_b p 

set jenis = ( select jenis from pengguna where id = p.user_id ) , 
id_polres =  ( select id_polres from pengguna where id = p.user_id ) , 

id_polsek =  ( select id_polsek from pengguna where id = p.user_id ) ; 


update lap_c p 

set jenis = ( select jenis from pengguna where id = p.user_id ) , 
id_polres =  ( select id_polres from pengguna where id = p.user_id ) , 

id_polsek =  ( select id_polsek from pengguna where id = p.user_id ) ; 


update lap_d p 

set jenis = ( select jenis from pengguna where id = p.user_id ) , 
id_polres =  ( select id_polres from pengguna where id = p.user_id ) , 

id_polsek =  ( select id_polsek from pengguna where id = p.user_id ) ; 

update lap_laka_lantas p 

set jenis = ( select jenis from pengguna where id = p.user_id ) , 
id_polres =  ( select id_polres from pengguna where id = p.user_id ) , 

id_polsek =  ( select id_polsek from pengguna where id = p.user_id ) ; 





update lap_a_tersangka set temp_lap_a_id = lap_a_id where temp_lap_a_id is null ; 

update lap_a_saksi set temp_lap_a_id = lap_a_id where temp_lap_a_id is null ; 
update lap_a_korban set temp_lap_a_id = lap_a_id where temp_lap_a_id is null ; 



update lap_b_tersangka set temp_lap_b_id = lap_b_id where temp_lap_b_id is null ; 

update lap_b_saksi set temp_lap_b_id = lap_b_id where temp_lap_b_id is null ; 
update lap_b_korban set temp_lap_b_id = lap_b_id where temp_lap_b_id is null ; 





alter table lap_b 
add column ( 
kendaraan_nopol   varchar(100),
kendaraan_pemilik   varchar(100),
kendaraan_no_rangka   varchar(100),
kendaraan_no_mesin   varchar(100),
kendaraan_merk   varchar(100),
kendaraan_model   varchar(100),
kendaraan_warna   varchar(100) 
);



ALTER TABLE `lap_b` ADD `is_lantas` INT NULL AFTER `id_polsek`;

ALTER TABLE `lap_b` ADD `kendaraan_no_bpkb` VARCHAR(50) NULL AFTER `kendaraan_warna`;
ALTER TABLE `lap_b` ADD `kendaraan_pemilik_alamat` VARCHAR(200) NULL AFTER `kendaraan_pemilik`;
ALTER TABLE `lap_b` ADD `kendaraan_jenis` VARCHAR(20) NOT NULL AFTER `kendaraan_no_bpkb`;
ALTER TABLE `lap_b` ADD `kendaraan_tahun` INT NULL AFTER `kendaraan_jenis`;
ALTER TABLE `lap_b` ADD `kendaraan_jumlah_roda` INT NULL AFTER `kendaraan_tahun`;





alter table lap_a 
add column ( 
kendaraan_nopol   varchar(100),
kendaraan_pemilik   varchar(100),
kendaraan_no_rangka   varchar(100),
kendaraan_no_mesin   varchar(100),
kendaraan_merk   varchar(100),
kendaraan_model   varchar(100),
kendaraan_warna   varchar(100) 
);



ALTER TABLE `lap_a` ADD `is_lantas` INT NULL AFTER `id_polsek`;

ALTER TABLE `lap_a` ADD `kendaraan_no_bpkb` VARCHAR(50) NULL AFTER `kendaraan_warna`;
ALTER TABLE `lap_a` ADD `kendaraan_pemilik_alamat` VARCHAR(200) NULL AFTER `kendaraan_pemilik`;
ALTER TABLE `lap_a` ADD `kendaraan_jenis` VARCHAR(20) NOT NULL AFTER `kendaraan_no_bpkb`;
ALTER TABLE `lap_a` ADD `kendaraan_tahun` INT NULL AFTER `kendaraan_jenis`;
ALTER TABLE `lap_a` ADD `kendaraan_jumlah_roda` INT NULL AFTER `kendaraan_tahun`;

ALTER TABLE `lap_a` ADD `is_ranmor` INT NULL AFTER `id_polsek`;

ALTER TABLE `lap_b` ADD `is_ranmor` INT NULL AFTER `id_polsek`;


kendaraan_nopol, kendaraan_pemilik, kendaraan_no_rangka, kendaraan_no_mesin, kendaraan_merk, kendaraan_model, kendaraan_warna, kendaraan_no_bpkb, kendaraan_pemilik_alamat, kendaraan_jenis, kendaraan_tahun, kendaraan_jumlah_roda, 

drop view v_lap_aa; 
create view v_lap_aa as 
select  
	`a`.`lap_a_id` AS `lap_a_id`, 
	`a`.`nomor` AS `nomor`, 
	`a`.`tanggal` AS `tanggal`, 
	`a`.`pelapor_nama` AS `pelapor_nama`, 
	group_concat(
		`tr`.`tersangka_nama` separator ','
	) AS `terlapor`, 
	`a`.`tindak_pidana` AS `tindak_pidana`, 
	group_concat(distinct `u`.`nama` separator ',') AS `penyidik_nama`, 
	`a`.`user_id` AS `user_id`, 
	`op`.`nama` AS `operator`, 
	`a`.`penyelesaian` AS `penyelesaian`, 
	`a`.`id_fungsi` AS `id_fungsi`, 
	`a`.`jenis` AS `jenis`, 
	`a`.`id_polres` AS `id_polres`, 
	`a`.`id_polsek` AS `id_polsek`, 
	is_ranmor , kendaraan_nopol 
from 
	(
		(
			(
				(
					`laporjogjadb`.`lap_a` `a` 
					left join `laporjogjadb`.`lap_a_tersangka` `tr` on(
						(`a`.`lap_a_id` = `tr`.`lap_a_id`)
					)
				) 
				left join `laporjogjadb`.`lap_a_penyidik` `p` on(
					(`p`.`lap_a_id` = `a`.`lap_a_id`)
				)
			) 
			left join `laporjogjadb`.`pengguna` `u` on(
				(`u`.`id` = `p`.`id_penyidik`)
			)
		) 
		left join `laporjogjadb`.`pengguna` `op` on(
			(`op`.`id` = `a`.`user_id`)
		)
	) 
group by 
	`a`.`lap_a_id`; 



drop view v_lap_bb ; 
create view v_lap_bb as 
select 
	`a`.`lap_b_id` AS `lap_b_id`, 
	`a`.`nomor` AS `nomor`, 
	`a`.`tanggal` AS `tanggal`, 
	`a`.`pelapor_nama` AS `pelapor_nama`, 
	group_concat(
		`tr`.`tersangka_nama` separator ','
	) AS `terlapor`, 
	`a`.`tindak_pidana` AS `tindak_pidana`, 
	group_concat(distinct `u`.`nama` separator ',') AS `penyidik_nama`, 
	`a`.`user_id` AS `user_id`, 
	`op`.`nama` AS `operator`, 
	`a`.`penyelesaian` AS `penyelesaian`, 
	`a`.`id_fungsi` AS `id_fungsi`, 
	`a`.`jenis` AS `jenis`, 
	`a`.`id_polres` AS `id_polres`, 
	`a`.`id_polsek` AS `id_polsek` , 
    is_ranmor , kendaraan_nopol 
from 
	(
		(
			(
				(
					`laporjogjadb`.`lap_b` `a` 
					left join `laporjogjadb`.`lap_b_tersangka` `tr` on(
						(`a`.`lap_b_id` = `tr`.`lap_b_id`)
					)
				) 
				left join `laporjogjadb`.`lap_b_penyidik` `p` on(
					(`p`.`lap_b_id` = `a`.`lap_b_id`)
				)
			) 
			left join `laporjogjadb`.`pengguna` `u` on(
				(`u`.`id` = `p`.`id_penyidik`)
			)
		) 
		left join `laporjogjadb`.`pengguna` `op` on(
			(`op`.`id` = `a`.`user_id`)
		)
	) 
group by 
	`a`.`lap_b_id`; 
