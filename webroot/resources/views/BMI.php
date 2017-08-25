<form action="" method="post">
Height:<input type=text name="height" maxlength=3 size=3> cm<p>
Weight:<input type=text name="weight" maxlength=3 size=3> kg<p>
<input type=submit name=OK value="BMI">
</form>

<?php
if($_POST['OK'])
{
	$heights=$_POST['height'];
	$weights=$_POST['weight'];
	$result1=$heights/100;
	$result2=$result1*$result1;
	$BMI1=$weights/$result3;
	$BMI=round($BMI1, 1);
	echo "<p>Height ".$heights." cm, Weight ".$weights." kg, Value of BMI".$BMI."";
}

?>