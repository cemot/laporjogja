
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

            <?php 
                foreach($data->result() as $row) : 
                    echo "'$row->nama',";
                endforeach;
            ?>
            
            // 'Januari',
            // 'Februari',
            // 'Maret',
            // 'April',
            // 'Mei',
            // 'Juni',
            // 'Juli',
            // 'Agustus',
            // 'September',
            // 'Oktober',
            // 'November',
            // 'Desember'
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

            <?php 
                foreach($arr  as $a=>$b) : 
                    echo "{";

                        echo "name : '$a', ";
                        echo "data : [";
                            foreach($b as $y) : 
                                echo "$y,";
                            endforeach;
                        echo "]";

                    echo "},";
                endforeach;
            ?>


        // {
        //     name: 'BULAN',
        //     data: [
        
        //         <?php 
        //              echo "$data->jan, $data->feb, $data->mar, $data->apr, 
        //              $data->mei, $data->jun, $data->jul, $data->agu, 
        //              $data->sep, $data->okt, $data->nov, $data->des, ";
        //         ?>
        
        
        //     ]

        // }

        




        ]

    });
      
});  


</script>
<div id="view"></div>