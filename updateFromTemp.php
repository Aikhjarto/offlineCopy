<?php

include 'inc.php';
include 'settings.php';

# get lists from input files
list($uniqueInF1,$uniqueInF2,$double)=getArraysFromSource();

  # how to treat symlinks???

# TODO: show filesize that will be freed
# TODO: implement a pause to avoid accidentely deleting files
# TODO: implement a recycle bin like behavior (move files rather than deleting)

# purge old files
foreach ($uniqueInF2 in $file) {
  $dst=$prefixF2. "/" . substr($file,2,strlen($file)-3);
  if (is_file($dst)) {
    unlink($dst);
  } else if (is_dir(dst)) {
    rmdir($dst); # removes folder if empty (ensure propper sorting of $uniqueInF2 to ensure all files are deleted in prior iterations of the loop)
  }
}

#copy new files
foreach ($uniqueInF1 in $file) {
  $src=$tmpFolderF1 . "/" . substr($file,2,strlen($file)-3);
  $dst=$prefixF1. "/" . substr($file,2,strlen($file)-3);
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