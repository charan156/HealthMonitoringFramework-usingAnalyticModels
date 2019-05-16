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

$colname_filter = "-1";
if (isset($_GET['idname'])) {
  $colname_filter = $_GET['idname'];
}
mysql_select_db($database_hmsphp, $hmsphp);
$query_filter = sprintf("SELECT medicine, diagnosis, instructions, doc_name FROM prescription WHERE id = %s", GetSQLValueString($colname_filter, "int"));
$filter = mysql_query($query_filter, $hmsphp) or die(mysql_error());
$row_filter = mysql_fetch_assoc($filter);
$totalRows_filter = mysql_num_rows($filter);

$colname_patientdetails = "-1";
if (isset($_GET['iddetail'])) {
  $colname_patientdetails = $_GET['iddetail'];
}
mysql_select_db($database_hmsphp, $hmsphp);
$query_patientdetails = sprintf("SELECT name, age, gender, occupation FROM patients WHERE id = %s", GetSQLValueString($colname_patientdetails, "int"));
$patientdetails = mysql_query($query_patientdetails, $hmsphp) or die(mysql_error());
$row_patientdetails = mysql_fetch_assoc($patientdetails);
$totalRows_patientdetails = mysql_num_rows($patientdetails);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<meta id="_moz_html_fragment">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<div style="text-align: center;"><br>
<br>
<br>
<br>
<big><big>GLOSYS HOSPITALS<br>
<br>
<br>
</big></big>
<body style="background-image:url(background4.jpg);
background-size:cover"> 

<form id="form2" name="form2" method="get" action="">

  <p>
  <label for="iddetail">Enter Patient ID to view patient details: </label>
  <input type="text" name="iddetail" id="iddetail" />
  <br>
  <input type="submit" name="Submit" id="Submit" value="Submit" />
  </p>
  <center>
  <table border="1" cellpadding="1" cellspacing="1">
    <tr>
      <td>name</td>
      <td>age</td>
      <td>gender</td>
      <td>occupation</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_patientdetails['name']; ?></td>
        <td><?php echo $row_patientdetails['age']; ?></td>
        <td><?php echo $row_patientdetails['gender']; ?></td>
        <td><?php echo $row_patientdetails['occupation']; ?></td>
      </tr>
      <?php } while ($row_patientdetails = mysql_fetch_assoc($patientdetails)); ?>
  </table>
  </center>
</form>

<form id="form1" name="form1" method="get" action="">
  <p>
    <label for="idname">Enter Patient ID to view your prescription:</label>
    <input type="text" name="idname" id="idname" />
  </p>
  <p>
    <input type="submit" name="Submit" id="Submit" value="Submit" />
  </p>
  <p>&nbsp;</p>
  <center>
  <table border="2" cellpadding="1" cellspacing="1">
    <tr>
      <td>medicine</td>
      <td>diagnosis</td>
      <td>instructions</td>
      <td>doc_name</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_filter['medicine']; ?></td>
        <td><?php echo $row_filter['diagnosis']; ?></td>
        <td><?php echo $row_filter['instructions']; ?></td>
        <td><?php echo $row_filter['doc_name']; ?></td>
      </tr>
      <?php } while ($row_filter = mysql_fetch_assoc($filter)); ?>
  </table>
  </center>
</form>
<big><big><br>
</big></big></div>

<big><big><br>
</big></big></div>
</body>
</html>
<?php
mysql_free_result($filter);

mysql_free_result($patientdetails);
?>
