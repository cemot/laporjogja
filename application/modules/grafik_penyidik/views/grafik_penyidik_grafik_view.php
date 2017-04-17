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
            valueSuffix: ' Kasus',
            crosshairs: [true, true]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
        <?php 
        $nilai = 0;
        foreach ($penyidik as $row) {
          $nilai= $nilai+1;
          ?>
           { name: '<?php echo $row['nama'] ?>',
            data: [<?php echo $row['Januari'].', '.$row['Februari'].', '.$row['Maret'].', '.$row['April'].', '.$row['Mei'].', '.$row['Juni'].', '.$row['Juli'].', '.$row['Agustus'].', '.$row['September'].', '.$row['Oktober'].', '.$row['November'].', '.$row['Desember']; ?>]
          },
        <?php }  ?>
        ]
    });
    
});
</script>
<div id="view"></div>