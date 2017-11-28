<?php
echo "<ul class='user-list'>";
foreach($peoples as $people){
     $data = unserialize($people['user_data']);
     $userdata = $data['userdata'];
     if(!empty($userdata['nama'])){
          echo "<li><span>Nama: $userdata[nama], Nomor HP: $userdata[nomor_hp], IP: $people[ip_address]</span></li>";
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