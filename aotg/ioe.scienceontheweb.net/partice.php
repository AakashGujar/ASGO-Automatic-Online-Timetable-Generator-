<?php
//het alorithm
$y=array();
$m=array();
$value="HET G SHETH";
$d = strlen($value);
$data = $value;
$n=0;
for($i=0;$i<$d;)
{
	$gh=substr($data,$i,1);
	$m[$i]=$gh;
	$i++;
}
for($j=0;$j<$d;)
{
	$tr=$m[$j];
for($i=32;$i<127;)
{
$k=chr($i);	
if (strpos($tr , $k) === false) {
}else{
	$ym=3+$i;
	$jh=chr($ym);
	$y[$j]=str_replace($k, $jh, $tr);
	echo $y[$j];
}
$i++;
}
$j++;
}
$g=array();
for($j=0;$j<$d;)
{
	$tr=$m[$j];
for($i=32;$i<127;)
{
$k=chr($i);	
if (strpos($tr , $k) === false) {
}else{
	$ym=$i-3;
	$jh=chr($ym);
	$g[$j]=str_replace($jh,$k, $tr);
	echo $g[$j];
}
$i++;
}
$j++;
}

?>
