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
  $insertSQL = sprintf("INSERT INTO thyroiddata (PatientName, DoctorName, TSH, FT4, FT3, `Result`) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['PatientName'], "text"),
                       GetSQLValueString($_POST['DoctorName'], "text"),
                       GetSQLValueString($_POST['TSH'], "text"),
                       GetSQLValueString($_POST['FT4'], "text"),
                       GetSQLValueString($_POST['FT3'], "text"),
                       GetSQLValueString($_POST['Result'], "text"));

  mysql_select_db($database_hmsphp, $hmsphp);
  $Result1 = mysql_query($insertSQL, $hmsphp) or die(mysql_error());

  $insertGoTo = "labdoctorloginsuccess.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_hmsphp, $hmsphp);
$query_Recordset1 = "SELECT * FROM thyroiddata";
$Recordset1 = mysql_query($query_Recordset1, $hmsphp) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
								  <li><p>&nbsp;</p></li>
								</ul>
			  </div>
				<div class="section group">				
				<div class="col span_1_of_3">
					
				</div>				
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>ENTER THE thyroid DETAILS </h3>
				    <form name="form" method="POST" action="<?php echo $editFormAction; ?>">
					    	<div>PatientName<span>
					    	<input id="PatientName" name="PatientName" type="text" class="textbox"></span>
						    </div>
						    <div>
					    	  <span>
					    	  <label>DoctorName</label></span>
						    	<span><input id="DoctorName" name="DoctorName" type="text" class="textbox"></span>
						    </div>
                            <div>
					    	  <span>
					    	  <label>TSH</label></span>
						    	<span><input id="TSH" name="TSH" type="text" class="textbox"></span>
						    </div>
                            <div>
						    	<span>
						    	<label>FT4</label></span>
						    	<span><input id="FT4" name="FT4" type="text" class="textbox"></span>
						    </div>       
                             <div>
					    	   <span>
					    	   <label>FT3</label></span>
						    	<span><input id="FT3" name="FT3" type="text" class="textbox"></span>
						    </div>
                             <div>
						    	<span>
						    	<label>Result</label></span>
						    	<span><input id="Result" name="Result" type="text" class="textbox"></span>
						    </div>                        
                            
						   <div>
						   		<span><input type="submit" value="SUBMIT"></span>
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
<?php
mysql_free_result($Recordset1);
?>
