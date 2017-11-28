<?php
echo "<ul class='user-list'>";
foreach($peoples as $people){
     $data = unserialize($people['user_data']);
     $userdata = $data['userdata'];
     if(!empty($userdata['nama'])){


        if($userdata['jenis']=="polda") {
            $info = "POLDA D.I.Y";
        }
        else if($userdata['jenis']=="polres") {
            $info =  " POLISI "; //strtoupper($userdata['jenis']); 
            $info .= " ".$userdata['nama_polres'];
        }
        else {
            // $info =  strtoupper($userdata['jenis']); 
             $info =  " POLISI "; 
            $info .= " ".$userdata['nama_polsek'];
        }



          echo "<li><span>Nama: $userdata[nama] ($userdata[user_id]) , $info, Online dari IP: $people[ip_address]</span></li>";
     }
     else{
          echo "<li><span>Nama: Unkown, Nomor HP: Unkown, IP: $people[ip_address]</span></li>";
     }
}
echo "</ul>";
?>
<style>
ul.user-list li{
     color: #38d57a;
     list-style-type: disc;
     font-size: 36px;
}
ul.user-list li span {
    /* Text color */
    color: black;
    font-size: 16px;
}
</style>