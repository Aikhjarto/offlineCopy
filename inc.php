<?php
$ret=function getArraysFromSource() {
include 'settings.php'

$f1=fopen("left.list",'r');
$f2=fopen("right.list",'r');

# used for copyToTmp.php
$prefixF1="/pub/Movies/Movies"; # should be the folder where "find ." was executed
$tmpFolder="/backup/tmp";

echo "Reading file 1\n";
while (!feof($f1)) {
    $arr1[]=fgets($f1);
}

fclose($f1);

echo "Reading file 2\n";
while (!feof($f2)) {
  $arr2[]=fgets($f2);
}
fclose($f2);

echo "calculating left unique\n";
$uniqueInF1=array_diff($arr1,$arr2);
echo "calculating right unique\n";
$uniqueInF2=array_diff($arr2,$arr1);
echo "calculating intersection\n";
$double=array_intersect($arr1,$arr2);

sort($uniqueInF1); # sort ascending to make it easy creating directories prior files
rsort($uniqueInF2);# sort descending to make it easy to delete files prior directories (Hint: some files might be left)
sort($double);

return array($uniqueInF1,$uniqueInF2,$double);
}
?>