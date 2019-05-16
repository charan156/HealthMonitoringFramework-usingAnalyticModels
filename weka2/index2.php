<?php




$username="root";
  $password="";
  $server="localhost";
  $database="hms";

  $dbhandle=new mysqli($server,$username,$password,$database) or die('no database found');
  $dbfound=mysqli_select_db($dbhandle,$database) or die ('no connectivity found');
        






	

$result=$dbhandle->query("select * from breastcancerdata");
$bayesarff=fopen("breasttest.arff", 'w');

$txt="@RELATION breast\n\n";
fwrite($bayesarff, $txt);
$txt="@ATTRIBUTE ClumpThickness REAL
@ATTRIBUTE UniformityOfCellSize REAL
@ATTRIBUTE UniformityOfCellShape REAL
@ATTRIBUTE MarginalAdhesion REAL
@ATTRIBUTE SingleEpithelialCellSize REAL
@ATTRIBUTE BareNuclei REAL
@ATTRIBUTE BlandChromatin REAL
@ATTRIBUTE NormalNucleoli REAL
@ATTRIBUTE Mitoses REAL
@ATTRIBUTE result {abnormal,normal}\n\n\n@DATA\n";
fwrite($bayesarff, $txt);

	$txt="";
	//echo ">>>>".mysql_num_rows($result)."<<<<<";
while($row=$result->fetch_assoc())
{

//echo $row['attitude'];
$name[]=$row['PatientName'];
 
$txt=$row['ClumpThickness'];  
$txt=$txt.",".$row['UniformityOfCellSize'];
$txt=$txt.",".$row['UniformityOfCellShape'];
$txt=$txt.",".$row['MarginalAdhesion'];
$txt=$txt.",".$row['SingleEpithelialCellSize'];
$txt=$txt.",".$row['BareNuclei'];
$txt=$txt.",".$row['BlandChromatin'];
$txt=$txt.",".$row['NormalNucleoli'];
$txt=$txt.",".$row['Mitoses'];


$txt=$txt.",normal\n";
//echo $txt;
fwrite($bayesarff,$txt);
//echo $bayesarff;
$txt="";



}
//exec("");
fclose($bayesarff);
//$test=$courseid."_bayestest.arff";
echo "<a href='breasttest.arff'>click here to view test set arff file</a>";
shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.bayes.NaiveBayes -t breast.arff  -d bayes.model");
//move_uploaded_file('bayestest.arff', )
$output=shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.Evaluation weka.classifiers.bayes.NaiveBayes -l bayes.model -T breasttest.arff -classifications weka.classifiers.evaluation.output.prediction.HTML");
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
$sql="update breastcancerdata set Result='".$predicted."' where PatientName='".$name[$j]."'"; 
$r=$dbhandle->query($sql);
$j++;

}
echo $output;

shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.trees.J48 -t breast.arff  -d id3.model");
//move_uploaded_file('bayestest.arff', )
$output=shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.Evaluation weka.classifiers.trees.J48 -l id3.model -T breasttest.arff -classifications weka.classifiers.evaluation.output.prediction.HTML");
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
$sql="update breastcancerdata set ResultID3='".$predicted."' where PatientName='".$name[$j]."'"; 
$r=$dbhandle->query($sql);
$j++;

}
echo $output;
shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.trees.RandomForest -t breast.arff  -d random.model");
//move_uploaded_file('bayestest.arff', )
$output=shell_exec("java -Xmx6g -cp weka.jar weka.classifiers.Evaluation weka.classifiers.trees.RandomForest -l random.model -T breasttest.arff -classifications weka.classifiers.evaluation.output.prediction.HTML");
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
$sql="update breastcancerdata set ResultRandom='".$predicted."' where PatientName='".$name[$j]."'"; 
$r=$dbhandle->query($sql);
$j++;

}

echo $output;

for($k=0;$k<$j;$k++)
{
	$result=$dbhandle->query("select * from  breastcancerdata where PatientName='".$name[$k]."'");
	$row=$result->fetch_assoc();
	$normal=0;
	$abnormal=0;
	if($row['Result']=='normal')
	{
		$normal++;
		
	}
	else
	{
		$abnormal++;
	}
	if($row['ResultID3']=='normal')
	{
		$normal++;
		
	}
	else
	{
		$abnormal++;
	}
	if($row['ResultRandom']=='normal')
	{
		$normal++;
		
	}
	else
	{
		$abnormal++;
	}
if($normal>=2)
    {
	$result=$dbhandle->query("update breastcancerdata set Final='normal' where PatientName='".$name[$k]."'");
    
	}

if($abnormal>=2){
	$result=$dbhandle->query("update breastcancerdata set Final='abnormal' where PatientName='".$name[$k]."'");
    
	}
	
	
}







?>
