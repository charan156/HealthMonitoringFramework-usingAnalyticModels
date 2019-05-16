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

mysql_select_db($database_hmsphp, $hmsphp);
$query_Doctorinfo = "SELECT * FROM doctors";
$Doctorinfo = mysql_query($query_Doctorinfo, $hmsphp) or die(mysql_error());
$row_Doctorinfo = mysql_fetch_assoc($Doctorinfo);
$totalRows_Doctorinfo = mysql_num_rows($Doctorinfo);
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
									<li></li>
									
								</ul>
							</div>
				<div class="section group">				
				<div class="col span_1_of_3">
					
				</div>				
				<div class="col span_2_of_3">
                <form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>WELCOME ADMIN!!</p>
  <style>
table, th, td {
    border: 1px solid black;
    padding: 5px;
}
table {
    border-spacing: 1px;
}
</style>
  <table>
    <tr>
      <td>Name</td>
      <td>Gender</td>
      <td>Specialization</td>
      <td>Phone no</td>
      <td>Age</td>
      <td>Designation</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Doctorinfo['Name']; ?></td>
        <td><?php echo $row_Doctorinfo['Gender']; ?></td>
        <td><?php echo $row_Doctorinfo['Specialization']; ?></td>
        <td><?php echo $row_Doctorinfo['Phone']; ?></td>
        <td><?php echo $row_Doctorinfo['Age']; ?></td>
        <td><?php echo $row_Doctorinfo['Designation']; ?></td>
      </tr>
      <?php } while ($row_Doctorinfo = mysql_fetch_assoc($Doctorinfo)); ?>
  </table>
<p>
<li><a href="adddoctor.php">Add</a></li>
<li><a href="updatedoctor.php">Update</a></li>
<li><a href="removedoctor.php">Remove</a></li>
    <p><br />
      <br />
    </p>
<p>&nbsp;</p>
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
</html>
<?php
mysql_free_result($Doctorinfo);
?>
