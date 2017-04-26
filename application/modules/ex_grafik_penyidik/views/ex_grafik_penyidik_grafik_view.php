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
        series:  [

            <?php 
            foreach($arr as $a => $b) : 
                echo "{";
                echo "name: '".$b['nama']."',";
                    echo "data : [";
                        foreach($b['data'] as $angka ) : 
                            echo $angka.",";
                        endforeach;
                    echo "]";
                echo "},";
                
            endforeach;

            ?>
            ]
           
        
         
    });
    
});
</script>
<div id="view"></div>

<div class="row">
  <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <tr>
              <th  align="center">NO. </th>
              <th  align="center">NAMA </th>
              <th  align="center" width="10%" style="text-align: center;">P21 </th>
              <th  align="center" width="10%" style="text-align: center;">PENYELIDIKAN</th>
              <th  align="center" width="10%" style="text-align: center;">PENYIDIKAN  </th>
              <th  align="center" width="10%" style="text-align: center;">TOTAL </th>
            </tr>

            <?php 
                $n=0;
                foreach($rec_penyidik->result() as $row) : 
                $n++;

            ?>
            <tr>
              <td ><?php echo $n; ?> </td>
              <td ><?php echo $row->nama; ?> </td>
              <td align="center"><?php echo $row->p21; ?> </td>
              <td align="center"><?php echo $row->sidik; ?> </td>
              <td align="center"><?php echo $row->lidik; ?> </td>
              <td align="center"><?php echo $row->total; ?>  </td>
            </tr>

            <?php  endforeach; ?>

        </table>

  </div>

</div>