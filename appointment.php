<!DOCTYPE HTML>
<html>
	<head>
	<title>GLOSYS HOSPITALS</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	</head>
	<body>
		<!---start-wrap--->
		<div class="wrap">
			<!---start-header--->
			<div class="header">
				<!---start-logo--->
				<div class="logo">
					<img src="images/logo.png" />
				</div>
				<!---start-logo--->
				<!---start-top-nav--->
				<div class="top-nav">
					<ul>
						
					</ul>
				</div>
				<div class="clear"> </div>
				<!---End-top-nav--->
			</div>
		</div>
			<!---End-header--->
		<!---start-content---->
		<div class="wrap">
		<div class="content">
			<div class="clear"> </div>
			<div class="contact">
				<div class="project-top-patination">
								<ul>
									<li></li>
									
								</ul>
							</div>
				<div class="section group">				
				<div class="col span_1_of_3">
					
				</div>				
				<div class="col span_2_of_3"></div>	
               <center> <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <p>
    <label for="fullname">Full Name</label>
    <input type="text" name="fullname" id="fullname" />
  </p>
  <p>
    <label for="phone">Phone no.</label>
    <input type="text" name="phone" id="phone" /></p>
  <p>
    <label for="time">Time (10AM to 8PM)</label>
    <input type="text" name="time" id="time" />
  </p>
  <p>
    <label for="date">Date(dd-mm-yy)</label>
    <input type="text" name="date" id="date" />
  </p>
  <p>Description</p>
  <p>
    <textarea name="description" id="description" cols="45" rows="5"></textarea>
  </p>
  <p>
    <input type="submit" name="BookAppointment" id="BookAppointment" value="Book Appointment" />
  </p>
  <input type="hidden" name="MM_insert" value="form1" />
</form>			</center>
			  </div>
			</div>
			<div class="clear"> </div>
			<div class="footer">
				<div class="footer-left">
					<img src="images/logo1.png" title="logo" />
				</div>
				
				<div class="clear"> </div>
			</div>
		</div>
		<!---End-content---->
		</div>
		<!---start-wrap--->
	</body>
</html>