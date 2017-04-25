select 
	mk.id_kelompok, 
	mk.kelompok, 
	-- count(x.id_gol_kejahatan) as jumlah 
	sum(if(month(x.tanggal)=1,1,0)) jan,
	sum(if(month(x.tanggal)=2,1,0)) feb,
	sum(if(month(x.tanggal)=3,1,0)) mar,
	sum(if(month(x.tanggal)=4,1,0)) apr,
	sum(if(month(x.tanggal)=5,1,0)) mei,
	sum(if(month(x.tanggal)=6,1,0)) jun,
	sum(if(month(x.tanggal)=7,1,0)) jul,
	sum(if(month(x.tanggal)=8,1,0)) agu,
	sum(if(month(x.tanggal)=9,1,0)) sep,
	sum(if(month(x.tanggal)=10,1,0)) okt,
	sum(if(month(x.tanggal)=11,1,0)) nov,
	sum(if(month(x.tanggal)=12,1,0)) des

from 
	m_kelompok_kejahatan mk 
	left join m_golongan_kejahatan a on mk.id_kelompok = a.id_kelompok 
	join (
		select 
			'a' as tb, 
			lap_a_id, 
			kp_tanggal as tanggal, 
			id_gol_kejahatan, 
			user_id 
		from 
			lap_a 
		union 
		select 
			'b' as tb, 
			lap_b_id, 
			kejadian_tanggal as tanggal, 
			id_gol_kejahatan, 
			user_id 
		from 
			lap_b
	) x on a.id = x.id_gol_kejahatan 
	join pengguna u on u.id = x.user_id 

-- where 
 
-- 	year(tanggal) = '2017' 
 group by mk.id_kelompok 
-- order by 
-- 	count(x.id_gol_kejahatan) desc