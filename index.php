<?php

$path = "./"; // путь до нужной папки в файловой системе
$uri = "/upload/img/"; // путь до папки от корневой папки домена, можно вычислять, но лучше прописать
$protocol = "https://"; // Протокол по которому нормально открываются картинки
$domain = $_SERVER['SERVER_NAME']; // Определим домен

$image_file_arr = get_image_list($path);

// Напишем "в лоб"
$xml = new SimpleXMLElement('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

foreach ($image_file_arr as $i) {
    $url = $xml->addChild("url");
    $url->addChild("loc", $protocol . $domain . $uri . $i["filename"]);
    $url->addChild("lastmod", $i["modify_date"]);
}

header('Content-type: text/xml');
echo $xml->asXML();




// Функция получает ассоциативный массив с файлами картинок в указанной дирректории
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

            // тестовый вывод одного файла
            // print("<pre>");
            // printf("%-20.20s   %15s         [%s]", $path . $f , number_format($filesize, 0, ',', ' ') , $modify_date);
            // print("</pre>");
        }
        
    }

    // тут массив уже готов
    // print("<pre>");
    // print_r($image_file_arr);
    // print("</pre>");
    return $image_file_arr;
}





// Через array_walk_recursive() так тоже можно, но будет хуже читаться
//
// print("<pre>");
// $xml = new SimpleXMLElement('<root/>');
// array_walk_recursive($image_file_arr, array ($xml, 'addChild'));
// print $xml->asXML();
// print("</pre>");




// Можно свою функцию рекурсивного обхода массива сделать, тут есть пример
// Но тоже читаться будет хуже
//
// source: https://stackoverflow.com/questions/1397036/how-to-convert-array-to-simplexml
// // function defination to convert array to xml
// function array_to_xml( $data, &$xml_data ) {
//     foreach( $data as $key => $value ) {
//         if( is_array($value) ) {
//             if( is_numeric($key) ){
//                 $key = 'item'.$key; //dealing with <0/>..<n/> issues
//             }
//             $subnode = $xml_data->addChild($key);
//             array_to_xml($value, $subnode);
//         } else {
//             $xml_data->addChild("$key",htmlspecialchars("$value"));
//         }
//      }
// }
