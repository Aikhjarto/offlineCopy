<?php

include 'inc.php';
include 'settings.php';

# get lists from input files
list($uniqueInF1,$uniqueInF2,$double)=getArraysFromSource();

foreach ($uniqueInF2 in $file) {
  $dst=$prefixF2. "/" . substr($file,2,strlen($file)-3);
  if (is_file($dst)) {
    unlink($dst);
  } else if (is_dir(dst)) {
    rmdir($dst); # removes folder if empty (ensure propper sorting of $uniqueInF2 to ensure all files are deleted in prior iterations of the loop)
  }
  # how to treat symlinks???
}

?>