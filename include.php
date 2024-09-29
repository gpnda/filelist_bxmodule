<?php

Bitrix\Main\Loader::registerAutoloadClasses(
	// имя модуля
	"img2sitemap",
	array(
		// ключ - имя класса с простанством имен, значение - путь относительно корня сайта к файлу
		"Gpnda\\Img2Sitemap\\Img2Sitemap" => "lib/img2sitemap.php",
		// файл инклудится за счет правильных имен, иначе будет ошибка при установке и удаленни модуля
		//"Hmarketing\\d7\\DataTable" => "lib/data.php",
	)
);


