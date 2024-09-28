<?php
namespace Bitrix\Img2Sitemap;

/**
 * 
 */
class Img2SM {

	
	public function print_sitemap()
	{
		$path = "./img_for_test/"; // путь до нужной папки в файловой системе. Последний слеш нужен!
		$uri = "/upload/img/"; // путь до папки от корневой папки домена, можно вычислять, но лучше прописать. Первый и последний слеш нужны!
		$protocol = "https://"; // протокол http/https
		$domain = $_SERVER['SERVER_NAME']; // определим домен

		// Получим список картинок
		$image_file_arr = get_image_list($path);

		// Сформируем sitemap.xml
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' 
			.'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

		foreach ($image_file_arr as $i) {
			$url = $xml->addChild("url");
			$url->addChild("loc", $protocol . $domain . $uri . $i["filename"]);
			$url->addChild("lastmod", $i["modify_date"]);
		}

		header('Content-type: text/xml');
		echo $xml->asXML();

	}

	// Функция получает ассоциативный массив с файлами картинок в указанной директории
	public function get_image_list($path) {
		$image_file_arr = [];
		$files = scandir($path);
		foreach($files as $f){
			$ext = strtolower(pathinfo($path . $f, PATHINFO_EXTENSION));
			if (in_array($ext, [ "jpg" , "jpeg" , "png" , "gif" , "svg" , "webp"]) ){
				$file = new SplFileInfo($path . $f);
				$modify_date = date('Y-m-d\TH:i:sP', $file->getMTime());
				// <lastmod>2024-05-28T14:06:42+03:00</lastmod>
				// <lastmod>2024-09-28CEST10:55:09+02:00</lastmod>
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

}

