<?php

$path = "./";
$files = scandir($path);
foreach($files as $f){
    $ext = strtolower(pathinfo($path . $f, PATHINFO_EXTENSION));
    if (in_array($ext, [ "jpg" , "jpeg" , "png" , "gif" , "svg" , "webp"]) ){
        print($f);
        print("<br>");
    }
    
}

