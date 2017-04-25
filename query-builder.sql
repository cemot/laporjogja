select *from (
select u.id,u.nama , 
sum(if(penyelesaian='p21',1,0)) as p21, 
sum(if(penyelesaian='lidik',1,0)) as lidik, 
sum(if(penyelesaian='sidik',1,0)) as sidik, 
count(x.id_penyidik) as total  
from  pengguna u 

left join ( 
 
select 
	'a' as tb, 
	a.lap_a_id, 
	kp_tanggal as tanggal, 
	id_gol_kejahatan, 
	user_id, 
	penyelesaian ,
    p.id_penyidik 
from 
	lap_a a 
    join lap_a_penyidik p on p.lap_a_id 
    
    
union 
select 
	'b' as tb, 
	a.lap_b_id, 
	kejadian_tanggal as tanggal, 
	id_gol_kejahatan, 
	user_id, 
	penyelesaian , 
    p.id_penyidik 
from 
	lap_b a 




    join lap_b_penyidik p on p.lap_b_id ) x 
    
on x.id_penyidik = u.id

group by u.id ) y 

order by y.p21 desc


