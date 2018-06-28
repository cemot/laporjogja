<div class="row">
    <div class="col-md-12">

        <table class="table">
            <TR>
                <TH width="3%">NO. </TH>
                <TH width="10%">NO.POLISI </TH>
                <TH width="10%">NO. RANGKA <br /> NO. BPKB  </TH>
                
                <TH width="10%">NAMA PEMILIK </TH>
                <TH width="20%">ALAMAT PEMILIK </TH>
                <TH width="5%">TAHUN </TH>
                <TH width="10%">MODEL </TH>
                <TH width="10%">WARNA </TH>
                <TH width="10%">MERK </TH>
            </TR>


        <?php 
            $n=0; 
            
            foreach($record->result() as $row) : 
                $n++;
        ?>
        <TR>
                <Td><?php echo $n; ?> </Td>
                <Td><?php echo $row->kendaraan_nopol; ?> </Td>
                <Td><?php echo $row->kendaraan_no_rangka."<br />".$row->kendaraan_no_bpkb; ?>  </Td>
<!--                 <Td><?php echo $row->kendaraan_no_bpkb; ?> </Td>
 -->                <Td><?php echo $row->kendaraan_pemilik; ?>  </Td>
                <Td><?php echo $row->kendaraan_pemilik_alamat; ?>  </Td>
                <Td><?php echo $row->kendaraan_tahun; ?>  </Td>
                <Td><?php echo $row->kendaraan_jenis ."".$row->kendaraan_model; ?>  </Td>
                <Td><?php echo $row->kendaraan_warna; ?>  </Td>
                <Td><?php echo $row->kendaraan_merk; ?>  </Td>
            </TR>

        <?php endforeach; ?>


        </table>


    </div>
</div>