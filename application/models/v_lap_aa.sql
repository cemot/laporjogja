select `a`.`lap_a_id` AS `lap_a_id`,`a`.`nomor` AS `nomor`,`a`.`tanggal` AS `tanggal`,
`a`.`pelapor_nama` AS `pelapor_nama`,group_concat(`tr`.`tersangka_nama` separator ',') AS `terlapor`,
`a`.`tindak_pidana` AS `tindak_pidana`,group_concat(`u`.`nama` separator ',') AS `penyidik_nama`,`a`.`user_id` AS `user_id` 
, op.nama as operator 
from (((`laporjogjadb`.`lap_a` `a` left join `laporjogjadb`.`lap_a_tersangka` `tr` 
	on((`a`.`lap_a_id` = `tr`.`lap_a_id`))) 
left join `laporjogjadb`.`lap_a_penyidik` `p` 
on((`p`.`lap_a_id` = `a`.`lap_a_id`))) 
left join `laporjogjadb`.`pengguna` `u` on((`u`.`id` = `p`.`id_penyidik`))) 
left join pengguna op on op.id = a.user_id
group by `a`.`lap_a_id`