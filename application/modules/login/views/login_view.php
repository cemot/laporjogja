
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>" />
    <title>SISTEM PENCATATAN LAPORAN POLISI &amp; PENYIDIKAN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url("assets") ?>/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url("assets") ?>/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <style type="text/css">
    body{padding-top:20px;}    </style>
   
<script src="<?php echo base_url("assets") ?>/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets") ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <script src="<?php echo base_url("assets") ?>/js/md5.js"></script>
   
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
         /* var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'http://bootsnipp.com');*/
		  $("#fm-login").submit(function(){
			  vuser = $("#username").val();
			  vpass = $.md5($("#password").val());
		  	  $.ajax({
				url : '<?php echo site_url("login/ceklogin"); ?>',
				type : 'post',
				dataType : 'json',
				data : { username: vuser, password : vpass },
				success : function(obj){
					//console.log(obj.error);
					if(obj.error==false){
						location.href=obj.url;
					}
					else {
						$("#salah").show();
					}
				}
				  
				});
			  
			  return false;
		  });
		  
        });
    </script>

<style type="text/css">
 
	
 body {
 	margin-top: 20px;
 	background-image: url('<?php echo base_url()."/assets/images/bg.jpg" ?>');
 	background-size: 80%;
 	width: 100%;
 }

/*#logo {
 	height: 70%;
    width: 70%;
}*/

#collogo {
display: block;  
  margin-right: auto;  
  margin-left: auto;  
  text-align: center;
}
#textlogo {
	text-align: center;
	color: white;
}

.txtbox {
  
   background-color:  rgba(255, 255, 255, 0.6);
   border:none;
   color: #000;

}

.txtbox::-webkit-input-pl	aceholder, .txtbox:-moz-placeholder
 {
	color: red;
}

</style>

</head>
<body>

<div class="row">
	<div class="col-md-5">
	</div>
    <div class="col-md-2" id="collogo">
    	<img align="center" id="logo" src="<?php echo base_url()."/assets/images/polda_diy.png" ?>" >


    </div>
</div>

<div class="row">
<div class="col-md-3">
	</div>
<div class="col-md-6" id="textlogo" >
<H4>LAPORAN POLISI </H4>
<H4>POLISI DAERAH DAERAH ISTIMEWA YOGYAKARTA</H4>
    	</div>
</div>



	<div class="container">
    <div class="row">
    </div>
    
    <p></p>
    <div class="row">
		<div class="col-md-4 col-md-offset-4">
    		 
			    	<form method="post" id="fm-login" accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">

			    		    <div class="input-group">
			    		    <span class="input-group-addon btn-default">
			    		    	<i class="fa fa-user"></i>
			    		    </span>
			    		    <input id="username" class="form-control txtbox input-lg" placeholder="Username" name="username" type="text">

			    		    </div>

			    		</div>
			    		<div class="form-group">

			    			<div class="input-group">
			    		    <span class="input-group-addon btn-default">
			    		    	<i class="fa fa-key"></i>
			    		    </span>
			    			<input class="form-control txtbox input-lg" placeholder="Password" name="password" type="password" value="" id="password">
			    			</div>
			    		</div>
			    		 

			    		<button type="submit"  class="btn btn-lg btn-default btn-block">
			    			<span class="fa fa-sign-in"></span>
			    		MASUK 
			    		</button>

			    		<!-- <input class="btn btn-lg btn-default btn-block" 
                        type="submit" value="MASUK"> -->
			    	 
			      	</form>
			 
		</div>
	</div>
    
  <div class="row">
  <div id="salah" class="col-md-4 col-md-offset-4" style="display:none">
            <div class="alert alert-danger" role="alert">
            	<strong>Gagal</strong> Username dan password salah
            </div>
        </div>
    </div>
    
</div>	<script type="text/javascript">
		</script>
</body>
</html>
