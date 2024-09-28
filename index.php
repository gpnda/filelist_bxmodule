<?php

$path = "./";
$files = scandir($path);
foreach($files as $f){
    $ext = strtolower(pathinfo($path . $f, PATHINFO_EXTENSION));
    if (in_array($ext, [ "jpg" , "jpeg" , "png" , "gif" , "svg" , "webp"]) ){
        //print($f);
        $file = new SplFileInfo($path . $f);
        $modify_date = date('Y-m-d H:i:s', $file->getMTime());
        $filesize = $file->getSize();

        print("<pre>");
        printf("%-20.20s   %15s         [%s]", $path . $f , number_format($filesize, 0, ',', ' ') , $modify_date);
        print("</pre>");
    }
    
}

