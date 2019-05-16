<?php require_once('Connections/hmsphp.php'); ?><?php
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE doctors SET Gender=%s, Specialization=%s, Phone=%s, Age=%s, Designation=%s WHERE Name=%s",
                       GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['Specialization'], "text"),
                       GetSQLValueString($_POST['Phone'], "text"),
                       GetSQLValueString($_POST['Age'], "text"),
                       GetSQLValueString($_POST['Designation'], "text"),
                       GetSQLValueString($_POST['Name'], "text"));

  mysql_select_db($database_hmsphp, $hmsphp);
  $Result1 = mysql_query($updateSQL, $hmsphp) or die(mysql_error());

  $updateGoTo = "doctorinfo.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_hmsphp, $hmsphp);
$query_DetailRS1 = sprintf("SELECT * FROM doctors WHERE Name = %s", GetSQLValueString($colname_DetailRS1, "text"));
$DetailRS1 = mysql_query($query_DetailRS1, $hmsphp) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysql_num_rows($DetailRS1);
?><!DOCTYPE HTML>
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
				<div class="col span_2_of_3">
                <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
                <style>
table, th, td {
    border: 1px solid black;
    padding: 5px;
}
table {
    border-spacing: 1px;
}
</style>
  <table align="center">
  
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Name:</td>
      <td><?php echo $row_DetailRS1['Name']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gender:</td>
      <td><input type="text" name="Gender" value="<?php echo htmlentities($row_DetailRS1['Gender'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Specialization:</td>
      <td><input type="text" name="Specialization" value="<?php echo htmlentities($row_DetailRS1['Specialization'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phone:</td>
      <td><input type="text" name="Phone" value="<?php echo htmlentities($row_DetailRS1['Phone'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Age:</td>
      <td><input type="text" name="Age" value="<?php echo htmlentities($row_DetailRS1['Age'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Designation:</td>
      <td><input type="text" name="Designation" value="<?php echo htmlentities($row_DetailRS1['Designation'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="Name" value="<?php echo $row_DetailRS1['Name']; ?>" />
</form>
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
</html><?php
mysql_free_result($DetailRS1);
?>