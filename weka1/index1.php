<?php




$username="root";
  $password="";
  $server="localhost";
  $database="hms";

  $dbhandle=new mysqli($server,$username,$password,$database) or die('no database found');
  $dbfound=mysqli_select_db($dbhandle,$database) or die ('no connectivity found');
        






	

$result=$dbhandle->query("select * from thyroiddata");
$bayesarff=fopen("thyroidtest.arff", 'w');

$txt="@RELATION thyroid\n\n";
fwrite($bayesarff, $txt);
$txt="@ATTRIBUTE tsh REAL
@ATTRIBUTE ft4 REAL
@ATTRIBUTE ft3 REAL
@ATTRIBUTE result {hyper,hypo,normal}\n\n\n@DATA\n";
fwrite($bayesarff, $txt);

	$txt="";
	//echo ">>>>".mysql_num_rows($result)."<<<<<";
while($row=$result->fetch_assoc())
{

//echo $row['attitude'];
$name[]=$row['PatientName'];
 
$txt=$row['TSH'];  
$txt=$txt.",".$row['FT4'];
$txt=$txt.",".$row['FT3'];



$txt=$txt.",normal\n";
//echo $txt;
fwrite($bayesarff,$txt);
//echo $bayesarff;
$txt="";



}
//exec("");
fclose($bayesarff);
//$test=$courseid."_bayestest.arff";
echo "<a href='thyroidtest.arff'>click here to view test set arff file</a>";
shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.bayes.NaiveBayes -t thyroid.arff -d bayes.model");
//move_uploaded_file('bayestest.arff', )
$output=shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.Evaluation weka.classifiers.bayes.NaiveBayes -l bayes.model -T thyroidtest.arff -classifications weka.classifiers.evaluation.output.prediction.HTML");

$outpu=explode('<td>',$output);
$k=count($outpu);
$j=0;
//explode(':', $output);
for($i=8;$i<$k;$i=$i+4)

{
 echo "\n";

 $a=explode(':',$outpu[$i]) ;
//$collection=$db->$mm;
$predicted=end($a);
$predicted=explode('</td>',$predicted);
$predicted=$predicted[0];
$bayes[]=$predicted;
$sql="update thyroiddata set Result='".$predicted."' where PatientName='".$name[$j]."'"; 
$r=$dbhandle->query($sql);
$j++;

}
echo $output;

shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.trees.J48 -t thyroid.arff -d id3.model");
//move_uploaded_file('bayestest.arff', )
$output=shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.Evaluation weka.classifiers.trees.J48 -l id3.model -T thyroidtest.arff -classifications weka.classifiers.evaluation.output.prediction.HTML");
//$mm="output_".$courseid;
//$array=str_split($output);
$outpu=explode('<td>',$output);
$k=count($outpu);
$j=0;
//explode(':', $output);
for($i=8;$i<$k;$i=$i+4)

{
 echo "\n";

 $a=explode(':',$outpu[$i]) ;
//$collection=$db->$mm;
$predicted=end($a);
$predicted=explode('</td>',$predicted);
$predicted=$predicted[0];
$random[]=$predicted;
$sql="update thyroiddata set ResultID3='".$predicted."' where PatientName='".$name[$j]."'"; 
$r=$dbhandle->query($sql);
$j++;

}
echo $output;
shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.trees.RandomForest -t thyroid.arff  -d random.model");
//move_uploaded_file('bayestest.arff', )
$output=shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.Evaluation weka.classifiers.trees.RandomForest -l random.model -T thyroidtest.arff -classifications weka.classifiers.evaluation.output.prediction.HTML");
//$mm="output_".$courseid;
//$array=str_split($output);
$outpu=explode('<td>',$output);
$k=count($outpu);
$j=0;
//explode(':', $output);
for($i=8;$i<$k;$i=$i+4)

{
 echo "\n";

 $a=explode(':',$outpu[$i]) ;
//$collection=$db->$mm;
$predicted=end($a);
$predicted=explode('</td>',$predicted);
$predicted=$predicted[0];
$id3[]=$predicted;
$sql="update thyroiddata set ResultRandom='".$predicted."' where PatientName='".$name[$j]."'"; 
$r=$dbhandle->query($sql);
$j++;

}

echo $output;

for($k=0;$k<$j;$k++)
{
	$result=$dbhandle->query("select * from  thyroiddata where PatientName='".$name[$k]."'");
	$row=$result->fetch_assoc();
	$normal=0;
	$hypo=0;
	$hyper=0;
	if($row['Result']=='normal')
	{
		$normal++;
		
	}
	else if($row['Result']=='hypo')
	{
		$hypo++;
	}
	else
	{
		$hyper++;
	}
	if($row['ResultID3']=='normal')
	{
		$normal++;
		
	}
	else if($row['ResultID3']=='hypo')
	{
		$hypo++;
	}
	else
	{
		$hyper++;
	}
	if($row['ResultRandom']=='normal')
	{
		$normal++;
		
	}
	else if($row['ResultRandom']=='hypo')
	{
		$hypo++;
	}
	else
	{
		$hyper++;
	}
if($normal>=2)
    {
	$result=$dbhandle->query("update thyroiddata set Final='normal' where PatientName='".$name[$k]."'");
    
	}

if($hypo>=2)
{
	$result=$dbhandle->query("update thyroiddata set Final='hypo' where PatientName='".$name[$k]."'");
    
	}
	
	if($hyper>=2)
	{
	$result=$dbhandle->query("update thyroiddata set Final='hyper' where PatientName='".$name[$k]."'");
     }
}
?>