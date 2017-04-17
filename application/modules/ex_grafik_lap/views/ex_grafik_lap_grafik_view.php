<script src="<?php echo base_url('assets/highcharts/highcharts.js'); ?>"></script>
<script>
$(function () {

  $('#view').highcharts({
        
chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo $title; ?> '
    },
    subtitle: {
        text: '<?php echo $title.' Tahun : '.$tahun; ?>'
    },
    xAxis: {
        categories: [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah kasus'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} Kasus</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Jumlah ',
        data: [
        
       // 49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4
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