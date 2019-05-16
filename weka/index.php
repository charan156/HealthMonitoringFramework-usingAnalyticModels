<?php




$username="root";
  $password="";
  $server="localhost";
  $database="hms";

  $dbhandle=new mysqli($server,$username,$password,$database) or die('no database found');
  $dbfound=mysqli_select_db($dbhandle,$database) or die ('no connectivity found');
        






	

$result=$dbhandle->query("select * from ecgdata");
$bayesarff=fopen("ecggtest.arff", 'w');

$txt="@RELATION ecgdataset\n\n";
fwrite($bayesarff, $txt);
$txt="@ATTRIBUTE attribute_2 REAL
@ATTRIBUTE attribute_3 REAL
@ATTRIBUTE attribute_4 REAL
@ATTRIBUTE attribute_5 REAL
@ATTRIBUTE attribute_6 REAL
@ATTRIBUTE attribute_7 REAL
@ATTRIBUTE attribute_8 REAL
@ATTRIBUTE attribute_9 REAL
@ATTRIBUTE attribute_10 REAL
@ATTRIBUTE attribute_11 {abnormal,normal}\n\n\n@DATA\n";
fwrite($bayesarff, $txt);

	$txt="";
	//echo ">>>>".mysql_num_rows($result)."<<<<<";
while($row=$result->fetch_assoc())
{

//echo $row['attitude'];
$name[]=$row['PatientName'];
 
$txt=$row['RR'];  
$txt=$txt.",".$row['QTinterval'];
$txt=$txt.",".$row['P'];
$txt=$txt.",".$row['PRinterval'];
$txt=$txt.",".$row['PRsegment'];
$txt=$txt.",".$row['QRS'];
$txt=$txt.",".$row['STsegment'];
$txt=$txt.",".$row['STinterval'];
$txt=$txt.",".$row['Twave'];


$txt=$txt.",normal\n";
//echo $txt;
fwrite($bayesarff,$txt);
//echo $bayesarff;
$txt="";



}
//exec("");
fclose($bayesarff);
//$test=$courseid."_bayestest.arff";
echo "<a href='ecggtest.arff'>click here to view test set arff file</a>";
shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.bayes.NaiveBayes -t ecg.arff  -d bayes.model");
//move_uploaded_file('bayestest.arff', )
$output=shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.Evaluation weka.classifiers.bayes.NaiveBayes -l bayes.model -T ecggtest.arff -classifications weka.classifiers.evaluation.output.prediction.HTML");
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
$bayes[]=$predicted;
$sql="update ecgdata set SinusRhythm='".$predicted."' where PatientName='".$name[$j]."'"; 
$r=$dbhandle->query($sql);
$j++;

}
echo $output;

shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.trees.J48 -t ecg.arff  -d id3.model");
//move_uploaded_file('bayestest.arff', )
$output=shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.Evaluation weka.classifiers.trees.J48 -l id3.model -T ecggtest.arff -classifications weka.classifiers.evaluation.output.prediction.HTML");
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
$sql="update ecgdata set SinusRhythmID3='".$predicted."' where PatientName='".$name[$j]."'"; 
$r=$dbhandle->query($sql);
$j++;

}
echo $output;
shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.trees.RandomForest -t ecg.arff  -d random.model");
//move_uploaded_file('bayestest.arff', )
$output=shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.Evaluation weka.classifiers.trees.RandomForest -l random.model -T ecggtest.arff -classifications weka.classifiers.evaluation.output.prediction.HTML");
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
$sql="update ecgdata set SinusRhythmRandom='".$predicted."' where PatientName='".$name[$j]."'"; 
$r=$dbhandle->query($sql);
$j++;

}

echo $output;

for($k=0;$k<$j;$k++)
{
	$result=$dbhandle->query("select * from ecgdata where PatientName='".$name[$k]."'");
	$row=$result->fetch_assoc();
	$normal=0;
	$abnormal=0;
	if($row['SinusRhythm']=='normal')
	{
		$normal++;
		
	}
	else
	{
		$abnormal++;
	}
	if($row['SinusRhythmRandom']=='normal')
	{
		$normal++;
		
	}
	else
	{
		$abnormal++;
	}
	if($row['SinusRhythmID3']=='normal')
	{
		$normal++;
		
	}
	else
	{
		$abnormal++;
	}
if($normal>=2)
    {
	$result=$dbhandle->query("update ecgdata set Final='normal' where PatientName='".$name[$k]."'");
    
	}

if($abnormal>=2){
	$result=$dbhandle->query("update ecgdata set Final='abnormal' where PatientName='".$name[$k]."'");
    
	}
	
	
}







?>
