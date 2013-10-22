<?php

include_once 'config.php';

// Set the output file
$filename = date('Y-m-d').'-backup.sql.gz';
$path = rtrim(getenv('SCRIPT_FILENAME'),'dbdump.php').'data/';
$location = $path.$filename;

// Instructing the system to zip and store the database
system(sprintf(
  'mysqldump --opt -h%s -u%s -p%s %s | gzip > %s',
  DB_SERVER, DB_USER, DB_PASS, DB_NAME, $location
));

header('Location: data/'.$filename);

?>