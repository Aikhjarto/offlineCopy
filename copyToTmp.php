<?php

# This script takes two lists of folders/files produced by "find .". It produces:
#  a list fleft.txt which contains all files only present in the first input file,
#  a list fright.txt which contains all files only present in the right input file,
#  a list fdouble.txt which contains all files that are present in both lists.


# todo:
# get additional information about double files (filesize, timestamp, md5sum)
#  check for moved files with these additional information
# don't copy a folder, but create it only (problem if file is prior a folder: this could be overcome by sorting by alphabet)
#  if entry is a link, create a folder. Otherwise copy the file.

include 'inc.php';
include 'settings.php';

# get lists from input files
list($uniqueInF1,$uniqueInF2,$double)=getArraysFromSource();
#print_r($uniqueInF1);
#print_r($uniqueInF2);
#print_r($double);

# write lists to output file (just informational)
$fleft=fopen("fleft.txt",'w');
foreach ($uniqueInF1 as $file) {
  fputs($fleft,$prefixF1."/".substr($file,2,strlen($file)));
}
fclose($fleft);

$fright=fopen("fright.txt",'w');
foreach ($uniqueInF2 as $file) {
  fputs($fright,$file);
}
fclose($fright);

# estimate copy volume for left to right
$sum=0;
foreach ($uniqueInF1 as $file) {
  $fn=$prefixF1 . "/" . substr($file,2,strlen($file)-3);
  $sum=$sum+filesize($fn);
}
echo "Sum left=". $sum/1024/1024/1024 . "GB\n";

# estimate doubly present volume
$sum=0;
foreach ($double as $file) {
  $fn=$prefixF1 . "/" . substr($file,2,strlen($file)-3);
  $sum=$sum+filesize($fn);
}
echo "Sum double=". $sum/1024/1024/1024 . "GB\n";

# copy files
echo "start copying";
foreach ($uniqueInF1 as $file) {
  $src=$prefixF1 . "/" . substr($file,2,strlen($file)-3);
  $dst=$tmpFolder. "/" . substr($file,2,strlen($file)-3);
  echo "processing ".$src."\n";

  if (is_dir($src)) {
    # create folders (might me empty)
    echo "creating ".$dst."\n";
    exec('/usr/bin/mkdir -v -p "'.$dst.'"');
  }
  else  if (is_file($src)) {
    # copy files (folder might be already present in destination but not in temporary path)
    if (!is_dir(dirname($dst))) {
      exec('/usr/bin/mkdir -v -p "'.dirname($dst).'"');
    }
    exec('/usr/bin/rsync -av "'.$src.'" "'.$dst.'"');    
  }

}

?>