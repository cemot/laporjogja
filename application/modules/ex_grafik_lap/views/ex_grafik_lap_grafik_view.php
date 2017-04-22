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
    series: [
        {
            name: 'Jumlah ',
            data: [
        
                <?php 
                    foreach($query as $x => $val) : 
                        echo "$val".",";
                    endforeach;
                ?>
        
        
            ]

        }

        




        ]

    });
        
});  


</script>
<div id="view"></div>