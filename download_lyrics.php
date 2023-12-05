<?php
    // You can add extra codes to get your pdf file name here
    $LOGOS_DIR = "./lyrics";
    $lyrics_pdf = $_GET["lyricsPDF"];

    $file = $LOGOS_DIR."/".$lyrics_pdf;

    if (file_exists($file)) {
        header("Content-Description: File Transfer"); 
        header("Content-Type: application/octet-stream"); 
        header("Content-Disposition: attachment; filename=\"". basename($file) ."\""); 

        readfile ($file);
        exit(); 
    }
?>