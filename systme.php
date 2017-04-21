<?php 
$x="function() {var that = this;if (localStorage.demoData === undefined) {\$.getJSON('', function(data) {localStorage.demoData = JSON.stringify(data);data.forEach(function(item) {that.addOption(item);});});}else{JSON.parse(localStorage.demoData).forEach(function(item) {that.addOption(item);});}}";
?>

ini buat test saja. kalo 



apa lagi ya ? kok saya jadi bosan begini. 
