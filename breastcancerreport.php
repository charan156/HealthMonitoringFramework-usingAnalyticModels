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
$query_Recordset1 = "SELECT PatientName, DoctorName, ClumpThickness, UniformityOfCellSize, UniformityOfCellShape, MarginalAdhesion, SingleEpithelialCellSize, BareNuclei, BlandChromatin, NormalNucleoli, Mitoses, Final FROM breastcancerdata";
$Recordset1 = mysql_query($query_Recordset1, $hmsphp) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);$colname_Recordset1 = "-1";
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_hmsphp, $hmsphp);
$query_Recordset1 = sprintf("SELECT PatientName, DoctorName, ClumpThickness, UniformityOfCellSize, UniformityOfCellShape, MarginalAdhesion, SingleEpithelialCellSize, BareNuclei, BlandChromatin, NormalNucleoli, Mitoses, Final FROM breastcancerdata WHERE DoctorName = %s", GetSQLValueString($colname_Recordset1, "text"));
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
      <td>ClumpThickness</td>
      <td>UniformityOfCellSize</td>
      <td>UniformityOfCellShape</td>
      <td>MarginalAdhesion</td>
      <td>SingleEpithelialCellSize</td>
      <td>BareNuclei</td>
      <td>BlandChromatin</td>
      <td>NormalNucleoli</td>
      <td>Mitoses</td>
      <td>Final</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['PatientName']; ?></td>
        <td><?php echo $row_Recordset1['DoctorName']; ?></td>
        <td><?php echo $row_Recordset1['ClumpThickness']; ?></td>
        <td><?php echo $row_Recordset1['UniformityOfCellSize']; ?></td>
        <td><?php echo $row_Recordset1['UniformityOfCellShape']; ?></td>
        <td><?php echo $row_Recordset1['MarginalAdhesion']; ?></td>
        <td><?php echo $row_Recordset1['SingleEpithelialCellSize']; ?></td>
        <td><?php echo $row_Recordset1['BareNuclei']; ?></td>
        <td><?php echo $row_Recordset1['BlandChromatin']; ?></td>
        <td><?php echo $row_Recordset1['NormalNucleoli']; ?></td>
        <td><?php echo $row_Recordset1['Mitoses']; ?></td>
        <td><?php echo $row_Recordset1['Final']; ?></td>    
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
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
mysql_free_result($Recordset1);
?>
