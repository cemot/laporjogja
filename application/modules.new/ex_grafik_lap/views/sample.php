 /* $('#view').highcharts({
        title: {
            text: '<?php echo $title; ?>',
            x: -20 //center
        },
		subtitle: {
            text: 'Tahun :<?php echo $tahun; ?>',
            x: -20
        },
        xAxis: {
            categories: [
					
					'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
				
			]
        },
        yAxis: {
            title: {
                text: '<?php echo $title.' Tahun : '.$tahun; ?>'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#f1c40f'
            }]
        },
        tooltip: {
            valueSuffix: ' Kejadian'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Jumlah',
            data: [
				<?php
					
					if($query == null ) {
                       // echo "null";
						for($x=1; $x<=count($query); $x++){
							echo '0, ';
						}
					} else {
						$data = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

						// for($x=0; $x<count($data); $x++) {
							
						// 	echo $query->$data[$x].', ';
						// }
                        foreach($query as $index =>$vl):
                            echo $vl.', ';
                        endforeach;
					}
					
				?>
				]
        }]
    });
		
}); */