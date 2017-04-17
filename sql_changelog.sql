drop view v_lap_bb; 
create veiw v_lap_bb as 
select 
	`a`.`lap_b_id` AS `lap_b_id`, 
	`a`.`nomor` AS `nomor`, 
	`a`.`tanggal` AS `tanggal`, 
	`a`.`pelapor_nama` AS `pelapor_nama`, 
	group_concat(
		`tr`.`tersangka_nama` separator ','
	) AS `terlapor`, 
	`a`.`tindak_pidana` AS `tindak_pidana`, 
	group_concat(`u`.`nama` separator ',') AS `penyidik_nama`, 
	`a`.`user_id` AS `user_id` , 
	op.nama as operator
from 
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
left join pengguna op on op.id = a.user_id 
group by 
	`a`.`lap_b_id`; 


drop view v_lap_aa; 
create view v_lap_aa as 

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
group by `a`.`lap_a_id`; 


ALTER TABLE `lap_a_korban` CHANGE `korban_id_desa` `korban_id_desa` CHAR(13)  NULL;
ALTER TABLE `lap_a_korban` ADD `jenis_korban` CHAR(10) NULL ;


ALTER TABLE `lap_b_korban` CHANGE `korban_id_desa` `korban_id_desa` CHAR(13) NULL; 
ALTER TABLE `lap_b_korban` ADD `jenis_korban` CHAR(10) NULL ; 


update m_polsek set nama_polsek = concat('SEKTOR ',nama_polsek);

update m_polres set nama_polres = replace(nama_polres,'RESORT','RESOR ') ; 

ALTER TABLE `m_polres` ADD `alamat` VARCHAR(200) NULL ;
ALTER TABLE `m_polsek` ADD `alamat` VARCHAR(200) NULL ;

ALTER TABLE `m_setting_polda` ADD `alamat` VARCHAR(200) NULL ; 


update lap_a set kp_wktu=concat(second(kp_wktu),':00',':00') WHERE HOUR( kp_wktu ) = '0' AND MINUTE( kp_wktu ) = '0' ;

update lap_b set kejadian_jam=concat(second(kejadian_jam),':00',':00') WHERE HOUR( kejadian_jam ) = '0' AND MINUTE( kejadian_jam ) = '0' ; 



	drop view v_pencarian ; 
create view v_pencarian as 
select 
	kp_wktu as waktu, 
	'lap_a' AS `laporan`, 
	`a`.`lap_a_id` AS `id`, 
	`a`.`tanggal` AS `tanggal`, 
	`a`.`nomor` AS `nomor`, 
	`a`.`id_fungsi` AS `id_fungsi`, 
	`f`.`fungsi` AS `fungsi`, 
	`a`.`pelapor_nama` AS `pelapor_nama`, 
	NULL AS `pelapor_alamat`, 
	NULL AS `pelapor_id_desa`, 
	NULL AS `pelapor_desa`, 
	NULL AS `palapor_id_kec`, 
	NULL AS `palapor_kecamatan`, 
	NULL AS `palapor_id_kota`, 
	NULL AS `palapor_kota`, 
	NULL AS `palapor_id_prop`, 
	NULL AS `palapor_provinsi`, 
	`p`.`pasal` AS `pasal`, 
	`p`.`id` AS `id_pasal`, 
	`a`.`id_gol_kejahatan` AS `id_gol_kejahatan`, 
	`g`.`golongan_kejahatan` AS `golongan_kejahatan`, 
	`a`.`kp_tempat_kejadian` AS `kp_tempat_kejadian`, 
	`a`.`kp_tempat_id_desa` AS `kp_tempat_id_desa`, 
	`desa`.`desa` AS `kejadian_desa`, 
	`kec`.`id` AS `kejadian_id_kec`, 
	`kec`.`kecamatan` AS `kejadian_kecamatan`, 
	`kota`.`id` AS `kejadian_id_kota`, 
	`kota`.`kota` AS `kejadian_kota`, 
	`prop`.`id` AS `kejadian_id_prop`, 
	`prop`.`provinsi` AS `kejadian_provinsi`, 
	`a`.`tindak_pidana` AS `tindak_pidana`, 
	`a`.`id_jenis_lokasi` AS `id_jenis_lokasi`, 
	`jl`.`jenis_lokasi` AS `jenis_lokasi`, 
	`a`.`kp_id_motif_kejahatan` AS `kp_id_motif_kejahatan`, 
	`m`.`motif` AS `motif`, 
	`a`.`kp_tanggal` AS `kp_tanggal`, 
	month(`a`.`kp_tanggal`) AS `bulan_kejadian`, 
	year(`a`.`kp_tanggal`) AS `tahun_kejadian`, 
	`t`.`tersangka_nama` AS `tersangka_nama`, 
	`s`.`saksi_nama` AS `saksi_nama`, 
	`k`.`korban_nama` AS `korban_nama`, 
	`b`.`barbuk_nama` AS `barbuk_nama`, 
	NULL AS `merk`, 
	NULL AS `no_polisi`, 
	NULL AS `pengemudi_nama` 
from 
	(
		(
			(
				(
					(
						(
							(
								(
									(
										(
											(
												(
													(
														(
															`laporjogjadb`.`lap_a` `a` 
															left join `laporjogjadb`.`lap_a_pasal` `lp` on(
																(`a`.`lap_a_id` = `lp`.`lap_a_id`)
															)
														) 
														left join `laporjogjadb`.`m_pasal` `p` on(
															(`p`.`id` = `lp`.`id_pasal`)
														)
													) 
													left join `laporjogjadb`.`m_golongan_kejahatan` `g` on(
														(
															`g`.`id` = `a`.`id_gol_kejahatan`
														)
													)
												) 
												left join `laporjogjadb`.`m_motif` `m` on(
													(
														`m`.`id_motif` = `a`.`kp_id_motif_kejahatan`
													)
												)
											) 
											left join `laporjogjadb`.`tiger_desa` `desa` on(
												(
													`desa`.`id` = `a`.`kp_tempat_id_desa`
												)
											)
										) 
										left join `laporjogjadb`.`tiger_kecamatan` `kec` on(
											(
												`desa`.`id_kecamatan` = `kec`.`id`
											)
										)
									) 
									left join `laporjogjadb`.`tiger_kota` `kota` on(
										(`kota`.`id` = `kec`.`id_kota`)
									)
								) 
								left join `laporjogjadb`.`tiger_provinsi` `prop` on(
									(
										`prop`.`id` = `kota`.`id_provinsi`
									)
								)
							) 
							left join `laporjogjadb`.`lap_a_tersangka` `t` on(
								(`t`.`lap_a_id` = `a`.`lap_a_id`)
							)
						) 
						left join `laporjogjadb`.`lap_a_saksi` `s` on(
							(`s`.`lap_a_id` = `a`.`lap_a_id`)
						)
					) 
					left join `laporjogjadb`.`lap_a_korban` `k` on(
						(`k`.`lap_a_id` = `a`.`lap_a_id`)
					)
				) 
				left join `laporjogjadb`.`lap_a_barbuk` `b` on(
					(`b`.`lap_a_id` = `a`.`lap_a_id`)
				)
			) 
			left join `laporjogjadb`.`m_fungsi` `f` on(
				(
					`f`.`id_fungsi` = `a`.`id_fungsi`
				)
			)
		) 
		left join `laporjogjadb`.`m_jenis_lokasi` `jl` on(
			(
				`jl`.`id_jenis_lokasi` = `a`.`id_jenis_lokasi`
			)
		)
	) 
union 
select 
	kejadian_jam as waktu, 
	'lap_b' AS `laporan`, 
	`a`.`lap_b_id` AS `id`, 
	`a`.`tanggal` AS `tanggal`, 
	`a`.`nomor` AS `nomor`, 
	`a`.`id_fungsi` AS `id_fungsi`, 
	`f`.`fungsi` AS `fungsi`, 
	`a`.`pelapor_nama` AS `pelapor_nama`, 
	`a`.`pelapor_alamat` AS `pelapor_alamat`, 
	`a`.`pelapor_id_desa` AS `pelapor_id_desa`, 
	`pelapor_desa`.`desa` AS `pelapor_desa`, 
	`pelapor_kec`.`id` AS `pelapor_id_kec`, 
	`pelapor_kec`.`kecamatan` AS `pelapor_kecamatan`, 
	`pelapor_kota`.`id` AS `pelapor_id_kota`, 
	`pelapor_kota`.`kota` AS `pelapor_kota`, 
	`pelapor_prop`.`id` AS `pelapor_id_prop`, 
	`pelapor_prop`.`provinsi` AS `pelapor_provinsi`, 
	`p`.`pasal` AS `pasal`, 
	`p`.`id` AS `id_pasal`, 
	`a`.`id_gol_kejahatan` AS `id_gol_kejahatan`, 
	`g`.`golongan_kejahatan` AS `golongan_kejahatan`, 
	`a`.`kejadian_tempat` AS `kejadian_tempat`, 
	`a`.`kejadian_id_desa` AS `kejadian_id_desa`, 
	`desa`.`desa` AS `kejadian_desa`, 
	`kec`.`id` AS `kejadian_id_kec`, 
	`kec`.`kecamatan` AS `kejadian_kecamatan`, 
	`kota`.`id` AS `kejadian_id_kota`, 
	`kota`.`kota` AS `kejadian_kota`, 
	`prop`.`id` AS `kejadian_id_prop`, 
	`prop`.`provinsi` AS `kejadian_provinsi`, 
	`a`.`tindak_pidana` AS `tindak_pidana`, 
	`a`.`id_jenis_lokasi` AS `id_jenis_lokasi`, 
	`jl`.`jenis_lokasi` AS `jenis_lokasi`, 
	`a`.`kejadian_id_motif_kejahatan` AS `kejadian_id_motif_kejahatan`, 
	`m`.`motif` AS `motif`, 
	`a`.`kejadian_tanggal` AS `kejadian_tanggal`, 
	month(`a`.`kejadian_tanggal`) AS `bulan_kejadian`, 
	year(`a`.`kejadian_tanggal`) AS `tahun_kejadian`, 
	`t`.`tersangka_nama` AS `tersangka_nama`, 
	`s`.`saksi_nama` AS `saksi_nama`, 
	`k`.`korban_nama` AS `korban_nama`, 
	`b`.`barbuk_nama` AS `barbuk_nama`, 
	NULL AS `merk`, 
	NULL AS `no_polisi`, 
	NULL AS `pengemudi_nama` 
from 
	(
		(
			(
				(
					(
						(
							(
								(
									(
										(
											(
												(
													(
														(
															(
																(
																	(
																		(
																			`laporjogjadb`.`lap_b` `a` 
																			left join `laporjogjadb`.`lap_b_pasal` `lp` on(
																				(`a`.`lap_b_id` = `lp`.`lap_b_id`)
																			)
																		) 
																		left join `laporjogjadb`.`m_pasal` `p` on(
																			(`p`.`id` = `lp`.`id_pasal`)
																		)
																	) 
																	left join `laporjogjadb`.`m_golongan_kejahatan` `g` on(
																		(
																			`g`.`id` = `a`.`id_gol_kejahatan`
																		)
																	)
																) 
																left join `laporjogjadb`.`m_motif` `m` on(
																	(
																		`m`.`id_motif` = `a`.`kejadian_id_motif_kejahatan`
																	)
																)
															) 
															left join `laporjogjadb`.`tiger_desa` `desa` on(
																(
																	`desa`.`id` = `a`.`kejadian_id_desa`
																)
															)
														) 
														left join `laporjogjadb`.`tiger_kecamatan` `kec` on(
															(
																`desa`.`id_kecamatan` = `kec`.`id`
															)
														)
													) 
													left join `laporjogjadb`.`tiger_kota` `kota` on(
														(`kota`.`id` = `kec`.`id_kota`)
													)
												) 
												left join `laporjogjadb`.`tiger_provinsi` `prop` on(
													(
														`prop`.`id` = `kota`.`id_provinsi`
													)
												)
											) 
											left join `laporjogjadb`.`tiger_desa` `pelapor_desa` on(
												(
													`pelapor_desa`.`id` = `a`.`pelapor_id_desa`
												)
											)
										) 
										left join `laporjogjadb`.`tiger_kecamatan` `pelapor_kec` on(
											(
												`pelapor_desa`.`id_kecamatan` = `pelapor_kec`.`id`
											)
										)
									) 
									left join `laporjogjadb`.`tiger_kota` `pelapor_kota` on(
										(
											`pelapor_kota`.`id` = `pelapor_kec`.`id_kota`
										)
									)
								) 
								left join `laporjogjadb`.`tiger_provinsi` `pelapor_prop` on(
									(
										`pelapor_prop`.`id` = `pelapor_kota`.`id_provinsi`
									)
								)
							) 
							left join `laporjogjadb`.`lap_b_tersangka` `t` on(
								(`t`.`lap_b_id` = `a`.`lap_b_id`)
							)
						) 
						left join `laporjogjadb`.`lap_b_saksi` `s` on(
							(`s`.`lap_b_id` = `a`.`lap_b_id`)
						)
					) 
					left join `laporjogjadb`.`lap_b_korban` `k` on(
						(`k`.`lap_b_id` = `a`.`lap_b_id`)
					)
				) 
				left join `laporjogjadb`.`lap_b_barbuk` `b` on(
					(`b`.`lap_b_id` = `a`.`lap_b_id`)
				)
			) 
			left join `laporjogjadb`.`m_fungsi` `f` on(
				(
					`f`.`id_fungsi` = `a`.`id_fungsi`
				)
			)
		) 
		left join `laporjogjadb`.`m_jenis_lokasi` `jl` on(
			(
				`jl`.`id_jenis_lokasi` = `a`.`id_jenis_lokasi`
			)
		)
	) 
union 
select 
 	kejadian_jam as waktu, 
	'lap_c' AS `laporan`, 
	`a`.`lap_c_id` AS `id`, 
	`a`.`tanggal` AS `tanggal`, 
	`a`.`nomor` AS `nomor`, 
	NULL AS `id_fungsi`, 
	NULL AS `fungsi`, 
	`a`.`pelapor_nama` AS `pelapor_nama`, 
	`a`.`pelapor_alamat` AS `pelapor_alamat`, 
	`a`.`pelapor_id_desa` AS `pelapor_id_desa`, 
	`pelapor_desa`.`desa` AS `pelapor_desa`, 
	`pelapor_kec`.`id` AS `pelapor_id_kec`, 
	`pelapor_kec`.`kecamatan` AS `pelapor_kecamatan`, 
	`pelapor_kota`.`id` AS `pelapor_id_kota`, 
	`pelapor_kota`.`kota` AS `pelapor_kota`, 
	`pelapor_prop`.`id` AS `pelapor_id_prop`, 
	`pelapor_prop`.`provinsi` AS `pelapor_provinsi`, 
	NULL AS `pasal`, 
	NULL AS `id_pasal`, 
	NULL AS `id_gol_kejahatan`, 
	NULL AS `golongan_kejahatan`, 
	`a`.`kejadian_tempat` AS `kejadian_tempat`, 
	`a`.`kejadian_id_desa` AS `kejadian_id_desa`, 
	`desa`.`desa` AS `kejadian_desa`, 
	`kec`.`id` AS `kejadian_id_kec`, 
	`kec`.`kecamatan` AS `kejadian_kecamatan`, 
	`kota`.`id` AS `kejadian_id_kota`, 
	`kota`.`kota` AS `kejadian_kota`, 
	`prop`.`id` AS `kejadian_id_prop`, 
	`prop`.`provinsi` AS `kejadian_provinsi`, 
	NULL AS `tindak_pidana`, 
	NULL AS `id_jenis_lokasi`, 
	NULL AS `jenis_lokasi`, 
	NULL AS `kejadian_id_motif_kejahatan`, 
	NULL AS `motif`, 
	`a`.`kejadian_tanggal` AS `kejadian_tanggal`, 
	month(`a`.`kejadian_tanggal`) AS `bulan_kejadian`, 
	year(`a`.`kejadian_tanggal`) AS `tahun_kejadian`, 
	NULL AS `tersangka_nama`, 
	NULL AS `saksi_nama`, 
	NULL AS `korban_nama`, 
	NULL AS `barbuk_nama`, 
	NULL AS `merk`, 
	NULL AS `no_polisi`, 
	NULL AS `pengemudi_nama` 
from 
	(
		(
			(

				(
					(
						(
							(
								(
									`laporjogjadb`.`lap_c` `a` 
									left join `laporjogjadb`.`tiger_desa` `desa` on(
										(
											`desa`.`id` = `a`.`kejadian_id_desa`
										)
									)
								) 
								left join `laporjogjadb`.`tiger_kecamatan` `kec` on(
									(
										`desa`.`id_kecamatan` = `kec`.`id`
									)
								)
							) 
							left join `laporjogjadb`.`tiger_kota` `kota` on(
								(`kota`.`id` = `kec`.`id_kota`)
							)
						) 
						left join `laporjogjadb`.`tiger_provinsi` `prop` on(
							(
								`prop`.`id` = `kota`.`id_provinsi`
							)
						)
					) 
					left join `laporjogjadb`.`tiger_desa` `pelapor_desa` on(
						(
							`pelapor_desa`.`id` = `a`.`pelapor_id_desa`
						)
					)
				) 
				left join `laporjogjadb`.`tiger_kecamatan` `pelapor_kec` on(
					(
						`pelapor_desa`.`id_kecamatan` = `pelapor_kec`.`id`
					)
				)
			) 
			left join `laporjogjadb`.`tiger_kota` `pelapor_kota` on(
				(
					`pelapor_kota`.`id` = `pelapor_kec`.`id_kota`
				)
			)
		) 
		left join `laporjogjadb`.`tiger_provinsi` `pelapor_prop` on(
			(
				`pelapor_prop`.`id` = `pelapor_kota`.`id_provinsi`
			)
		)
	) 
union 
select 
	null as waktu, 
	'lap_d' AS `laporan`, 
	`a`.`lap_d_id` AS `id`, 
	`a`.`tanggal` AS `tanggal`, 
	`a`.`nomor` AS `nomor`, 
	NULL AS `id_fungsi`, 
	NULL AS `fungsi`, 
	NULL AS `pelapor_nama`, 
	NULL AS `pelapor_alamat`, 
	NULL AS `pelapor_id_desa`, 
	NULL AS `pelapor_desa`, 
	NULL AS `palapor_id_kec`, 
	NULL AS `palapor_kecamatan`, 
	NULL AS `palapor_id_kota`, 
	NULL AS `palapor_kota`, 
	NULL AS `palapor_id_prop`, 
	NULL AS `palapor_provinsi`, 
	NULL AS `pasal`, 
	NULL AS `id_pasal`, 
	NULL AS `id_gol_kejahatan`, 
	NULL AS `golongan_kejahatan`, 
	`a`.`kejadian_tempat` AS `kejadian_tempat`, 
	`a`.`kejadian_id_desa` AS `kejadian_id_desa`, 
	`desa`.`desa` AS `kejadian_desa`, 
	`kec`.`id` AS `kejadian_id_kec`, 
	`kec`.`kecamatan` AS `kejadian_kecamatan`, 
	`kota`.`id` AS `kejadian_id_kota`, 
	`kota`.`kota` AS `kejadian_kota`, 
	`prop`.`id` AS `kejadian_id_prop`, 
	`prop`.`provinsi` AS `kejadian_provinsi`, 
	`a`.`kejadian_apa` AS `tindak_pidana`, 
	NULL AS `id_jenis_lokasi`, 
	NULL AS `jenis_lokasi`, 
	NULL AS `kejadian_id_motif_kejahatan`, 
	NULL AS `motif`, 
	`a`.`kejadian_tanggal` AS `kejadian_tanggal`, 
	month(`a`.`kejadian_tanggal`) AS `bulan_kejadian`, 
	year(`a`.`kejadian_tanggal`) AS `tahun_kejadian`, 
	NULL AS `tersangka_nama`, 
	NULL AS `saksi_nama`, 
	NULL AS `korban_nama`, 
	NULL AS `barbuk_nama`, 
	NULL AS `merk`, 
	NULL AS `no_polisi`, 
	NULL AS `pengemudi_nama` 
from 
	(
		(
			(
				(
					`laporjogjadb`.`lap_d` `a` 
					left join `laporjogjadb`.`tiger_desa` `desa` on(
						(
							`desa`.`id` = `a`.`kejadian_id_desa`
						)
					)
				) 
				left join `laporjogjadb`.`tiger_kecamatan` `kec` on(
					(
						`desa`.`id_kecamatan` = `kec`.`id`
					)
				)
			) 
			left join `laporjogjadb`.`tiger_kota` `kota` on(
				(`kota`.`id` = `kec`.`id_kota`)
			)
		) 
		left join `laporjogjadb`.`tiger_provinsi` `prop` on(
			(
				`prop`.`id` = `kota`.`id_provinsi`
			)
		)
	) 
union 
select 
	kp_waktu as waktu, 
	'lap_laka_latas' AS `laporan`, 
	`a`.`lap_laka_lantas_id` AS `id`, 
	`a`.`tanggal` AS `tanggal`, 
	`a`.`nomor` AS `nomor`, 
	NULL AS `id_fungsi`, 
	NULL AS `fungsi`, 
	`a`.`pelapor_nama` AS `pelapor_nama`, 
	NULL AS `pelapor_alamat`, 
	NULL AS `pelapor_id_desa`, 
	NULL AS `pelapor_desa`, 
	NULL AS `palapor_id_kec`, 
	NULL AS `palapor_kecamatan`, 
	NULL AS `palapor_id_kota`, 
	NULL AS `palapor_kota`, 
	NULL AS `palapor_id_prop`, 
	NULL AS `palapor_provinsi`, 
	NULL AS `pasal`, 
	NULL AS `id_pasal`, 
	NULL AS `id_gol_kejahatan`, 
	NULL AS `golongan_kejahatan`, 
	`a`.`kp_tempat_kejadian` AS `kp_tempat_kejadian`, 
	`a`.`kp_id_desa` AS `kp_id_desa`, 
	`desa`.`desa` AS `kejadian_desa`, 
	`kec`.`id` AS `kejadian_id_kec`, 
	`kec`.`kecamatan` AS `kejadian_kecamatan`, 
	`kota`.`id` AS `kejadian_id_kota`, 
	`kota`.`kota` AS `kejadian_kota`, 
	`prop`.`id` AS `kejadian_id_prop`, 
	`prop`.`provinsi` AS `kejadian_provinsi`, 
	`a`.`kp_apa_yang_terjadi` AS `kp_apa_yang_terjadi`, 
	NULL AS `id_jenis_lokasi`, 
	NULL AS `jenis_lokasi`, 
	NULL AS `kejadian_id_motif_kejahatan`, 
	NULL AS `motif`, 
	`a`.`kp_tanggal` AS `kp_tanggal`, 
	month(`a`.`kp_tanggal`) AS `bulan_kejadian`, 
	year(`a`.`kp_tanggal`) AS `tahun_kejadian`, 
	NULL AS `tersangka`, 
	`s`.`saksi_nama` AS `saksi_nama`, 
	`k`.`korban_nama` AS `korban_nama`, 
	NULL AS `barbuk_nama`, 
	`ken`.`merk` AS `merk`, 
	`ken`.`no_polisi` AS `no_polisi`, 
	`p`.`pengemudi_nama` AS `pengemudi_nama` 
from 
	(
		(
			(
				(
					(
						(
							(
								(
									`laporjogjadb`.`lap_laka_lantas` `a` 
									left join `laporjogjadb`.`tiger_desa` `desa` on(
										(`desa`.`id` = `a`.`kp_id_desa`)
									)
								) 
								left join `laporjogjadb`.`tiger_kecamatan` `kec` on(
									(
										`desa`.`id_kecamatan` = `kec`.`id`
									)
								)
							) 
							left join `laporjogjadb`.`tiger_kota` `kota` on(
								(`kota`.`id` = `kec`.`id_kota`)
							)
						) 
						left join `laporjogjadb`.`tiger_provinsi` `prop` on(
							(
								`prop`.`id` = `kota`.`id_provinsi`
							)
						)
					) 
					left join `laporjogjadb`.`lap_laka_saksi` `s` on(
						(
							`s`.`lap_laka_lantas_id` = `a`.`lap_laka_lantas_id`
						)
					)
				) 
				left join `laporjogjadb`.`lap_laka_korban` `k` on(
					(
						`k`.`lap_laka_lantas_id` = `a`.`lap_laka_lantas_id`
					)
				)
			) 
			left join `laporjogjadb`.`lap_laka_kendaraan` `ken` on(
				(
					`ken`.`lap_laka_lantas_id` = `a`.`lap_laka_lantas_id`
				)
			)
		) 
		left join `laporjogjadb`.`lap_laka_pengemudi` `p` on(
			(
				`p`.`lap_laka_lantas_id` = `a`.`lap_laka_lantas_id`
			)
		)
	);




