offlineCopy
===========

This set of scripts enables a simple sync of a foldertree (with the files of course) if the source and the destination are not accessible at the same time.
This can be if, e.g.,
* you are on journey with your laptop and have no internet connection
* you only have limited internet bandwidth 
* ...

In either case you need a "find ." dump of your destination filesystem and an moveable temp-directory (e.g. on an external harddisk or an thumbdrive).

Usage
=====
* use "find . > left.list" in source folder
* use "find . > right.list" in destination folder
* adjust settings,php that 
** $prefixF1 points to source folder (only needed for  creation of temp folder on source machine)
** $prefixF2 points to destination folder  (only needed for applying temp folder to destination on target machine)
** $tmpFolder to point to a folder on your external harddisk/thumbdrive 
* run "php copyToTmp.php" to copy missing files to temp
* move external harddisk to destination computer
* run "php applyTemp.php" 

Best practice is to keep left.list and right.list as well as these scripts on your external drive.

Prerequisites
=============
* PHP 4 or 5
* a ```mkdir``` that understands the recursive parameter "-p" (should be available in any linux distribution)
* rsync
