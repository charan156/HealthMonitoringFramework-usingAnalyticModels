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
if (!isset($_SESSION)) {
  session_start();
}
$maxRows_doctordetails = 10;
$pageNum_doctordetails = 0;
if (isset($_GET['pageNum_doctordetails'])) {
  $pageNum_doctordetails = $_GET['pageNum_doctordetails'];
}
$startRow_doctordetails = $pageNum_doctordetails * $maxRows_doctordetails;

$colname_doctordetails = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_doctordetails = $_SESSION['MM_Username'];
}
mysql_select_db($database_hmsphp, $hmsphp);
$query_doctordetails = sprintf("SELECT * FROM doctors WHERE Name = %s", GetSQLValueString($colname_doctordetails, "text"));
$query_limit_doctordetails = sprintf("%s LIMIT %d, %d", $query_doctordetails, $startRow_doctordetails, $maxRows_doctordetails);
$doctordetails = mysql_query($query_limit_doctordetails, $hmsphp) or die(mysql_error());
$row_doctordetails = mysql_fetch_assoc($doctordetails);

if (isset($_GET['totalRows_doctordetails'])) {
  $totalRows_doctordetails = $_GET['totalRows_doctordetails'];
} else {
  $all_doctordetails = mysql_query($query_doctordetails);
  $totalRows_doctordetails = mysql_num_rows($all_doctordetails);
}
$totalPages_doctordetails = ceil($totalRows_doctordetails/$maxRows_doctordetails)-1;
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
   <p align="right"><a href="Doctorlogin.php">Logout</a></p>
  <p>Your Details:</p>
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
      <td>Name</td>
      <td>Gender</td>
      <td>Specialization</td>
      <td>Phone</td>
      <td>Age</td>
      <td>Designation</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_doctordetails['Name']; ?></td>
        <td><?php echo $row_doctordetails['Gender']; ?></td>
        <td><?php echo $row_doctordetails['Specialization']; ?></td>
        <td><?php echo $row_doctordetails['Phone']; ?></td>
        <td><?php echo $row_doctordetails['Age']; ?></td>
        <td><?php echo $row_doctordetails['Designation']; ?></td>
      </tr>
      <?php } while ($row_doctordetails = mysql_fetch_assoc($doctordetails)); ?>
  </table>
<p><a href="patientreport.php">Click here to view Patient reports</a></p>
<p>&nbsp;</p>
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
mysql_free_result($doctordetails);
?>
