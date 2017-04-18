<script src="<?php echo base_url('assets/highcharts/highcharts.js'); ?>"></script>
<script>
$(function () {
		
    $('#view').highcharts({
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
            valueSuffix: ' Orang'
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
                    foreach($query as $index =>$vl):
                                    echo $vl.', ';
                    endforeach;
                ?>
				]
        }]
    });
		
});
</script>
<div id="view"></div>