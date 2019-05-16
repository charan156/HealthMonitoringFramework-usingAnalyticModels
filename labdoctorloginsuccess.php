
<!DOCTYPE HTML>
<html>
	<head>
	<title>GLOSYS HOSPITALS</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/responsiveslides.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		
	</head>
	<body>
		<!---start-wrap--->
		<div class="wrap">
			<!---start-header--->
			<div class="header">
				<!---start-logo--->
				<div class="logo">
					<a href="index.html"><img src="images/logo.png" /></a>
				</div>
				<!---start-logo--->
				<!---start-top-nav--->
				<div class="top-nav">
					
				</div>
				<div class="clear"> </div>
				<!---End-top-nav--->
			</div>
		</div>
			<!---End-header--->
			<!--start-image-slider---->
					<div class="image-slider">
						<!-- Slideshow 1 -->
					   
						 <!-- Slideshow 2 -->
					</div>
					<!--End-image-slider---->
		<!---start-content---->
		<div class="wrap">
		<div class="content">
			<div class="content-slogan">
				
		  </div>
			<div class="content-slogan">
					
					<p>^WELCOME TO GLOSYS^</p>
		  </div>
			<div class="clear"> </div>
			<div class="grids">
			  <div class="section group">
              <center>
				<div class="contact-form">
                <p align="right" style="font-family:'MS Serif', 'New York', serif";><a href="doctorpatientlogin.php">logout</a></p>
                <p style="font-family:'MS Serif', 'New York', serif";>CHOOSE AN OPTION:</p>
                <p style="font-family:'MS Serif', 'New York', serif";><strong>DATA ENTRY</strong></p>
					<form method="post" action="ecgdataentry.php" name="addnewpatient">
  <input name="addnewpatient" value="             ECG READINGS           " type="submit">
  </form>
  <br><br>
  <form method="post" action="thyroiddataentry.php" name="prescription">
  <input name="prescription" value="       THYROID READINGS        " type="submit">
  </form>
  <br><br>
  <form method="post" action="breastcancerdataentry.php" name="viewpatients">
  <input name="viewpatients" value="BREAST CANCER READINGS " type="submit">
  </form>
  <br><br>   
            <p><br>
            <p style="font-family:'MS Serif', 'New York', serif";><strong>DATA PREDICTIONS</strong></p>
                 
           		  <form action="weka/index.php">
       				  <input name="ECG Predictions" value="           ECG PREDICTIONS            " type="submit" > </p>
                  </form>  
                    <form action="weka1/index1.php">
                    <p><br>
       				  <input name="THYROID PREDICTIONS" value="        THYROID PREDICTIONS      " type="submit" > </p>
                  </form>  
                    <form action="weka2/index2.php">
                    <p><br>
       				  <input name="BREAST CANCER PREDICTIONS" value="BREAST CANCER PREDICTIONS" type="submit" > </p>
                  </form>  
				</div>
				<div class="contact-form">
               <p style="font-family:'MS Serif', 'New York', serif";><strong>RESULTS</strong></p>
					 <form method="post" action="ecgfinal.php" name="">
  <input name="ECG Results" value="ECG Results" type="submit">     
  </form>
  <br><br>
  <form method="post" action="thyroidfinal.php" name="">
  <input name="Thyroid Results" value="Thyroid Results" type="submit">     
  </form>
  <br><br>
  <form method="post" action="breastcancerfinal.php" name="">
  <input name="Breast Cancer Results" value="Breast Cancer Results" type="submit">     
  </form>
				</div>
			  </div>
			</div>
			</center>
		  <div class="clear"> </div>
			<div class="clear"> </div>
		  <div class="footer">
				<div class="footer-left">
					<a href="index.html"><img src="images/logo1.png" title="logo" /></a>
				</div>
				
				<div class="clear"> </div>
			</div>
		</div>
		<!---End-content---->
		</div>
		<!---start-wrap--->
	</body>
</html>

