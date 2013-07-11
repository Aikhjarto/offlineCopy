<?php

$f1="left.list"; # file that was produced with "find . > left.list" in source folder
$f2="right.list";# file that was produced with "find . > right.list" in destination folder

# folders on source machine
$prefixF1="/pub/Movies/Movies"; # should be the folder where "find ." was executed in source folder
$tmpFolderF1="/backup/tmp"; # folder on your external harddrive as mounted on the source machine


# folders on destination machine
$prefixF2="/pub/newMovies"; # should be the folder where "find ." was executed in destination folder
$tmpFolderF2="/backup/tmp"; # folder on your external harddrive as mounted on the destination machine

?>