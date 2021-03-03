<?php
//This script cleans old temp PDF files from PDF folder.
$files = glob($_SERVER['DOCUMENT_ROOT']."/pdf/*"); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file)) {
    unlink($file); // delete file
  }
}
?>