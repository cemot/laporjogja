
<script type="text/javascript" src="<?php echo base_url("assets/tinymce/js/tinymce/tinymce.min.js"); ?>"></script>


<script type="text/javascript" src="<?php echo base_url("assets/tinymce/js/tinymce/jquery.tinymce.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/tinymce/js/tinymce/plugins/table/"); ?>/plugin.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/tinymce/js/tinymce/plugins/paste/"); ?>/plugin.min.js"></script>  

<script type="text/javascript">

</script>

<p>
</p>

<a href="javascript:perkembangan_baru();" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Tambah Perkembangan Kasus </a>
<a target="blank" href="<?php echo site_url("$this->controller/cetak_daftar_isi/$lap_b_id") ?>" class="btn btn-success"><span class="glyphicon glyphicon-print"></span>Cetak Daftar Isi </a>
<p></p>

<table width="100%"  border="0" class="table table-striped 
             table-bordered table-hover dataTable no-footer" id="grid_perkembangan" role="grid">
<thead>
  <tr style="background-color:#CCC">
        <th width="3%">NO.</th>
         <th width="10%">TANGGAL</th>
         <th width="10%">NO. URUT</th>
        <th width="10%">LIDIK/SIDIK</th>
        <th width="29%">TAHAP</th>
        <th width="19%">NO DOKUMEN</th>
       
        
        <th width="22%">KETERANGAN</th>
        <th width="22%">DOKUMEN</th>
        <th width="5%">#</th>
         
       
    </tr>
  
</thead>
</table>


<style type="text/css">
  
  #perkembangan_modal { overflow-y:scroll }
</style>

<div class="modal fade" id="perkembangan_modal" tabindex="-1" role="dialog" aria-labelledby="perkembangan_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titleModal">Tambah Penyidik</h4>
      </div>
      <div class="modal-body">
        
<form action="" id="formulir_perkembangan" method="post" enctype="multipart/form-data">
            <table width="100%"  class='table table-bordered'>
              
                <tr><td width="30%" >URUTAN</td>
              <TD>
            <!--  <input type="text" name="no_urut" id="no_urut" class="form-control" placeholder="Nomor urut jika tanggal sama "> -->
              <?php 
                $arr_urut = $this->cm->get_urutan();
                echo form_dropdown("no_urut",$arr_urut,'','class="form-control" id="no_urut"');

              ?>

               </TD></tr>


                <tr><td width="30%" >APAKAH DAPAT DITINGKATKAN KE PROSES PENYIDIKAN </td>
              <TD>
              <?php 
                $arr = array(
                    "TIDAK"=>"TIDAK","YA"=>"YA");
                echo form_dropdown("proses_penyidikan",$arr,'','id="proses_penyidikan" class="form-control"');
              ?>

               </TD></tr>


               
              <tr><td>Lidik / Sidik </td>
              <TD>
              <?php 
                $arr = array(
                    'x'=>"== PILIH ==",
                    1=>"Penyidikan",2=>"Penyelidikan");
                echo form_dropdown("lidik",$arr,'','id="lidik" class="form-control"');
              ?>

               </TD></tr>


            <tr><td  >Tahap Perkembangan </td>
              <TD>
              <?php 
                echo form_dropdown("id_tahap",array(),"",'id="id_tahap" class="form-control"');
              ?>

            </TD></tr>
            

            <tr><td  >Nomor Dokumen </td>
            <TD><input type="text" name="no_dokumen" id="no_dokumen" class="form-control" placeholder="Nomor Dokumen"></TD></tr>

            <tr><td  >Tanggal proses</td>
            <TD><input type="text" name="tanggal" id="tanggal" class="form-control tanggal" placeholder="Tangal Proses" data-date-format="dd-mm-yyyy"></TD></tr>

            <tr><td  >Keterangan</td>
            <TD><textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan"></textarea></TD></tr>

             <tr><td  >Pengadilan Negeri</td>
            <TD><?php 
            $arr_pn = $this->cm->get_arr_dropdown("m_pengadilan","id","pengadilan","pengadilan");
            $arr_pn = add_arr_head($arr_pn,"x","== PILIH PENGADILAN ==");

            echo form_dropdown("id_pn",$arr_pn,'','id="id_pn" class="form-control"');

            ?></TD></tr>


            <tr><td  >Lapas</td>
            <TD><?php 
            $arr_pn = $this->cm->get_arr_dropdown("m_lapas","id","lapas","lapas");
            $arr_pn = add_arr_head($arr_pn,"x","== PILIH LAPAS ==");

            echo form_dropdown("id_lapas",$arr_pn,'','id="id_lapas" class="form-control"');

            ?></TD></tr>


             <tr><td >Upload dokumen (max 2Mb) <br /> 
            hanya menerima extensi .jpg, .jpeg, .png, .pdf, .xlsx, .doc, .docx</td>
            <TD><input type="file" name="file_dokumen" id="file_dokumen"></TD></tr>


            <tr><td colspan="2">

            <div class="row">
              <div class="col-md-9">

               <div class="form-group">
                <label for="id_template">Pilih Template Dokumen</label>
                  <?php 
                  $arr_template = $this->cm->get_arr_dropdown("template_dokumen","id","nama","nama"); 

                  $arr_template = $this->cm->add_arr_head($arr_template,"x","= PILIH TEMPLATE DOKUMEN = "); 
                  echo form_dropdown("",$arr_template,'','id="id_template" class="form-control"');
                  ?>
    


              </div>
              </div>

             <!--   <div class="col-md-3">
              
              <div class="form-group">
                <label for="tombol">&nbsp; &nbsp;&nbsp;   </label><br />
                <button class="btn btn-primary" id="tombol">SIMPAN TEMPLATE </button>
              </div>
              
              </div> -->

            </div>

            Isi Dokumen : <br /> 
            <textarea id="isi" name="isi"></textarea>
            </td></tr>



               </table>
            <input type="hidden" name="id" value=""  id="id"  />   
            <input type="hidden" name="lap_b_id"  id="lap_b_id" value="<?php echo $lap_b_id; ?>"  /> 
            
             </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <!-- <button type="button" class="btn btn-primary" onclick="return perkembangan_simpan();"  >Simpan</button> -->
         <button type="button" class="btn btn-primary" onclick="return perkembangan_simpan();"  >Simpan</button>
      </div>
    </div>
  </div>
</div>





<div id="modal_nama" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">TEMPLATE BARU</h4>
      </div>
      <div class="modal-body">
        <p>
        <div class="form-group">
        <label>Masukkan nama Template</label>
        <input type="text" id="nama_template" class="form-control" /> 
        </div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="simpantemplate">Simpan</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->