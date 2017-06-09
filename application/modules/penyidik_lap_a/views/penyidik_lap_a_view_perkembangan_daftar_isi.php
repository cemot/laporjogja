<html>
<body onload="window.print();">
<CENTER>
<H3><u>DAFTAR ISI</u> </H32>
</CENTER>
<p></p>

<ol>
<?php 
foreach($rec->result() as $row ) : 
	echo "<li>$row->tahap </li>"; 
endforeach;
?>
</ol>
</body>
</html>