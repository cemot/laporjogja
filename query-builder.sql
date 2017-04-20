select 
				sum(minggu) as minggu, 
				sum(senin) as senin, 
				sum(selasa) as selasa, 
				sum(rabu) as rabu, 
				sum(kamis) as kamis, 
				sum(jumat) as jumat, 
				sum(sabtu) as sabtu
				from 
				(
				select kp_tanggal,  
				if(date_format(kp_tanggal,'%w') = 0,1,0) minggu,   
				if(date_format(kp_tanggal,'%w') = 1,1,0) senin,   
				if(date_format(kp_tanggal,'%w') = 2,1,0) selasa,   
				if(date_format(kp_tanggal,'%w') = 3,1,0) rabu,   
				if(date_format(kp_tanggal,'%w') = 4,1,0) kamis,   
				if(date_format(kp_tanggal,'%w') = 5,1,0) jumat,   
				if(date_format(kp_tanggal,'%w') = 6,1,0) sabtu   
				from ($sql) y
				
				group by laporan, id ) as x 