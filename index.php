<?php

$path = "./"; // путь до нужной папки в файловой системе
$uri = "/upload/img/"; // путь до папки от корневой папки домена, можно вычислять, но лучше прописать
$protocol = "https://"; // протокол http/https
$domain = $_SERVER['SERVER_NAME']; // определим домен

// Получим список картинок
$image_file_arr = get_image_list($path);

// Сформируем sitemap.xml
$xml = new SimpleXMLElement('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

foreach ($image_file_arr as $i) {
    $url = $xml->addChild("url");
    $url->addChild("loc", $protocol . $domain . $uri . $i["filename"]);
    $url->addChild("lastmod", $i["modify_date"]);
}

header('Content-type: text/xml');
echo $xml->asXML();




// Функция получает ассоциативный массив с файлами картинок в указанной директории
function get_image_list($path) {
    $image_file_arr = [];
    $files = scandir($path);
    foreach($files as $f){
        $ext = strtolower(pathinfo($path . $f, PATHINFO_EXTENSION));
        if (in_array($ext, [ "jpg" , "jpeg" , "png" , "gif" , "svg" , "webp"]) ){
            //print($f);
            $file = new SplFileInfo($path . $f);
            $modify_date = date('Y-m-d H:i:s', $file->getMTime());
            $filesize = $file->getSize();

            $image_file_arr[] = [
                "filename" => $f ,
                "size" => $filesize ,
                "modify_date" => $modify_date ,
            ];

        }
        
    }

    return $image_file_arr;
}

