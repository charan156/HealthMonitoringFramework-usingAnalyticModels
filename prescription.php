<?php
error_reporting(0); // Turn off all error reporting
?>
<?php require_once('Connections/hmsphp.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO prescription (name, medicine, diagnosis, instructions, doc_name) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Medicine'], "text"),
                       GetSQLValueString($_POST['diagnosis'], "text"),
                       GetSQLValueString($_POST['instruction'], "text"),
                       GetSQLValueString($_POST['doc_name'], "text"));

  mysql_select_db($database_hmsphp, $hmsphp);
  $Result1 = mysql_query($insertSQL, $hmsphp) or die(mysql_error());

  $insertGoTo = "prescriptioncreated.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

error_reporting(0); // Turn off all error reporting
?>
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
									<li><a href="patientreport.php">Back</a></li>
									<li><p>Create Prescription</p></li>
								</ul>
			  </div>
				<div class="section group">				
				<div class="col span_1_of_3">
					
				</div>				
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>ENTER THE DETAILS TO ADD PRESCRIPTION</h3>
				    <form name="form" method="POST" action="<?php echo $editFormAction; ?>">
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input id="name" name="Name" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>Medicine</label></span>
						    	<span><input id="medicine" name="Medicine" type="text" class="textbox"></span>
						    </div>
                            <div>
						    	<span><label>Diagnosis</label></span>
						    	<span><input id="diagnosis" name="diagnosis" type="text" class="textbox"></span>
						    </div>
                            <div>
						    	<span><label>Instruction</label></span>
						    	<span><input id="instruction" name="instruction" type="text" class="textbox"></span>
						    </div>       
                             <div>
						    	<span><label>Doctor's(your) Name</label></span>
						    	<span><input id="doc_name" name="doc_name" type="text" class="textbox"></span>
						    </div>
						    
						   <div>
						   		<span><input type="submit" value="Create Prescription"></span>
						  </div>
						   <input type="hidden" name="MM_insert" value="form">
					    </form>

			      </div>
  				</div>				
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