<P>
</P>
<?php
$arr = $this->cm->arr_status_kasus;

$arr_alasan = $this->cm->arr_alasan;
echo "STATUS KASUS : " . $arr[$penyelesaian];

if($penyelesaian=="dihentikan") {
  
  echo " DENGAN ALASAN : ". $arr_alasan[$alasan];
}

?>