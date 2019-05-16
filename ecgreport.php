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
$query_Recordset2 = "SELECT PatientName, DoctorName, RR, QTinterval, P, PRinterval, PRsegment, QRS, STsegment, STinterval, Twave, Final FROM ecgdata";
$Recordset2 = mysql_query($query_Recordset2, $hmsphp) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);$colname_Recordset2 = "-1";
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset2 = $_SESSION['MM_Username'];
}
mysql_select_db($database_hmsphp, $hmsphp);
$query_Recordset2 = sprintf("SELECT PatientName, DoctorName, RR, QTinterval, P, PRinterval, PRsegment, QRS, STsegment, STinterval, Twave, Final FROM ecgdata WHERE DoctorName = %s", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $hmsphp) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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
									
								</ul>
			  </div>
				<div class="section group">				
				<div class="col span_1_of_3">
					
				</div>				
				<div class="col span_2_of_3">
                <form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <style>
table, th, td {
    border: 1px solid black;
    padding: 5px;
}
table {
    border-spacing: 1px;
}
</style>
  <table >
    <tr>
      <td>PatientName</td>
      <td>DoctorName</td>
      <td>RR</td>
      <td>QTinterval</td>
      <td>P (Value)</td>
      <td>PRinterval</td>
      <td>PRsegment</td>
      <td>QRS</td>
      <td>STsegment</td>
      <td>STinterval</td>
      <td>Twave</td>
      <td>Final</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset2['PatientName']; ?></td>
        <td><?php echo $row_Recordset2['DoctorName']; ?></td>
        <td><?php echo $row_Recordset2['RR']; ?></td>
        <td><?php echo $row_Recordset2['QTinterval']; ?></td>
        <td><?php echo $row_Recordset2['P']; ?></td>
        <td><?php echo $row_Recordset2['PRinterval']; ?></td>
        <td><?php echo $row_Recordset2['PRsegment']; ?></td>
        <td><?php echo $row_Recordset2['QRS']; ?></td>
        <td><?php echo $row_Recordset2['STsegment']; ?></td>
        <td><?php echo $row_Recordset2['STinterval']; ?></td>
        <td><?php echo $row_Recordset2['Twave']; ?></td>
        <td><?php echo $row_Recordset2['Final']; ?></td>    
      </tr>
      <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
  </table>
<p>&nbsp;</p>
<p><a href="prescription.php">Click Here to Upload Prescription For Abnormal Patients</a></p>
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
mysql_free_result($Recordset2);
?>
